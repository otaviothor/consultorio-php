<?php
require "./conn.php";

$action = $_GET["action"];

if ($action === "post") {

  $nome = $_POST['nome'];
  $telefone = $_POST['telefone'];
  $crm = $_POST['crm'];
  $idEspecialidade = $_POST['idEspecialidade'];

  $query = "SELECT id FROM medico WHERE nome = :nome";
  $data = $conn->prepare($query);
  $data->bindValue(':nome', $nome);
  $data->execute();
  $existeMedico = $data->fetchAll();

  if ($existeMedico) {
    echo "
      <script>
        alert('Já existe um médico com esse nome!');
        location.href = 'formMedico.php';
      </script>
    ";
    die;
  }


  try {
    $query = "INSERT INTO medico (nome, telefone, crm, idEspecialidade) VALUES (:nome ,:telefone ,:crm ,:idEspecialidade)";
    $result = $conn->prepare($query);

    $result->bindValue(':nome', $nome);
    $result->bindValue(':telefone', $telefone);
    $result->bindValue(':crm', $crm);
    $result->bindValue(':idEspecialidade', $idEspecialidade);
    $result->execute();

    if ($result->rowCount() == 1) {
      echo "
        <script>
          alert('Médico cadastrado com sucesso!');
          location.href = 'index.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Erro ao cadastrar médico!');
          location.href = 'index.php';
        </script>
      ";
    }
  } catch (PDOException $er) {
    echo "
      <script>
        alert('Erro ao cadastrar {$er->getMessage()}');
        location.href = 'index.php';
      </script>
    ";
  }
} else if ($action === "edit") {

  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $telefone = $_POST['telefone'];
  $crm = $_POST['crm'];
  $idEspecialidade = $_POST['idEspecialidade'];

  try {
    $query = "UPDATE medico SET nome = :nome, telefone = :telefone, crm = :crm, idEspecialidade = :idEspecialidade WHERE id = :id";
    $result = $conn->prepare($query);

    $result->bindValue(':id', $id);
    $result->bindValue(':nome', $nome);
    $result->bindValue(':telefone', $telefone);
    $result->bindValue(':crm', $crm);
    $result->bindValue(':idEspecialidade', $idEspecialidade);
    $result->execute();

    echo "
      <script>
        alert('Médico editado com sucesso!');
        location.href='index.php';
      </script>
    ";
  } catch (PDOException $er) {
    echo "
      <script>
        alert('Erro ao atualizar {$er->getMessage()}');
        location.href = 'index.php';
      </script>
    ";
  }
} else if ($action === "delete") {

  $id = $_GET['id'];

  try {
    $query = "DELETE FROM medico WHERE id = :id";
    $result = $conn->prepare($query);

    $result->bindValue(':id', $id);
    $result->execute();

    if ($result->rowCount() == 1) {
      echo "Médico deletado com sucesso!";
    } else {
      echo "Erro ao deletar médico!";
    }
  } catch (PDOException $er) {
    echo "Erro no banco - {$er->getMessage()}";
  }
} else {
  echo "
    <script>
      alert('Requisição não encontrada!');
      location.href = 'index.php';
    </script>
  ";
}
