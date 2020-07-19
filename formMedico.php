<?php
require "./reqHeader.php";

$query = "SELECT * FROM especialidade";
$resultado = $conn->query($query);
$especialidades = $resultado->fetchAll();

$btnText = "Cadastrar médico";
$id;
$method = "post";
$medico = [
  "id" => "",
  "nome" => "",
  "telefone" => "",
  "crm" => "",
  "idEspecialidade" => ""
];

if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $btnText = "Salvar alterações";
  $method = "edit";

  $query = "SELECT * FROM medico WHERE id = :id";
  $resultado = $conn->prepare($query);
  $resultado->bindValue(':id', $id);
  $resultado->execute();
  $medico = $resultado->fetch();
}
?>

<div class="container">
  <div class="row">
    <div class="col s12 m10 l6 offset-m1 offset-l3">
      <div class="card-panel z-depth-5 formPerfil">
        <form action="medicoController.php?action=<?= $method ?>" method="post" autocomplete="off">
          <h3>Dados Pessoais</h3>
          <div class="input-field">
            <input type="text" id="nome" class="inputDark" name="nome" value="<?= $medico["nome"]; ?>" />
            <label for="nome">Nome do médico</label>
          </div>
          <div class="row">
            <div class="input-field col s12 m6">
              <input type="text" id="telefone" class="inputDark" name="telefone" value="<?= $medico["telefone"]; ?>" data-mask="(00) 0000-0000" />
              <label for="telefone">Telefone</label>
            </div>
            <div class="input-field col s12 m6">
              <input type="text" id="crm" class="inputDark" name="crm" value="<?= $medico["crm"]; ?>" data-mask="000000-0/AA" />
              <label for="crm">CRM</label>
            </div>
          </div>
          <div class="input-field">
            <select name="idEspecialidade">
              <?php
              foreach ($especialidades as $especialidade) :
              ?>
                <option value="<?= $especialidade["id"] ?>" <?php
                                                            if ($especialidade["id"] == $medico["idEspecialidade"]) {
                                                              echo "selected";
                                                            }
                                                            ?>><?= $especialidade["nome"] ?></option>
              <?php
              endforeach;
              ?>
            </select>
            <label>Especialidade</label>
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