<?php
require "./reqHeader.php";

$query = "SELECT * FROM paciente";
$data = $conn->query($query);
$pacientes = $data->fetchAll();

$query = "SELECT med.id AS idMedico, med.nome AS nomeMedico, esp.nome AS especialidadeMedico FROM medico AS med INNER JOIN especialidade AS esp ON med.idEspecialidade = esp.id";
$data = $conn->query($query);
$medicos = $data->fetchAll();

$btnText = "Cadastrar consulta";
$id;
$method = "post";
$consulta = [
  "id" => "",
  "data" => "",
  "hora" => "",
  "idPaciente" => "",
  "idMedico" => ""
];

if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $btnText = "Salvar alterações";
  $method = "edit";

  $query = "SELECT * FROM consulta WHERE id = :id";
  $resultado = $conn->prepare($query);
  $resultado->bindValue(':id', $id);
  $resultado->execute();
  $consulta = $resultado->fetch();
}
?>

<div class="container">
  <div class="row">
    <div class="col s12 m10 l8 offset-m1 offset-l2">
      <div class="card-panel z-depth-5 formPerfil">
        <form action="consultaController.php?action=<?= $method ?>" method="post" autocomplete="off">
          <h3>Consulta</h3>
          <div class="row">
            <div class="input-field col s12 m6">
              <input type="text" id="data" class="inputDark datepicker" name="data" value="<?= $consulta["data"]; ?>" />
              <label for="data">Data</label>
            </div>
            <div class="input-field col s12 m6">
              <input type="text" id="hora" class="inputDark timepicker" name="hora" value="<?= $consulta["hora"]; ?>" />
              <label for="hora">Hora</label>
            </div>
            <div class="input-field col s12 m6">
              <select name="idPaciente">
                <?php
                foreach ($pacientes as $paciente) :
                ?>
                  <option value="<?= $paciente["id"] ?>" <?php
                                                      if ($paciente["id"] == $consulta["idPaciente"]) {
                                                        echo "selected";
                                                      }
                                                      ?>><?= $paciente["nome"] ?></option>
                <?php
                endforeach;
                ?>
              </select>
              <label>Paciente</label>
            </div>
            <div class="input-field col s12 m6">
              <select name="idMedico">
                <?php
                foreach ($medicos as $medico) :
                ?>
                  <option value="<?= $medico["idMedico"] ?>" <?php
                                                      if ($medico["idMedico"] == $consulta["idMedico"]) {
                                                        echo "selected";
                                                      }
                                                      ?>><?= $medico["nomeMedico"] ?> - <?= $medico["especialidadeMedico"] ?></option>
                <?php
                endforeach;
                ?>
              </select>
              <label>Médico</label>
            </div>
          </div>
          <div class="input-field">
            <input type="hidden" name="id" value="<?= $id ?>" />
            <button type="submit" class="btn btn-flat btn-large btnDark btnBlock"><?= $btnText ?></button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<?php
require "./reqFooter.php";
?>