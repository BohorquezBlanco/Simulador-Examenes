<?php 
namespace App\Models;

use CodeIgniter\Model;

class MateriaPreguntaModel extends Model
{

    protected $table      = 'materia_pregunta';
    protected $primaryKey = null; 
    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idMateria', 'idPregunta'];



    //eliminarRelacion 
    public function eliminarRelacionMateriaPregunta($idMateria, $idPregunta)
    {
        return $this->where('idMateria', $idMateria)
                    ->where('idPregunta', $idPregunta)
                    ->delete();
    }

    public function insertarRelacionMateriaPregunta($idMateria, $idPregunta)
    {
        $data = [
            'idMateria' => $idMateria,
            'idPregunta' => $idPregunta
        ];

        return $this->insert($data);
    }


}