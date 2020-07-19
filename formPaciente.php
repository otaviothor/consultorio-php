<?php
require "./reqHeader.php";

$query = "SELECT * FROM plano";
$resultado = $conn->query($query);
$planos = $resultado->fetchAll();

$btnText = "Cadastrar paciente";
$id;
$method = "post";
$paciente = [
  "id" => "",
  "nome" => "",
  "idade" => "",
  "telefone" => "",
  "idPlano" => ""
];

if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $btnText = "Salvar alterações";
  $method = "edit";

  $query = "SELECT * FROM paciente WHERE id = :id";
  $resultado = $conn->prepare($query);
  $resultado->bindValue(':id', $id);
  $resultado->execute();
  $paciente = $resultado->fetch();
}
?>

<div class="container">
  <div class="row">
    <div class="col s12 m10 l6 offset-m1 offset-l3">
      <div class="card-panel z-depth-5 formPerfil">
        <form action="pacienteController.php?action=<?= $method ?>" method="post" autocomplete="off">
          <h3>Dados Pessoais</h3>
          <div class="input-field">
            <input type="text" id="nome" class="inputDark" name="nome" value="<?= $paciente["nome"]; ?>" />
            <label for="nome">Nome do paciente</label>
          </div>
          <div class="row">
            <div class="input-field col s12 m6">
              <input type="text" id="telefone" class="inputDark" name="telefone" value="<?= $paciente["telefone"]; ?>" data-mask="(00) 0000-0000" />
              <label for="telefone">Telefone</label>
            </div>
            <div class="input-field col s12 m6">
              <input type="text" id="idade" class="inputDark" name="idade" value="<?= $paciente["idade"]; ?>" maxlength="3" />
              <label for="idade">Idade</label>
            </div>
          </div>
          <div class="input-field">
            <select name="idPlano">
              <?php
              foreach ($planos as $plano) :
              ?>
                <option value="<?= $plano["id"] ?>" <?php
                                                    if ($plano["id"] == $paciente["idPlano"]) {
                                                      echo "selected";
                                                    }
                                                    ?>><?= $plano["nome"] ?></option>
              <?php
              endforeach;
              ?>
            </select>
            <label>Plano</label>
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