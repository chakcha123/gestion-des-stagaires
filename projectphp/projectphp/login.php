<?php
session_start();
$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require __DIR__ . "/db.php";

    $email = $mysqli->real_escape_string($_POST["email"]);

    $sql = "SELECT * FROM etudiant WHERE email = '$email'";

    $result = $mysqli->query($sql);

    if ($result) {
        $user = $result->fetch_assoc();

        if ($user) {
            if ($_POST["mdp"] === $user["mdp"]) {
                session_regenerate_id();
                $_SESSION["user_id"] = $user["id"];
                header("Location: index.php");
                exit;
            } else {
                $is_invalid = true;
            }
        } else {
            $is_invalid = true;
        }
    } else {
        echo "Query error: " . $mysqli->error;
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V8</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="POST" action="">
					<span class="login100-form-title">
						Stagiaire
					</span>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">
						<input class="input100" type="text" name="email" placeholder="Email" value="<?= isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : "" ?>">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Please enter password">
						<input class="input100" type="password" name="mdp" placeholder="Mot de passe">
						<span class="focus-input100"></span>
					</div>

					<?php if ($is_invalid): ?>
					<br>
					<div class="text-danger">Invalid email or password</div>
					<?php endif; ?>

					<br>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">Se connecter</button>
					</div>

					<div class="flex-col-c p-t-170 p-b-40">
						<span class="txt1 p-b-9">
							Vous êtes Administrateur?
						</span>

						<a href="admin.php" class="txt3">
							Cliquer ici
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
