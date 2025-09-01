<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Trimite Email către toți pacienții</title>
    <link rel="stylesheet" href="/spital/public/css/style2.css">
</head>
<body>
<div class="container">
    <h2>Trimite Email către toți pacienții</h2>

    <?php if (!empty($status)): ?>
        <p style="color: green"><?= htmlspecialchars($status) ?></p>
    <?php endif; ?>

    <form method="POST" action="?route=send_mail_action">
        <label>Subiect:</label>
        <input type="text" name="subject" required>

        <label>Mesaj:</label>
        <textarea name="message" rows="6" required></textarea>

        <button type="submit">Trimite la toți pacienții</button>
    </form>

    <a class="back-button" href="?route=home">Înapoi la Home</a>
</div>
</body>
</html>
