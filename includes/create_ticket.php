<?php
session_start();
require_once '../config/config.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user_id = $_SESSION["id"];
    $descricao = trim($_POST["descricao"]);
    $tipo_incidente = trim($_POST["tipo_incidente"]);
    
    // Inserir chamado no banco de dados
    $sql = "INSERT INTO tickets (user_id, descricao, tipo_incidente) VALUES (?, ?, ?)";
    
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "iss", $user_id, $descricao, $tipo_incidente);
        
        if (mysqli_stmt_execute($stmt)) {
            $ticket_id = mysqli_insert_id($link);

            // Salvar anexos
            foreach ($_FILES["anexos"]["tmp_name"] as $key => $tmp_name) {
                $file_name = $_FILES["anexos"]["name"][$key];
                $file_data = file_get_contents($tmp_name);
                $file_base64 = base64_encode($file_data);
                
                $sql = "INSERT INTO anexos (ticket_id, arquivo, nome_arquivo) VALUES (?, ?, ?)";
                if ($stmt_anexo = mysqli_prepare($link, $sql)) {
                    mysqli_stmt_bind_param($stmt_anexo, "iss", $ticket_id, $file_base64, $file_name);
                    mysqli_stmt_execute($stmt_anexo);
                    mysqli_stmt_close($stmt_anexo);
                }
            }

            // Salvar contatos
            foreach ($_POST["contatos"] as $contato) {
                $nome = $contato["nome"];
                $telefone = $contato["telefone"];
                $observacao = $contato["observacao"];
                
                $sql = "INSERT INTO contatos (ticket_id, nome, telefone, observacao) VALUES (?, ?, ?, ?)";
                if ($stmt_contato = mysqli_prepare($link, $sql)) {
                    mysqli_stmt_bind_param($stmt_contato, "isss", $ticket_id, $nome, $telefone, $observacao);
                    mysqli_stmt_execute($stmt_contato);
                    mysqli_stmt_close($stmt_contato);
                }
            }

            // Redirecionar para a visualização do chamado
            header("location: ../views/view_ticket.php?id=$ticket_id");
        } else {
            echo "Algo deu errado. Por favor, tente novamente mais tarde.";
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
}
?>
