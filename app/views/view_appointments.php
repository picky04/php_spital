<?php
// Presupunem că $appointments și $user vin din controller
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Programările mele</title>
</head>
<body>
<h1>Programările lui <?= htmlspecialchars($user['prenume'] . ' ' . $user['nume']) ?></h1>

<?php if (empty($appointments)): ?>
    <p>Nu există programări.</p>
<?php else: ?>
    <table border="1" cellpadding="5">
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

<br>
<button onclick="window.location.href='?route=home'">Înapoi la Home</button>
</body>
</html>
