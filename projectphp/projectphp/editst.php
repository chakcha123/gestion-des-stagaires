<?php
    require 'db.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM etudiant WHERE id = ?";
    $statement = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($statement, 'i', $id);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $person = mysqli_fetch_object($result);
    
    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['mdp'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        
        $sql = "UPDATE etudiant SET nom = ?, prenom = ?, email = ?, mdp = ? WHERE id = ?";
        $statement = mysqli_prepare($mysqli, $sql);
        mysqli_stmt_bind_param($statement, 'ssssi', $nom, $prenom, $email, $mdp, $id);
        
        if (mysqli_stmt_execute($statement)) {
            mysqli_stmt_close($statement);
            mysqli_close($mysqli);
            header("Location: /");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($mysqli);
        }
    }
?>


<?php require 'index.php'; ?>

<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Mise à jour de donnees</h2>
    </div>
    <div class="card-body">
      <?php if (!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="nom">Nom</label>
          <input value="<?= $person->nom; ?>" type="text" name="nom" id="nom" class="form-control" readonly>
        </div>
        <div class="form-group">
          <label for="prenom">Prenom</label>
          <input value="<?= $person->prenom; ?>" type="text" name="prenom" id="prenom" class="form-control" readonly>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" value="<?= $person->email; ?>" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Mot de passe</label>
          <input value="<?= $person->mdp; ?>" type="text" name="mdp" id="mdp" class="form-control">
        </div>
        <div class="form-group">
          <br>
          <button type="submit" class="btn btn-info">Edit</button>
        </div>
      </form>
    </div>
  </div>
</div>
