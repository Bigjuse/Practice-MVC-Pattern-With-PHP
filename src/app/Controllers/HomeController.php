<?php


namespace App\Controllers;

use App\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return $this->render('home', ['foo' => 'bar']);
    }
}
