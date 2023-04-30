<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Antecedente;
use App\Models\Ginecostetrico;
use App\Models\PaciAnte;
use App\Models\Paciente;
use App\Models\PaciVacuna;
use App\Models\Peso;
use App\Models\Tipaje;
use App\Models\Vacuna;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class PacientesComponent extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'confirmed', 'buscar',
        'limpiarAntecedentes', 'confirmedAntecedente',
        'limpiarGinecostetricos', 'confirmedGinecostetrico',
        'limpiarVacunas', 'confirmedVacuna'
    ];

    public $view, $btn_nuevo = true, $btn_cancelar = false, $footer = false, $btn_editar = false, $new_paciente = false;
    public $cedula, $nombre, $fechaNac, $edad, $telefono, $direccion, $fur, $fpp, $gestas, $partos, $cesarias, $abortos,
        $grupo, $paciente_id, $getPaciente, $getEdad, $keyword;
    public $peso_fecha, $peso_kg, $peso_id, $getPeso, $labelPeso = "Nuevo";
    public $ante_nombre, $ante_familiares = false, $ante_personales = false, $ante_otros = false, $antecedente_id,
            $keywordAntecedentes;
    public $form_personales = false, $form_familiares = false, $form_otros = false,
            $pa_antecedentes_id, $paValor, $pa_detalles, $pa_id, $pa_familiares, $pa_personales, $pa_otros,
            $pa_tipo, $pa_label_fa, $pa_label_pe = true, $pa_label_ot;
    public $keywordGinecostetricos, $gine_nombre, $ginecostetrico_id;
    public $keywordVacunas, $vacu_nombre, $vacuna_id;
    public $pv_listar, $pv_vacuna_id, $pv_dosis_1, $pv_dosis_2, $pv_refuerzo, $pv_label_va = true, $pv_label_ti,
            $form_vacunas = false, $pv_id;
    public $form_tipaje = false, $tipaje_id, $pt_madre, $pt_padre, $pt_sensibilidad;

    public function render()
    {
        $pacientes = Paciente::buscar($this->keyword)->orderBy('cedula', 'ASC')->paginate(30);
        $rows = Paciente::count();
        $antecedentes = Antecedente::buscar($this->keywordAntecedentes)->get();
        $rowsAntecedentes = Antecedente::count();
        $ginecostetricos = Ginecostetrico::buscar($this->keywordGinecostetricos)->get();
        $rowsGinecostetricos = Ginecostetrico::count();
        $vacunas = Vacuna::buscar($this->keywordVacunas)->get();
        $rowsVacunas = Vacuna::count();
        return view('livewire.dashboard.pacientes-component')
            ->with('listarPacientes', $pacientes)
            ->with('rows', $rows)
            ->with('listarAntecedentes', $antecedentes)
            ->with('rowsAntecedentes', $rowsAntecedentes)
            ->with('listarGinecostetricos', $ginecostetricos)
            ->with('rowsGinecostetricos', $rowsGinecostetricos)
            ->with('listarVacunas', $vacunas)
            ->with('rowsVacunas', $rowsVacunas)
            ;
    }

    // ************************************* PACIENTES *******************************************************************

    public function limpiarPacientes()
    {
        $this->reset([
            'view', 'btn_nuevo', 'btn_cancelar', 'footer', 'btn_editar', 'keyword',
            'cedula', 'nombre', 'fechaNac', 'edad', 'telefono', 'direccion', 'fur', 'fpp', 'gestas', 'partos', 'cesarias',
            'abortos', 'grupo'
        ]);
    }

    public function create()
    {
        $this->limpiarPacientes();
        $this->reset(['paciente_id']);
        $this->new_paciente = true;
        $this->btn_nuevo = false;
        $this->btn_cancelar = true;
        $this->view = "form";
    }

    public function updatedFechaNac()
    {
        $edad = Carbon::create($this->fechaNac)->age;
        $this->edad = $edad;
    }

    public function savePacientes()
    {
        $rules = [
            'nombre'    => 'required|min:4',
            'cedula'    =>  ['required', 'min:7', Rule::unique('pacientes', 'cedula')->ignore($this->paciente_id)],
            'fechaNac'  => 'required_without:edad',
            'edad'      => 'required_without:fechaNac|numeric|gte:0',
            'telefono'  => 'required|min:10',
            'gestas'    => 'nullable|numeric|gte:0',
            'partos'    => 'nullable|numeric|gte:0',
            'cesarias'    => 'nullable|numeric|gte:0',
            'abortos'    => 'nullable|numeric|gte:0',
        ];
        $this->validate($rules);
        $message = null;
        if (is_null($this->paciente_id)){
            //nuevo
            $paciente = new Paciente();
        }else{
            //editar
            $paciente = Paciente::find($this->paciente_id);
        }
        $paciente->cedula = $this->cedula;
        $paciente->nombre = $this->nombre;
        if (!empty($this->fechaNac)){
            $paciente->fecha_nac = $this->fechaNac;
        }
        if (!empty($this->edad)){
            $paciente->edad = $this->edad;
        }
        $paciente->telefono = $this->telefono;
        $paciente->direccion = $this->direccion;
        $paciente->fur = $this->fur;
        $paciente->fpp = $this->fpp;
        $paciente->gestas = $this->gestas;
        $paciente->partos = $this->partos;
        $paciente->cesarias = $this->cesarias;
        $paciente->abortos = $this->abortos;
        $paciente->grupo = $this->grupo;

        $paciente->save();
        $this->showPacientes($paciente->id);
        $this->btnPeso();
        $this->alert(
            'success',
            'Guardado.'
        );

    }

    public function showPacientes($id)
    {
        $this->limpiarPacientes();
        $this->getPaciente = Paciente::find($id);
        $this->paciente_id = $this->getPaciente->id;
        if (is_null($this->getPaciente->edad)){
            $this->getEdad = Carbon::create($this->getPaciente->fecha_nac)->age;
        }else{
            $this->getEdad = $this->getPaciente->edad;
        }
        $this->btn_editar = true;
        $this->view = "show";
        $this->footer = true;
    }

    public function edit()
    {
        $paciente = Paciente::find($this->paciente_id);
        $this->nombre = $paciente->nombre;
        $this->cedula = $paciente->cedula;
        $this->fechaNac = $paciente->fecha_nac;
        $this->edad = $paciente->edad;
        $this->telefono = $paciente->telefono;
        $this->direccion = $paciente->direccion;
        $this->grupo = $paciente->grupo;
        $this->fur = $paciente->fur;
        $this->fpp = $paciente->fpp;
        $this->gestas = $paciente->gestas;
        $this->partos = $paciente->partos;
        $this->cesarias = $paciente->cesarias;
        $this->abortos = $paciente->abortos;
        $this->btn_cancelar = true;
        $this->btn_editar = false;
        $this->btn_nuevo = false;
        $this->footer = false;
        $this->view = "form";
    }

    public function btnCancelar()
    {
        if ($this->paciente_id){
            $this->showPacientes($this->paciente_id);
        }else{
            $this->limpiarPacientes();
            $this->reset('new_paciente');
        }
    }

    public function destroy()
    {
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' =>  '¡Sí, bórralo!',
            'text' =>  '¡No podrás revertir esto!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function confirmed()
    {
        $paciente = Paciente::find($this->paciente_id);

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        if ($vinculado) {
            $this->alert('warning', '¡No se puede Borrar!', [
                'position' => 'center',
                'timer' => '',
                'toast' => false,
                'text' => 'El registro que intenta borrar ya se encuentra vinculado con otros procesos.',
                'showConfirmButton' => true,
                'onConfirmed' => '',
                'confirmButtonText' => 'OK',
            ]);
        } else {
            $paciente->delete();
            $this->limpiarPacientes();
            $this->reset(['getPaciente', 'getEdad', 'paciente_id']);
            $this->alert(
                'success',
                'Paciente Eliminado.'
            );

        }
    }

    public function buscar($keyword)
    {
        $this->keyword = $keyword;
    }

    // ************************************* PESO *******************************************************************

    public function limpiarPeso()
    {
        $this->reset([
            'peso_fecha', 'peso_kg', 'peso_id', 'labelPeso'
        ]);
    }

    public function btnPeso()
    {
        $this->limpiarPacientes();
        $this->limpiarPeso();
        $this->btn_editar = false;
        $this->btn_nuevo = false;
        $this->btn_cancelar = true;
        $this->footer = true;
        $this->getPeso = Peso::where('pacientes_id', $this->paciente_id)->orderBy('fecha', 'ASC')->get();
        $this->peso_fecha = date("Y-m-d");
        $this->view = "peso";
    }

    public function savePeso()
    {
        $rules = [
            'peso_fecha'    => 'required',
            'peso_kg'    => 'required|numeric|gte:0|max:1000'
        ];
        $messages = [
            'peso_fecha.required' => 'El campo Fecha es obligatorio.',
        ];
        $this->validate($rules, $messages);
        if (is_null($this->peso_id)){
            //nuevo
            $peso = new Peso();
            $message = "Peso Guardado.";
        }else{
            //editar
            $peso = Peso::find($this->peso_id);
            $message = "Peso Actualizado.";
        }
        $peso->pacientes_id = $this->paciente_id;
        $peso->peso = $this->peso_kg;
        $peso->fecha = $this->peso_fecha;
        $peso->save();

        if ($this->new_paciente){
            $this->reset('new_paciente');
            $this->showPacientes($this->paciente_id);
        }else{
            $this->btnPeso();
        }

        $this->alert(
            'success',
            $message
        );
    }

    public function editPeso($id)
    {
        $peso = Peso::find($id);
        $this->peso_id = $peso->id;
        $this->peso_fecha = $peso->fecha;
        $this->peso_kg = $peso->peso;
        $this->labelPeso = "Editar";
    }

    public function destroyPeso($id)
    {
        $peso = Peso::find($id);
        $peso->delete();
        $this->btnPeso();
        $this->alert(
            'success',
            'Peso Eliminado.'
        );
    }

    // ************************************* ANTECEDENTES *******************************************************************

    public function limpiarAntecedentes()
    {
        $this->reset([
            'ante_nombre', 'ante_familiares', 'ante_personales', 'ante_otros', 'antecedente_id', 'keywordAntecedentes'
        ]);
    }

    public function saveAntecedente()
    {
        $rules = [
            'ante_nombre'    =>  ['required', 'min:4', Rule::unique('antecedentes', 'nombre')->ignore($this->antecedente_id)],
        ];
        $messages = [
            'ante_nombre.required' => 'El campo nombre es obligatorio.',
            'ante_nombre.min' => 'nombre debe contener al menos 4 caracteres.',
            'ante_nombre.unique' => 'El campo nombre ya ha sido registrado.',
        ];

        $this->validate($rules, $messages);
        $mesage = null;

        if (is_null($this->antecedente_id)){
            //nuevo
            $antecedente = new Antecedente();
            $mesage = "Antecedente creado.";
        }else{
            //editar
            $antecedente = Antecedente::find($this->antecedente_id);
            $mesage = "Antecedente Actualizado.";
        }

        $antecedente->nombre = $this->ante_nombre;
        if ($this->ante_familiares) { $antecedente->familiares = $this->ante_familiares; }else{ $antecedente->familiares = 0; }
        if ($this->ante_personales) { $antecedente->personales = $this->ante_personales; }else{ $antecedente->personales = 0; }
        if ($this->ante_otros) { $antecedente->otros = $this->ante_otros; }else{ $antecedente->otros = 0; }
        $antecedente->save();
        $this->editAntecedente($antecedente->id);
        $this->alert(
            'success',
            $mesage
        );
    }

    public function editAntecedente($id)
    {
        $this->limpiarAntecedentes();
        $antecedente = Antecedente::find($id);
        $this->antecedente_id = $antecedente->id;
        $this->ante_nombre = $antecedente->nombre;
        if ($antecedente->familiares) { $this->ante_familiares = $antecedente->familiares; }
        if ($antecedente->personales) { $this->ante_personales = $antecedente->personales; }
        if ($antecedente->otros) { $this->ante_otros = $antecedente->otros; }
    }

    public function destroyAntecedente($id)
    {
        $this->antecedente_id = $id;
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' =>  '¡Sí, bórralo!',
            'text' =>  '¡No podrás revertir esto!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmedAntecedente',
        ]);
    }

    public function confirmedAntecedente()
    {
        $antecedente = Antecedente::find($this->antecedente_id);

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        if ($vinculado) {
            $this->alert('warning', '¡No se puede Borrar!', [
                'position' => 'center',
                'timer' => '',
                'toast' => false,
                'text' => 'El registro que intenta borrar ya se encuentra vinculado con otros procesos.',
                'showConfirmButton' => true,
                'onConfirmed' => '',
                'confirmButtonText' => 'OK',
            ]);
        } else {
            $antecedente->delete();
            $this->alert(
                'success',
                'Antecedente Eliminado.'
            );
            $this->limpiarAntecedentes();
            $this->limpiarPacientes();
        }
    }

    public function buscarAntecedente()
    {
        //
    }

    // ************************************* PACIENTE - ANTECEDENTES *******************************************************************

    public function limpiarPaciAnte()
    {
        $this->reset([
            'form_personales', 'form_familiares', 'form_otros',
            'pa_antecedentes_id', 'paValor', 'pa_detalles', 'pa_id',
            'pa_personales', 'pa_familiares', 'pa_otros',
        ]);
    }
    public function btnAntecedentes()
    {
        $this->limpiarPacientes();
        $this->limpiarPaciAnte();
        $this->btn_editar = false;
        $this->btn_nuevo = false;
        $this->btn_cancelar = true;
        $this->footer = true;

        $this->pa_familiares = Antecedente::where('familiares', 1)->get();
        $this->pa_otros = Antecedente::where('otros', 1)->get();
        $this->pa_personales = Antecedente::where('personales', 1)->get();

        $this->pa_personales->each(function ($antecedente){
            $paciAnte = PaciAnte::where('pacientes_id', $this->paciente_id)->where('antecedentes_id', $antecedente->id)->where('personales', 1)->first();
            if ($paciAnte){
                if ($paciAnte->valor){
                    $antecedente->si = true;
                    $antecedente->no = false;
                }else{
                    $antecedente->si = false;
                    $antecedente->no = true;
                }
                $antecedente->detalles = $paciAnte->detalles;
                $antecedente->pa_id = $paciAnte->id;
            }else{
                $antecedente->si = false;
                $antecedente->no = false;
                $antecedente->detalles = null;
                $antecedente->pa_id = false;
            }
        });
        $this->pa_familiares->each(function ($antecedente){
            $paciAnte = PaciAnte::where('pacientes_id', $this->paciente_id)->where('antecedentes_id', $antecedente->id)->where('familiares', 1)->first();
            if ($paciAnte){
                if ($paciAnte->valor){
                    $antecedente->si = true;
                    $antecedente->no = false;
                }else{
                    $antecedente->si = false;
                    $antecedente->no = true;
                }
                $antecedente->detalles = $paciAnte->detalles;
                $antecedente->pa_id = $paciAnte->id;
            }else{
                $antecedente->si = false;
                $antecedente->no = false;
                $antecedente->detalles = null;
                $antecedente->pa_id = false;
            }
        });
        $this->pa_otros->each(function ($antecedente){
            $paciAnte = PaciAnte::where('pacientes_id', $this->paciente_id)->where('antecedentes_id', $antecedente->id)->where('otros', 1)->first();
            if ($paciAnte){
                if ($paciAnte->valor){
                    $antecedente->si = true;
                    $antecedente->no = false;
                }else{
                    $antecedente->si = false;
                    $antecedente->no = true;
                }
                $antecedente->detalles = $paciAnte->detalles;
                $antecedente->pa_id = $paciAnte->id;
            }else{
                $antecedente->si = false;
                $antecedente->no = false;
                $antecedente->detalles = null;
                $antecedente->pa_id = false;
            }
        });

        $this->view = "antecedentes";
    }

    public function editPaciAnte($id, $tipo)
    {
        $this->btnAntecedentes();
        $antecedente = Antecedente::find($id);
        $this->pa_antecedentes_id = $antecedente->id;
        $paciAnte = null;
        switch ($tipo){
            case "personales":
                $paciAnte = PaciAnte::where('pacientes_id', $this->paciente_id)->where('antecedentes_id', $antecedente->id)->where('personales', 1)->first();
                $this->form_personales = $antecedente->nombre;
                $this->pa_tipo = 1;
                break;
            case "familiares":
                $paciAnte = PaciAnte::where('pacientes_id', $this->paciente_id)->where('antecedentes_id', $antecedente->id)->where('familiares', 1)->first();
                $this->form_familiares = $antecedente->nombre;
                $this->pa_tipo = 2;
                break;
            case "otros":
                $paciAnte = PaciAnte::where('pacientes_id', $this->paciente_id)->where('antecedentes_id', $antecedente->id)->where('otros', 1)->first();
                $this->form_otros = $antecedente->nombre;
                $this->pa_tipo = 3;
                break;
        }
        if ($paciAnte){
            $this->pa_id = $paciAnte->id;
            $this->paValor = $paciAnte->valor;
            $this->pa_detalles = $paciAnte->detalles;
        }
        $this->label($tipo);

    }

    public function savePaciAnte()
    {
        if (is_null($this->pa_id)){
            //nuevo
            $paciAnte = new PaciAnte();
        }else{
            //editar
            $paciAnte = PaciAnte::find($this->pa_id);
        }
        if (!is_null($this->paValor)){
            $paciAnte->pacientes_id = $this->paciente_id;
            $paciAnte->antecedentes_id = $this->pa_antecedentes_id;
            $paciAnte->valor = $this->paValor;
            $paciAnte->detalles = $this->pa_detalles;
            switch ($this->pa_tipo){
                case 1:
                    $paciAnte->personales = 1;
                    break;
                case 2:
                    $paciAnte->familiares = 1;
                    break;
                case 3:
                    $paciAnte->otros = 1;
                    break;
            }
            $paciAnte->save();
            $this->alert(
                'success',
                'Antecedente Actualizado.'
            );
        }
        $this->btnAntecedentes();
    }

    public function updatedPaValor()
    {
        $this->pa_familiares = Antecedente::where('familiares', 1)->get();
        $this->pa_otros = Antecedente::where('otros', 1)->get();
        $this->pa_personales = Antecedente::where('personales', 1)->get();

        $this->pa_personales->each(function ($antecedente){
            $paciAnte = PaciAnte::where('pacientes_id', $this->paciente_id)->where('antecedentes_id', $antecedente->id)->where('personales', 1)->first();
            if ($paciAnte){
                if ($paciAnte->valor){
                    $antecedente->si = true;
                    $antecedente->no = false;
                }else{
                    $antecedente->si = false;
                    $antecedente->no = true;
                }
                $antecedente->detalles = $paciAnte->detalles;
                $antecedente->pa_id = $paciAnte->id;
            }else{
                $antecedente->si = false;
                $antecedente->no = false;
                $antecedente->detalles = null;
                $antecedente->pa_id = false;
            }
        });
        $this->pa_familiares->each(function ($antecedente){
            $paciAnte = PaciAnte::where('pacientes_id', $this->paciente_id)->where('antecedentes_id', $antecedente->id)->where('familiares', 1)->first();
            if ($paciAnte){
                if ($paciAnte->valor){
                    $antecedente->si = true;
                    $antecedente->no = false;
                }else{
                    $antecedente->si = false;
                    $antecedente->no = true;
                }
                $antecedente->detalles = $paciAnte->detalles;
                $antecedente->pa_id = $paciAnte->id;
            }else{
                $antecedente->si = false;
                $antecedente->no = false;
                $antecedente->detalles = null;
                $antecedente->pa_id = false;
            }
        });
        $this->pa_otros->each(function ($antecedente){
            $paciAnte = PaciAnte::where('pacientes_id', $this->paciente_id)->where('antecedentes_id', $antecedente->id)->where('otros', 1)->first();
            if ($paciAnte){
                if ($paciAnte->valor){
                    $antecedente->si = true;
                    $antecedente->no = false;
                }else{
                    $antecedente->si = false;
                    $antecedente->no = true;
                }
                $antecedente->detalles = $paciAnte->detalles;
                $antecedente->pa_id = $paciAnte->id;
            }else{
                $antecedente->si = false;
                $antecedente->no = false;
                $antecedente->detalles = null;
                $antecedente->pa_id = false;
            }
        });
    }

    public function destroyPaciAnte($id)
    {
        $paciAnte = PaciAnte::find($id);
        if ($paciAnte->personales){
            $this->label('personales');
        }
        if ($paciAnte->familiares){
            $this->label('familiares');
        }
        if ($paciAnte->otros){
            $this->label('otros');
        }
        $paciAnte->delete();
        $this->btnAntecedentes();
        $this->alert(
            'success',
            'Antecedente Eliminado.'
        );
    }

    public function label($label)
    {
        switch ($label){
            case "personales":
                $this->pa_label_pe = true;
                $this->pa_label_fa = false;
                $this->pa_label_ot = false;
                break;
            case "familiares":
                $this->pa_label_pe = false;
                $this->pa_label_fa = true;
                $this->pa_label_ot = false;
                break;
            case "otros":
                $this->pa_label_pe = false;
                $this->pa_label_fa = false;
                $this->pa_label_ot = true;
                break;
        }
    }

    // ************************************* GINECOSTETRICOS *******************************************************************

    public function limpiarGinecostetricos()
    {
        $this->reset([
            'gine_nombre', 'ginecostetrico_id', 'keywordGinecostetricos'
        ]);
    }

    public function saveGinecostetrico()
    {
        $rules = [
            'gine_nombre'    =>  ['required', 'min:4', Rule::unique('ginecostetricos', 'nombre')->ignore($this->ginecostetrico_id)],
        ];
        $messages = [
            'gine_nombre.required' => 'El campo nombre es obligatorio.',
            'gine_nombre.min' => 'nombre debe contener al menos 4 caracteres.',
            'gine_nombre.unique' => 'El campo nombre ya ha sido registrado.',
        ];

        $this->validate($rules, $messages);
        $mesage = null;

        if (is_null($this->ginecostetrico_id)){
            //nuevo
            $antecedente = new Ginecostetrico();
            $mesage = "Ginecostetrico creado.";
        }else{
            //editar
            $antecedente = Ginecostetrico::find($this->ginecostetrico_id);
            $mesage = "Ginecostetricos Actualizado.";
        }

        $antecedente->nombre = $this->gine_nombre;
        $antecedente->save();
        $this->editGinecostetrico($antecedente->id);
        $this->alert(
            'success',
            $mesage
        );
    }

    public function editGinecostetrico($id)
    {
        $this->limpiarGinecostetricos();
        $antecedente = Ginecostetrico::find($id);
        $this->ginecostetrico_id = $antecedente->id;
        $this->gine_nombre = $antecedente->nombre;
    }

    public function destroyGinecostetrico($id)
    {
        $this->ginecostetrico_id = $id;
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' =>  '¡Sí, bórralo!',
            'text' =>  '¡No podrás revertir esto!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmedGinecostetrico',
        ]);
    }

    public function confirmedGinecostetrico()
    {
        $antecedente = Ginecostetrico::find($this->ginecostetrico_id);

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        if ($vinculado) {
            $this->alert('warning', '¡No se puede Borrar!', [
                'position' => 'center',
                'timer' => '',
                'toast' => false,
                'text' => 'El registro que intenta borrar ya se encuentra vinculado con otros procesos.',
                'showConfirmButton' => true,
                'onConfirmed' => '',
                'confirmButtonText' => 'OK',
            ]);
        } else {
            $antecedente->delete();
            $this->alert(
                'success',
                'Ginecostetrico Eliminado.'
            );
            $this->limpiarGinecostetricos();
            $this->limpiarPacientes();
        }
    }

    public function buscarGinecostetrico()
    {
        //
    }

    // ************************************* VACUNAS *******************************************************************

    public function limpiarVacunas()
    {
        $this->reset([
            'vacu_nombre', 'vacuna_id', 'keywordVacunas'
        ]);
    }

    public function saveVacuna()
    {
        $rules = [
            'vacu_nombre'    =>  ['required', 'min:4', Rule::unique('vacunas', 'nombre')->ignore($this->vacuna_id)],
        ];
        $messages = [
            'vacu_nombre.required' => 'El campo nombre es obligatorio.',
            'vacu_nombre.min' => 'nombre debe contener al menos 4 caracteres.',
            'vacu_nombre.unique' => 'El campo nombre ya ha sido registrado.',
        ];

        $this->validate($rules, $messages);
        $mesage = null;

        if (is_null($this->vacuna_id)){
            //nuevo
            $antecedente = new Vacuna();
            $mesage = "Vacuna creada.";
        }else{
            //editar
            $antecedente = Vacuna::find($this->vacuna_id);
            $mesage = "Vacuna Actualizada.";
        }

        $antecedente->nombre = $this->vacu_nombre;
        $antecedente->save();
        $this->editVacuna($antecedente->id);
        $this->alert(
            'success',
            $mesage
        );
    }

    public function editVacuna($id)
    {
        $this->limpiarVacunas();
        $antecedente = Vacuna::find($id);
        $this->vacuna_id = $antecedente->id;
        $this->vacu_nombre = $antecedente->nombre;
    }

    public function destroyVacuna($id)
    {
        $this->vacuna_id = $id;
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' =>  '¡Sí, bórralo!',
            'text' =>  '¡No podrás revertir esto!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmedVacuna',
        ]);
    }

    public function confirmedVacuna()
    {
        $antecedente = Vacuna::find($this->vacuna_id);

        //codigo para verificar si realmente se puede borrar, dejar false si no se requiere validacion
        $vinculado = false;

        if ($vinculado) {
            $this->alert('warning', '¡No se puede Borrar!', [
                'position' => 'center',
                'timer' => '',
                'toast' => false,
                'text' => 'El registro que intenta borrar ya se encuentra vinculado con otros procesos.',
                'showConfirmButton' => true,
                'onConfirmed' => '',
                'confirmButtonText' => 'OK',
            ]);
        } else {
            $antecedente->delete();
            $this->alert(
                'success',
                'Ginecostetrico Eliminado.'
            );
            $this->limpiarVacunas();
            $this->limpiarPacientes();
        }
    }

    public function buscarVacuna()
    {
        //
    }


    // ************************************* PACIENTES - VACUNAS *******************************************************************

    public function limpiarPaciVacu()
    {
        $this->reset([
            'pv_listar', 'pv_vacuna_id', 'pv_dosis_1', 'pv_dosis_2', 'pv_refuerzo', 'pv_label_va', 'pv_label_ti', 'form_vacunas', 'pv_id',
            'form_tipaje', 'tipaje_id', 'pt_madre', 'pt_padre', 'pt_sensibilidad'
        ]);
    }

    public function btnVacunas()
    {
        $this->limpiarPacientes();
        $this->limpiarPaciVacu();
        $this->btn_editar = false;
        $this->btn_nuevo = false;
        $this->btn_cancelar = true;
        $this->footer = true;

        $this->pv_listar = Vacuna::get();
        $this->pv_listar->each(function ($vacuna){
            $paciVacu = PaciVacuna::where('pacientes_id', $this->paciente_id)->where('vacunas_id', $vacuna->id)->first();
            if ($paciVacu){
                $vacuna->pv_id = $paciVacu->id;
                $vacuna->dosis_1 = $paciVacu->dosis_1;
                $vacuna->dosis_2 = $paciVacu->dosis_2;
                $vacuna->refuerzo = $paciVacu->refuerzo;
            }else{
                $vacuna->pv_id = null;
                $vacuna->dosis_1 = null;
                $vacuna->dosis_2 = null;
                $vacuna->refuerzo = null;
            }
        });

        $tipaje = Tipaje::where('pacientes_id', $this->paciente_id)->first();
        if ($tipaje){
            $this->tipaje_id = $tipaje->id;
            $this->pt_madre = $tipaje->madre;
            $this->pt_padre = $tipaje->padre;
            $this->pt_sensibilidad = $tipaje->sensibilidad;
        }

        $this->view = "vacunas";
    }

    public function editPaciVacu($id)
    {
        $this->btnVacunas();
        $vacuna = Vacuna::find($id);
        $this->form_vacunas = $vacuna->nombre;
        $paciVacu = PaciVacuna::where('pacientes_id', $this->paciente_id)->where('vacunas_id', $vacuna->id)->first();
        if ($paciVacu){
            $this->pv_id = $paciVacu->id;
            $this->pv_dosis_1 = $paciVacu->dosis_1;
            $this->pv_dosis_2 = $paciVacu->dosis_2;
            $this->pv_refuerzo = $paciVacu->refuerzo;
        }else{
            $this->pv_id = null;
            $this->pv_dosis_1 = null;
            $this->pv_dosis_2 = null;
            $this->pv_refuerzo = null;
        }
        $this->pv_vacuna_id = $id;
    }

    public function savePaciVacu()
    {
        if (is_null($this->pv_id)){
            //nuevo
            $paciVacu = new PaciVacuna();
            $message = "Registro Guardado.";
        }else{
            //editar
            $paciVacu = PaciVacuna::find($this->pv_id);
            $message = "Registro Actualizado.";
        }

        if ($this->pv_dosis_1 || $this->pv_dosis_2 || $this->pv_refuerzo){
            $paciVacu->pacientes_id = $this->paciente_id;
            $paciVacu->vacunas_id = $this->pv_vacuna_id;
            $paciVacu->dosis_1 = $this->pv_dosis_1;
            $paciVacu->dosis_2 = $this->pv_dosis_2;
            $paciVacu->refuerzo = $this->pv_refuerzo;
            $paciVacu->save();
            $this->alert(
                'success',
                $message
            );
        }
        $this->btnVacunas();
    }

    public function destroyPaciVacu($id)
    {
        $paciVacu = PaciVacuna::find($id);
        $paciVacu->delete();
        $this->alert(
            'success',
            'Registro Borrado.'
        );
        $this->btnVacunas();
    }

    public function editTipaje()
    {
        $this->btnVacunas();
        $this->pv_label_va = false;
        $this->pv_label_ti = true;
        $this->form_tipaje = true;
    }

    public function saveTipaje()
    {

        if (is_null($this->tipaje_id)){
            //nuevo
            $tipaje = new Tipaje();
            $message = "Tipaje Guardado.";
        }else{
            //editar
            $tipaje = Tipaje::find($this->tipaje_id);
            $message = "Tipaje Actualizado.";
        }

        if ($this->pt_madre || $this->pt_padre || $this->pt_sensibilidad){
            $tipaje->pacientes_id = $this->paciente_id;
            $tipaje->madre= $this->pt_madre;
            $tipaje->padre= $this->pt_padre;
            $tipaje->sensibilidad= $this->pt_sensibilidad;
            $tipaje->save();
            $this->alert(
                'success',
                $message
            );
        }
        $this->btnVacunas();
        $this->pv_label_va = false;
        $this->pv_label_ti = true;
    }

    public function destroyTipaje()
    {
        $tipaje = Tipaje::find($this->tipaje_id);
        $tipaje->delete();
        $this->alert(
            'success',
            'Tipaje Eliminado.'
        );
        $this->btnVacunas();
        $this->pv_label_va = false;
        $this->pv_label_ti = true;
    }

    // ************************************* Ginecostetricos *******************************************************************



}
