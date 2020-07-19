<?php require "./reqHeader.php"; ?>

<div class="container grey-text text-darken-4">
  <div class="row">
    <h1>Planos</h1>

    <table class="responsive-table striped centered">
      <thead>
        <tr>
          <th>ID do plano</th>
          <th>Nome do plano</th>
          <th>Ações</th>
        </tr>
      </thead>

      <tbody>
        <?php
        $query = "SELECT * FROM plano";
        $data = $conn->query($query);
        $planos = $data->fetchAll();
        foreach ($planos as $plano) :
        ?>
          <tr>
            <td><?= $plano["id"]; ?></td>
            <td><?= $plano["nome"]; ?></td>
            <td>
              <a onclick='deletarPlano(<?= $plano["id"] ?>)' class="btn btn-flat btnDark">
                <i class="large material-icons">delete</i>
              </a>
              <a href="formPlano.php?id=<?= $plano["id"]; ?>" class="btn btn-flat btnDark">
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