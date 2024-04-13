<?php

namespace App\Controllers;

use App\Models\CarreraModel;

class Home extends BaseController
{
    public function index(): string
    {
        return view('adm/inicioAdm');
    }

}
