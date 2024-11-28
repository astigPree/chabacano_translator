<?php
include dirname(__DIR__) . '/../config/DBConnector.php';

session_start();

// Display success/error message if set
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    echo '<div class="mb-0 alert alert-' . $message['type'] . ' alert-dismissible fade show" role="alert">';
    echo htmlspecialchars($message['content']);
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';

    // Clear the session message after displaying it
    unset($_SESSION['message']);
}

$stmt = $conn->prepare("SELECT * FROM dictionary_tb");
$stmt->execute();
$dictionary_entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles/index.css">
    <style>
        body {
            background-image: none;
            background: #F7F7F7;
        }

        body::after {
            display: none;
        }
    </style>
    <title>Admin Panel - Dictionary</title>
</head>

<body>
    <main class="main d-flex gap-2">
        <!-- Sidebar -->
        <aside class="sidebar d-flex flex-column justify-content-between align-items-center py-2 px-3 bg-secondary">
            <div class="sidebar__content d-flex flex-column gap-3">
                <div class="sidebar__logo-container">
                    <img src="../../assets/images/chabacano_translator_v2.png" alt="Chabacano Translator Logo" width="300">
                </div>
                <div class="sidebar__menus">
                    <ul class="sidebar__menus__list d-flex flex-column gap-2">
                        <li class="sidebar__menus__list__item py-3">
                            <a href="./index.php" class="sidebar__menus__list__item__link text-light fs-body-text-semibold">Pages</a>
                        </li>
                        <li class="sidebar__menus__list__item py-3">
                            <a href="./chabacanoDictionary.php" class="sidebar__menus__list__item__link text-light fs-body-text-semibold">Dictionary</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main__sidebar__logout-btn">
                <a href="../../scripts/logout.php" class="button button--light fs-body-text-semibold">Logout</a>
            </div>
        </aside>

        <!-- Heading -->
        <div class="main__content p-5">
            <div class="main__content__heading py-3 px-4 bg-white-fff">
                <h1 class="fs-heading-3">Welcome, Admin</h1>
            </div>

            <div class="main__content__editor py-3 px-4 mt-3 bg-white-fff">
                <div class="main__content__editor__section">
                    <h2 class="fs-heading-5 mb-3">Manage Dictionary</h2>
                    <form class="main__content__editor__section__form" action="../../scripts/dictionaryScript.php" method="POST">
                        <div class="main__content__editor__section__form__input">
                            <label for="chabacano-lang" class="form-label">Chabacano</label>
                            <input type="text" name="chabacano-lang" id="chabacano-lang" class="ct-input" placeholder="Word or Phrase in Chabacano">
                        </div>

                        <div class="main__content__editor__section__form__input">
                            <label for="tagalog-lang" class="form-label">Tagalog</label>
                            <input type="text" name="tagalog-lang" id="tagalog-lang" class="ct-input" placeholder="Word or Phrase in Tagalog">
                        </div>

                        <div class="main__content__editor__section__form__input">
                            <label for="english-lang" class="form-label">English</label>
                            <input type="text" name="english-lang" id="english-lang" class="ct-input" placeholder="Word or Phrase in English">
                        </div>

                        <div class="main__content__editor__section__form__input">
                            <label for="definition" class="form-label">Definition</label>
                            <textarea name="definition" id="definition" class="ct-textarea" cols="30" rows="5" placeholder="Definition in English"></textarea>
                        </div>

                        <div class="main__content__editor__section__form__btn">
                            <button type="submit" class="button button--secondary" id="homepage-btn">
                                Add New Entry
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="main__content__table py-3 px-4 mt-3 bg-white-fff">
                <h2 class="fs-heading-5 mb-3">Dictionary Entries</h2>
                <div class="main__content__table__container">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col" class="px-3 py-2">Chabacano</th>
                                <th scope="col" class="px-3 py-2">Tagalog</th>
                                <th scope="col" class="px-3 py-2">English</th>
                                <th scope="col" class="px-3 py-2">Definition</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($dictionary_entries)): ?>
                                <?php foreach ($dictionary_entries as $key => $value): ?>
                                    <tr>
                                        <td class="px-3 py-2"><?= $value['chabacano_lang'] ?></td>
                                        <td class="px-3 py-2"><?= $value['tagalog_lang'] ?></td>
                                        <td class="px-3 py-2"><?= $value['english_lang'] ?></td>
                                        <td class="px-3 py-2"><?= $value['definition'] ?></td>
                                        <td class="px-3 py-2" align="center">
                                            <button class="button button--xsm button--secondary edit-section-btn" onclick="populateEditForm(<?php echo $value['id']; ?>)" data-bs-toggle="modal" data-bs-target="#editSectionModal">
                                                Edit
                                            </button>
                                            <form action="../../scripts/dictionaryScript.php" method="POST" class="d-inline-block">
                                                <input type="hidden" name="id" value="<?= $value['id'] ?>">
                                                <input type="hidden" name="action" value="delete">
                                                <button type="submit" class="button button--xsm button--secondary">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" align="center">No entries found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Edit Dictionary Entry Modal -->
    <div class="modal fade" id="editSectionModal" tabindex="-1" aria-labelledby="editSectionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="../../scripts/dictionaryScript.php" method="POST" id="edit-form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSectionModalLabel">Edit Dictionary Entry</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id" value="">
                        <input type="hidden" name="action" value="update">

                        <div class="mb-3">
                            <label for="edit-chabacano-lang" class="form-label">Chabacano</label>
                            <input type="text" name="chabacano-lang" id="edit-chabacano-lang" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-tagalog-lang" class="form-label">Tagalog</label>
                            <input type="text" name="tagalog-lang" id="edit-tagalog-lang" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-english-lang" class="form-label">English</label>
                            <input type="text" name="english-lang" id="edit-english-lang" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-definition" class="form-label">Definition</label>
                            <textarea name="definition" id="edit-definition" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button button--xsm button--primary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="button button--xsm button--secondary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>

    <script>
        // Array holding dictionary entries data (fetched from PHP)
        const dictionaryEntries = <?php echo json_encode($dictionary_entries); ?>;

        function populateEditForm(entryId) {
            // Find the entry data by id
            const entry = dictionaryEntries.find(entry => entry.id == entryId);

            if (entry) {
                // Populate modal form fields with the entry data
                document.getElementById('edit-id').value = entry.id;
                document.getElementById('edit-chabacano-lang').value = entry.chabacano_lang;
                document.getElementById('edit-tagalog-lang').value = entry.tagalog_lang;
                document.getElementById('edit-english-lang').value = entry.english_lang;
                document.getElementById('edit-definition').value = entry.definition;
            } else {
                console.log("Entry not found");
            }
        }
    </script>
</body>

</html>