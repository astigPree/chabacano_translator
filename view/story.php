<?php

include dirname(__DIR__) . "/config/DBConnector.php";

function getAllHeadersAndSubheaders()
{
    global $conn;

    $query = "SELECT * FROM story_headers_tb ORDER BY section_order ASC";

    $stmt = $conn->prepare($query);

    try {
        $stmt->execute();
        $headers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $results = [];

        foreach ($headers as $header) {
            $query = "SELECT * FROM story_subheaders_tb WHERE heading_id = :header_id";
            $stmt = $conn->prepare($query);
            $stmt->bindValue(':header_id', $header['id'], PDO::PARAM_INT);
            $stmt->execute();
            $subheaders = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $header['subheaders'] = $subheaders;
            $results[] = $header;
        }

        return $results;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return [];
    }
}

$headers = getAllHeadersAndSubheaders();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../public/chabacano_logo.png">
    <link rel="stylesheet" href="../styles/index.css">
    <style>
        body {
            background-image: none;
            background: #F7F7F7;
        }

        body::after {
            display: none;
        }
    </style>
    <title>Chabacano Dictionary</title>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <nav class="header__navbar ">
            <div class="header__navbar__logo">
                <a href="../index.php" class="header__navbar__logo__link">
                    <img src="../public/chabacano_logo.png" alt="Chabcano Translator Logo" width="300" loading="lazy">
                </a>
            </div>
            <ul class="header__navbar__links">
                <div class="header__navbar__links__container">

                    <li class="navbar__links__item">
                        <a href="../index.php" class="text-light fs-body-text-semibold">Home</a>
                    </li>
                    <li class="navbar__links__item">
                        <a href="../index.php#about-us" class="text-light fs-body-text-semibold">About Us</a>
                    </li>
                    <li class="navbar__links__item">
                        <a href="../view/story.php" class="text-light fs-body-text-semibold">Story</a>
                    </li>
                    <li class="navbar__links__item">
                        <a href="../view/chabacanoDictionary.php" class="text-light fs-body-text-semibold">Dictionary</a>
                    </li>
                </div>
                <div class="header__navbar__links__cta">
                    <div class="header__navbar__cta" role="button">
                        <a href="../view/translator.php" class="button button--light fs-body-text-semibold">Translator</a>
                    </div>
                </div>
            </ul>
            <div class="header__navbar__burger--menu">
                <img src="./assets/images/hamburger.png" alt="Menu Icon">
            </div>
        </nav>
    </header>

    <main class="story">
        <nav class="story__navigation">
            <?php
            foreach ($headers as $header) {
                $ref = '#' . str_replace(' ', '_', strtolower($header['heading_title']));

                echo '<a href="' . htmlspecialchars($ref) . '" class="fs-body-text text-accent-3">' . htmlspecialchars($header['heading_title']) . '</a>';
            }
            ?>
        </nav>
        <div class="story__image--heading"></div>
        <div class="story__content">
            <?php foreach ($headers as $header): ?>
                <div class="story__content__heading" id="<?= htmlspecialchars(str_replace(' ', '_', strtolower($header['heading_title']))) ?>">
                    <h1 class="fs-heading-4"><?= htmlspecialchars($header['heading_title']) ?></h1>
                    <p class="fs-body-text text-dark">
                        <?= htmlspecialchars($header['heading_content']) ?>
                    </p>
                    <?php foreach ($header['subheaders'] as $subheading): ?>
                        <div class="story__content__subheading">
                            <h2 class="fs-heading-6"><?= htmlspecialchars($subheading['subheading_title']) ?></h2>
                            <p class="fs-body-text">
                                <?= htmlspecialchars($subheading['subheading_content']) ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>

</html>