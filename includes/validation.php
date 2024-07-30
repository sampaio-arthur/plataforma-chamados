<?php
function validate_registration($nome_completo, $data_nascimento, $email, $telefone, $whatsapp, $senha, $confirmar_senha, $cidade, $estado) {
    $errors = [];

    // Verificação de campos vazios
    if (empty($nome_completo) || empty($data_nascimento) || empty($email) || empty($telefone) || empty($whatsapp) || empty($senha) || empty($confirmar_senha) || empty($cidade) || empty($estado)) {
        $errors[] = "Todos os campos são obrigatórios.";
    }

    // Verificação de idade
    $idade = date_diff(date_create($data_nascimento), date_create('now'))->y;
    if ($idade < 18) {
        $errors[] = "Você deve ter mais de 18 anos para se cadastrar.";
    }

    // Verificação de email válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "E-mail inválido.";
    }

    // Verificação de senha
    if ($senha !== $confirmar_senha) {
        $errors[] = "As senhas não coincidem.";
    }

    // Outras validações específicas...

    return $errors;
}
?>
