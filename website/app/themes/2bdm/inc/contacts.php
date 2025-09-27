<?php

use PHPMailer\PHPMailer\PHPMailer;

add_action('wp_ajax_submit_dynamic_form', 'submit_dynamic_form');
add_action('wp_ajax_nopriv_submit_dynamic_form', 'submit_dynamic_form');

function configure_smtp(PHPMailer $phpmailer, string $to, string $from, string $message): void
{
    $env = PROJECT_ENV_CONFIG;
    $phpmailer->isSMTP();
    $phpmailer->isHTML();
    $phpmailer->Host = $env['HOST'];      // SMTP SERVER
    $phpmailer->SMTPAuth = (bool) $env['SMTPAUTH'];
    $phpmailer->Port = (int) $env['PORT'];
    $phpmailer->Username = $from === 'recruitment' ? $env['USERNAME_RECRUIT'] : $env['USERNAME_APPLY'];
    $phpmailer->Password = $from === 'recruitment' ? $env['PASSWORD_RECRUIT'] : $env['PASSWORD_APPLY'];
    $phpmailer->SMTPSecure = $env['SMTPSECURE'];
    $phpmailer->CharSet = 'UTF-8';
    $senderMail = $from === 'recruitment' ? $env['FROM_RECRUIT'] : $env['FROM_APPLY'];
    $fromName = $from === 'recruitment' ? $env['FROMNAME_RECRUIT'] : $env['FROMNAME_APPLY'] ;
    $phpmailer->setFrom($senderMail, $fromName);
    $phpmailer->addAddress($to);
    $phpmailer->Subject = 'Nouveau message depuis le formulaire de contact';
    $phpmailer->Body = $message;
    $phpmailer->AltBody = strip_tags($message);
}

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
    $from = $_POST['email_from'];
    $message = '';
    foreach ($_POST as $key => $value) {
        switch ($key) {
            case 'email_to':
            case 'action':
                break;
            case 'message':
                $message .= "<p>" . str_replace('_', ' ', ucfirst($key)) . ' :<br>' . sanitize_text_field($value) . "</p><br>";
                break;
            default:
                $message .= "<p>" . str_replace('_', ' ', ucfirst($key)) . ' : ' . sanitize_text_field($value) . "</p><br>";
                break;
        }
    }

    try {
        // Handle uploaded files
        $attachments = [];
        if (!empty($_FILES)) {
            $message .= "<p>Fichiers uploadés :</p>";
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
        $mail = new PHPMailer(true);
        configure_smtp($mail, $to, $from, $message);
        foreach ($attachments as $attachment) {
            $mail->addAttachment($attachment);
        }
        $mail_sent = $mail->send();

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
            <div class="form-group group-file">
                <input type="file" class="custom-file-input" name="<?= htmlspecialchars($data['label']) ?>" id="<?= htmlspecialchars($data['label']) ?>">
                <label for="<?= htmlspecialchars($data['label']) ?>" class="custom-file-label">
                    <?= htmlspecialchars($data['label']) ?>
                    <?php get_template_part("components/svg-arrow-down"); ?>
                </label>
                <!-- Conteneur pour afficher les infos du fichier -->
                <div class="file-info-container" style="display: none;">
                    <div class="file-name"></div>
                    <div class="file-size"></div>
                    <div class="progress-container">
                        <div class="progress-bar"></div>
                    </div>
                </div>
            </div>
            <?php break;
        default:
            break;
    }
}
