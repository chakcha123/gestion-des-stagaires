<?php
require 'db.php';
$message = '';

if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['mdp'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $alterSql = "ALTER TABLE etudiant MODIFY id INT";
    $mysqli->query($alterSql);
    $result = $mysqli->query("SELECT MAX(id) FROM etudiant");
    $row = $result->fetch_assoc();
    $previousId = $row['MAX(id)'];
    $newId = $previousId + 1;
    $insertSql = "INSERT INTO etudiant (id, nom, prenom, email, mdp) VALUES ('$newId', '$nom', '$prenom', '$email', '$mdp')";
    if ($mysqli->query($insertSql)) {
        $message = 'Donnée créée avec succès';
    } else {
        $message = 'Erreur lors de la création des données: ' . $mysqli->error;
    }
}

$mysqli->close();

?>
<?php require 'acadmin.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Créer un étudiant</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="nom">Nom</label>
          <input type="text" name="nom" id="nom" class="form-control">
        </div>
        <div class="form-group">
          <label for="prenom">Prenom</label>
          <input type="text" name="prenom" id="prenom" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
          <label for="mdp">Mot de passe</label>
          <input type="text" name="mdp" id="mdp" class="form-control">
        </div>
        <div class="form-group">
            <br>
          <button type="submit" class="btn btn-info">Créer un stagiaire</button>
        </div>
      </form>
    </div>
  </div>
</div>
