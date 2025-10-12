const behavior_forms = {
    init() {
        const form = document.getElementById('dynamic-form');
        const fileInput = form.querySelector('.custom-file-input');
        const fileInfoContainer = form.querySelector('.file-info-container');
        const fileNameEl = form.querySelector('.file-name');
        const fileSizeEl = form.querySelector('.file-size');

        if (fileInput) {
            fileInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (!file) {
                    fileInfoContainer.style.display = 'none';
                    return;
                }

                const allowedTypes = ['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                const maxSize = 5 * 1024 * 1024; // 5 Mo

                // Vérification type
                if (!allowedTypes.includes(file.type)) {
                    alert('⚠️ Seuls les fichiers PDF ou DOCX sont autorisés.');
                    fileInput.value = '';
                    fileInfoContainer.style.display = 'none';
                    return;
                }

                // File size check
                if (file.size > maxSize) {
                    alert('⚠️ Le fichier doit faire moins de 5 Mo.');
                    fileInput.value = '';
                    fileInfoContainer.style.display = 'none';
                    return;
                }

                const fileType = file.type.includes('/')
                    ? file.type.split('/')[1]
                    : file.type || 'inconnu';

                // Ko or Mo
                let fileSizeText;
                if (file.size < 1024 * 1024) {
                    const sizeKB = (file.size / 1024).toFixed(1);
                    fileSizeText = `${sizeKB} Ko`;
                } else {
                    const sizeMB = (file.size / 1024 / 1024).toFixed(2);
                    fileSizeText = `${sizeMB} Mo`;
                }

                fileInfoContainer.style.display = 'block';
                fileNameEl.textContent = `Nom : ${file.name}`;
                fileSizeEl.textContent = `Type : ${fileType} — Taille : ${fileSizeText}`;
            });
        }

        form.addEventListener('submit', (e) => {
            e.preventDefault();

            const sumbitButton = document.getElementById('submit-button');
            const ajaxurl = sumbitButton.getAttribute('data-url');
            const formData = new FormData(form);
            formData.append('action', 'submit_dynamic_form');

            fetch(ajaxurl, {
                method: 'POST',
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert('✅ Formulaire soumis avec succès');
                        form.reset();
                        fileInfoContainer.style.display = 'none';
                    } else {
                        if (Object.keys(data.data).length > 1) {
                            alert('❌ Une erreur est survenue. Veuillez réessayer.');
                        } else {
                            alert('❌ Erreur : ' + data.data);
                        }
                    }
                })
                .catch((error) => {
                    console.error('Erreur:', error);
                });
        });
    },
};

export default behavior_forms;
