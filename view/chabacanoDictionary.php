<?php

include dirname(__DIR__) . "/config/DBConnector.php";

function getWordsByLetter($letter)
{
    global $conn;

    // Prepare the query
    $query = "SELECT * FROM dictionary_tb WHERE chabacano_lang LIKE :letter ORDER BY chabacano_lang ASC";
    $stmt = $conn->prepare($query);

    // Use a prepared statement to safely inject the parameter
    $stmt->bindValue(':letter', $letter . '%', PDO::PARAM_STR);

    // Execute the query
    $stmt->execute();

    // Fetch the results as an associative array
    $words = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $words;
}

// If a letter is clicked, get words starting with that letter
$selected_letter = isset($_GET['letter']) ? $_GET['letter'] : 'A';
$words = getWordsByLetter($selected_letter);

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
            scroll-behavior: smooth;
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
        <nav class="header__navbar bg-primary">
            <div class="header__navbar__logo">
                <a href="../index.php" class="header__navbar__logo__link">
                    <img src="../public/chabacano_logo.png" alt="Chabcano Translator Logo" width="300" loading="lazy">
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
                <img src="../assets/images/hamburger.png" alt="Menu Icon">
            </div>
        </nav>
    </header>

    <main>
        <!-- Dictionary -->
        <section class="dictionary">
            <div class="dictionary__content">
                <div class="dictionary__content__heading">
                    <h1 class="fs-heading-3">Chabacano Dictionary</h1>
                </div>
                <div class="dictionary__content__body">
                    <p class="fs-body-text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste sed sunt assumenda distinctio voluptate nihil earum expedita? Temporibus perspiciatis voluptate repellendus iure, at quasi est debitis! Molestias neque tempora quae.
                    </p>
                </div>
                <div class="divider"></div>
                <div class="dictionary__content__navigation">
                    <!-- Navigation A-Z -->
                    <nav class="nav-container">
                        <?php foreach (range('A', 'Z') as $letter): ?>
                            <a href="?letter=<?php echo $letter; ?>" class="fs-body-text text-accent-3">
                                <?php echo $letter; ?>
                            </a>
                            <?php if ($letter !== 'Z'): ?>
                                <span>/</span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </nav>
                </div>
                <p>Results:</p>

                <div class="dictionary__content__word--lists">
                    <?php if (!empty($words)): ?>
                        <?php foreach ($words as $word): ?>
                            <div class="">
                                <p class="fs-heading-6"><?php echo $word['chabacano_lang'] . ' / ' . $word['tagalog_lang'] . ' / ' . $word['english_lang']; ?></p>
                                <p class="fs-body-text">
                                    <?php echo $word['definition']; ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No words found starting with "<?php echo $selected_letter; ?>"</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>
</body>

</html>