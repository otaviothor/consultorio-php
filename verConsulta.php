<?php
require "./reqHeader.php";

$consulta = [
  "idConsulta" => "",
  "dataConsulta" => "",
  "horaConsulta" => "",
  "nomeEspecialidade" => "",
  "idMedico" => "",
  "nomeMedico" => "",
  "crmMedico" => "",
  "idPaciente" => "",
  "nomePaciente" => "",
  "idadePaciente" => "",
  "planoPaciente" => ""
];

if (isset($_GET["id"])) {
  $id = $_GET["id"];

  $query = "SELECT con.id AS idConsulta, con.data AS dataConsulta, con.hora AS horaConsulta, esp.nome AS nomeEspecialidade, med.id AS idMedico, med.nome AS nomeMedico, med.crm AS crmMedico, pac.id AS idPaciente, pac.nome AS nomePaciente, pac.idade AS idadePaciente, pla.nome AS planoPaciente FROM consulta AS con INNER JOIN medico AS med ON con.idMedico = med.id INNER JOIN especialidade AS esp ON med.idEspecialidade = esp.id INNER JOIN paciente AS pac ON con.idPaciente = pac.id INNER JOIN plano AS pla ON pac.idPlano = pla.id WHERE con.id = :id";
  $resultado = $conn->prepare($query);
  $resultado->bindValue(':id', $id);
  $resultado->execute();
  $consulta = $resultado->fetch();
}
?>



<div class="container grey-text text-darken-4">
  <h1><?= $consulta["nomeEspecialidade"]; ?></h1>
  <p class="flow-text">
    Dia da consulta: <?= $consulta["dataConsulta"]; ?> | Hora: <?= $consulta["horaConsulta"]; ?>
    <span class="right">
      <a onclick='deletarConsulta(<?= $consulta["idConsulta"] ?>)' class="btn btn-flat btnDark">
        <i class="large material-icons">delete</i>
      </a>
      <a href="formConsulta.php?id=<?= $consulta["idConsulta"]; ?>" class="btn btn-flat btnDark">
        <i class="large material-icons">edit</i>
      </a>
    </span>
  </p>

  <div class="row">
    <h3>Médico</h3>
    <div class="card light-blue lighten-5 z-depth-3">
      <div class="card-content">
        <h4><?= $consulta["nomeMedico"]; ?></h4>
        <p class="flow-text">
          CRM: <?= $consulta["crmMedico"]; ?>
        </p>
      </div>
      <div class="card-action right-align">
        <a href="formMedico.php?id=<?= $consulta["idMedico"]; ?>" class="btn btn-flat btnDark">Perfil do médico</a>
      </div>
    </div>
  </div>
  <div class="row">
    <h3>Paciente</h3>
    <div class="card light-blue lighten-5 z-depth-3">
      <div class="card-content">
        <h4><?= $consulta["nomePaciente"]; ?></h4>
        <p class="flow-text">
          Idade: <?= $consulta["idadePaciente"]; ?> | Plano: <?= $consulta["planoPaciente"]; ?>
        </p>
      </div>
      <div class="card-action right-align">
        <a href="formPaciente.php?id=<?= $consulta["idPaciente"]; ?>" class="btn btn-flat btnDark">Perfil do paciente</a>
      </div>
    </div>
  </div>


</div>


<?php require "./reqFooter.php"; ?>