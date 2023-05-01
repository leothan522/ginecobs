<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Antecedente;
use App\Models\PaciAnte;
use App\Models\Paciente;
use App\Models\PaciVacuna;
use App\Models\Tipaje;
use App\Models\Vacuna;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ControlComponent extends Component
{
    use LivewireAlert;
    protected $listeners = [
        'setPacienteActivo'
    ];

    public $table = "control";
    public $paciente_id, $nombre, $edad, $cedula, $fecha_nac, $telefono, $direccion, $fur, $fpp, $gestas, $partos,
            $cesarea, $abortos, $madre, $padre, $sensibilidad, $grupo;

    public function render()
    {
        $pacientes = Paciente::orderBy('cedula', 'ASC')->get();
        $personales = $this->getAntecedentes('personales');
        $otros = $this->getAntecedentes('otros');
        $familiares = $this->getAntecedentes('familiares');
        $vacunas = $this->getAntecedentes('vacunas');
        return view('livewire.dashboard.control-component')
            ->with('listarPacientes', $pacientes)
            ->with('listarPersonales', $personales)
            ->with('listarOtros', $otros)
            ->with('listarFamiliares', $familiares)
            ->with('listarVacunas', $vacunas)
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

}
