<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Trimite Email către toți pacienții</title>
</head>
<body>
<h2>Trimite Email către toți pacienții</h2>

<?php if (!empty($status)): ?>
    <p style="color: green"><?= htmlspecialchars($status) ?></p>
<?php endif; ?>

<form method="POST" action="?route=send_mail_action">
    <label>Subiect:</label><br>
    <input type="text" name="subject" required><br><br>

    <label>Mesaj:</label><br>
    <textarea name="message" rows="6" cols="50" required></textarea><br><br>

    <button type="submit">Trimite la toți pacienții</button>
</form>

<br>
<a href="?route=home">Înapoi la Home</a>
</body>
</html>
