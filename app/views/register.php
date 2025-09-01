<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Înregistrare</title>
    <link rel="stylesheet" href="/spital/public/css/style.css">
</head>
<body>
<div class="container">
    <h2>Înregistrare cont nou</h2>

    <?php if (!empty($message)): ?>
        <p class="error"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="POST" action="?route=register">
        <label>Prenume:</label>
        <input type="text" name="prenume" required>

        <label>Nume:</label>
        <input type="text" name="nume" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Parolă:</label>
        <input type="password" name="password" required>

        <label>CNP:</label>
        <input type="text" name="cnp" required>

        <button type="submit">Înregistrează-te</button>
    </form>

    <p>Ai deja cont? <a href="?route=login">Autentifică-te</a></p>
</div>
</body>
</html>
