<?php

namespace App\Controllers;

use App\Models\TelefonoModel;
use App\Models\PersonaModel;

class Telefono extends BaseController
{
    protected TelefonoModel $telefonoModel;
    protected PersonaModel $personaModel;

    public function __construct()
    {
        $this->telefonoModel = new TelefonoModel();
        $this->personaModel  = new PersonaModel();
    }

    public function index($id = null)
    {
        return $this->actual($id);
    }

    public function actual($id = null)
    {
        if ($id !== null) {
            $telefono = $this->telefonoModel->getTelefonoDetail($id);
        } else {
            $ultimo   = $this->telefonoModel->elultimo();
            $telefono = $ultimo ? $this->telefonoModel->getTelefonoDetail($ultimo['idtelefono']) : null;
        }

        $currentId = $telefono ? (int)$telefono['idtelefono'] : null;
        $posicion  = $currentId ? $this->telefonoModel->obtenerPosicion($currentId) : ['pos' => 0, 'total' => 0];

        $data = [
            'title'     => $telefono ? 'Teléfono: ' . esc($telefono['numero']) : 'Ficha de Teléfono',
            'module'    => 'telefono',
            'telefono'  => $telefono,
            'currentId' => $currentId,
            'posicion'  => $posicion,
        ];

        return view('telefono/telefono_record', $data);
    }

    public function elprimero()
    {
        $first = $this->telefonoModel->elprimero();
        return $this->actual($first ? $first['idtelefono'] : null);
    }

    public function elultimo()
    {
        $last = $this->telefonoModel->elultimo();
        return $this->actual($last ? $last['idtelefono'] : null);
    }

    public function siguiente($id)
    {
        $next = $this->telefonoModel->siguiente((int)$id);
        return $this->actual($next ? $next['idtelefono'] : $id);
    }

    public function anterior($id)
    {
        $prev = $this->telefonoModel->anterior((int)$id);
        return $this->actual($prev ? $prev['idtelefono'] : $id);
    }

    public function listar()
    {
        $search    = $this->request->getGet('q');
        $idpersona = $this->request->getGet('idpersona');

        $telefonos = $this->telefonoModel->getTelefonosWithPersona($search, $idpersona);

        $personaFiltro = null;
        if (!empty($idpersona)) {
            $personaFiltro = $this->personaModel->find((int)$idpersona);
        }

        $data = [
            'title'         => 'Listado General de Teléfonos',
            'module'        => 'telefono',
            'telefonos'     => $telefonos,
            'search'        => $search,
            'idpersona'     => $idpersona,
            'personaFiltro' => $personaFiltro,
            'total'         => count($telefonos),
        ];

        return view('telefono/telefono_list', $data);
    }

    public function add($idpersona = null)
    {
        $personas = $this->personaModel->orderBy('apellidos', 'ASC')->findAll();

        $data = [
            'title'              => 'Registrar Nuevo Teléfono',
            'module'             => 'telefono',
            'personas'           => $personas,
            'idpersonaSeleccion' => $idpersona ?? $this->request->getGet('idpersona'),
            'errors'             => session()->getFlashdata('errors') ?? [],
            'old'                => session()->getFlashdata('old') ?? [],
        ];

        return view('telefono/telefono_form', $data);
    }

    public function store()
    {
        $idpersona      = (int)$this->request->getPost('idpersona');
        $numero         = trim($this->request->getPost('numero') ?? '');
        $tipo           = trim($this->request->getPost('tipo') ?? 'Celular');
        $fechaoptencion = !empty($this->request->getPost('fechaoptencion')) ? $this->request->getPost('fechaoptencion') : date('Y-m-d');

        $postData = [
            'idpersona'      => $idpersona,
            'numero'         => $numero,
            'tipo'           => !empty($tipo) ? $tipo : 'Celular',
            'fechaoptencion' => $fechaoptencion,
        ];

        if (!$this->telefonoModel->insert($postData)) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $this->telefonoModel->errors())
                             ->with('old', $postData);
        }

        $nuevoId = $this->telefonoModel->getInsertID();

        if ($this->request->getPost('retornar_persona')) {
            return redirect()->to(base_url('persona/actual/' . $idpersona))
                             ->with('success', '¡Teléfono añadido con éxito a la persona!');
        }

        return redirect()->to(base_url('telefono/actual/' . $nuevoId))
                         ->with('success', '¡Teléfono registrado exitosamente!');
    }

    public function edit($id)
    {
        $telefono = $this->telefonoModel->find((int)$id);
        if (!$telefono) {
            return redirect()->to(base_url('telefono'))->with('error', 'Teléfono no encontrado.');
        }

        $personas = $this->personaModel->orderBy('apellidos', 'ASC')->findAll();

        $data = [
            'title'     => 'Editar Teléfono: ' . esc($telefono['numero']),
            'module'    => 'telefono',
            'telefono'  => $telefono,
            'personas'  => $personas,
            'currentId' => (int)$id,
            'errors'    => session()->getFlashdata('errors') ?? [],
        ];

        return view('telefono/telefono_edit', $data);
    }

    public function update($id)
    {
        $telefono = $this->telefonoModel->find((int)$id);
        if (!$telefono) {
            return redirect()->to(base_url('telefono'))->with('error', 'Registro no encontrado.');
        }

        $idpersona      = (int)$this->request->getPost('idpersona');
        $numero         = trim($this->request->getPost('numero') ?? '');
        $tipo           = trim($this->request->getPost('tipo') ?? 'Celular');
        $fechaoptencion = !empty($this->request->getPost('fechaoptencion')) ? $this->request->getPost('fechaoptencion') : null;

        $postData = [
            'idpersona'      => $idpersona,
            'numero'         => $numero,
            'tipo'           => !empty($tipo) ? $tipo : 'Celular',
            'fechaoptencion' => $fechaoptencion,
        ];

        if (!$this->telefonoModel->update((int)$id, $postData)) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $this->telefonoModel->errors());
        }

        if ($this->request->getPost('retornar_persona')) {
            return redirect()->to(base_url('persona/actual/' . $idpersona))
                             ->with('success', '¡Teléfono actualizado correctamente!');
        }

        return redirect()->to(base_url('telefono/actual/' . $id))
                         ->with('success', '¡Teléfono actualizado exitosamente!');
    }

    public function delete($id)
    {
        $telefono = $this->telefonoModel->find((int)$id);
        if (!$telefono) {
            return redirect()->to(base_url('telefono'))->with('error', 'Registro no encontrado.');
        }

        $idpersona = $telefono['idpersona'];
        $this->telefonoModel->delete((int)$id);

        if ($this->request->getGet('from_persona')) {
            return redirect()->to(base_url('persona/actual/' . $idpersona))
                             ->with('success', 'Teléfono eliminado de la persona.');
        }

        $ultimo      = $this->telefonoModel->elultimo();
        $redirectUrl = $ultimo ? base_url('telefono/actual/' . $ultimo['idtelefono']) : base_url('telefono');

        return redirect()->to($redirectUrl)
                         ->with('success', 'Teléfono #' . $id . ' eliminado exitosamente.');
    }
}