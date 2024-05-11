<?php 
namespace App\Models;

use CodeIgniter\Model;

class TemarioModel extends Model
{

    protected $table      = 'temario';
    protected $primaryKey = 'idTemario';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array'; //object y array
    protected $useSoftDeletes = true;

    //todas las columnas que tiene la tabla
    protected $allowedFields = ['idTemario','nombreTemario', 'contenidoTemario','libroTemario','videoTemario', 'idMateria'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime'; //date //int
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_modifica';
    protected $deletedField  = 'fecha_elimina';
    // En tu controlador o modelo de CodeIgniter

}