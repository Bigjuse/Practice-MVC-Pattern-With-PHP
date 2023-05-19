<?php


namespace App\Controllers;

use App\Application;
use App\Controller;
use App\Request;

class ContactController extends Controller
{

    public function index()
    {
        $this->render('contact', ['foo' => 'bar']);
    }
    public function store(Request $request)
    {

        print_r($request->getBody());
    }
}
