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
        // Handle uploaded files
        $attachments = [];
        if (!empty($_FILES)) {
            $message .= "<p>Fichiers uploadés:</p>";
            foreach ($_FILES as $key => $file) {
                // Check the file type and make sure they are only PDF
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

        // Send email with attachments
        $headers = ['Content-Type: text/html; charset=UTF-8'];
        $mail_sent = wp_mail($to, $subject, $message, $headers, $attachments);

        // Delete files from temp directory
        foreach ($attachments as $attachment) {
            if (file_exists($attachment)) {
                unlink($attachment);
            }
        }

        if ($mail_sent) {
            wp_send_json_success('Formulaire soumis avec succès et email envoyé');
        } else {
            wp_send_json_error(
                    [
                        'message' => 'Erreur lors de l\'envoi de l\'email',
                        'error' => $mail_sent
                    ],
                500,
            );
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
            <div class="form-group group-text group-label">
                <div class="error-container"></div>
                <label for="<?= $data['label'] ?>"><?= $data['label'] ?></label>
                <input type="text" id="<?= $data['label'] ?>" name="<?= $data['label'] ?>" placeholder="<?= $data['label'] ?>">
            </div>
            <?php
            break;
        case 'email':
            ?>
                <div class="form-group group-text group-label">
                    <div class="error-container"></div>
                    <label for="email"><?= $data['label'] ?></label>
                    <input autocomplete type="email" id="email" name="email" placeholder="<?= $data['label'] ?>">
                </div>
            <?php
            break;
        case 'cities':
            ?>
                <div class="form-group group-text group-cities">
                    <div class="error-container"></div>
                    <div class="cities-container">
                        <div class="city-title">Ville</div>
                        <div class="cities-option">
                            <?php foreach ($data['cities'] as $city): ?>
                                <div class="city-option">
                                    <input type="radio" id="<?= $city ?>" name="city" value="<?= $city ?>">
                                    <label for="<?= $city ?>"><?= $city ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php
            break;
        case 'text_area':
            ?>
                <div class="form-group group-text group-label">
                    <label for="message"><?= $data['label'] ?></label>
                    <textarea id="message" name="message" placeholder="<?= $data['label'] ?>"></textarea>
                </div>
            <?php
            break;
        case 'file':
            ?>
            <div class="form-group">
                <input type="file" id="<?= htmlspecialchars($data['label']) ?>" name="<?= htmlspecialchars($data['label']) ?>" class="custom-file-input">
                <label for="<?= htmlspecialchars($data['label']) ?>" class="custom-file-label">
                    <?= htmlspecialchars($data['label']) ?>
                </label>
            </div>
            <?php
            break;
        default:
            break;
    }
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once __DIR__ . '/../../../../vendor/autoload.php';
add_action('phpmailer_init', 'configure_smtp');

function configure_smtp($phpmailer): void
{
    $phpmailer->isSMTP();
    $phpmailer->Host = $env['HOST']; // Serveur SMTP pour IONOS
    $phpmailer->SMTPAuth = $env['SMTPAUTH'];
    $phpmailer->Port = $env['PORT']; // Port SMTP pour SSL
    $phpmailer->Username = $env['USERNAME']; // Remplacez par votre adresse email OVH
    $phpmailer->Password = $env['PASSWORD']; // Remplacez par votre mot de passe email
    $phpmailer->SMTPSecure = $env['SMTPSECURE']; // Utilisez 'tls' si vous utilisez le port 587
    $phpmailer->From = $env['FROM'];
    $phpmailer->FromName = $env['FROMNAME'];
}

