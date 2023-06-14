<?php
    require 'db.php';

    $sql = 'SELECT * FROM etudiant';
    $result = mysqli_query($mysqli, $sql);

    if ($result) {
        $etudiant = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $etudiant = array();
    }

    mysqli_close($mysqli);
?>

<?php require 'acadmin.php'; ?>

<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Tous les Stagiaires</h2>
    </div>
    <div class="card-body">
      <table class="table">
        <tr>
          <th>ID</th>
          <th>Nom</th>
          <th>Prenom</th>
          <th>Email</th>
          <th>Mot de passe</th>
          <th>Action</th>
        </tr>
        <?php foreach ($etudiant as $person) : ?>
          <tr>
            <td><?= $person['id']; ?></td>
            <td><?= $person['nom']; ?></td>
            <td><?= $person['prenom']; ?></td>
            <td><?= $person['email']; ?></td>
            <td><?= $person['mdp']; ?></td>
            <td>
              <a href="edit.php?id=<?= $person['id'] ?>" class="btn btn-info">Edit</a>
              <a onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement?')" href="delete.php?id=<?= $person['id'] ?>" class="btn btn-danger">Supprimer</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>


