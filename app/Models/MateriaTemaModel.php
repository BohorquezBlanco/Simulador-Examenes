<?php 
namespace App\Models;

use CodeIgniter\Model;

class MateriaTemaModel extends Model
{

    protected $table      = 'materia_tema';
    protected $primaryKey = null; 
    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idMateria', 'idTema'];
    


    //eliminarRelacion 
    public function eliminarRelacionMateriaTema($idMateria, $idTema)
    {
        return $this->where('idMateria', $idMateria)
                    ->where('idTema', $idTema)
                    ->delete();
    }

    public function insertarRelacionMateriaTema($idMateria, $idTema)
    {
        $data = [
            'idMateria' => $idMateria,
            'idPregunta' => $idTema
        ];

        return $this->insert($data);
    }


}