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
    
