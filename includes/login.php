<?php
session_start();
require_once '../config/config.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = trim($_POST["email"]);
    $senha = trim($_POST["senha"]);

    // Verificar credenciais
    $sql = "SELECT id, nome_completo, senha FROM users WHERE email = ?";
    
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $id, $nome_completo, $hashed_password);
                
                if (mysqli_stmt_fetch($stmt)) {
                    if (password_verify($senha, $hashed_password)) {
                        // Senha correta, criar sessão
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["nome_completo"] = $nome_completo;
                        header("location: ../views/index.php");
                    } else {
                        echo "A senha que você inseriu não é válida.";
                    }
                }
            } else {
                echo "Nenhuma conta encontrada com esse e-mail.";
            }
        } else {
            echo "Algo deu errado. Por favor, tente novamente mais tarde.";
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
}
?>
