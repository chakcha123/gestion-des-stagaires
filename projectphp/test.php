<?php

// Initialize variables
$name = "";
$email = "";
$password = "";
$password_confirmation = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Form is submitted, process the data

    // Validate form inputs
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $password_confirmation = $_POST["password_confirmation"];

    if (empty($name)) {
        $errors["name"] = "Full Name is required";
    }

    if (empty($email)) {
        $errors["email"] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format";
    }

    if (empty($password)) {
        $errors["password"] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors["password"] = "Password must be at least 8 characters";
    }

    if (empty($password_confirmation)) {
        $errors["password_confirmation"] = "Please confirm your password";
    } elseif ($password !== $password_confirmation) {
        $errors["password_confirmation"] = "Passwords do not match";
    }

    if (empty($errors)) {
        // All form inputs are valid, proceed with signup process

        // Database connection and insertion code
        // Replace with your own database connection code
        require 'db.php';

        // Escape user inputs to prevent SQL injection

        // Check if email already exists in the database
        $query1 = "SELECT * FROM kliyan WHERE email = '$email'";
        $result1 = $mysqli->query($query1);

        if ($result1->num_rows > 0) {
            $errors["email"] = "Email already taken";
        } else {
            $alterSql = "ALTER TABLE kliyan MODIFY id INT";
            $mysqli->query($alterSql);
            $result = $mysqli->query("SELECT MAX(id) FROM kliyan");
            $row = $result->fetch_assoc();
            $previousId = $row['MAX(id)'];
            $newId = $previousId + 1;    
            // Insert user data into the database
            $query = "INSERT INTO kliyan (id, name, email, password, xnu_5ask) VALUES ('$newId', '$name', '$email', '$password', '')";

            if ($mysqli->query($query) === true) {
                // Redirect to success page
                header("Location: login.php");
                exit;
            } else {
                $errors["database"] = "Database error: " . $mysqli->error;
            }
        }

        $mysqli->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
<style>
        @import url("reset.css");
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
        @font-face {
          font-family: Ubuntu-Bold;
          src: url('../fonts/ubuntu/Ubuntu-Bold.ttf'); 
        }
    *{
        font-family: Ubuntu-Bold;
    }
    body {
    font-family: 'Poppins', sans-serif;
    min-height: 100vh;
    background-image: url(b1.jpg);
    display: flex;
    justify-content: center;
    align-items: center;
}

.signup-card {
    width: 450px;
    background: rgba(255, 255, 255, .5);
    padding: 4rem;
    border-radius: 10px;
    position: relative;
}

.signup-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(255, 255, 255, .15);
    transform: rotate(-6deg);
    border-radius: 10px;
    z-index: -1;
}

.signup-card-logo {
    margin-bottom: 2rem;
}

.signup-card-logo img {
    width: 360px;
    max-width: 100%;
}

.signup-card-logo,
.signup-card-header,
.signup-card-footer {
    text-align: center;
}

.signup-card a {
    text-decoration: none;
    color: #35339a;
}

.signup-card a:hover {
    text-decoration: underline;
}

.signup-card-header {
    margin-bottom: 2rem;
}

.signup-card-header h1 {
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: .5rem;
}

.signup-card-header h1+div {
    font-size: calc(1rem * .8);
    opacity: .8;
}

.signup-card-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    align-items: center;
}

.signup-card-form .form-item {
    position: relative;
}

.signup-card-form .form-item .form-item-icon {
    position: absolute;
    top: .82rem;
    left: 1.4rem;
    font-size: 1.3rem;
    opacity: .4;
}

.signup-card-form .checkbox {
    display: flex;
    align-items: center;
    gap: 7px;
}

.signup-card-form .form-item-other {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: calc(1rem * .8);
    margin-bottom: .5rem;
}

.signup-card-footer {
    margin-top: 1.5rem;
    font-size: calc(1rem * .8);
}

.signup-card input[type="text"],
.signup-card input[type="password"],
.signup-card input[type="email"] {
    border: none;
    outline: none;
    background: rgba(255, 255, 255, .3);
    padding: 1rem 1.5rem;
    padding-left: calc(1rem * 6.5);
    border-radius: 100px;
    width: 55%;
    transition: background .5s;
}

.signup-card input:focus {
    background: white;
}

.signup-card input[type="checkbox"] {
    width: 16px;
    height: 16px;
    accent-color: black;
}

.signup-card button {
    background: black;
    color: white;
    padding: 1rem;
    border-radius: 100px;
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 2px;
    transition: background .5s;
}

.signup-card button:hover {
    background-color: rgba(0, 0, 0, 0.85);
    cursor: pointer;
}

.signup-card-social {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    text-align: center;
    margin-top: 3rem;
}

.signup-card-social>div {
    opacity: .8;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-size: calc(1rem * .8);
}

.signup-card-social-btns {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
}

.signup-card-social-btns a {
    display: flex;
    align-items: center;
    justify-content: center;
    color: black;
    width: 50px;
    height: 50px;
    background-color: rgba(255, 255, 255, .6);
    border-radius: 100px;
    transition: all .5s;
}

.signup-card-social-btns a:hover {
    background-color: white;
    transform: scale(1.1);
}

@media (max-width: 768px) {

    body {
        padding: 2rem 0;
    }

    .signup-card {
        width: 280px;
        padding: 2rem;
    }

    .signup-card-logo img {
        width: 240px;
    }
}
        .error {
            color: red;
            font-size: 12px;
            text-align: center;
        }
</style>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,600,0,0" />
<title>Sign Up Page</title>
<script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
<script src="/js/validation.js" defer></script>
</head>
<body>
    <div class="signup-card-container">
        <div class="signup-card">
        <div class="signup-card-logo">
                <img src="logo.webp" alt="logo">
            </div>
            <div class="signup-card-header">
                <h1>Sign Up</h1>
                <div>Create an account to access the platform</div>
            </div>
            <form class="signup-card-form" action="signup.php" method="post" id="signup" novalidate>
                <div class="signup-card-form-container">
                    <div class="form-item">
                        <span class="form-item-icon material-symbols-rounded">person</span>
                        <input type="text" placeholder="Username" id="name" name="name" autofocus value="<?php echo $name; ?>">
                        <?php if (isset($errors["name"])): ?>
                            <p class="error"><?php echo $errors["name"]; ?></p>
                        <?php endif; ?>
                    </div>
                    <br>
                    <div class="form-item">
                        <span class="form-item-icon material-symbols-rounded">mail</span>
                        <input type="email" placeholder="Email" id="emailFm" name="email" value="<?php echo $email; ?>">
                        <?php if (isset($errors["email"])): ?>
                            <p class="error"><?php echo $errors["email"]; ?></p>
                        <?php endif; ?>
                    </div>
                    <br>
                    <div class="form-item">
                        <span class="form-item-icon material-symbols-rounded">lock</span>
                        <input type="password" placeholder="Password" id="password" name="password">
                        <?php if (isset($errors["password"])): ?>
                            <p class="error"><?php echo $errors["password"]; ?></p>
                        <?php endif; ?>
                    </div>
                    <br>
                    <div class="form-item">
                        <span class="form-item-icon material-symbols-rounded">lock</span>
                        <input type="password" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation">
                        <?php if (isset($errors["password_confirmation"])): ?>
                            <p class="error"><?php echo $errors["password_confirmation"]; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <button type="submit">Sign Up</button>
            </form>
            <div class="signup-card-footer">
                Already have an account? <a href="login.php">Sign In.</a>
            </div>
        </div>
    </div>
</body>
</html>