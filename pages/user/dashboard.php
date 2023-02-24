<?php
require('../../lib/database.php');
require('../../lib/session.php');
require('../../lib/authentication.php');
require('../../lib/response.php');
session_start();

if (auth_user() == null) {
    redirect('signin.php');
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
    <script src="https://kit.fontawesome.com/fa6e6fa057.js" crossorigin="anonymous"></script>

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

    <!-- List of all Receipes from user -->

    <section class="all__user__receipes">
        <div class="flex-container">
            <div class="all__user__receipes__card">
                <h2>Alle deine Rezepte</h2>

                <!-- Table -->

                <table id="all__receipes">
                    <tr>
                        <th>ID</th>
                        <th>Titel</th>
                        <th>Löschen</th>
                    </tr>
                    <tr>
                        <td>Alfreds Futterkiste</td>
                        <td>Maria Anders</td>
                        <td>Germany</td>
                    </tr>
                    <tr>
                        <td>Berglunds snabbköp</td>
                        <td>Christina Berglund</td>
                        <td>Sweden</td>
                    </tr>
                    <tr>
                        <td>Centro comercial Moctezuma</td>
                        <td>Francisco Chang</td>
                        <td>Mexico</td>
                    </tr>
                </table>

            </div>
        </div>
    </section>

    <!-- Create new Receipe -->
    <section class="create__receipe">
        <div class="flex-container">
            <div class="create__receipe__card">
                <h2>Rezept anlegen</h2>

                <form action="dashboard.php" method="post">

                    <div class="form-group">
                        <label for="receipe_title">Rezept Titel</label>
                        <input type="text" name="receipe_title" id="receipe_title" placeholder="Rezept Titel">
                    </div>

                    <div class="form-group">
                        <label for="receipe_portions">Anzahl der Portionen</label>
                        <input type="number" name="receipe_portions" id="receipe_portions" value="0">
                    </div>

                    <div class="form-group" style="height: 200px;">
                        <label for="receipe_description">Rezept Beschreibung</label>
                        <textarea name="receipe_description" id="receipe_description" autosize
                            placeholder="Deine Rezept Beschreibung"></textarea>
                    </div>

                    <div class="form-group">
                        <div class="flex-container">
                            <label for="upload_img" class="upload_button"><i class="fa fa-cloud-upload"></i> Bild
                                hochladen</label>
                            <input type="file" id="upload_img" name="upload_img" accept="image/*">
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Anlegen">
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