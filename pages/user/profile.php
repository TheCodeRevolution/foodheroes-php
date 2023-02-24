<?php

require('../../lib/database.php');
require('../../lib/session.php');
require('../../lib/authentication.php');
require('../../lib/response.php');

session_start();

if(auth_user() == null) {
    redirect('signin.php');
}

$database_connection = db_connect([
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'foodheroes'
]);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $current_password = $_POST['current_password'] ?? '';
    $changed_password = $_POST['changed_password'] ?? '';

    if ($current_password === '') {
        $errors['current_password'] = 'Das aktuelle Passwort darf nicht leer sein';
    }

    if (strlen($changed_password) <= 7) {
        $errors['changed_password'] = 'Das Passwort muss mindestens 8 Zeichen enthalten';
    }

    if ($changed_password === '') {
        $errors['changed_password'] = 'Das neue Passwort darf nicht leer sein';
    }

    if (!$errors) {

        $user = db_get('SELECT * FROM user WHERE email = :email', [
            'email' => auth_user()["email"]
        ]);

        if (password_verify($current_password, $user["password"])) {
            $ok = true;
        } else {
            $errors['current_password'] = 'Dein Passwort ist nicht korrekt!';
        }

        if (isset($ok) && $ok) {
            db_update('user', auth_user()["id"], [
                'password' => password_hash($changed_password, PASSWORD_DEFAULT),
            ]);

            logout();
            redirect('signin.php');

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

    <!-- Profile Design -->

    <section class="user__profile__settings">
        <div class="flex-container">
            <div class="user__card">
                <h1>Deine Profil Einstellungen</h1>

                <form action="profile.php" , method="post">
                    <div class="form-group">
                        <label for="current_password">Aktuelles Passwort</label>
                        <input type="password" name="current_password" id="current_password"
                            placeholder="Neues Passwort angeben">

                        <?php if (isset($errors['current_password'])): ?>
                            <div class="alert">
                                <?= $errors['current_password'] ?>
                            </div>
                        <?php endif; ?>

                    </div>

                    <div class="form-group">
                        <label for="changed_password">Dein Passwort ändern</label>
                        <input type="password" name="changed_password" id="changed_password"
                            placeholder="Neues Passwort angeben">

                        <?php if (isset($errors['changed_password'])): ?>
                            <div class="alert">
                                <?= $errors['changed_password'] ?>
                            </div>
                        <?php endif; ?>

                    </div>

                    <div class="form-group">
                        <input type="submit" value="Aktualisieren">
                    </div>
                </form>

            </div>
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
                            <a href="index.php">Startseite</a>
                        </li>
                        <li>
                            <a href="#">Alle Rezepte</a>
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