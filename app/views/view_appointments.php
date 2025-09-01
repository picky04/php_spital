<?php
// Presupunem că $appointments și $user vin din controller
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Programările mele</title>
    <link rel="stylesheet" href="/spital/public/css/style2.css">
</head>
<body>
<div class="container">
    <h1>Programările lui <?= htmlspecialchars($user['prenume'] . ' ' . $user['nume']) ?></h1>

    <?php if (empty($appointments)): ?>
        <p>Nu există programări.</p>
    <?php else: ?>
        <table>
            <thead>
            <tr>
                <th>Data</th>
                <th>Ora</th>
                <th>Doctor</th>
                <th>Specializare</th>
                <th>Scop</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($appointments as $appt): ?>
                <tr>
                    <td><?= htmlspecialchars($appt['data_programare']) ?></td>
                    <td><?= htmlspecialchars($appt['ora_programare']) ?></td>
                    <td><?= htmlspecialchars($appt['nume'] . ' ' . $appt['prenume']) ?></td>
                    <td><?= htmlspecialchars($appt['specializare']) ?></td>
                    <td><?= htmlspecialchars($appt['scop']) ?></td>
                    <td><?= htmlspecialchars($appt['status']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <button onclick="window.location.href='?route=home'">Înapoi la Home</button>
</div>
</body>
</html>
