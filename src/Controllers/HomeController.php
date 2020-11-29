<?php
namespace App\Controllers;

use App\Controllers\CoreController;

class HomeController extends CoreController {

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $this->loadView('home');
    }

}