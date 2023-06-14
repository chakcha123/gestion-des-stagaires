<?php

session_start();

if (isset($_SESSION["user_id"])) {
    require __DIR__ . "/db.php";
    
    $sql = "SELECT * FROM etudiant
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <style>
    #nv {
        background-color: #3bc7ee;
    }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    
    <?php if (isset($user)): ?>
        <br>
        <nav id='nv' class="navbar navbar-expand-lg fixed-top">
            <div class="container">
             <a class="navbar-brand" href="/">Bonjour  <?= htmlspecialchars($user["nom"]) ?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                        <a class="nav-link" href="logout.php">Log out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- info stagiaire -->

        <div class="container">
            <div class="card mt-5">
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
                        <tr>
                            <td><?= $user['id']; ?></td>
                            <td><?= $user['nom']; ?></td>
                            <td><?= $user['prenom']; ?></td>
                            <td><?= $user['email']; ?></td>
                            <td><?= $user['mdp']; ?></td>
                            <td>
                            <a href="editst.php?id=<?= $user['id'] ?>" class="btn btn-info">Edit</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    <?php else: ?>
        
        <nav id='nv' class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">Bonjour</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    <a class="nav-link" href="login.php">Log in</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
        
    <?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
</body>
</html>
