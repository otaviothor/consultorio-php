<?php require "./reqHeader.php"; ?>

<div class="container grey-text text-darken-4">
  <div class="row">
    <h1>Especialidades</h1>

    <table class="responsive-table striped centered">
      <thead>
        <tr>
          <th>ID da especialidade</th>
          <th>Nome da especialidade</th>
          <th>Ações</th>
        </tr>
      </thead>

      <tbody>
        <?php
        $query = "SELECT * FROM especialidade";
        $data = $conn->query($query);
        $especialidades = $data->fetchAll();
        foreach ($especialidades as $especialidade) :
        ?>
          <tr>
            <td><?= $especialidade["id"]; ?></td>
            <td><?= $especialidade["nome"]; ?></td>
            <td>
              <a onclick='deletarEspecialidade(<?= $especialidade["id"]; ?>)' class="btn btn-flat btnDark">
                <i class="large material-icons">delete</i>
              </a>
              <a href="formEspecialidade.php?id=<?= $especialidade["id"]; ?>" class="btn btn-flat btnDark">
                <i class="large material-icons">edit</i>
              </a>
            </td>
          </tr>
        <?php
        endforeach;
        ?>
      </tbody>
    </table>
  </div>
</div>


<?php require "./reqFooter.php"; ?>