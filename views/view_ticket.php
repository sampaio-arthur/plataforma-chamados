<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once '../config/config.php';

$ticket_id = $_GET["id"];

// Obter detalhes do chamado
$sql = "SELECT * FROM tickets WHERE id = ?";
if ($stmt = mysqli_prepare($link, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $ticket_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $ticket = mysqli_fetch_assoc($result);
    } else {
        echo "Algo deu errado. Por favor, tente novamente mais tarde.";
    }

    mysqli_stmt_close($stmt);
}

// Obter anexos
$sql = "SELECT * FROM anexos WHERE ticket_id = ?";
if ($stmt = mysqli_prepare($link, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $ticket_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $anexos = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo "Algo deu errado. Por favor, tente novamente mais tarde.";
    }

    mysqli_stmt_close($stmt);
}

// Obter contatos
$sql = "SELECT * FROM contatos WHERE ticket_id = ?";
if ($stmt = mysqli_prepare($link, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $ticket_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $contatos = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo "Algo deu errado. Por favor, tente novamente mais tarde.";
    }

    mysqli_stmt_close($stmt);
}

// Obter histórico
$sql = "SELECT * FROM historico WHERE ticket_id = ?";
if ($stmt = mysqli_prepare($link, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $ticket_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $historico = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo "Algo deu errado. Por favor, tente novamente mais tarde.";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($link);
?>

<?php include('components/header.php'); ?>

<div class="container">
    <h2>Detalhes do Chamado</h2>
    <p><strong>Descrição:</strong> <?php echo $ticket["descricao"]; ?></p>
    <p><strong>Tipo de Incidente:</strong> <?php echo $ticket["tipo_incidente"]; ?></p>
    <h3>Anexos</h3>
    <?php foreach ($anexos as $anexo): ?>
        <p><a href="data:application/octet-stream;base64,<?php echo $anexo["arquivo"]; ?>" download="<?php echo $anexo["nome_arquivo"]; ?>"><?php echo $anexo["nome_arquivo"]; ?></a></p>
    <?php endforeach; ?>
    <h3>Contatos</h3>
    <?php foreach ($contatos as $contato): ?>
        <p><strong>Nome:</strong> <?php echo $contato["nome"]; ?></p>
        <p><strong>Telefone:</strong> <?php echo $contato["telefone"]; ?></p>
        <p><strong>Observação:</strong> <?php echo $contato["observacao"]; ?></p>
    <?php endforeach; ?>
    <h3>Histórico</h3>
    <?php foreach ($historico as $item): ?>
        <p><?php echo $item["descricao"]; ?> - <em><?php echo $item["data"]; ?></em></p>
    <?php endforeach; ?>
</div>

<?php include('components/footer.php'); ?>
