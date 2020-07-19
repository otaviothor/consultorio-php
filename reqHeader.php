<?php require "./conn.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Clínica</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="style.css">

</head>

<body>

  <nav class="grey darken-4">
    <div class="container">
      <div class="nav-wrapper">
        <a href="./index.php" class="brand-logo
        ">
          Clínica
        </a>
        <ul class="right hide-on-med-and-down">
          <li>
            <a href="verPlanos.php" class="btn btn-flat btnTextLight">Planos</a>
          </li>
          <li>
            <a href="verEspecialidades.php" class="btn btn-flat btnTextLight">Especialidades</a>
          </li>
          <li>
            <a href="#" class="btn btn-flat btnLight dropdown-trigger" data-target='novoDrop'>Cadastro</a>
            <ul id='novoDrop' class='dropdown-content'>
              <li>
                <a href="formConsulta.php">Consulta</a>
              </li>
              <li>
                <a href="formMedico.php">Médico</a>
              </li>
              <li>
                <a href="formPaciente.php">Paciente</a>
              </li>
              <li>
                <a href="formEspecialidade.php">Especialidades</a>
              </li>
              <li>
                <a href="formPlano.php">Planos</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>