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

        if ($request->isPost()) {
            $regModel = new RegisterModel();
            $regModel->loadData($request->getBody());


            if ($regModel->validate() && $regModel->register()) {
                return 'success';
            } else {
                echo '<pre>';

                print_r($regModel->errors);

                echo '</pre>';
                return $this->render('register', ['model' => $regModel]);
            }
        }
    }
}
