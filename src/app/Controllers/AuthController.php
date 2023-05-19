<?php

namespace App\Controllers;

use App\Models\RegisterModel;
use App\Request;
use App\Controller;



class AuthController extends Controller
{

    public function login(Request $request)
    {
        $this->setLayout('second_layout');
        if ($request->isGet()) {
            $this->render('login');
        }
    }


    public function register(Request $request)
    {
        $this->setLayout('second_layout');
        if ($request->isGet()) {
            $this->render('register');
        }

        $regModel = new RegisterModel();
    }
}
