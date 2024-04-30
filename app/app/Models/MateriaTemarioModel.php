<?php 
namespace App\Models;

use CodeIgniter\Model;

class MateriaTemarioModel extends Model
{

    protected $table      = 'materia_temario';
    protected $primaryKey = null; 
    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idMateria', 'idTemario'];
    


    //eliminarRelacion 
    public function eliminarRelacionMateriaTema($idMateria, $idTemario)
    {
        return $this->where('idMateria', $idMateria)
                    ->where('idTemario', $idTemario)
                    ->delete();
    }

    public function insertarRelacionMateriaTema($idMateria, $idTemario)
    {
        $data = [
            'idMateria' => $idMateria,
            'idTemario' => $idTemario
        ];

        return $this->insert($data);
    }
    public function existeRelacion($idMateria, $idTemario)
    {
        // Consulta la tabla para verificar si existe una relación con los mismos valores de idMateria e idTemario
        $registro = $this->where('idMateria', $idMateria)
                        ->where('idTemario', $idTemario)
                        ->first();

        // Devuelve true si se encontró un registro, de lo contrario devuelve false
        return ($registro !== null);
    }


}