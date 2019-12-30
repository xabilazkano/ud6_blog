<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GestorController extends Controller
{
	public function __construct(){
		$this->middleware('role:gestor');
	}

	public function index(){
		return "Soy gestor";
	}
}
