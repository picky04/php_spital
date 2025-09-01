<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Solicită Programare</title>
    <link rel="stylesheet" href="/spital/public/css/style2.css">
</head>
<body>
<div class="container">
    <h1>Solicită Programare</h1>

    <?php if (!empty($message)): ?>
        <p class="<?= strpos($message, '✅') !== false ? 'success' : 'error' ?>">
            <?= htmlspecialchars($message) ?>
        </p>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Doctor:</label>
        <select name="id_doctor" required>
            <option value="">-- Alege doctor --</option>
            <?php foreach ($doctors as $doctor): ?>
                <option value="<?= $doctor['id_doctor'] ?>">
                    <?= htmlspecialchars($doctor['nume'] . " " . $doctor['prenume'] . " - " . $doctor['specializare']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Data:</label>
        <input type="date" name="data" required>

        <label>Ora:</label>
        <input type="time" name="ora" required>

        <label>Scop / Observații:</label>
        <textarea name="scop"></textarea>

        <button type="submit">Trimite</button>
    </form>

    <button onclick="window.location.href='?route=home'">Înapoi la Home</button>
</div>
</body>
</html>
