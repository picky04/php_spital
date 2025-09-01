<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Solicită Programare</title>
</head>
<body>
<h1>Solicită Programare</h1>

<?php if (!empty($message)): ?>
    <p style="color: <?= strpos($message, '✅') !== false ? 'green' : 'red' ?>"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST" action="">
    <label>Doctor:</label><br>
    <select name="id_doctor" required>
        <option value="">-- Alege doctor --</option>
        <?php foreach ($doctors as $doctor): ?>
            <option value="<?= $doctor['id_doctor'] ?>">
                <?= htmlspecialchars($doctor['nume'] . " " . $doctor['prenume'] . " - " . $doctor['specializare']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Data:</label><br>
    <input type="date" name="data" required><br><br>

    <label>Ora:</label><br>
    <input type="time" name="ora" required><br><br>

    <label>Scop / Observații:</label><br>
    <textarea name="scop"></textarea><br><br>

    <button type="submit">Trimite</button>
</form>

<br>
<a href="?route=home">Înapoi la Home</a>
</body>
</html>
