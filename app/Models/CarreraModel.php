<?php 
namespace App\Models;

use CodeIgniter\Model;

class CarreraModel extends Model
{

    protected $table      = 'carrera';
    protected $primaryKey = 'idCarrera';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array'; //object y array
    protected $useSoftDeletes = true;

    //todas las columnas que tiene la tabla
    protected $allowedFields = ['idCarrera','nombreCarrera', 'descripcionCarrera','imagenCarrera','fecha_elimina','fecha_modifica','fecha_modifica'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime'; //date //int
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_modifica';
    protected $deletedField  = 'fecha_elimina';
    // En tu controlador o modelo de CodeIgniter

}