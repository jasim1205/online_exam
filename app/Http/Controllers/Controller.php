<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Toastr;
abstract class Controller
{
    public $notice;

    public function __construct()
    {
        $this->notice = new Toastr();
    }
}
