<?php
require "./conn.php";

$action = $_GET["action"];

if ($action === "post") {

  $dia = $_POST['data'];
  $hora = $_POST['hora'];
  $idPaciente = $_POST['idPaciente'];
  $idMedico = $_POST['idMedico'];

  $query = "SELECT id FROM consulta WHERE data = '{$dia}' AND hora = '{$hora}'";
  $data = $conn->prepare($query);
  $data->execute();
  $existeConsulta = $data->fetchAll();

  if ($existeConsulta) {
    echo "
      <script>
        alert('Já existe uma consulta marcada nesse horário!');
        location.href = 'formConsulta.php';
      </script>
    ";
    die;
  }


  try {
    $query = "INSERT INTO consulta (hora, data, idPaciente, idMedico) VALUES ('{$hora}', '{$dia}', {$idPaciente}, {$idMedico})";

    $result = $conn->prepare($query);
    $result->execute();

    if ($result->rowCount() == 1) {
      echo "
        <script>
          alert('Consulta marcada com sucesso!');
          location.href = 'index.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Erro ao marcar consulta!');
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
  $dia = $_POST['data'];
  $hora = $_POST['hora'];
  $idPaciente = $_POST['idPaciente'];
  $idMedico = $_POST['idMedico'];

  try {
    $query = "UPDATE consulta SET data = '{$dia}', hora = '{$hora}', idPaciente = {$idPaciente}, idMedico = {$idMedico} WHERE id = {$id}";
    $result = $conn->prepare($query);

    $result->execute();

    echo "
      <script>
        alert('Consulta editado com sucesso!');
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
    $query = "DELETE FROM consulta WHERE id = :id";
    $result = $conn->prepare($query);

    $result->bindValue(':id', $id);
    $result->execute();

    if ($result->rowCount() == 1) {
      echo "Consulta deletada com sucesso!";
    } else {
      echo "Erro ao deletar consulta!";
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
