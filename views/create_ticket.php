<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php include('../config/config.php'); ?>
<?php include('components/header.php'); ?>

<div class="container">
    <h2>Registrar Novo Chamado</h2>
    <form action="../includes/create_ticket.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="descricao">Descrição do Problema:</label>
            <textarea id="descricao" name="descricao" class="form-control summernote" required></textarea>
        </div>
        <div class="form-group">
            <label for="tipo_incidente">Tipo de Incidente:</label>
            <input type="text" class="form-control" id="tipo_incidente" name="tipo_incidente" required>
        </div>
        <div class="form-group">
            <label for="anexos">Anexos:</label>
            <input type="file" class="form-control" id="anexos" name="anexos[]" multiple>
        </div>
        <div id="contatos-container">
            <div class="form-group contato">
                <label for="nome_contato">Nome do Contato:</label>
                <input type="text" class="form-control" id="nome_contato" name="contatos[0][nome]" required>
                <label for="telefone_contato">Telefone:</label>
                <input type="text" class="form-control" id="telefone_contato" name="contatos[0][telefone]" required>
                <label for="observacao_contato">Observação:</label>
                <input type="text" class="form-control" id="observacao_contato" name="contatos[0][observacao]">
            </div>
        </div>
        <button type="button" id="add-contato" class="btn btn-secondary">Adicionar Contato</button>
        <button type="submit" class="btn btn-primary">Registrar Chamado</button>
    </form>
</div>

<?php include('components/footer.php'); ?>
