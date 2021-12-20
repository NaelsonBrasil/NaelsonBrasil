<?php
session_start();
require 'inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if ($_POST['type'] == 'site') {

    switch ($_POST['plataform']) {
      case 'pts':

        break;

      case 'java':

        $_SESSION['configs'] = $_POST;
        $_SESSION['success'] = 'Connected!';
        header('Location:' . 'templates');

        break;

      default:
        $_SESSION['field_erros'] = 'Error execption';
        header('Location:' . 'connect');
        break;
    }
    
  }


} else {

  $_SESSION['field_erros'] = 'Erros fields';
  header('Location:' . 'connect');
}
