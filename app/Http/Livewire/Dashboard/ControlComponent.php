<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Antecedente;
use App\Models\Control;
use App\Models\Laboratorio1;
use App\Models\Laboratorio2;
use App\Models\PaciAnte;
use App\Models\Paciente;
use App\Models\PaciUro;
use App\Models\PaciUrocultivo;
use App\Models\PaciVacuna;
use App\Models\Peso;
use App\Models\Tipaje;
use App\Models\Vacuna;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ControlComponent extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'setPacienteActivo', 'confirmedControl', 'confirmedLaboratorio1', 'confirmedLaboratorio2', 'confirmedUroanalisis',
        'confirmedUrocultivos'
    ];

    public $table = "control", $form, $title_agregar = "Agregar";
    public $paciente_id, $nombre, $edad, $cedula, $fecha_nac, $telefono, $direccion, $fur, $fpp, $gestas, $partos,
        $cesarea, $abortos, $madre, $padre, $sensibilidad, $grupo;
    public $control_fecha, $control_edad, $control_peso, $control_ta, $control_au, $control_pres, $control_fcf, $contol_mov,
        $control_du, $control_edema, $control_sintomas, $control_observaciones, $control_id;
    public $ex1_fecha, $ex1_hb, $ex1_leuco, $ex1_plaqueta, $ex1_glicemia, $ex1_urea, $ex1_crea, $ex1_ac, $ex1_tp, $ex1_tpt,
            $ex1_id;
    public $ex2_fecha, $ex2_hiv, $ex2_vdrl, $ex2_anticore, $ex2_tgo, $ex2_tpg, $ex2_ldh, $ex2_igm, $ex2_igg, $ex2_tsh, $ex2_t4,
            $ex2_id;
    public $ex3_fecha, $ex3_leu, $ex3_bac, $ex3_detalles, $ex3_id;
    public $ex4_fecha, $ex4_detalles, $ex4_id;

    public function render()
    {
        $pacientes = Paciente::orderBy('cedula', 'ASC')->get();
        $personales = $this->getAntecedentes('personales');
        $otros = $this->getAntecedentes('otros');
        $familiares = $this->getAntecedentes('familiares');
        $vacunas = $this->getAntecedentes('vacunas');
        $control = Control::where('pacientes_id', $this->paciente_id)->orderBy('fecha', 'ASC')->paginate(30);
        $laboratorio1 = Laboratorio1::where('pacientes_id', $this->paciente_id)->orderBy('fecha', 'ASC')->paginate(30);
        $laboratorio2 = Laboratorio2::where('pacientes_id', $this->paciente_id)->orderBy('fecha', 'ASC')->paginate(30);
        $uroanalisis = PaciUro::where('pacientes_id', $this->paciente_id)->orderBy('fecha', 'ASC')->get();
        $urocultivos = PaciUrocultivo::where('pacientes_id', $this->paciente_id)->orderBy('fecha', 'ASC')->get();
        return view('livewire.dashboard.control-component')
            ->with('listarPacientes', $pacientes)
            ->with('listarPersonales', $personales)
            ->with('listarOtros', $otros)
            ->with('listarFamiliares', $familiares)
            ->with('listarVacunas', $vacunas)
            ->with('listarControl', $control)
            ->with('listarLaboratorio1', $laboratorio1)
            ->with('listarLaboratorio2', $laboratorio2)
            ->with('listarUroanalisis', $uroanalisis)
            ->with('listarUrocultivos', $urocultivos)
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
        if ($tipaje) {
            $this->madre = $tipaje->madre;
            $this->padre = $tipaje->padre;
            $this->sensibilidad = $tipaje->sensibilidad;
        }
    }

    public function getAntecedentes($tipo)
    {
        switch ($tipo) {
            case "personales":
                $antecedentes = Antecedente::where('personales', 1)->get();
                $antecedentes->each(function ($antecedente) {
                    $paciAnte = PaciAnte::where('pacientes_id', $this->paciente_id)->where('antecedentes_id', $antecedente->id)->where('personales', 1)->first();
                    if ($paciAnte) {
                        $antecedente->valor = $paciAnte->valor;
                    } else {
                        $antecedente->valor = null;
                    }
                });
                break;
            case "familiares":
                $antecedentes = Antecedente::where('familiares', 1)->get();
                $antecedentes->each(function ($antecedente) {
                    $paciAnte = PaciAnte::where('pacientes_id', $this->paciente_id)->where('antecedentes_id', $antecedente->id)->where('familiares', 1)->first();
                    if ($paciAnte) {
                        $antecedente->valor = $paciAnte->valor;
                    } else {
                        $antecedente->valor = null;
                    }
                });
                break;
            case "otros":
                $antecedentes = Antecedente::where('otros', 1)->get();
                $antecedentes->each(function ($antecedente) {
                    $paciAnte = PaciAnte::where('pacientes_id', $this->paciente_id)->where('antecedentes_id', $antecedente->id)->where('otros', 1)->first();
                    if ($paciAnte) {
                        if (is_null($paciAnte->detalles)) {
                            if ($paciAnte->valor) {
                                $antecedente->valor = "SI";
                            } else {
                                $antecedente->valor = "NO";
                            }
                        } else {
                            $antecedente->valor = $paciAnte->detalles;
                        }
                    } else {
                        $antecedente->valor = null;
                    }
                });
                break;
            case "vacunas":
                $antecedentes = Vacuna::get();
                $antecedentes->each(function ($antecedente) {
                    $paciAnte = PaciVacuna::where('pacientes_id', $this->paciente_id)->where('vacunas_id', $antecedente->id)->first();
                    if ($paciAnte) {
                        $antecedente->dosis_1 = $paciAnte->dosis_1;
                        $antecedente->dosis_2 = $paciAnte->dosis_2;
                        $antecedente->refuerzo = $paciAnte->refuerzo;
                    } else {
                        $antecedente->dosis_1 = null;
                        $antecedente->dosis_2 = null;
                        $antecedente->refuerzo = null;
                    }
                });
                break;
        }
        return $antecedentes;
    }

    public function btnExamenes($num = null)
    {
        switch ($num) {
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
                $this->title_agregar = "Agregar Control";
                $this->form = "control";
                $this->control_fecha = date("Y-m-d");
                break;
            case "examenes_1":
                $this->limpiarLaboratorio1();
                $this->title_agregar = "Agregar Laboratorio 1";
                $this->form = "examen_1";
                $this->ex1_fecha = date("Y-m-d");
                break;
            case "examenes_2":
                $this->limpiarLaboratorio2();
                $this->title_agregar = "Agregar Laboratorio 2";
                $this->form = "examen_2";
                $this->ex2_fecha = date('Y-m-d');
                break;
        }
    }

    public function btnCerrarModal()
    {
        $this->limpiarControl();
        $this->limpiarLaboratorio1();
        $this->limpiarLaboratorio2();
    }

    // *********************************************** CONTROL *******************************************************************

    public function limpiarControl()
    {
        $this->reset([
            'control_fecha', 'control_edad', 'control_peso', 'control_ta', 'control_au', 'control_pres', 'control_fcf', 'contol_mov',
            'control_du', 'control_edema', 'control_sintomas', 'control_observaciones', 'control_id'
        ]);
    }

    public function saveControl()
    {
        $rules = [
            'control_fecha' =>  ['required', Rule::unique('pacientes_control', 'fecha')->where(function ($query) {
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

        if ($this->control_edad || $this->control_peso || $this->control_ta || $this->control_au || $this->control_pres || $this->control_fcf ||
            $this->contol_mov || $this->control_du || $this->control_edema || $this->control_sintomas || $this->control_observaciones){
            // procesar
            $tipo = "success";

            if (is_null($this->control_id)){
                //nuevo
                $control = new Control();
                $message = "Control Guardado.";
            }else{
                //editar
                $control = Control::find($this->control_id);
                $message = "Control Actualizado.";
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
            $control->edad_gestacional = $this->control_edad;
            $control->ta = $this->control_ta;
            $control->au = $this->control_au;
            $control->pres = $this->control_pres;
            $control->fcf = $this->control_fcf;
            $control->mov_fetales = $this->contol_mov;
            $control->du = $this->control_du;
            $control->edema = $this->control_edema;
            $control->sintomas = $this->control_sintomas;
            $control->observaciones = $this->control_observaciones;
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
        $control = Control::find($id);
        $this->control_id = $control->id;
        $this->control_fecha = $control->fecha;
        $this->control_edad = $control->edad_gestacional;
        if ($control->peso_id){
            $this->control_peso = $control->peso->peso;
        }
        $this->control_ta = $control->ta;
        $this->control_au = $control->au;
        $this->control_pres = $control->pres;
        $this->control_fcf = $control->fcf;
        $this->contol_mov = $control->mov_fetales;
        $this->control_du = $control->du;
        $this->control_edema = $control->edema;
        $this->control_sintomas = $control->sintomas;
        $this->control_observaciones = $control->observaciones;
        $this->title_agregar = "Editar Control";
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
        $control = Control::find($this->control_id);
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
            'ex1_fecha', 'ex1_hb', 'ex1_leuco', 'ex1_plaqueta', 'ex1_glicemia', 'ex1_urea', 'ex1_crea', 'ex1_ac', 'ex1_tp',
            'ex1_tpt', 'ex1_id'
        ]);
    }

    public function saveLaboratorio1()
    {
        $rules = [
            'ex1_fecha' =>  ['required', Rule::unique('pacientes_laboratorio_1', 'fecha')->where(function ($query) {
                return $query->where('pacientes_id', $this->paciente_id);
            })->ignore($this->ex1_id)],
        ];
        $messages = [
            'ex1_fecha.required'    =>  'El campo fecha es obligatorio.',
            'ex1_fecha.unique'    =>  'El campo fecha ya ha sido registrado.'
        ];
        $this->validate($rules, $messages);

        if ($this->ex1_hb || $this->ex1_leuco || $this->ex1_plaqueta || $this->ex1_glicemia || $this->ex1_urea || $this->ex1_crea ||
            $this->ex1_ac || $this->ex1_tp || $this->ex1_tpt){

            //procesar
            $tipo = "success";
            if ($this->ex1_id){
                //editar
                $examen = Laboratorio1::find($this->ex1_id);
                $message = "Registro Actualizado.";
            }else{
                //nuevo
                $examen = new Laboratorio1();
                $examen->pacientes_id = $this->paciente_id;
                $message = "Registro Guardado.";
            }
            $examen->fecha = $this->ex1_fecha;
            $examen->hb = $this->ex1_hb;
            $examen->leuco = $this->ex1_leuco;
            $examen->plaqueta = $this->ex1_plaqueta;
            $examen->glicemia = $this->ex1_glicemia;
            $examen->urea = $this->ex1_urea;
            $examen->crea = $this->ex1_crea;
            $examen->ac_urico = $this->ex1_ac;
            $examen->tp = $this->ex1_tp;
            $examen->tpt = $this->ex1_tpt;
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
        $examen = Laboratorio1::find($id);
        $this->ex1_id = $examen->id;
        $this->ex1_fecha = $examen->fecha;
        $this->ex1_hb = $examen->hb;
        $this->ex1_leuco = $examen->leuco;
        $this->ex1_plaqueta = $examen->plaqueta;
        $this->ex1_glicemia = $examen->glicemia;
        $this->ex1_urea = $examen->urea;
        $this->ex1_crea = $examen->crea;
        $this->ex1_ac = $examen->ac_urico;
        $this->ex1_tp = $examen->tp;
        $this->ex1_tpt = $examen->tpt;
        $this->title_agregar = "Editar Laboratorio 1";
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
        $examen = Laboratorio1::find($this->ex1_id);
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

    // *********************************************** LABORATORIO 2 *******************************************************************

    public function limpiarLaboratorio2()
    {
        $this->reset([
                'ex2_fecha', 'ex2_hiv', 'ex2_vdrl', 'ex2_anticore', 'ex2_tgo', 'ex2_tpg', 'ex2_ldh', 'ex2_igm', 'ex2_igg',
                'ex2_tsh', 'ex2_t4', 'ex2_id'
            ]);
    }

    public function saveLaboratorio2()
    {
        $rules = [
            'ex2_fecha' =>  ['required', Rule::unique('pacientes_laboratorio_2', 'fecha')->where(function ($query) {
                return $query->where('pacientes_id', $this->paciente_id);
            })->ignore($this->ex2_id)],
        ];
        $messages = [
            'ex2_fecha.required'    =>  'El campo fecha es obligatorio.',
            'ex2_fecha.unique'    =>  'El campo fecha ya ha sido registrado.'
        ];
        $this->validate($rules, $messages);
        if ($this->ex2_hiv || $this->ex2_vdrl || $this->ex2_anticore || $this->ex2_tgo || $this->ex2_tpg || $this->ex2_ldh ||
            $this->ex2_igm || $this->ex2_igg || $this->ex2_tsh || $this->ex2_t4){

            //procesar
            $tipo = "success";
            if ($this->ex2_id){
                //editar
                $examen = Laboratorio2::find($this->ex2_id);
                $message = "Registro Actualizado.";
            }else{
                //nuevo
                $examen = new Laboratorio2();
                $examen->pacientes_id = $this->paciente_id;
                $message = "Registro Guardado.";
            }
            $examen->fecha = $this->ex2_fecha;
            $examen->hiv = $this->ex2_hiv;
            $examen->vdrl = $this->ex2_vdrl;
            $examen->anticore = $this->ex2_anticore;
            $examen->tgo = $this->ex2_tgo;
            $examen->tpg = $this->ex2_tpg;
            $examen->ldh = $this->ex2_ldh;
            $examen->toxo_igm = $this->ex2_igm;
            $examen->toxo_igg = $this->ex2_igg;
            $examen->tsh = $this->ex2_tsh;
            $examen->t4 = $this->ex2_t4;
            $examen->save();
            $this->editLaboratorio2($examen->id);
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

    public function editLaboratorio2($id)
    {
        $this->limpiarLaboratorio2();
        $examen = Laboratorio2::find($id);
        $this->ex2_id = $examen->id;
        $this->ex2_fecha = $examen->fecha;
        $this->ex2_hiv = $examen->hiv;
        $this->ex2_vdrl = $examen->vdrl;
        $this->ex2_anticore = $examen->anticore;
        $this->ex2_tgo = $examen->tgo;
        $this->ex2_tpg = $examen->tpg;
        $this->ex2_ldh = $examen->ldh;
        $this->ex2_igm = $examen->toxo_igm;
        $this->ex2_igg = $examen->toxo_igg;
        $this->ex2_tsh = $examen->tsh;
        $this->ex2_t4 = $examen->t4;
        $this->title_agregar = "Editar Laboratorio 2";
        $this->form = "examen_2";
    }

    public function destroyLaboratorio2($id)
    {
        $this->ex2_id = $id;
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' =>  '¡Sí, bórralo!',
            'text' =>  '¡No podrás revertir esto!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmedLaboratorio2',
        ]);
    }

    public function confirmedLaboratorio2()
    {
        $examen = Laboratorio2::find($this->ex2_id);
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
            $this->limpiarLaboratorio2();
            $this->alert(
                'success',
                'Registro Eliminado.'
            );
        }
    }

    // *********************************************** UROANALISIS *******************************************************************

    public function limpiarUroanalisis()
    {
        $this->reset([
            'ex3_fecha', 'ex3_leu', 'ex3_bac', 'ex3_detalles', 'ex3_id'
        ]);
    }

    public function saveUroanalisis()
    {
        $rules = [
            'ex3_fecha' =>  ['required', Rule::unique('pacientes_uroanalisis', 'fecha')->where(function ($query) {
                return $query->where('pacientes_id', $this->paciente_id);
            })->ignore($this->ex3_id)],
        ];
        $messages = [
            'ex3_fecha.required'    =>  'El campo fecha es obligatorio.',
            'ex3_fecha.unique'    =>  'El campo fecha ya ha sido registrado.'
        ];
        $this->validate($rules, $messages);
        if ($this->ex3_leu || $this->ex3_bac || $this->ex3_detalles){

            //procesar
            $tipo = "success";
            if ($this->ex3_id){
                //editar
                $examen = PaciUro::find($this->ex3_id);
                $message = "Registro Actualizado.";
            }else{
                //nuevo
                $examen = new PaciUro();
                $examen->pacientes_id = $this->paciente_id;
                $message = "Registro Guardado.";
            }
            $examen->fecha = $this->ex3_fecha;
            $examen->leu = $this->ex3_leu;
            $examen->bac = $this->ex3_bac;
            $examen->detalles = $this->ex3_detalles;
            $examen->save();
            $this->limpiarUroanalisis();

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

    public function editUroanalisis($id)
    {
        $this->limpiarUroanalisis();
        $examen = PaciUro::find($id);
        $this->ex3_id = $examen->id;
        $this->ex3_fecha = $examen->fecha;
        $this->ex3_leu = $examen->leu;
        $this->ex3_bac = $examen->bac;
        $this->ex3_detalles = $examen->detalles;
    }

    public function destroyUroanalisis($id)
    {
        $this->ex3_id = $id;
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' =>  '¡Sí, bórralo!',
            'text' =>  '¡No podrás revertir esto!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmedUroanalisis',
        ]);
    }

    public function confirmedUroanalisis()
    {
        $examen = PaciUro::find($this->ex3_id);
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
            $this->limpiarUroanalisis();
            $this->alert(
                'success',
                'Registro Eliminado.'
            );
        }
    }


    // *********************************************** UROCULTIVO *******************************************************************

    public function limpiarUrocultivos()
    {
        $this->reset([
            'ex4_fecha', 'ex4_detalles', 'ex4_id'
        ]);
    }

    public function saveUrocultivos()
    {
        $rules = [
            'ex4_fecha' =>  ['required', Rule::unique('pacientes_urocultivos', 'fecha')->where(function ($query) {
                return $query->where('pacientes_id', $this->paciente_id);
            })->ignore($this->ex4_id)],
        ];
        $messages = [
            'ex4_fecha.required'    =>  'El campo fecha es obligatorio.',
            'ex4_fecha.unique'    =>  'El campo fecha ya ha sido registrado.'
        ];
        $this->validate($rules, $messages);
        if ($this->ex4_detalles){

            //procesar
            $tipo = "success";
            if ($this->ex4_id){
                //editar
                $examen = PaciUrocultivo::find($this->ex4_id);
                $message = "Registro Actualizado.";
            }else{
                //nuevo
                $examen = new PaciUrocultivo();
                $examen->pacientes_id = $this->paciente_id;
                $message = "Registro Guardado.";
            }
            $examen->fecha = $this->ex4_fecha;
            $examen->detalles = $this->ex4_detalles;
            $examen->save();
            $this->limpiarUrocultivos();

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

    public function editUrocultivos($id)
    {
        $this->limpiarUrocultivos();
        $examen = PaciUrocultivo::find($id);
        $this->ex4_id = $examen->id;
        $this->ex4_fecha = $examen->fecha;
        $this->ex4_detalles = $examen->detalles;
    }

    public function destroyUrocultivos($id)
    {
        $this->ex4_id = $id;
        $this->confirm('¿Estas seguro?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' =>  '¡Sí, bórralo!',
            'text' =>  '¡No podrás revertir esto!',
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmedUrocultivos',
        ]);
    }

    public function confirmedUrocultivos()
    {
        $examen = PaciUrocultivo::find($this->ex4_id);
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
            $this->limpiarUrocultivos();
            $this->alert(
                'success',
                'Registro Eliminado.'
            );
        }
    }






}
