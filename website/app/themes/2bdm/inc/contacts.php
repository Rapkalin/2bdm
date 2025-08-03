<?php

add_action('wp_ajax_submit_dynamic_form', 'submit_dynamic_form');
add_action('wp_ajax_nopriv_submit_dynamic_form', 'submit_dynamic_form');
function submit_dynamic_form(): void {
    // reCAPTCHA
    // recaptchaCheck();

    // Data validation
    $errors = [];
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[$key] = 'Ce champ est requis';
        } else {
            if (
                ($key === 'email' || $key === 'email_to') &&
                !filter_var($value, FILTER_VALIDATE_EMAIL)
            ) {
                $errors[$key] = 'Email invalide';
            }
        }
    }

    if (!empty($errors)) {
        wp_send_json_error($errors);
    }

    // Preparing email
    $to = $_POST['email_to'];
    $subject = 'Nouveau message depuis le formulaire de contact';
    $message = '';
    foreach ($_POST as $key => $value) {
        switch ($key) {
            case 'email_to':
            case 'action':
                break;
            case 'message':
                $message .= "<p>" . ucfirst($key) . ' :<br>' . sanitize_text_field($value) . "</p><br>";
                break;
            default:
                $message .= "<p>" . ucfirst($key) . ' : ' . sanitize_text_field($value) . "</p><br>";
                break;

        }
    }


    try {
        // Gérer les fichiers uploadés
        $attachments = [];
        if (!empty($_FILES)) {
            $message .= "<p>Fichiers uploadés:</p>";
            foreach ($_FILES as $key => $file) {
                // Vérification du type de fichier
                $file_type = wp_check_filetype_and_ext($file['tmp_name'], $file['name']);
                if ($file_type['type'] !== 'application/pdf') {
                    wp_send_json_error('Seuls les fichiers PDF sont autorisés.');
                }

                if ($file['error'] === UPLOAD_ERR_OK) {
                    $upload_dir = wp_upload_dir();
                    $file_path = $upload_dir['path'] . '/' . basename($file['name']);
                    move_uploaded_file($file['tmp_name'], $file_path);
                    $attachments[] = $file_path;
                    $message .= "<p>" . ucfirst($key) . ': ' . basename($file['name']) . "</p>";
                }
            }
        }

        // Envoi de l'email avec pièces jointes
        $headers = ['Content-Type: text/html; charset=UTF-8'];
        $mail_sent = wp_mail($to, $subject, $message, $headers, $attachments);

        // Supprimer les fichiers temporaires après l'envoi de l'email
        foreach ($attachments as $attachment) {
            if (file_exists($attachment)) {
                unlink($attachment);
            }
        }

        if ($mail_sent) {
            wp_send_json_success('Formulaire soumis avec succès et email envoyé');
        } else {
            wp_send_json_error('Erreur lors de l\'envoi de l\'email');
        }
    } catch (\Exception $e) {
        wp_send_json_error('Erreur lors de l\'envoi de l\'email : ' . $e->getMessage());
    }
}

function recaptchaCheck() {
    $recaptcha_secret = 'votre_cle_secrete_recaptcha';
    $recaptcha_response = $_POST['g-recaptcha-response'];
    $recaptcha_url = "https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response";
    $recaptcha_data = json_decode(file_get_contents($recaptcha_url));

    if (!$recaptcha_data->success) {
        wp_send_json_error('reCAPTCHA verification failed');
    }
}

function getFormGroup(string $type, array $data = []): void {
    switch ($type) {
        case 'text':
            ?>
            <div class="form-group">
                <div class="error-container"></div>
                <label for="<?= $data['label'] ?>"><?= $data['label'] ?></label>
                <input type="text" id="<?= $data['label'] ?>" name="<?= $data['label'] ?>">
            </div>
            <?php
            break;
        case 'email':
            ?>
                <div class="form-group">
                    <div class="error-container"></div>
                    <label for="email"><?= $data['label'] ?></label>
                    <input autocomplete type="email" id="email" name="email">
                </div>
            <?php
            break;
        case 'cities':
            ?>
                <div class="form-group">
                    <div class="error-container"></div>
                    <label><?= $data['label'] ?></label>;
                    <?php foreach ($data['cities'] as $city): ?>
                        <div class="ville-option">
                            <label for="<?= $city ?>"><?= $city ?></label>
                            <input type="radio" id="<?= $city ?>" name="ville" value="<?= $city ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php
            break;
        case 'text_area':
            ?>
                <div class="form-group">
                    <label for="message"><?= $data['label'] ?></label>
                    <textarea id="message" name="message"></textarea>
                </div>
            <?php
            break;
        case 'file':
            ?>
                <div class="form-group">
                    <label for="<?= htmlspecialchars($data['label']) ?>"><?= htmlspecialchars($data['label']) ?></label>
                    <input type="file" id="<?= htmlspecialchars($data['label']) ?>" name="<?= htmlspecialchars($data['label']) ?>">
                </div>
            <?php
        default:
            break;
    }
}
