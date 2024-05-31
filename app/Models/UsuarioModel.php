<?php 
namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{

    protected $table      = 'usuario';
    protected $primaryKey = 'idUsuario';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object'; //object y array
    protected $useSoftDeletes = true;

    //todas las columnas que tiene la tabla
    protected $allowedFields = ['idUsuario', 'imgUsuario','nombre','correo','password','tipo'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime'; //date //int
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_modifica';
    protected $deletedField  = 'fecha_elimina';
    // En tu controlador o modelo de CodeIgniter


    
  // INICIO DE sesion
  public function getUserBy($field, $value)
    {
        return $this->where($field, $value)->first();
    }
}