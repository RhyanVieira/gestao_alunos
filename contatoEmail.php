<?php
    session_start();

    require_once "vendor/autoload.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //

    $mail = new PHPMailer();

    try {

            //Server settings
            $mail->CharSet      = "utf-8";
            //$mail->SMTPDebug    = SMTP::DEBUG_SERVER;                                 // Habilitar saída de depuração detalhada
            $mail->isSMTP(true);                                                        // Enviar usando SMTP
            $mail->Host         = 'smtp.gmail.com';                                     // Host
            $mail->SMTPAuth     = true;                                                 // Habilitar autenticação SMTP
            $mail->Username     = 'nextalvocaptacao@gmail.com';             
            $mail->Password     = "xnff iuvw zvpw kqha";     
            $mail->SMTPSecure   = PHPMailer::ENCRYPTION_SMTPS;                          // Habilitar criptografia TLS implícita
            $mail->Port         = 465;

            //Recipients
            $mail->setFrom($_POST['email'], $_POST['nome-instituicao']);                // Rementente
            $mail->addAddress('nextalvocaptacao@gmail.com', 'Next Alvo');
            $mail->addReplyTo($_POST['email'], $_POST['nome-instituicao']);             // Destinatário
            //$mail->addReplyTo('info@example.com', 'Information');                     // E-mail de resposta
            //$mail->addCC('cc@example.com');                                           // cópia
            //$mail->addBCC('bcc@example.com');                                         // Cópia oculta
    
            // Anexos
            //$mail->addAttachment('/var/tmp/file.tar.gz');                             // Adicionar Anexos
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');
    
            //Content
            $mail->isHTML(true);                                                        // Defina o formato do e-mail para HTML
            $mail->Subject = $_POST['assunto'];
            $mail->Body    = $_POST['mensagem'];                                        // Corpo do e-mail no formato HTML
            $mail->AltBody = $_POST['mensagem'];                                        // Corpo do e-mail no formato texto
            
        if ($mail->send()) {
            $_SESSION['msgSuccess'] = "E-mail enviado com sucesso.";
            if (isset($_GET['pagina'])) {
                $pagina = $_GET['pagina'];
                header("Location: index.php?pagina=$pagina");
                exit();
            } elseif (isset($_SERVER['HTTP_REFERER'])) {
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                header("Location: index.php");
                exit();
            }
        } else {
            $_SESSION['msgError'] = "ERROR: Error ao tentar enviar e-mail: " . $mail->ErrorInfo;
            if (isset($_GET['pagina'])) {
                $pagina = $_GET['pagina'];
                header("Location: index.php?pagina=$pagina");
                exit();
            } elseif (isset($_SERVER['HTTP_REFERER'])) {
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                header("Location: index.php");
                exit();
            }
        }

    } catch (\Exception $e) {
        $_SESSION['msgError'] = "ERROR: Error ao tentar enviar e-mail: " . $mail->ErrorInfo;
        return header("Location: index.php?pagina=contato");
    }