<?php
require "./conn.php";

$action = $_GET["action"];

if ($action === "post") {

  $nome = $_POST['nome'];

  $query = "SELECT id FROM especialidade WHERE nome = :nome";
  $data = $conn->prepare($query);
  $data->bindValue(':nome', $nome);
  $data->execute();
  $existePlano = $data->fetchAll();

  if ($existePlano) {
    echo "
      <script>
        alert('Já existe uma especialidade com esse nome!');
        location.href = 'formEspecialidade.php';
      </script>
    ";
    die;
  }


  try {
    $query = "INSERT INTO especialidade (nome) VALUES (:nome)";
    $result = $conn->prepare($query);

    $result->bindValue(':nome', $nome);
    $result->execute();

    if ($result->rowCount() == 1) {
      echo "
        <script>
          alert('Especialidade cadastrada com sucesso!');
          location.href = 'verEspecialidades.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Erro ao cadastrar especialidade!');
          location.href = 'verEspecialidades.php';
        </script>
      ";
    }
  } catch (PDOException $er) {
    echo "
      <script>
        alert('Erro ao cadastrar {$er->getMessage()}');
        location.href = 'verEspecialidades.php';
      </script>
    ";
  }
} else if ($action === "edit") {

  $id = $_POST['id'];
  $nome = $_POST['nome'];

  try {
    $query = "UPDATE especialidade SET nome = :nome WHERE id = :id";
    $result = $conn->prepare($query);

    $result->bindValue(':nome', $nome);
    $result->bindValue(':id', $id);
    $result->execute();

    echo "
      <script>
        alert('Especialidade editada com sucesso!');
        location.href='verEspecialidades.php';
      </script>
    ";
  } catch (PDOException $er) {
    echo "
      <script>
        alert('Erro ao atualizar {$er->getMessage()}');
        location.href = 'verEspecialidades.php';
      </script>
    ";
  }
} else if ($action === "delete") {

  $id = $_GET['id'];

  try {
    $query = "DELETE FROM especialidade WHERE id = :id";
    $result = $conn->prepare($query);

    $result->bindValue(':id', $id);
    $result->execute();

    if ($result->rowCount() == 1) {
      echo "Especialidade deletada com sucesso!";
    } else {
      echo "Erro ao deletar especialidade!";
    }
  } catch (PDOException $er) {
    echo "Erro no banco - {$er->getMessage()}";
  }
} else {
  echo "
    <script>
      alert('Requisição não encontrada!');
      location.href = 'verEspecialidades.php';
    </script>
  ";
}
