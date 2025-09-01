<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Modificare Program</title>
</head>
<body>
<h2>Modificare Program Doctor</h2>

<?php if (!empty($_GET['message'])): ?>
    <p style="color: green;"><?= htmlspecialchars($_GET['message']) ?></p>
<?php endif; ?>

<form method="POST">
    <table border="1" cellpadding="6" cellspacing="0">
        <tr>
            <th>Zi</th>
            <th>Ora start</th>
            <th>Ora end</th>
        </tr>

        <?php foreach ($scheduleMap as $zi => $interval): ?>
            <tr>
                <td>
                    <?= htmlspecialchars($zi) ?>
                    <input type="hidden" name="zi_saptamana[]" value="<?= htmlspecialchars($zi) ?>">
                </td>
                <td>
                    <input type="time" name="ora_start[]" value="<?= htmlspecialchars($interval['ora_start']) ?>">
                </td>
                <td>
                    <input type="time" name="ora_end[]" value="<?= htmlspecialchars($interval['ora_end']) ?>">
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <button type="submit">Salvează programul</button>
    <button type="button" onclick="window.location.href='?route=home'">Înapoi acasă</button>
</form>
</body>
</html>
