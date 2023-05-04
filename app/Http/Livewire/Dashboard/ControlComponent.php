<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Antecedente;
use App\Models\Control;
use App\Models\PaciAnte;
use App\Models\Paciente;
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
        'setPacienteActivo', 'confirmedControl'
    ];

    public $table = "control", $form, $title_agregar = "Agregar";
    public $paciente_id, $nombre, $edad, $cedula, $fecha_nac, $telefono, $direccion, $fur, $fpp, $gestas, $partos,
        $cesarea, $abortos, $madre, $padre, $sensibilidad, $grupo;
    public $control_fecha, $control_edad, $control_peso, $control_ta, $control_au, $control_pres, $control_fcf, $contol_mov,
        $control_du, $control_edema, $control_sintomas, $control_observaciones, $control_id;

    public function render()
    {
        $pacientes = Paciente::orderBy('cedula', 'ASC')->get();
        $personales = $this->getAntecedentes('personales');
        $otros = $this->getAntecedentes('otros');
        $familiares = $this->getAntecedentes('familiares');
        $vacunas = $this->getAntecedentes('vacunas');
        $control = Control::where('pacientes_id', $this->paciente_id)->paginate(30);
        return view('livewire.dashboard.control-component')
            ->with('listarPacientes', $pacientes)
            ->with('listarPersonales', $personales)
            ->with('listarOtros', $otros)
            ->with('listarFamiliares', $familiares)
            ->with('listarVacunas', $vacunas)
            ->with('listarControl', $control)
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
                $this->control_fecha = date("Y-m-d");
                $this->form = "control";
                break;
        }
    }

    public function btnCerrarModal()
    {
        $this->limpiarControl();
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



}
