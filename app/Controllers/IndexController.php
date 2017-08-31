<?php

namespace App\Controllers;

class IndexController extends Controller
{
    public function indexAction()
    {
        return response()->write('hello, index page');
    }
}
