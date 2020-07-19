<?php require "./reqHeader.php"; ?>

<div class="container grey-text text-darken-4">
  <div class="row">

    <div class="col s12 formPerfil">
      <ul class="tabs">
        <li class="tab col s4"><a href="#consultas" class="grey-text text-darken-4">Consultas</a></li>
        <li class="tab col s4"><a href="#medicos" class="grey-text text-darken-4">Médicos</a></li>
        <li class="tab col s4"><a href="#pacientes" class="grey-text text-darken-4">Pacientes</a></li>
      </ul>
    </div>
    <div id="consultas" class="col s12">
      <h1>Consultas</h1>
      <?php
      $query = "SELECT con.id AS idConsulta, con.data AS dataConsulta, con.hora AS horaConsulta, med.idEspecialidade AS idEspecialidade, esp.nome AS nomeEspecialidade, pac.nome AS nomePaciente FROM consulta AS con INNER JOIN especialidade AS esp INNER JOIN medico AS med ON med.idEspecialidade = esp.id INNER JOIN paciente AS pac ON con.idPaciente = pac.id";
      $data = $conn->query($query);
      $consultas = $data->fetchAll();
      foreach ($consultas as $consulta) :
      ?>
        <div class="col s12 m4">
          <div class="card z-depth-3">
            <div class="card-content">
              <span class="card-title"><?= $consulta["nomeEspecialidade"]; ?></span>
              <p class="truncate">Paciente: <?= $consulta["nomePaciente"]; ?></p>
              <p><?= $consulta["dataConsulta"]; ?> - <?= $consulta["horaConsulta"]; ?></p>
            </div>
            <div class="card-action right-align">
              <a href="verConsulta.php?id=<?= $consulta["idConsulta"]; ?>" class="btn btn-flat btnDark">Detalhes</a>
            </div>
          </div>
        </div>
      <?php
      endforeach;
      ?>
    </div>
    <div id="medicos" class="col s12">
      <h1>Médicos</h1>
      <?php
      $query = "SELECT med.id AS idMedico, med.nome AS nomeMedico, esp.nome AS especialidadeMedico FROM medico AS med INNER JOIN especialidade AS esp ON med.idEspecialidade = esp.id";
      $data = $conn->query($query);
      $medicos = $data->fetchAll();
      foreach ($medicos as $medico) :
      ?>
        <div class="col s12 m4">
          <div class="card z-depth-3">
            <div class="card-content">
              <span class="card-title"><?= $medico["nomeMedico"]; ?></span>
              <p>Especialidade: <?= $medico["especialidadeMedico"]; ?></p>
            </div>
            <div class="card-action right-align">
              <a onclick='deletarMedico(<?= $medico["idMedico"] ?>)' class="btn btn-flat btnDark">
                <i class="large material-icons">delete</i>
              </a>
              <a href="formMedico.php?id=<?= $medico["idMedico"]; ?>" class="btn btn-flat btnDark">Detalhes</a>
            </div>
          </div>
        </div>
      <?php
      endforeach;
      ?>
    </div>
    <div id="pacientes" class="col s12">
      <h1>Pacientes</h1>
      <?php
      $query = "SELECT pac.id AS idPaciente, pac.nome AS nomePaciente, pac.idade AS idadePaciente, pla.nome AS planoPaciente FROM paciente AS pac INNER JOIN plano AS pla ON pac.idPlano = pla.id";
      $data = $conn->query($query);
      $pacientes = $data->fetchAll();
      foreach ($pacientes as $paciente) :
      ?>
        <div class="col s12 m4">
          <div class="card z-depth-3">
            <div class="card-content">
              <span class="card-title"><?= $paciente["nomePaciente"]; ?></span>
              <p>Idade: <?= $paciente["idadePaciente"]; ?></p>
              <p>Plano: <?= $paciente["planoPaciente"]; ?></p>
            </div>
            <div class="card-action right-align">
              <a onclick='deletarPaciente(<?= $paciente["idPaciente"] ?>)' class="btn btn-flat btnDark">
                <i class="large material-icons">delete</i>
              </a>
              <a href="formPaciente.php?id=<?= $paciente["idPaciente"]; ?>" class="btn btn-flat btnDark">Detalhes</a>
            </div>
          </div>
        </div>
      <?php
      endforeach;
      ?>
    </div>
  </div>

</div>


<?php require "./reqFooter.php"; ?>