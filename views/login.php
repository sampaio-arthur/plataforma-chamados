<?php include('../config/config.php'); ?>
<?php include('components/header.php'); ?>

<div class="container">
    <h2>Login</h2>
    <form action="../includes/login.php" method="post">
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<?php include('components/footer.php'); ?>
