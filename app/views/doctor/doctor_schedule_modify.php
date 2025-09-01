<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Modificare Program Doctor</title>
    <link rel="stylesheet" href="/spital/public/css/style2.css">
</head>
<body>
<div class="container">
    <h1>Modificare Program Doctor</h1>

    <?php if (!empty($_GET['message'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_GET['message']) ?></p>
    <?php endif; ?>

    <form method="POST">
        <table>
            <tr>
                <th>Zi</th>
                <th>Ora Start</th>
                <th>Ora End</th>
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

        <button type="submit">Salvează Programul</button>
        <button type="button" onclick="window.location.href='?route=home'">Înapoi Acasă</button>
    </form>
</div>
</body>
</html>
