<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h2>Autentificare</h2>

<?php if (!empty($message)): ?>
    <p style="color:red"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST" action="?route=login">
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Parolă:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<hr>

<p>Nu ai cont? <a href="?route=register">Înregistrează-te aici</a></p>
</body>
</html>
