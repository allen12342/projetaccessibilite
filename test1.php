<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz Vitrine</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        header {
            background: #333;
            color: #fff;
            padding: 1em 0;
            text-align: center;
        }
        main {
            padding: 20px;
        }
        section {
            margin-bottom: 20px;
        }
        #readTextButton {
            background: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        #readTextButton:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <h1>Bienvenue sur Quiz Vitrine</h1>
    </header>
    <main>
        <section>
            <h2>À propos de Quiz Vitrine</h2>
            <p>Quiz Vitrine est une plateforme interactive où vous pouvez tester vos connaissances sur divers sujets.</p>
        </section>
        <section>
            <h2>Fonctionnalités</h2>
            <p>Notre site propose des quiz sur une multitude de sujets, un suivi de vos scores, et la possibilité de défier vos amis.</p>
        </section>
        <section>
            <h2>Comment ça marche ?</h2>
            <p>Inscrivez-vous, choisissez un quiz, et commencez à répondre aux questions. Vous pouvez voir vos résultats immédiatement.</p>
        </section>
        <section>
            <h2>Rejoignez-nous</h2>
            <p>Créez un compte aujourd'hui et rejoignez notre communauté de passionnés de quiz. C'est gratuit et amusant !</p>
        </section>
        <button id="readTextButton">Lire le texte</button>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const readTextButton = document.getElementById('readTextButton');
            const sections = document.querySelectorAll('main section');
            let currentSectionIndex = 0;
            let isReading = false;
            const synth = window.speechSynthesis;

            function readSection(index) {
                if (index < sections.length) {
                    const content = sections[index].textContent;
                    const utterThis = new SpeechSynthesisUtterance(content);
                    utterThis.lang = 'fr-FR';
                    synth.speak(utterThis);
                    
                    utterThis.onend = () => {
                        if (isReading) {
                            readTextButton.textContent = 'Lire le texte';
                        }
                    };
                }
            }

            readTextButton.addEventListener('click', () => {
                isReading = !isReading;
                if (isReading) {
                    readSection(currentSectionIndex);
                    readTextButton.textContent = 'Arrêter la lecture';
                } else {
                    synth.cancel();
                    readTextButton.textContent = 'Lire le texte';
                }
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Tab') {
                    event.preventDefault(); // Empêcher le comportement par défaut de Tab
                    if (isReading) {
                        currentSectionIndex = (currentSectionIndex + 1) % sections.length;
                        synth.cancel();
                        readSection(currentSectionIndex);
                    } else {
                        isReading = true;
                        readSection(currentSectionIndex);
                        readTextButton.textContent = 'Arrêter la lecture';
                    }
                }
            });
        });
    </script>
</body>
</html>
