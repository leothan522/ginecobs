<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Paciente;
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
        'confirmed', 'buscar'
    ];

    public $view, $btn_nuevo = true, $btn_cancelar = false, $footer = false, $btn_editar = false, $new_paciente = false;
    public $cedula, $nombre, $fechaNac, $edad, $telefono, $direccion, $fur, $fpp, $gestas, $partos, $cesarias, $abortos,
        $grupo, $paciente_id, $getPaciente, $getEdad, $keyword;

    public function render()
    {
        $pacientes = Paciente::buscar($this->keyword)->orderBy('cedula', 'ASC')->paginate(30);
        $rows = Paciente::count();
        return view('livewire.dashboard.pacientes-component')
            ->with('listarPacientes', $pacientes)
            ->with('rows', $rows)
            ;
    }

    public function limpiarPacientes()
    {
        $this->reset([
            'view', 'btn_nuevo', 'btn_cancelar', 'footer', 'btn_editar', 'new_paciente', 'getPaciente', 'getEdad', 'keyword'
        ]);
    }

    public function create()
    {
        $this->limpiarPacientes();
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
            $this->paciente_id = null;
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



}
