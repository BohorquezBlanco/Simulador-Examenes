<?php 
namespace App\Models;

use CodeIgniter\Model;

class PreguntaModel extends Model
{

    protected $table      = 'pregunta';
    protected $primaryKey = 'idPregunta';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array'; //object y array
    protected $useSoftDeletes = true;

    //todas las columnas que tiene la tabla
    protected $allowedFields = ['idPregunta','enunciado', 'a','b','c','d','e','respuesta','formula', 'idTema','exPas','imagenPregunta','dificultad','fecha_elimina'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime'; //date //int
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_modifica';
    protected $deletedField  = 'fecha_elimina';
    // En tu controlador o modelo de CodeIgniter

}