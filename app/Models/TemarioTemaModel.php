<?php 
namespace App\Models;

use CodeIgniter\Model;

class TemarioTemaModel extends Model
{

    protected $table      = 'temario_tema';
    protected $primaryKey = null; 
    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idTema', 'idTemario'];



    //eliminarRelacion 
    public function eliminarRelacion($idTemario, $idTema)
    {
        return $this->where('idTemario', $idTemario)
                    ->where('idTema', $idTema)
                    ->delete();
    }

    public function insertarRelacionTemaTemario($idTemario, $idTema)
    {
        // Verificar si ya existe una relación con los mismos valores
        $existe = $this->where('idTemario', $idTemario)
                               ->where('idTema', $idTema)
                               ->first();
    
        if ($existe) {
            // Si ya existe, retornar un mensaje de error o lanzar una excepción
            return "La relación ya existe en la base de datos";
        }
    
        // Si no existe, realizar la inserción
        $data = [
            'idTemario' => $idTemario,
            'idTema' => $idTema
        ];
    
        return $this->insert($data);
    }
    


}