<?php 
namespace App\Models;

use CodeIgniter\Model;

class RelacionModel extends Model
{

    protected $table      = 'examen_preguntas';
    protected $primaryKey = null; // No hay clave primaria predeterminada
    protected $allowedFields = ['idExamen', 'idMateria', 'idCarrera','idPreguntas']; // Reemplaza con los nombres de tus campos

    
}