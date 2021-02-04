<?php

function checkLoggedIn(){
  if($_SESSION['restaurant'] = null){
    return '/html/login.html';
  }else{
    return '/html/editarPerfil.html';
  }
}

$router ->define([
  '' => checkLoggedIn(),
  'profile' => '/html/editarPerfil.html',
  'edit-cards' => '/html/editarCarta.html',
  'login' => '/html/login.html',
  'register' => '/html/register.html'
]);