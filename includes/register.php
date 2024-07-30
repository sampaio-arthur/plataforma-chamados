<?php
require_once '../config/config.php';
require_once 'functions.php';
require_once 'validation.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Coletar dados do formulário
    $nome_completo = trim($_POST["nome_completo"]);
    $data_nascimento = trim($_POST["data_nascimento"]);
    $email = trim($_POST["email"]);
    $telefone = trim($_POST["telefone"]);
    $whatsapp = trim($_POST["whatsapp"]);
    $senha = trim($_POST["senha"]);
    $confirmar_senha = trim($_POST["confirmar_senha"]);
    $cidade = trim($_POST["cidade"]);
    $estado = trim($_POST["estado"]);

    // Validação dos dados
    $errors = validate_registration($nome_completo, $data_nascimento, $email, $telefone, $whatsapp, $senha, $confirmar_senha, $cidade, $estado);

    if (empty($errors)) {
        // Hash da senha
        $hashed_password = password_hash($senha, PASSWORD_DEFAULT);
        $codigo_validacao = generate_validation_code();

        // Inserir no banco de dados
        $sql = "INSERT INTO users (nome_completo, data_nascimento, email, telefone, whatsapp, senha, cidade, estado, codigo_validacao) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssssss", $nome_completo, $data_nascimento, $email, $telefone, $whatsapp, $hashed_password, $cidade, $estado, $codigo_validacao);
            
            if (mysqli_stmt_execute($stmt)) {
                // Enviar email de validação
                send_validation_email($email, $codigo_validacao);
                header("location: ../views/login.php");
            } else {
                echo "Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            mysqli_stmt_close($stmt);
        }
    } else {
        // Exibir erros de validação
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }

    mysqli_close($link);
}
?>
