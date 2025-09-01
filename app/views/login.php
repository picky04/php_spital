<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="/spital/public/css/style.css">
</head>
<body>
<div class="container">
    <h2>Autentificare</h2>

    <?php if (!empty($message)): ?>
        <p style="color:red"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="POST" action="?route=login">
        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Parolă:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <hr>

    <p>Nu ai cont? <a href="?route=register">Înregistrează-te aici</a></p>
</div>
</body>

</html>
