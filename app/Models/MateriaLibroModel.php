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

}
