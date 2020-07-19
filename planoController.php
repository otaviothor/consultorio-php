<?php
require "./conn.php";

$action = $_GET["action"];

if ($action === "post") {
  
  $nome = $_POST['nome'];

  $query = "SELECT id FROM plano WHERE nome = :nome";
  $data = $conn->prepare($query);
  $data->bindValue(':nome', $nome);
  $data->execute();
  $existePlano = $data->fetchAll();

  if ($existePlano) {
    echo "
      <script>
        alert('Já existe um plano com esse nome!');
        location.href = 'formPlano.php';
      </script>
    ";
    die;
  }


  try {
    $query = "INSERT INTO plano (nome) VALUES (:nome)";
    $result = $conn->prepare($query);

    $result->bindValue(':nome', $nome);
    $result->execute();

    if ($result->rowCount() == 1) {
      echo "
        <script>
          alert('Plano cadastrado com sucesso!');
          location.href = 'verPlanos.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Erro ao cadastrar plano!');
          location.href = 'verPlanos.php';
        </script>
      ";
    }
  } catch (PDOException $er) {
    echo "
      <script>
        alert('Erro ao cadastrar {$er->getMessage()}');
        location.href = 'verPlanos.php';
      </script>
    ";
  }
} else if ($action === "edit") {

  $id = $_POST['id'];
  $nome = $_POST['nome'];

  try {
    $query = "UPDATE plano SET nome = :nome WHERE id = :id";
    $result = $conn->prepare($query);

    $result->bindValue(':nome', $nome);
    $result->bindValue(':id', $id);
    $result->execute();

    echo "
      <script>
        alert('Plano editado com sucesso!');
        location.href='verPlanos.php';
      </script>
    ";
  } catch (PDOException $er) {
    echo "
      <script>
        alert('Erro ao atualizar {$er->getMessage()}');
        location.href = 'verPlanos.php';
      </script>
    ";
  }
} else if ($action === "delete") {

  $id = $_GET['id'];

  try {
    $query = "DELETE FROM plano WHERE id = :id";
    $result = $conn->prepare($query);

    $result->bindValue(':id', $id);
    $result->execute();

    if ($result->rowCount() == 1) {
      echo "Plano deletado com sucesso!";
    } else {
      echo "Erro ao deletar plano!";
    }
  } catch (PDOException $er) {
    echo "Erro no banco - {$er->getMessage()}";
  }
} else {
  echo "
    <script>
      alert('Requisição não encontrada!');
      location.href = 'verPlanos.php';
    </script>
  ";
}
