<?php 
namespace App\Models;

use CodeIgniter\Model;

class LibroModel extends Model 
{

    protected $table      = 'libro';
    protected $primaryKey = 'idLibro';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array'; //object y array
    protected $useSoftDeletes = true;

    //todas las columnas que tiene la tabla
    protected $allowedFields = ['idLibro','nombreLibro','descripcionLibro','imagenLibro','urlLibro'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime'; //date //int
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_modifica';
    protected $deletedField  = 'fecha_elimina';
    // En tu controlador o modelo de CodeIgniter

    public function materias()
    {
        return $this->belongsToMany('App\Models\MateriaModel', 'materia_libro', 'idLibro', 'idMateria');
    }
    

}