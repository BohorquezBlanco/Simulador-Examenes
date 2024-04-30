<?php 

namespace App\Models;

use CodeIgniter\Model;

class MateriaLibroModel extends Model
{

    protected $table = 'materia_libro';

    protected $primaryKey = null; 
    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idMateria', 'idLibro'];

    //eliminarRelacion 
    public function eliminarRelacionMateriaLibro($idMateria, $idLibro)
    {
        return $this->where('idMateria', $idMateria)
                    ->where('idLibro', $idLibro)
                    ->delete();
    }

    public function insertarRelacionMateriaLibro($idMateria, $idLibro)
    {
        $data = [
            'idMateria' => $idMateria,
            'idLibro' => $idLibro
        ];

        return $this->insert($data);
    }
    public function existeRelacion($idMateria, $idLibro)
    {
        // Consulta la tabla para verificar si existe una relación con los mismos valores de idMateria e idTemario
        $registro = $this->where('idMateria', $idMateria)
                        ->where('idLibro', $idLibro)
                        ->first();

        // Devuelve true si se encontró un registro, de lo contrario devuelve false
        return ($registro !== null);
    }
}
