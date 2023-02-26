<?php
require('../../lib/database.php');
require('../../lib/session.php');
require('../../lib/authentication.php');
require('../../lib/response.php');
session_start();

if (auth_user() == null) {
    redirect('signin.php');
}

$database_connection = db_connect([
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'foodheroes'
]);

$errors = [];

$all_receipes = db_all('SELECT * FROM receipes WHERE user_id = :user_id', [
    'user_id' => auth_id()
]);

$target_dir = "../../uploads/";

$file = $_FILES["upload_img"]["name"] ?? '';
$imageFileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));

$target_file = $target_dir . basename($file) ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $edit_row_id = $_POST['edit_row_id'] ?? '';
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $receipe_title = $_POST['receipe_title'] ?? '';
    $receipe_portions = $_POST['receipe_portions'] ?? 0;
    $receipe_description = $_POST['receipe_description'] ?? '';

    if ($receipe_title === '') {
        $errors['receipe_title'] = 'Du musst einen Rezept Titel angeben';
    }

    if (is_numeric($receipe_portions) == false) {
        $errors['receipe_portions'] = 'Die Portionen müssen ein Zahlenwert sein';
    }

    if ($receipe_portions === '') {
        $errors['receipe_portions'] = 'Du musst eine Anzahl an Portionen angeben';
    }

    if ($receipe_portions < 1) {
        $errors['receipe_portions'] = 'Die Anzahl an Portionen muss mindestens 1 sein';
    }

    if ($receipe_description === '') {
        $errors['receipe_description'] = 'Du musst eine Rezept Beschreibung angeben';
    }

    if ($file == '' && $_FILES["upload_img"]["tmp_name"] == null) {
        $errors['upload_img'] = 'Du musst ein Bild auswählen!';
    } else {

        if ($_FILES["upload_img"]["size"] > 500000) {
            $errors['upload_img'] = 'Die Datei ist zu groß!';
        }

        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"
        ) {
            $errors['upload_img'] = 'Dieser Dateityp ist nicht erlaubt!';
        }
    }


    if (!$errors) {

        if ($file != '' && $_FILES["upload_img"]["tmp_name"] != null) {

            $newfilename = date('dmYHis') . str_replace(" ", "", basename($_FILES["upload_img"]["name"]));
            move_uploaded_file($_FILES["upload_img"]["tmp_name"], $target_dir . $newfilename);
        }

        db_insert('receipes', [
            'user_id' => auth_user()['id'],
            'description' => $receipe_description,
            'title' => $receipe_title,
            'portions' => $receipe_portions,
            'image' => $newfilename ?? ''
        ]);

        $receipe_title = '';
        $receipe_portions = '';
        $receipe_description = '';

        redirect('dashboard.php');

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
                    <li> <a href="../../lib/bootsrap/logout.php">Abmelden</a></li>
                <?php } else { ?>
                    <li> <a href="signup.php">Registrieren</a></li>
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
                        <th>Titel</th>
                        <th>Beschreibung</th>
                        <th>Erstellt am</th>
                        <th>Editieren</th>
                        <th>Löschen</th>
                    </tr>

                    <?php foreach ($all_receipes as $value): ?>

                        <tr>
                            <form action="../../lib/bootsrap/update.php" method="post">
                                <td>
                                    <input type="text" name="update__title" id="update__title"
                                        value=" <?= htmlspecialchars($value['title']) ?>">
                                </td>

                                <td>
                                    <textarea name="update__description" id="update__descriptio" cols="40"
                                        rows="3"><?= htmlspecialchars($value['description']) ?></textarea>
                                </td>

                                <td>
                                    <?= htmlspecialchars($value['created_at']) ?>
                                </td>
                                <td>

                                    <input type="hidden" name="updated_id" value="<?= $value["id"] ?>">
                                    <input type="submit" value="Aktualisieren">

                                </td>

                            </form>

                            <td>

                                <form action="../../lib/bootsrap/delete.php" method="post">
                                    <input type="hidden" name="deleted_id" value="<?= $value["id"] ?>">
                                    <button type="submit" class="delete__button"><img src="../../assets/icons/trash.svg"
                                            alt="Trash" height="15" width="15"></button>
                                </form>
                            </td>

                        </tr>

                    <?php endforeach; ?>
                </table>
            </div>
        </div>


    </section>

    <!-- Create new Receipe -->
    <section class="create__receipe">
        <div class="flex-container">
            <div class="create__receipe__card">
                <h2>Rezept anlegen</h2>

                <form action="dashboard.php" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="receipe_title">Rezept Titel</label>
                        <input type="text" name="receipe_title" id="receipe_title" placeholder="Rezept Titel"
                            value='<?= htmlspecialchars($receipe_title ?? '') ?>'>

                        <?php if (isset($errors['receipe_title'])): ?>
                            <div class="alert">
                                <?= $errors['receipe_title'] ?>
                            </div>
                        <?php endif; ?>

                    </div>

                    <div class="form-group">
                        <label for="receipe_portions">Anzahl der Portionen</label>
                        <input type="number" name="receipe_portions" id="receipe_portions"
                            value='<?= htmlspecialchars($receipe_portions ?? 0) ?>'>

                        <?php if (isset($errors['receipe_portions'])): ?>
                            <div class="alert">
                                <?= $errors['receipe_portions'] ?>
                            </div>
                        <?php endif; ?>

                    </div>

                    <div class="form-group" style="height: 200px;">
                        <label for="receipe_description">Rezept Beschreibung</label>
                        <textarea name="receipe_description" id="receipe_description" autosize
                            placeholder="Deine Rezept Beschreibung"><?= htmlspecialchars($receipe_description ?? '') ?></textarea>

                        <?php if (isset($errors['receipe_description'])): ?>
                            <div class="alert">
                                <?= $errors['receipe_description'] ?>
                            </div>
                        <?php endif; ?>

                    </div>

                    <div class="form-group">
                        <label for="upload_img">Bild
                            hochladen</label>
                        <input type="file" id="upload_img" name="upload_img" accept="image/*">

                        <?php if (isset($errors['upload_img'])): ?>
                            <div class="alert">
                                <?= $errors['upload_img'] ?>
                            </div>
                        <?php endif; ?>

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