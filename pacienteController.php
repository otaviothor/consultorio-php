<?php
require "./conn.php";

$action = $_GET["action"];

if ($action === "post") {

  $nome = $_POST['nome'];
  $telefone = $_POST['telefone'];
  $idade = $_POST['idade'];
  $idPlano = $_POST['idPlano'];

  $query = "SELECT id FROM paciente WHERE nome = :nome";
  $data = $conn->prepare($query);
  $data->bindValue(':nome', $nome);
  $data->execute();
  $existePaciente = $data->fetchAll();

  if ($existePaciente) {
    echo "
      <script>
        alert('Já existe um paciente com esse nome!');
        location.href = 'formPaciente.php';
      </script>
    ";
    die;
  }


  try {
    $query = "INSERT INTO paciente (nome, telefone, idade, idPlano) VALUES (:nome ,:telefone ,:idade ,:idPlano)";
    $result = $conn->prepare($query);

    $result->bindValue(':nome', $nome);
    $result->bindValue(':telefone', $telefone);
    $result->bindValue(':idade', $idade);
    $result->bindValue(':idPlano', $idPlano);
    $result->execute();

    if ($result->rowCount() == 1) {
      echo "
        <script>
          alert('Paciente cadastrado com sucesso!');
          location.href = 'index.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Erro ao cadastrar paciente!');
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
  $idade = $_POST['idade'];
  $idPlano = $_POST['idPlano'];

  try {
    $query = "UPDATE paciente SET nome = :nome, telefone = :telefone, idade = :idade, idPlano = :idPlano WHERE id = :id";
    $result = $conn->prepare($query);

    $result->bindValue(':id', $id);
    $result->bindValue(':nome', $nome);
    $result->bindValue(':telefone', $telefone);
    $result->bindValue(':idade', $idade);
    $result->bindValue(':idPlano', $idPlano);
    $result->execute();

    echo "
      <script>
        alert('Paciente editado com sucesso!');
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
    $query = "DELETE FROM paciente WHERE id = :id";
    $result = $conn->prepare($query);

    $result->bindValue(':id', $id);
    $result->execute();

    if ($result->rowCount() == 1) {
      echo "Paciente deletado com sucesso!";
    } else {
      echo "Erro ao deletar paciente!";
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
