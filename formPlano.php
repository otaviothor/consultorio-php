<?php
require "./reqHeader.php";

$btnText = "Cadastrar plano";
$id;
$method = "post";
$plano = [
  "id" => "",
  "nome" => ""
];

if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $btnText = "Salvar alterações";
  $method = "edit";

  $query = "SELECT * FROM plano WHERE id = :id";
  $resultado = $conn->prepare($query);
  $resultado->bindValue(':id', $id);
  $resultado->execute();
  $plano = $resultado->fetch();
}
?>

<div class="container">
  <div class="row">
    <div class="col s12 m10 l6 offset-m1 offset-l3">
      <div class="card-panel z-depth-5 formPerfil">
        <form action="planoController.php?action=<?= $method ?>" method="post" autocomplete="off">
          <h3>Plano</h3>
          <div class="input-field">
            <input type="text" id="nome" class="inputDark" name="nome" value="<?= $plano["nome"]; ?>" />
            <label for="nome">Nome do plano</label>
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