<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Antecedente;
use App\Models\Ginecostetrico;
use App\Models\Historia;
use App\Models\PaciAnte;
use App\Models\Paciente;
use App\Models\PaciGine;
use App\Models\PaciTabla;
use App\Models\PaciVacuna;
use App\Models\Peso;
use App\Models\Tipaje;
use App\Models\Vacuna;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class GinecologiaComponent extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'setPacienteActivo', 'confirmedControl', 'confirmedLaboratorio1'
    ];

    public $table = "control", $form, $title_agregar = "Agregar";
    public $paciente_id, $nombre, $edad, $cedula, $fecha_nac, $telefono, $direccion, $fur, $fpp, $gestas, $partos,
        $cesarea, $abortos, $madre, $padre, $sensibilidad, $grupo;
    public $control_fecha, $control_mc, $control_peso, $control_ta, $control_mama, $control_cue, $control_zt, $control_cabeza,
        $control_cuello, $control_torax, $control_abdomen, $control_extremidades, $control_snc, $control_genitales,
        $control_observacion, $control_plan, $control_id;
    public $ex1_year, $ex1_semanas, $ex1_via, $ex1_sexo, $ex1_peso, $ex1_id;

    public function render()
    {
        $pacientes = Paciente::orderBy('cedula', 'ASC')->get();
        $personales = $this->getAntecedentes('personales');
        $otros = $this->getAntecedentes('otros');
        $familiares = $this->getAntecedentes('familiares');
        $vacunas = $this->getAntecedentes('vacunas');
        $ginecostetricos = $this->getAntecedentes('ginecostetricos');
        $control = Historia::where('pacientes_id', $this->paciente_id)->orderBy('fecha', 'ASC')->paginate(30);
        $tabla = PaciTabla::where('pacientes_id', $this->paciente_id)->paginate(30);
        return view('livewire.dashboard.ginecologia-component')
            ->with('listarPacientes', $pacientes)
            ->with('listarPersonales', $personales)
            ->with('listarOtros', $otros)
            ->with('listarFamiliares', $familiares)
            ->with('listarVacunas', $vacunas)
            ->with('listarGinecostetricos', $ginecostetricos)
            ->with('listarControl', $control)
            ->with('listarTabla', $tabla)
            ;
    }

    public function setPacienteActivo($id)
    {
        $paciente = Paciente::find($id);
        $this->paciente_id = $paciente->id;
        $this->nombre = $paciente->nombre;
        $this->edad = $paciente->edad;
        $this->cedula = $paciente->cedula;
        $this->fecha_nac = $paciente->fecha_nac;
        $this->telefono = $paciente->telefono;
        $this->direccion = $paciente->direccion;
        $this->fur = $paciente->fur;
        $this->fpp = $paciente->fpp;
        $this->gestas = $paciente->gestas;
        $this->partos = $paciente->partos;
        $this->cesarea = $paciente->cesarias;
        $this->abortos = $paciente->abortos;
        $this->grupo = $paciente->grupo;
        $tipaje = Tipaje::where('pacientes_id', $this->paciente_id)->first();
        if ($tipaje){
            $this->madre = $tipaje->madre;
            $this->padre = $tipaje->padre;
            $this->sensibilidad = $tipaje->sensibilidad;
        }
    }

    public function getAntecedentes($tipo)
    {
        switch ($tipo){
            case "personales":
                $antecedentes = Antecedente::where('personales', 1)->get();
                $antecedentes->each(function ($antecedente){
                    $paciAnte = PaciAnte::where('pacientes_id', $this->paciente_id)->where('antecedentes_id', $antecedente->id)->where('personales', 1)->first();
                    if ($paciAnte){
                        $antecedente->valor = $paciAnte->valor;
                    }else{
                        $antecedente->valor = null;
                    }
                });
                break;
            case "familiares":
                $antecedentes = Antecedente::where('familiares', 1)->get();
                $antecedentes->each(function ($antecedente){
                    $paciAnte = PaciAnte::where('pacientes_id', $this->paciente_id)->where('antecedentes_id', $antecedente->id)->where('familiares', 1)->first();
                    if ($paciAnte){
                        $antecedente->valor = $paciAnte->valor;
                    }else{
                        $antecedente->valor = null;
                    }
                });
                break;
            case "otros":
                $antecedentes = Antecedente::where('otros', 1)->get();
                $antecedentes->each(function ($antecedente){
                    $paciAnte = PaciAnte::where('pacientes_id', $this->paciente_id)->where('antecedentes_id', $antecedente->id)->where('otros', 1)->first();
                    if ($paciAnte){
                        if (is_null($paciAnte->detalles)){
                            if ($paciAnte->valor){
                                $antecedente->valor = "SI";
                            }else{
                                $antecedente->valor = "NO";
                            }
                        }else{
                            $antecedente->valor = $paciAnte->detalles;
                        }
                    }else{
                        $antecedente->valor = null;
                    }
                });
                break;
            case "vacunas":
                $antecedentes = Vacuna::get();
                $antecedentes->each(function ($antecedente){
                    $paciAnte = PaciVacuna::where('pacientes_id', $this->paciente_id)->where('vacunas_id', $antecedente->id)->first();
                    if ($paciAnte){
                        $antecedente->dosis_1 = $paciAnte->dosis_1;
                        $antecedente->dosis_2 = $paciAnte->dosis_2;
                        $antecedente->refuerzo = $paciAnte->refuerzo;
                    }else{
                        $antecedente->dosis_1 = null;
                        $antecedente->dosis_2 = null;
                        $antecedente->refuerzo = null;
                    }
                });
                break;
            case "ginecostetricos":
                $antecedentes = Ginecostetrico::get();
                $antecedentes->each(function ($antecedente){
                    $paciAnte = PaciGine::where('pacientes_id', $this->paciente_id)->where('ginecostetricos_id', $antecedente->id)->first();
                    if ($paciAnte){
                        $antecedente->valor = $paciAnte->detalles;
                    }else{
                        $antecedente->valor = null;
                    }
                });
                break;
        }
        return $antecedentes;
    }

    public function btnExamenes($num = null)
    {
        switch ($num)
        {
            case 1:
                $this->table = "examenes_1";
                break;
            case 2:
                $this->table = "examenes_2";
                break;
            case 3:
                $this->table = "examenes_3";
                break;
            default:
                $this->reset('table');
                break;
        }

    }

    // *********************************************** BTN AGREGAR *******************************************************************

    public function btnAgregar()
    {
        switch ($this->table) {
            default:
                $this->limpiarControl();
                $this->title_agregar = "Agregar Registro";
                $this->form = "control";
                $this->control_fecha = date("Y-m-d");
                break;
            case "examenes_1":
                $this->limpiarLaboratorio1();
                $this->title_agregar = "Agregar Tabla";
                $this->form = "examen_1";
                break;
            /*case "examenes_2":
                $this->limpiarLaboratorio2();
                $this->title_agregar = "Agregar Laboratorio 2";
                $this->form = "examen_2";
                $this->ex2_fecha = date('Y-m-d');
                break;*/
        }
    }

    public function btnCerrarModal()
    {
        $this->limpiarControl();
        //$this->limpiarLaboratorio1();
        //$this->limpiarLaboratorio2();
    }

    // *********************************************** CONTROL *******************************************************************

    public function limpiarControl()
    {
        $this->reset([
            'control_fecha', 'control_mc', 'control_peso', 'control_ta', 'control_mama', 'control_cue', 'control_zt', 'control_cabeza',
            'control_cuello', 'control_torax', 'control_abdomen', 'control_extremidades', 'control_snc', 'control_genitales',
            'control_observacion', 'control_plan', 'control_id'
        ]);
    }

    public function saveControl()
    {
        $rules = [
            'control_fecha' =>  ['required', Rule::unique('pacientes_historia', 'fecha')->where(function ($query) {
                return $query->where('pacientes_id', $this->paciente_id);
            })->ignore($this->control_id)],
            'control_peso'  =>   'nullable|numeric|gte:0|max:1000'
        ];
        $messages = [
            'control_fecha.required'    =>  'El campo fecha es obligatorio.',
            'control_fecha.unique'    =>  ' El campo fecha ya ha sido registrado.',
            'control_peso.numeric'    =>  'peso debe ser numérico.',
            'control_peso.gte'    =>  'El campo peso debe ser como mínimo 0.',
            'control_peso.max'    =>  'peso no debe ser mayor que 1000.'
        ];
        $this->validate($rules, $messages);

        if ($this->control_mc || $this->control_peso || $this->control_ta || $this->control_mama || $this->control_cue || $this->control_zt ||
            $this->control_cabeza || $this->control_cuello || $this->control_torax || $this->control_abdomen || $this->control_extremidades ||
            $this->control_snc || $this->control_genitales || $this->control_observacion || $this->control_plan){
            // procesar
            $tipo = "success";

            if (is_null($this->control_id)){
                //nuevo
                $control = new Historia();
                $message = "Registro Guardado.";
            }else{
                //editar
                $control = Historia::find($this->control_id);
                $message = "Registro Actualizado.";
            }

            if ($this->control_peso){
                $existe = Peso::where('pacientes_id', $this->paciente_id)->where('fecha', $this->control_fecha)->orderBy('id', 'DESC')->first();
                if ($existe){
                    $peso = Peso::find($existe->id);
                }else{
                    $peso = new Peso();
                    $peso->pacientes_id = $this->paciente_id;
                    $peso->fecha = $this->control_fecha;
                }
                $peso->peso = $this->control_peso;
                $peso->save();
                $control->peso_id = $peso->id;
            }

            $control->pacientes_id = $this->paciente_id;
            $control->fecha = $this->control_fecha;
            $control->mc = $this->control_mc;
            $control->ta = $this->control_ta;
            $control->mama = $this->control_mama;
            $control->cue = $this->control_cue;
            $control->zt = $this->control_zt;
            $control->cabeza = $this->control_cabeza;
            $control->cuello = $this->control_cuello;
            $control->torax = $this->control_torax;
            $control->abdomen = $this->control_abdomen;
            $control->extremidades = $this->control_extremidades;
            $control->snc = $this->control_snc;
            $control->genitales = $this->control_genitales;
            $control->observacion = $this->control_observacion;
            $control->plan = $this->control_plan;
            $control->save();
            $this->editControl($control->id);
        }else{
            //vacio
            $tipo = "error";
            $message = "No puedes Guardar un Registro Vacio.";
        }

        $this->alert(
            $tipo,
            $message
        );
    }

    public function editControl($id)
    {
        $this->limpiarControl();
        $control = Historia::find($id);
        $this->control_id = $control->id;
        $this->control_fecha = $control->fecha;
        $this->control_mc = $control->mc;
        if ($control->peso_id){
            $this->control_peso = $control->peso->peso;
        }
        $this->control_ta = $control->ta;
        $this->control_mama = $control->mama;
        $this->control_cue = $control->cue;
        $this->control_zt = $control->zt;
        $this->control_cabeza = $control->cabeza;
        $this->control_cuello = $control->cuello;
        $this->control_torax = $control->torax;
        $this->control_abdomen = $control->abdomen;
        $this->control_extremidades = $control->extremidades;
        $this->control_snc = $control->snc;
        $this->control_genitales = $control->genitales;
        $this->control_observacion = $control->observacion;
        $this->control_plan = $control->plan;
        $this->title_agregar = "Editar Registro";
        $this->form = "control";
    }

    public function destroyControl($id)
    {
        $this->control_id = $id;
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' =>  '¡Sí, bórralo!',
            'text' =>  '¡No podrás revertir esto!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmedControl',
        ]);
    }

    public function confirmedControl()
    {
        $control = Historia::find($this->control_id);
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
            $control->delete();
            $this->limpiarControl();
            $this->alert(
                'success',
                'Registro Eliminado.'
            );
        }
    }

    // *********************************************** LABORATORIO 1 *******************************************************************

    public function limpiarLaboratorio1()
    {
        $this->reset([
            'ex1_year', 'ex1_semanas', 'ex1_via', 'ex1_sexo', 'ex1_peso', 'ex1_id'
        ]);
    }

    public function saveLaboratorio1()
    {
        $rules = [
            'ex1_peso'  =>   'nullable|numeric|gte:0|max:1000'
        ];
        $messages = [
            'ex1_peso.numeric'    =>  'peso debe ser numérico.',
            'ex1_peso.gte'    =>  'El campo peso debe ser como mínimo 0.',
            'ex1_peso.max'    =>  'peso no debe ser mayor que 1000.'
        ];
        $this->validate($rules, $messages);

        if ($this->ex1_year || $this->ex1_semanas || $this->ex1_via || $this->ex1_sexo || $this->ex1_peso){

            //procesar
            $tipo = "success";
            if ($this->ex1_id){
                //editar
                $examen = PaciTabla::find($this->ex1_id);
                $message = "Registro Actualizado.";
            }else{
                //nuevo
                $examen = new PaciTabla();
                $examen->pacientes_id = $this->paciente_id;
                $message = "Registro Guardado.";
            }
            $examen->year = $this->ex1_year;
            $examen->semanas = $this->ex1_semanas;
            $examen->via = $this->ex1_via;
            $examen->sexo = $this->ex1_sexo;
            $examen->peso = $this->ex1_peso;
            $examen->save();
            $this->editLaboratorio1($examen->id);
        }else{
            //vacio
            $tipo = "error";
            $message = "No puedes Guardar un Registro Vacio.";
        }

        $this->alert(
            $tipo,
            $message
        );

    }

    public function editLaboratorio1($id)
    {
        $this->limpiarLaboratorio1();
        $examen = PaciTabla::find($id);
        $this->ex1_id = $examen->id;
        $this->ex1_year = $examen->year;
        $this->ex1_semanas = $examen->semanas;
        $this->ex1_via = $examen->via;
        $this->ex1_sexo = $examen->sexo;
        $this->ex1_peso = $examen->peso;
        $this->title_agregar = "Editar Tabla";
        $this->form = "examen_1";
    }

    public function destroyLaboratorio1($id)
    {
        $this->ex1_id = $id;
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' =>  '¡Sí, bórralo!',
            'text' =>  '¡No podrás revertir esto!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmedLaboratorio1',
        ]);
    }

    public function confirmedLaboratorio1()
    {
        $examen = PaciTabla::find($this->ex1_id);
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
            $examen->delete();
            $this->limpiarLaboratorio1();
            $this->alert(
                'success',
                'Registro Eliminado.'
            );
        }
    }

}
