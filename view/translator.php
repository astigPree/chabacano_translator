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
            height: 100vh;
        }
    </style>
    <title>Chabacano Translator</title>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <nav class="header__navbar">
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

    <!-- Main -->
    <main>
        <div class="translator">
            <div class="translator__content">
                <!-- Column 1 -->
                <div class="translator__col translator__col--1">
                    <div class="translator__col__language--selector">
                        <button id="lang1-chabacano" data-src-lang="cb" class="fs-body-text-semibold text-light">Chabacano</button>
                        <button id="lang1-tagalog" data-src-lang="tl" class="fs-body-text-semibold text-light">Tagalog</button>
                        <button id="lang1-english" data-src-lang="en" class="fs-body-text-semibold text-light">English</button>
                    </div>
                    <div class="translator__col__textarea">
                        <textarea id="textarea1"></textarea>
                    </div>
                    <div class="translator__col__action translator__col__speaker">
                        <button class="fs-body-text te" id="record-button">

                        <svg height="25" width="25" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#ffffff;} </style> <g> <path class="st0" d="M225.474,417.434c-14.997-0.018-30.099,5.766-41.536,17.183l-36.285,36.314 c-9.032,9.012-20.744,13.46-32.581,13.479c-11.838-0.02-23.542-4.467-32.582-13.479c-9.02-9.04-13.479-20.754-13.488-32.601 c0.009-11.827,4.468-23.541,13.488-32.581l-19.493-19.493c-14.357,14.348-21.584,33.278-21.574,52.074 c-0.02,18.806,7.217,37.737,21.574,52.094C77.345,504.763,96.265,512,115.072,512c18.806,0,37.736-7.237,52.084-21.575 l36.285-36.304c6.12-6.101,14.014-9.098,22.033-9.126c8.019,0.028,15.913,3.025,22.023,9.135 c6.464,6.464,9.451,14.921,9.108,23.388l27.55,1.194c0.707-15.828-5.06-32-17.145-44.075 C255.573,423.201,240.451,417.416,225.474,417.434z"></path> <path class="st0" d="M439.548,31.022c-39.12-39.12-101.219-41.23-142.859-6.396l149.255,149.265 C480.788,132.251,478.677,70.143,439.548,31.022z"></path> <path class="st0" d="M256.48,100.939L369.65,214.1c22.701-1.584,44.982-10.462,63.063-26.614L283.104,37.867 C266.943,55.939,258.075,78.22,256.48,100.939z"></path> <path class="st0" d="M51.637,347.47l71.472,71.472l222.494-201.578l-92.379-92.388L51.637,347.47z M274.723,210.482l-29.25,29.26 l-14.625-14.644l29.25-29.23L274.723,210.482z"></path> </g> </g></svg>

                        <!-- <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve">
                                <g>
                                    <path d="M512 256c0 54.32-14.116 107.04-40.82 152.46-26.111 44.409-62.876 79.749-106.32 102.2a12 12 0 1 1-11.018-21.32C435.34 447.223 488 355.632 488 256S435.34 64.777 353.842 22.661a12 12 0 1 1 11.018-21.32c43.444 22.45 80.209 57.79 106.32 102.2C497.884 148.96 512 201.68 512 256ZM402.707 364.694c19.836-32.141 30.32-69.727 30.32-108.694s-10.484-76.553-30.32-108.694c-19.475-31.558-46.668-55.959-78.641-70.567a12 12 0 0 0-9.974 21.83c57.671 26.348 94.935 88.144 94.935 157.431s-37.264 131.083-94.935 157.431a12 12 0 1 0 9.974 21.83c31.973-14.608 59.166-39.009 78.641-70.567ZM354.054 256c0-48.215-29.751-90.675-72.35-103.256a12 12 0 0 0-6.8 23.018c32.47 9.589 55.148 42.585 55.148 80.238s-22.678 70.649-55.148 80.238a12 12 0 1 0 6.8 23.018c42.596-12.581 72.35-55.041 72.35-103.256ZM226.55 48.787v414.426a12 12 0 0 1-20.8 8.155L90.664 347.149H12a12 12 0 0 1-12-12V176.85a12 12 0 0 1 12-12h78.664L205.748 40.632a12 12 0 0 1 20.8 8.155Zm-24 30.609-97.842 105.609a12 12 0 0 1-8.8 3.845H24v134.3h71.905a12 12 0 0 1 8.8 3.845L202.55 432.6Z" fill="#efe8dc" opacity="1" data-original="#efe8dc"></path>
                                </g>
                            </svg> -->
                        <span id="recoding-display" style=" display: none; color: #ffffff;"> Recording ... </span>
                        </button>
                    </div>
                </div>

                <div class="translator__col__swap--button">
                    <button class="fs-heading-4 text-light fw-semibold">⇆</button>
                </div>

                <!-- Column 2 -->
                <div class="translator__col translator__col--2">
                    <div class="translator__col__language--selector">
                        <button id="lang2-chabacano" data-target-lang="cb" class="fs-body-text-semibold text-light">Chabacano</button>
                        <button id="lang2-tagalog" data-target-lang="tl" class="fs-body-text-semibold text-light">Tagalog</button>
                        <button id="lang2-english" data-target-lang="en" class="fs-body-text-semibold text-light">English</button>
                    </div>
                    <div class="translator__col__textarea">
                        <textarea id="textarea2" disabled></textarea>
                    </div>
                    <div class="translator__col__action translator__col__speaker">
                        <button class="fs-body-text te">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve">
                                <g>
                                    <path d="M512 256c0 54.32-14.116 107.04-40.82 152.46-26.111 44.409-62.876 79.749-106.32 102.2a12 12 0 1 1-11.018-21.32C435.34 447.223 488 355.632 488 256S435.34 64.777 353.842 22.661a12 12 0 1 1 11.018-21.32c43.444 22.45 80.209 57.79 106.32 102.2C497.884 148.96 512 201.68 512 256ZM402.707 364.694c19.836-32.141 30.32-69.727 30.32-108.694s-10.484-76.553-30.32-108.694c-19.475-31.558-46.668-55.959-78.641-70.567a12 12 0 0 0-9.974 21.83c57.671 26.348 94.935 88.144 94.935 157.431s-37.264 131.083-94.935 157.431a12 12 0 1 0 9.974 21.83c31.973-14.608 59.166-39.009 78.641-70.567ZM354.054 256c0-48.215-29.751-90.675-72.35-103.256a12 12 0 0 0-6.8 23.018c32.47 9.589 55.148 42.585 55.148 80.238s-22.678 70.649-55.148 80.238a12 12 0 1 0 6.8 23.018c42.596-12.581 72.35-55.041 72.35-103.256ZM226.55 48.787v414.426a12 12 0 0 1-20.8 8.155L90.664 347.149H12a12 12 0 0 1-12-12V176.85a12 12 0 0 1 12-12h78.664L205.748 40.632a12 12 0 0 1 20.8 8.155Zm-24 30.609-97.842 105.609a12 12 0 0 1-8.8 3.845H24v134.3h71.905a12 12 0 0 1 8.8 3.845L202.55 432.6Z" fill="#efe8dc" opacity="1" data-original="#efe8dc"></path>
                                </g>
                            </svg>
                        </button>
                    </div>
                    <div class="translator__col__action translator__col__copy">
                        <button class="fs-body-text text-light">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25" x="0" y="0" viewBox="0 0 488.3 488.3" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                <g>
                                    <path d="M314.25 85.4h-227c-21.3 0-38.6 17.3-38.6 38.6v325.7c0 21.3 17.3 38.6 38.6 38.6h227c21.3 0 38.6-17.3 38.6-38.6V124c-.1-21.3-17.4-38.6-38.6-38.6zm11.5 364.2c0 6.4-5.2 11.6-11.6 11.6h-227c-6.4 0-11.6-5.2-11.6-11.6V124c0-6.4 5.2-11.6 11.6-11.6h227c6.4 0 11.6 5.2 11.6 11.6v325.6z" fill="#efe8dc" opacity="1" data-original="#000000"></path>
                                    <path d="M401.05 0h-227c-21.3 0-38.6 17.3-38.6 38.6 0 7.5 6 13.5 13.5 13.5s13.5-6 13.5-13.5c0-6.4 5.2-11.6 11.6-11.6h227c6.4 0 11.6 5.2 11.6 11.6v325.7c0 6.4-5.2 11.6-11.6 11.6-7.5 0-13.5 6-13.5 13.5s6 13.5 13.5 13.5c21.3 0 38.6-17.3 38.6-38.6V38.6c0-21.3-17.3-38.6-38.6-38.6z" fill="#efe8dc" opacity="1" data-original="#000000"></path>
                                </g>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>

        let sourceLanguage = 'cb';
        let targetLanguage = 'tl';

        const chabano1 = document.getElementById('lang1-chabacano');
        const tagalog1 = document.getElementById('lang1-tagalog');
        const english1 = document.getElementById('lang1-english');

        const chabano2 = document.getElementById('lang2-chabacano');
        const tagalog2 = document.getElementById('lang2-tagalog');
        const english2 = document.getElementById('lang2-english');

        chabano1.classList.add('selected');
        tagalog2.classList.add('selected');

        chabano1.addEventListener('click', function() {
            sourceLanguage = 'cb';
            chabano1.classList.add('selected');
            tagalog1.classList.remove('selected');
            english1.classList.remove('selected');
        });

        tagalog1.addEventListener('click', function() {
            sourceLanguage = 'tl';
            tagalog1.classList.add('selected');
            chabano1.classList.remove('selected');
            english1.classList.remove('selected');
        });

        english1.addEventListener('click', function() {
            sourceLanguage = 'en';
            english1.classList.add('selected');
            chabano1.classList.remove('selected');
            tagalog1.classList.remove('selected');
        });

        chabano2.addEventListener('click', function() {
            targetLanguage = 'cb';
            chabano2.classList.add('selected');
            tagalog2.classList.remove('selected');
            english2.classList.remove('selected');
        });

        tagalog2.addEventListener('click', function() {
            targetLanguage = 'tl';
            tagalog2.classList.add('selected');
            chabano2.classList.remove('selected');
            english2.classList.remove('selected');
        });

        english2.addEventListener('click', function() {
            targetLanguage = 'en';
            english2.classList.add('selected');
            chabano2.classList.remove('selected');
            tagalog2.classList.remove('selected');
        });


        let isRecording = false;

        const recordDisplay = document.getElementById('recoding-display');
        const recordButton = document.getElementById('record-button');
        recordButton.addEventListener('click', function() {
            if (isRecording) {
                isRecording = false;
                recordDisplay.style.display = 'none';
                // stopRecording();
            } else {
                isRecording = true;
                recordDisplay.style.display = 'inline';
                // startRecording();
            }
        });




        // // Set default selection
        // document.getElementById('lang1-chabacano').classList.add('selected');
        // document.getElementById('lang2-tagalog').classList.add('selected');
        // document.getElementById('lang2-chabacano').disabled = true;

        // let sourceLanguage = document.querySelector('.translator__col--1 .selected').getAttribute('data-src-lang');
        // let targetLanguage = document.querySelector('.translator__col--2 .selected').getAttribute('data-target-lang');
        // const textArea1 = document.getElementById('textarea1');
        // const textArea2 = document.getElementById('textarea2');

        // textArea1.addEventListener('input', () => {
        //     textArea2.value = '...';
        //     if (textArea1.value.length > 0) {
        //         textArea2.value = '';
        //     }
        //     const translationData = {
        //         sentence: textArea1.value,
        //         sourceLanguage: sourceLanguage,
        //         targetLanguage: targetLanguage
        //     }

        //     // make a request using promise
        //     fetch('http://127.0.0.1:5000/ct/translate', {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json'
        //             },
        //             body: JSON.stringify(translationData)
        //         })
        //         .then(response => response.json())
        //         .then(data => {
        //             console.log(data)
        //             const translatedText = data.translated_sentence;
        //             textArea2.value = translatedText;
        //         })
        //         .catch(error => {
        //             textArea2.value = '';
        //             console.error('Error:', error);
        //         })

        // })

        // // Add event listeners to all buttons
        // document.querySelectorAll('.translator__col__language--selector button').forEach(button => {
        //     button.addEventListener('click', (event) => {
        //         const col = event.target.closest('.translator__col').classList.contains('translator__col--1') ? 1 : 2;
        //         handleLanguageSelect(col, event.target);
        //     });
        // });

        // // Function to handle button selection
        // const handleLanguageSelect = (col, selectedLang) => {
        //     const columnButtons = document.querySelectorAll(`.translator__col--${col} .translator__col__language--selector button`);

        //     // Remove selected class from all buttons in this column
        //     columnButtons.forEach(button => {
        //         button.classList.remove('selected');
        //     });

        //     // Add selected class to the clicked button
        //     selectedLang.classList.add('selected');

        //     // Get the selected language in column 1
        //     const selectedCol1 = document.querySelector('.translator__col--1 .selected');

        //     // Disable the same language in column 2
        //     const col2Buttons = document.querySelectorAll('.translator__col--2 .translator__col__language--selector button');
        //     let selectedCol2 = document.querySelector('.translator__col--2 .selected')

        //     col2Buttons.forEach(button => {
        //         if (button.getAttribute('data-target-lang') === selectedCol1.getAttribute('data-src-lang')) {
        //             button.disabled = true; // Disable the button if it's the same language

        //             if (button === selectedCol2) {
        //                 // If the same language is selected, clear all selections and select another randomly
        //                 col2Buttons.forEach(b => b.classList.remove('selected')); // Clear all selected in Column 2
        //                 let otherLanguages = Array.from(col2Buttons).filter(b => !b.disabled);
        //                 let randomChoice = otherLanguages[Math.floor(Math.random() * otherLanguages.length)];
        //                 randomChoice.classList.add('selected'); // Randomly select a different language
        //                 selectedCol2 = randomChoice;
        //             }
        //         } else {
        //             button.disabled = false; // Enable other buttons
        //         }
        //     });

        //     sourceLanguage = selectedCol1.getAttribute('data-src-lang');
        //     targetLanguage = selectedCol2.getAttribute('data-target-lang');

        // };
    </script>
</body>

</html>