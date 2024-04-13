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
    protected $allowedFields = ['idUsuario','nombre', 'apellidoPaterno','correo','password','tipo'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime'; //date //int
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_modifica';
    protected $deletedField  = 'fecha_elimina';
    // En tu controlador o modelo de CodeIgniter


    
  // INICIO DE sesion
  public function getUserBy(string $column, string $value)
  {
    return $this->where($column,$value)->first();

  }
}