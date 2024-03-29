<?php
require('lib/database.php');
require('lib/session.php');
require('lib/authentication.php');
require('lib/response.php');

$database_connection = db_connect([
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'foodheroes'
]);

session_start();

$newReceipes = db_all('SELECT * FROM receipes WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 3 DAY) LIMIT 3');

?>



<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodHeroes | Home</title>

    <link rel="stylesheet" href="assets/css/flex.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <script src="https://kit.fontawesome.com/fa6e6fa057.js" crossorigin="anonymous"></script>

</head>

<body>
    <!-- Navigation Bar -->
    <nav>
        <div class="flex-container">
            <!-- Logo -->
            <div class="flex-item-33">
                <div class="flex-container">
                    <a class="logo" href="index.php">FoodHeroes</a>
                </div>
            </div>
            <!-- Navigation -->
            <div class="flex-item-33">
                <div class="flex-container">
                    <ul>
                        <li><a href="index.php">Startseite</a></li>
                        <li><a href="pages/receipes/receipes.php">Alle Rezepte</a></li>
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
                                <a href="pages/user/profile.php">Profil</a>
                                <a href="pages/user/dashboard.php">Meine Rezepte</a>
                                <a href="lib/bootsrap/logout.php">Abmelden</a>
                            </div>
                        </div>
                    <?php } else { ?>

                        <div class="dropdown">
                            <button class="dropbtn">Dein Account</button>
                            <div class="dropdown-content">
                                <a href="pages/user/signup.php">Registrieren</a>
                                <a href="pages/user/signin.php">Anmelden</a>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar__button" id="sidebar__button">
        <button><img src="assets/icons/burger.svg" height="25" width="25" alt="Burger Menu"></button>
    </div>

    <div class="sidebar__content" id="sidebar__content">
        <div class="sidebar__items">
            <ul>
                <li><a href="index.php">Startseite</a></li>
                <li><a href="pages/receipes/receipes.php">Alle Rezepte</a></li>

                <?php if (auth_user() != null) { ?>
                    <li><a href="pages/user/profile.php">Profil</a></li>
                    <li><a href="pages/receipes/receipes.php">Alle Rezepte</a></li>
                    <li> <a href="lib/bootsrap/logout.php">Abmelden</a></li>
                <?php } else { ?>
                    <li><a href="pages/user/signup.php">Registrieren</a></li>
                    <li><a href="pages/user/signin.php">Anmelden</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <!-- New Receipes -->
    <section class="new__receipes">
        <div class="flex-container">
            <div class="headline">
                <h1>Neue Rezepte</h1>
            </div>
        </div>

        <!--Receipes Images -->
        <div class="flex-container">
            <div class="flex-container" style="width: 80%;">

                <?php foreach ($newReceipes as $value): ?>

                    <div class="flex-item-33">
                        <div class="flex-container">
                            <!-- Food Card -->
                            <div class="food__card">
                                <div class="food__card__content">
                                    <div class="food__card__header">
                                        <img src=" <?='uploads/' . $value["image"] ?>" alt="Burger">
                                    </div>
                                    <div class="food__card__body">
                                        <h2>
                                            <?= htmlspecialchars($value["title"]) ?>
                                        </h2>

                                        <!-- PHP: Nach 5 Wörtern Zeichenumbruch -->
                                        <p class="food__card__description">
                                            <?= strlen(htmlspecialchars($value["description"])) > 30 ? substr(htmlspecialchars($value["description"]), 0, 30) . "..." : htmlspecialchars($value["description"]) ?>
                                        </p>

                                        <a class="food__card__button"
                                            href="pages/receipes/single_receipe.php?receipe_id=<?= htmlspecialchars($value["id"]) ?>">Weitere
                                            Informationen</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
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
                            <a href="pages/receipes/receipes.php">Alle Rezepte</a>
                        </li>
                        <li>
                            <a href="pages/user/signin.php">Anmelden</a>
                        </li>
                        <li>
                            <a href="pages/user/signup.php">Registrieren</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <p>Copyright 2023 FoodHeroes. <br> Made by TheCodeRevoluition with <span
                style="color: var(--accent-color)">❤️</span></p>

    </footer>


    <script src="js/sidebar.js"></script>

</body>

</html>