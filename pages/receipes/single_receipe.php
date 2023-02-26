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

$receipe_id = $_GET["receipe_id"] ?? '';

if ($receipe_id == '') {
    redirect('../../index.php');
}

$receipe = db_get('SELECT * FROM receipes WHERE id = :id', [
    'id' => $receipe_id
]);

$user = db_get('SELECT * FROM user WHERE id = :user_id', [
    'user_id' => $receipe["user_id"]
]);

session_start();
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodHeroes | Home</title>

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
                                <a href="../user/profile.php">Profil</a>
                                <a href="../user/dashboard.php">Meine Rezepte</a>
                                <a href="../../lib/bootsrap/logout.php">Abmelden</a>
                            </div>
                        </div>
                    <?php } else { ?>

                        <div class="dropdown">
                            <button class="dropbtn">Dein Account</button>
                            <div class="dropdown-content">
                                <a href="../user/signup.php">Registrieren</a>
                                <a href="../user/signin.php">Anmelden</a>
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
                    <li><a href="../user/profile.php">Profil</a></li>
                    <li><a href="../user/dashboard.php">Meine Rezepte</a></li>
                    <li> <a href="../user/logout.php">Abmelden</a></li>
                <?php } else { ?>
                    <li><a href="../user/signup.php">Registrieren</a></li>
                    <li><a href="../user/signin.php">Anmelden</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>


    <!-- Single Receipe -->
    <section class="single__receipe">
        <div class="flex-container">
            <!-- Food Card -->
            <div class="food__card" style="margin-top: 130px;">
                <div class="food__card__content">
                    <div class="food__card__header">
                        <img src=" <?='../../uploads/' . $receipe["image"] ?>" alt="Burger">
                    </div>
                    <div class="food__card__body">
                        <h2>
                            <?= htmlspecialchars($receipe["title"]) ?>
                        </h2>
                        <p class="food__card__description">
                            <?= htmlspecialchars($receipe["description"]) ?>
                        </p>


                        <p class="food__card__portions">
                            Portionen:
                            <?= htmlspecialchars($receipe["portions"]) ?>
                        </p>

                        <p class="food__card__user">
                            <img src="../../assets/icons/user.svg" alt="User" height="16" width="16">
                            <?= htmlspecialchars($user["username"]) ?>
                        </p>

                    </div>
                </div>
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
                            <a href="../../index.php">Startseite</a>
                        </li>
                        <li>
                            <a href="receipes.php">Alle Rezepte</a>
                        </li>
                        <li>
                            <a href="../user/signin.php">Anmelden</a>
                        </li>
                        <li>
                            <a href="../user/signup.php">Registrieren</a>
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