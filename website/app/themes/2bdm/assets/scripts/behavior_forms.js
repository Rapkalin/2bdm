const behavior_forms = {
    init() {
        const MIME_TYPES_MAP = {
            'application/pdf': 'pdf',

            // Word
            'application/msword': 'doc',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document': 'docx',

            // Excel
            'application/vnd.ms-excel': 'xls',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet': 'xlsx',

            // PowerPoint
            'application/vnd.ms-powerpoint': 'ppt',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation': 'pptx',

            // Images
            'image/jpeg': 'jpg',
            'image/png': 'png',
            'image/gif': 'gif',
            'image/webp': 'webp',

            // Texte
            'text/plain': 'txt',
            'text/csv': 'csv',

            // fallback
            'default': 'fichier',
        };

        const form = document.getElementById('dynamic-form');
        const fileInputs = form.querySelectorAll('.custom-file-input');

        fileInputs.forEach(input => {

            input.addEventListener('change', (e) => {
                const container = e.target.closest('.group-file');
                const fileInfoContainer = container.querySelector('.file-info-container');
                const files = Array.from(e.target.files);

                if (!files.length) {
                    fileInfoContainer.style.display = 'none';
                    return;
                }

                const allowedTypes = [
                    'application/pdf',

                    // Word
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',

                    // PowerPoint
                    'application/vnd.ms-powerpoint', // .ppt
                    'application/vnd.openxmlformats-officedocument.presentationml.presentation' // .pptx
                ];

                const maxSize = 5 * 1024 * 1024;

                let validFiles = [];

                files.forEach(file => {
                    if (!allowedTypes.includes(file.type)) {
                        alert(`⚠️ ${file.name} invalide (PPT/PPTX/PDF/DOCX uniquement)`);
                        return;
                    }

                    if (file.size > maxSize) {
                        alert(`⚠️ ${file.name} ne doit pas dépasser 5 Mo`);
                        return;
                    }

                    validFiles.push(file);
                });

                if (!validFiles.length) {
                    e.target.value = '';
                    fileInfoContainer.style.display = 'none';
                    return;
                }
                
                fileInfoContainer.style.display = 'block';
                fileInfoContainer.innerHTML = validFiles.map(file => {
                    const size = file.size < 1024 * 1024
                        ? `${(file.size / 1024).toFixed(1)} Ko`
                        : `${(file.size / 1024 / 1024).toFixed(2)} Mo`;

                    const type = getReadableFileType(file);

                    return `
                        <div class="file-item">
                            <span class="file-title">- ${file.name}</span>
                            <span class="file-separator">:</span>
                            <span class="file-meta">${type} — ${size}</span>
                        </div>
                    `;
                }).join('');
            });
        });

        form.addEventListener('submit', (e) => {
            e.preventDefault();

            const submitButton = document.getElementById('submit-button');
            const ajaxurl = submitButton.getAttribute('data-url');

            const formData = new FormData(form);
            formData.append('action', 'submit_dynamic_form');

            fetch(ajaxurl, {
                method: 'POST',
                body: formData,
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert('✅ Formulaire envoyé');
                        form.reset();

                        // 🔥 reset de CHAQUE bloc
                        document.querySelectorAll('.group-file').forEach(group => {
                            const info = group.querySelector('.file-info-container');
                            if (info) info.style.display = 'none';
                        });

                    } else {
                        alert('❌ Erreur');
                    }
                })
                .catch(err => console.error(err));
        });

        function getReadableFileType(file) {
            return MIME_TYPES_MAP[file.type] || file.name.split('.').pop() || MIME_TYPES_MAP.default;
        }
    },
};

export default behavior_forms;