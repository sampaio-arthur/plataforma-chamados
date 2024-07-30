<?php
function generate_validation_code() {
    return bin2hex(random_bytes(16));
}

function send_validation_email($email, $codigo_validacao) {
    $subject = "Valide seu e-mail";
    $message = "Clique no link para validar seu e-mail: http://seusite.com/validate.php?code=$codigo_validacao";
    $headers = "From: no-reply@seusite.com";

    mail($email, $subject, $message, $headers);
}
?>
