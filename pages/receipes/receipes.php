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
                            <a href="../user/signup.php">Registrieren</a>
                            <a href="../user/signin.php">Anmelden</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </nav>

    <!-- Favourite Receipes -->

    <section class="all__receipes" style="margin-top: 60px">
        <div class="flex-container">
            <div class="headline">
                <h1>Alle Rezepte</h1>
            </div>
        </div>

        <!-- TODO: Slider or image gallery -->
        <div class="flex-container" style="margin-top: 10px">

            <div class="grid-container">
                <div class="grid-item">
                    <!-- Food Card -->
                    <div class="food__card">
                        <div class="food__card__content">
                            <div class="food__card__header">
                                <img src="../../burger.webp" alt="Burger">
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
                <div class="grid-item">
                    <!-- Food Card -->
                    <div class="food__card">
                        <div class="food__card__content">
                            <div class="food__card__header">
                                <img src="../../burger.webp" alt="Burger">
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
                <div class="grid-item">
                    <!-- Food Card -->
                    <div class="food__card">
                        <div class="food__card__content">
                            <div class="food__card__header">
                                <img src="../../burger.webp" alt="Burger">
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
                <div class="grid-item">
                    <!-- Food Card -->
                    <div class="food__card">
                        <div class="food__card__content">
                            <div class="food__card__header">
                                <img src="../../burger.webp" alt="Burger">
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

        <!-- Pagination -->
        <div class="flex-container">
            <div class="pagination">
                <a href="#">&laquo;</a>
                <a href="#">1</a>
                <a class="active" href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">6</a>
                <a href="#">&raquo;</a>
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