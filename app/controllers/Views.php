<?php

class Views extends Control
{

  public function index()
  {
    $datos = [
      "title" => "Inicio"
    ];
    $this->load_view('inicio', $datos);
  }

  public function login()
  {
    $datos = [
      "title" => "Login"
    ];
    $this->load_view('login', $datos);
  }

  
  public function dashboard()
  {
    $datos = [
      "title" => "Dashboard"
    ];
    $this->load_view('dashboard', $datos);
  }
  
  public function registro()
  {
    $datos = [
      "title" => "Registro"
    ];
    $this->load_view('registro', $datos);
  }
  
  public function update($id)
  {
    echo "Update view " . $id;
  }

}