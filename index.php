<?php

include __DIR__ . "/config/DBConnector.php";

$stmt = $conn->prepare("SELECT * FROM home_page_content_tb WHERE id = :id");
$stmt->execute([':id' => 1]);

$homePageContent = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="./public/chabacano_logo.png">
    <link rel="stylesheet" href="./styles/index.css">
    <title>Chabacano Translator</title>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <nav class="header__navbar">
            <div class="header__navbar__logo">
                <a href="./index.php" class="header__navbar__logo__link">
                    <img src="./public/chabacano_logo.png" alt="Chabcano Translator Logo" width="300" loading="lazy">
                </a>
            </div>
            <ul class="header__navbar__links">
                <div class="header__navbar__links__container">

                    <li class="navbar__links__item">
                        <a href="#home" class="text-light fs-body-text-semibold">Home</a>
                    </li>
                    <li class="navbar__links__item">
                        <a href="#about-us" class="text-light fs-body-text-semibold">About Us</a>
                    </li>
                    <li class="navbar__links__item">
                        <a href="./view/story.php" class="text-light fs-body-text-semibold">Story</a>
                    </li>
                    <li class="navbar__links__item">
                        <a href="./view/chabacanoDictionary.php" class="text-light fs-body-text-semibold">Dictionary</a>
                    </li>
                </div>
                <div class="header__navbar__links__cta">
                    <div class="header__navbar__cta" role="button">
                        <a href="./view/translator.php" class="button button--light fs-body-text-semibold">Translator</a>
                    </div>
                </div>
            </ul>
            <div class="header__navbar__burger--menu">
                <img src="./assets/images/hamburger.png" alt="Menu Icon">
            </div>
        </nav>
    </header>
    <!-- Main -->
    <main>

        <!-- Hero Section -->
        <section class="hero" id="home" aria-labelledby="hero-heading">
            <div class="hero__content">
                <div class="hero__content__main">
                    <div class="hero__content__heading">
                        <h1 id="hero-heading" class="fs-heading-1-bold text-light">
                            <?php echo $homePageContent['hero_title']; ?>
                        </h1>
                    </div>
                    <div class="hero__content__tagline">
                        <p class="fs-heading-3 text-light">
                            <?php echo $homePageContent['hero_content']; ?>
                        </p>
                    </div>
                    <div class="hero__content__cta">
                        <a href="./view/admin/index.php" class="button button--light" role="button" aria-label="Get started with the translator">Get Started</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Us Section -->
        <section class="about-us bg-accent-2" id="about-us" role="region" aria-labelledby="about-us-heading">
            <div class="about-us__content">
                <div class="about-us__content__col-1">
                    <div class="about-us__content__col-1__content">
                        <!-- About Us -->
                        <h2 id="about-us-heading" class="fs-heading-4 text-dark">
                            <?php echo $homePageContent['about_us_title']; ?>
                        </h2>
                        <p class="fs-body-text text-dark">
                            <?php echo $homePageContent['about_us_content']; ?>
                        </p>
                    </div>

                    <!-- Our Mission -->
                    <div class="about-us__content__col-1__content">
                        <h3 class="fs-heading-4 text-dark">
                            <?php echo $homePageContent['our_mission_title']; ?>
                        </h3>
                        <p class="fs-body-text text-dark">
                            <?php echo $homePageContent['our_mission_content']; ?>
                        </p>
                    </div>

                    <!-- Our Vision -->
                    <div class="about-us__content__col-1__content">
                        <h3 class="fs-heading-4 text-dark">
                            <?php echo $homePageContent['our_vision_title']; ?>
                        </h3>
                        <p class="fs-body-text text-dark">
                            <?php echo $homePageContent['our_vision_content']; ?>
                        </p>
                    </div>

                    <!-- Why Chabacano? -->
                    <div class="about-us__content__col-1__content">
                        <h3 class="fs-heading-4 text-dark">
                            <?php echo $homePageContent['why_chabacano_title']; ?>
                        </h3>
                        <p class="fs-body-text text-dark">
                            <?php echo $homePageContent['why_chabacano_content']; ?>
                        </p>
                    </div>
                </div>
                <div class="about-us__content__col-2">
                    <div class="about-us__content__col-2__image">
                        <img src="./assets/images/monument_about_us_pic.png" alt="A historical monument representing our story" loading="lazy">
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta">
            <div class="cta__heading">
                <h3 class="fs-heading-3 text-dark text-center">
                    Discover the Beauty of Chabacano
                </h3>
                <p class="fs-body-text text-dark text-center">
                    Effortlessly translate between Chabacano, English, and Tagalog. Bridge cultures and languages with our simple yet powerful translator.
                </p>
            </div>

            <div class="cta__cta" role="button">
                <a href="view/translator.php" class="button button--primary">Get Started</a>
                <a href="view/chabacanoDictionary.php" class="button button--primary">Learn More</a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer bg-primary">
        <nav class="navbar">
            <div class="navbar__logo">
                <a href="#home">
                    <img src="./public/chabacano_logo.png" alt="Chabcano Translator Logo" width="300">
                </a>
            </div>
            <ul class="navbar__links">
                <li class="navbar__links__item">
                    <a href="#home" class="text-light fs-body-text-semibold">Home</a>
                </li>
                <li class="navbar__links__item">
                    <a href="#about-us" class="text-light fs-body-text-semibold">About Us</a>
                </li>
                <li class="navbar__links__item">
                    <a href="./view/story.php" class="text-light fs-body-text-semibold">Story</a>
                </li>
                <li class="navbar__links__item">
                    <a href="./view/chabacanoDictionary.php" class="text-light fs-body-text-semibold">Dictionary</a>
                </li>
            </ul>
        </nav>
        <div class="footer__copyright text-center">
            <p class="fs-small-text text-light">
                Copyright © 2024 All Rights Reserved.
            </p>
        </div>
    </footer>
</body>

</html>