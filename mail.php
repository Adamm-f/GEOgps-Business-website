<?php
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $message = isset($_POST['message']) ? strip_tags(trim($_POST['message'])) : '';

    if (empty($name)) {
        $errors[] = "Zadajte svoje meno.";
    }

    if (empty($email)) {
        $errors[] = "Zadajte svoj email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Neplatný email.";
    }

    if (empty($message)) {
        $errors[] = "Zadejte zprávu.";
    }

    if (empty($errors)) {
        $recipient = "marianfedorjak@gmail.com";
    
        $headers = "Od: $name <$email>";

        if (mail($recipient, $message, $headers)) {
            echo "Email bol úsešne odoslal.";
        } else {
            echo "Nastala chyba, skúste to znovu.";
        }
    } else {
        echo "Došlo k následujícím chybám:<br>";
        foreach ($errors as $error) {
            echo "- $error<br>";
        }
    } 
} else {
    header("HTTP/1.1 403 Forbidden");
    echo "Nemáte oprávnenie k pristupu na tuto stránku.";
}
?>