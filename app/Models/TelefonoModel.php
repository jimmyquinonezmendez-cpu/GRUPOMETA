<?php

namespace App\Models;

use CodeIgniter\Model;

class TelefonoModel extends Model
{
    use NavigableTrait;

    protected $table            = 'telefono';
    protected $primaryKey       = 'idtelefono';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'idpersona',
        'numero',
        'tipo',
        'fechaoptencion',
    ];

    protected $validationRules = [
        'idpersona'      => 'required|is_natural_no_zero',
        'numero'         => 'required|max_length[20]|regex_match[/^[0-9+\-\s()]{7,20}$/]',
        'tipo'           => 'permit_empty|max_length[50]',
        'fechaoptencion' => 'permit_empty|valid_date',
    ];

    protected $validationMessages = [
        'idpersona' => [
            'required'           => 'Debe seleccionar una persona a quien pertenezca el teléfono.',
            'is_natural_no_zero' => 'Seleccione una persona válida.',
        ],
        'numero' => [
            'required'    => 'El número de teléfono es obligatorio.',
            'max_length'  => 'El número no puede superar los 20 caracteres.',
            'regex_match' => 'Ingrese un número válido (solo dígitos, espacios, +, - y paréntesis; mínimo 7 caracteres).',
        ],
        'fechaoptencion' => [
            'valid_date' => 'La fecha de obtención debe ser una fecha válida (AAAA-MM-DD).',
        ],
    ];

    public function getTelefonosWithPersona($search = null, $idpersona = null)
    {
        $builder = $this->select('telefono.*, persona.cedula, persona.nombres, persona.apellidos')
                        ->join('persona', 'persona.idpersona = telefono.idpersona', 'inner')
                        ->orderBy('telefono.idtelefono', 'DESC');

        if (!empty($idpersona)) {
            $builder->where('telefono.idpersona', (int)$idpersona);
        }

        if (!empty($search)) {
            $builder->groupStart()
                    ->like('telefono.numero', $search)
                    ->orLike('telefono.tipo', $search)
                    ->orLike('persona.cedula', $search)
                    ->orLike('persona.nombres', $search)
                    ->orLike('persona.apellidos', $search)
                    ->groupEnd();
        }

        return $builder->findAll();
    }

    public function getTelefonoDetail($id)
    {
        return $this->select('telefono.*, persona.cedula, persona.nombres, persona.apellidos')
                    ->join('persona', 'persona.idpersona = telefono.idpersona', 'inner')
                    ->where('telefono.idtelefono', (int)$id)
                    ->first();
    }

    public function getTelefonosByPersona($idpersona)
    {
        return $this->where('idpersona', (int)$idpersona)
                    ->orderBy('idtelefono', 'DESC')
                    ->findAll();
    }
}