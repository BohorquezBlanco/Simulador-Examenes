<?php 
namespace App\Models;

use CodeIgniter\Model;

class MateriaModel extends Model
{

    protected $table      = 'materia';
    protected $primaryKey = 'idMateria';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array'; //object y array
    protected $useSoftDeletes = true;

    //todas las columnas que tiene la tabla
    protected $allowedFields = ['idMateria','nombreMateria', 'descripcionMateria','imagenMateria', 'idCarrera'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime'; //date //int
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_modifica';
    protected $deletedField  = 'fecha_elimina';
    // En tu controlador o modelo de CodeIgniter

    public function libros()
    {
        return $this->belongsToMany('App\Models\LibroModel', 'materia_libro', 'idMateria', 'idLibro');
    }

}