<?php

require('../../lib/database.php');
require('../../lib/session.php');
require('../../lib/authentication.php');
require('../../lib/response.php');

$database_connection = db_connect([
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'foodheroes'
]);

session_start();

if(auth_user() != null) {
    redirect('dashboard.php');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Bitte gebe eine korrekte E-Mail Adresse an!';
    }

    if ($email === '') {
        $errors['email'] = 'Bitte gebe eine E-Mail Adresse an!';
    }

    if ($password === '') {
        $errors['password'] = 'Bitte gebe ein Passwort an';
    }

    if (!$errors) {
        $user = db_get('SELECT * FROM user WHERE email = :email', [
            'email' => $email
        ]);

        if ($user && password_verify($password, $user["password"])) {
            $ok = true;
        } else {
            $errors['login'] = 'Fehler beim Anmelden!';
        }

        if (isset($ok) && $ok) {
            login(['id' => $user['id'], 'username' => $user['username'], 'email' => $user['email']]);
            redirect('dashboard.php');
        }

    }

}

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodHeroes | Anmelden</title>

    <link rel="stylesheet" href="../../assets/css/flex.css">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="../../assets/css/responsive.css">

</head>

<body>
    <!-- Navigation Bar -->
    <nav>
        <div class="flex-container">
            <!-- Logo -->
            <div class="flex-item-33">
                <div class="flex-container">
                    <a class="logo" href="../../index.php">FoodHeroes</a>
                </div>
            </div>
            <!-- Navigation -->
            <div class="flex-item-33">
                <div class="flex-container">
                    <ul>
                        <li><a href="../../index.php">Startseite</a></li>
                        <li><a href="../receipes/receipes.php">Alle Rezepte</a></li>
                        <li><input type="search" name="search" id="search" placeholder="Rezept Suchen"></li>
                    </ul>
                </div>
            </div>
            <!-- Profile -->
            <div class="flex-item-33">
                <div class="flex-container">

                    <?php if (auth_user() != null) { ?>

                        <div class="dropdown">
                            <button class="dropbtn">
                                <?='Hallo ' . auth_user()["username"] ?>
                            </button>
                            <div class="dropdown-content">
                                <a href="profile.php">Profil</a>
                                <a href="dashboard.php">Meine Rezepte</a>
                                <a href="../../lib/bootsrap/logout.php">Abmelden</a>
                            </div>
                        </div>
                    <?php } else { ?>

                        <div class="dropdown">
                            <button class="dropbtn">Dein Account</button>
                            <div class="dropdown-content">
                                <a href="signup.php">Registrieren</a>
                                <a href="signin.php">Anmelden</a>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar__button" id="sidebar__button">
        <button><img src="../../assets/icons/burger.svg" height="25" width="25" alt="Burger Menu"></button>
    </div>

    <div class="sidebar__content" id="sidebar__content">
        <div class="sidebar__items">
            <ul>
                <li><a href="../../index.php">Startseite</a></li>
                <li><a href="../receipes/receipes.php">Alle Rezepte</a></li>

                <?php if (auth_user() != null) { ?>
                    <li><a href="profile.php">Profil</a></li>
                    <li> <a href="dashboard.php">Meine Rezepte</a></li>
                    <li> <a href="../../lib//bootsrap/logout.php">Abmelden</a></li>
                <?php } else { ?>
                    <li>  <a href="signup.php">Registrieren</a></li>
                    <li> <a href="signin.php">Anmelden</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <!-- Signin and Signup Form -->

    <section class="login__form">
        <div class="flex-container">
            <form action="" method="post">
                <h1>Anmelden</h1>
                <div class="form-group">
                    <label for="username">Deine E-Mail</label>
                    <input type="email" name="email" id="email" placeholder="E-Mail Adresse"
                        value='<?= htmlspecialchars($email ?? '') ?>'>

                    <?php if (isset($errors['email'])): ?>
                        <div class="alert">
                            <?= $errors['email'] ?>
                        </div>
                    <?php endif; ?>

                </div>
                <div class="form-group">
                    <label for="username">Dein Passwort</label>
                    <input type="password" name="password" id="password" placeholder="Passwort"
                        value='<?= htmlspecialchars($password ?? '') ?>'>

                    <?php if (isset($errors['password'])): ?>
                        <div class="alert">
                            <?= $errors['password'] ?>
                        </div>
                    <?php endif; ?>


                </div>

                <div class="form-group">
                    <input type="submit" value="Anmelden">
                    <?php if (isset($errors['login'])): ?>
                        <div class="alert">
                            <?= $errors['login'] ?>
                        </div>
                    <?php endif; ?>
                </div>

            </form>
        </div>
    </section>


    <!-- Footer -->
    <footer>
        <div class="flex-container">
            <div class="flex-item-50">
                <div class="flex-container">
                    <ul>
                        <li>
                            <a href="#">Impressum</a>
                        </li>
                        <li><a href="#">Datenschutz</a></li>
                        <li><a href="#">Kontakt</a></li>
                    </ul>
                </div>
            </div>
            <div class="flex-item-50">
                <div class="flex-container">
                    <ul>
                        <li>
                            <a href="../../index.php">Startseite</a>
                        </li>
                        <li>
                            <a href="../receipes/receipes.php">Alle Rezepte</a>
                        </li>
                        <li>
                            <a href="signin.php">Anmelden</a>
                        </li>
                        <li>
                            <a href="signup.php">Registrieren</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <p>Copyright 2023 FoodHeroes. <br> Made by TheCodeRevoluition with <span
                style="color: var(--accent-color)">❤️</span></p>

    </footer>


    <script src="../../js/sidebar.js"></script>
</body>

</html>