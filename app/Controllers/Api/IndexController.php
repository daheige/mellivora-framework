<?php

namespace App\Controllers\Api;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->success('ok');
    }
}
