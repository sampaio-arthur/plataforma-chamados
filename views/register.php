<?php include('../config/config.php'); ?>
<?php include('components/header.php'); ?>

<div class="container">
    <h2>Cadastro</h2>
    <form action="../includes/register.php" method="post">
        <div class="form-group">
            <label for="nome_completo">Nome Completo:</label>
            <input type="text" class="form-control" id="nome_completo" name="nome_completo" required>
        </div>
        <div class="form-group">
            <label for="data_nascimento">Data de Nascimento:</label>
            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
        </div>
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="telefone">Telefone:</label>
            <input type="text" class="form-control" id="telefone" name="telefone" required>
        </div>
        <div class="form-group">
            <label for="whatsapp">WhatsApp:</label>
            <input type="text" class="form-control" id="whatsapp" name="whatsapp" required>
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>
        <div class="form-group">
            <label for="confirmar_senha">Confirmar Senha:</label>
            <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="">Selecione o Estado</option>
                <!-- Carregar estados dinamicamente -->
            </select>
        </div>
        <div class="form-group">
            <label for="cidade">Cidade:</label>
            <select class="form-control" id="cidade" name="cidade" required>
                <option value="">Selecione a Cidade</option>
                <!-- Carregar cidades dinamicamente -->
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>

<?php include('components/footer.php'); ?>
