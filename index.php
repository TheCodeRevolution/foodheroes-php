<?php

require('php/bootsrap.php');

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
                        <li><input type="search" name="search" id="search" placeholder="Rezept Suchen"></li>
                    </ul>
                </div>
            </div>
            <!-- Profile -->
            <div class="flex-item-33">
                <div class="flex-container">
                    <div class="dropdown">
                        <button class="dropbtn">Dein Account</button>
                        <div class="dropdown-content">
                            <a href="pages/user/signup.php">Registrieren</a>
                            <a href="pages/user/signin.php">Anmelden</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </nav>

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
                <div class="flex-item-33">
                    <div class="flex-container">
                        <!-- Food Card -->
                        <div class="food__card">
                            <div class="food__card__content">
                                <div class="food__card__header">
                                    <img src="burger.webp" alt="Burger">
                                </div>
                                <div class="food__card__body">
                                    <h2>Burger</h2>

                                    <!-- PHP: Nach 5 Wörtern Zeichenumbruch -->
                                    <p class="food__card__description">
                                        Lorem ipsum dolor sit amet, <br> consetetur sadipscing elitr, sed diam ...
                                    </p>

                                    <button class="food__card__button">Weitere Informationen</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-item-33">
                    <div class="flex-container">
                        <!-- Food Card -->
                        <div class="food__card">
                            <div class="food__card__content">
                                <div class="food__card__header">
                                    <img src="burger.webp" alt="Burger">
                                </div>
                                <div class="food__card__body">
                                    <h2>Burger</h2>

                                    <p class="food__card__description">
                                        Lorem ipsum dolor sit amet, <br> consetetur sadipscing elitr, sed diam ...
                                    </p>

                                    <button class="food__card__button">Weitere Informationen</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-item-33">
                    <div class="flex-container">
                        <!-- Food Card -->
                        <div class="food__card">
                            <div class="food__card__content">
                                <div class="food__card__header">
                                    <img src="burger.webp" alt="Burger">
                                </div>
                                <div class="food__card__body">
                                    <h2>Burger</h2>

                                    <p class="food__card__description">
                                        Lorem ipsum dolor sit amet, <br> consetetur sadipscing elitr, sed diam ...
                                    </p>

                                    <button class="food__card__button">Weitere Informationen</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <!-- Fast Receipes -->
    <section class="fast__receipes">
        <div class="flex-container">
            <div class="headline">
                <h1>Schnelle Rezepte</h1>
            </div>
        </div>

        <!--Receipes Images -->
        <div class="flex-container">
            <div class="flex-container" style="width: 80%;">
                <div class="flex-item-33">
                    <div class="flex-container">
                        <!-- Food Card -->
                        <div class="food__card">
                            <div class="food__card__content">
                                <div class="food__card__header">
                                    <img src="burger.webp" alt="Burger">
                                </div>
                                <div class="food__card__body">
                                    <h2>Burger</h2>


                                    <p class="food__card__description">
                                        Lorem ipsum dolor sit amet, <br> consetetur sadipscing elitr, sed diam ...
                                    </p>

                                    <button class="food__card__button">Weitere Informationen</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-item-33">
                    <div class="flex-container">
                        <!-- Food Card -->
                        <div class="food__card">
                            <div class="food__card__content">
                                <div class="food__card__header">
                                    <img src="burger.webp" alt="Burger">
                                </div>
                                <div class="food__card__body">
                                    <h2>Burger</h2>


                                    <p class="food__card__description">
                                        Lorem ipsum dolor sit amet, <br> consetetur sadipscing elitr, sed diam ...
                                    </p>

                                    <button class="food__card__button">Weitere Informationen</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-item-33">
                    <div class="flex-container">
                        <!-- Food Card -->
                        <div class="food__card">
                            <div class="food__card__content">
                                <div class="food__card__header">
                                    <img src="burger.webp" alt="Burger">
                                </div>
                                <div class="food__card__body">
                                    <h2>Burger</h2>


                                    <p class="food__card__description">
                                        Lorem ipsum dolor sit amet, <br> consetetur sadipscing elitr, sed diam ...
                                    </p>

                                    <button class="food__card__button">Weitere Informationen</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- Favourite Receipes -->

    <section class="favourite__receipes">
        <div class="flex-container">
            <div class="headline">
                <h1>Beliebte Rezepte</h1>
            </div>
        </div>

        <!--Receipes Images -->
        <div class="flex-container">
            <div class="flex-container" style="width: 80%;">
                <div class="flex-item-33">
                    <div class="flex-container">
                        <!-- Food Card -->
                        <div class="food__card">
                            <div class="food__card__content">
                                <div class="food__card__header">
                                    <img src="burger.webp" alt="Burger">
                                </div>
                                <div class="food__card__body">
                                    <h2>Burger</h2>


                                    <p class="food__card__description">
                                        Lorem ipsum dolor sit amet, <br> consetetur sadipscing elitr, sed diam ...
                                    </p>

                                    <button class="food__card__button">Weitere Informationen</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-item-33">
                    <div class="flex-container">
                        <!-- Food Card -->
                        <div class="food__card">
                            <div class="food__card__content">
                                <div class="food__card__header">
                                    <img src="burger.webp" alt="Burger">
                                </div>
                                <div class="food__card__body">
                                    <h2>Burger</h2>


                                    <p class="food__card__description">
                                        Lorem ipsum dolor sit amet, <br> consetetur sadipscing elitr, sed diam ...
                                    </p>

                                    <button class="food__card__button">Weitere Informationen</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-item-33">
                    <div class="flex-container">
                        <!-- Food Card -->
                        <div class="food__card">
                            <div class="food__card__content">
                                <div class="food__card__header">
                                    <img src="burger.webp" alt="Burger">
                                </div>
                                <div class="food__card__body">
                                    <h2>Burger</h2>


                                    <p class="food__card__description">
                                        Lorem ipsum dolor sit amet, <br> consetetur sadipscing elitr, sed diam ...
                                    </p>

                                    <button class="food__card__button">Weitere Informationen</button>
                                </div>
                            </div>
                        </div>
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
                            <a href="index.php">Startseite</a>
                        </li>
                        <li>
                            <a href="#">Alle Rezepte</a>
                        </li>
                        <li>
                            <a href="pages/signin.php">Anmelden</a>
                        </li>
                        <li>
                            <a href="pages/signup.php">Registrieren</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <p>Copyright 2023 FoodHeroes. <br> Made by TheCodeRevoluition with <span
                style="color: var(--accent-color)">❤️</span></p>

    </footer>

</body>

</html>