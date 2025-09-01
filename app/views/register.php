<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Înregistrare</title>
</head>
<body>
<h2>Înregistrare cont nou</h2>

<?php if (!empty($message)): ?>
    <p style="color:red"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST" action="?route=register">
    <label>Prenume:</label><br>
    <input type="text" name="prenume" required><br><br>

    <label>Nume:</label><br>
    <input type="text" name="nume" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Parolă:</label><br>
    <input type="password" name="password" required><br><br>

    <label>CNP:</label><br>
    <input type="text" name="cnp" required><br><br>

    <button type="submit">Înregistrează-te</button>
</form>

<p>Ai deja cont? <a href="?route=login">Autentifică-te</a></p>
</body>
</html>
