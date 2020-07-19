<?php

  define('HOST', 'localhost');
  define('USER', 'root');
  define('PASS', '');
  define('DBNAME', 'clinica');

  try{
    $conn = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASS);
    $conn->exec("set names utf8");
  }
  catch(PDOException $e){
    echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
  }

?>
