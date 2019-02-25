<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Planilla;
use App\EmpleadoPlanilla;

class EmpleadoPlanillaController extends Controller
{
  public function index()
  {
      $planillas=Planilla::All();
      return view('empleadoPlanillas.index',compact('planillas'));
  }

  public function show(Planilla $planilla)
  {
      return view('empleadoPlanillas.show',compact('planilla'));
  }

}
