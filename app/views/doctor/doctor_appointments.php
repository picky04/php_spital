<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Programări Doctor</title>
    <link rel="stylesheet" href="/spital/public/css/style2.css">
</head>
<body>
<div class="container">
    <h1>Programările Doctorului</h1>

    <?php if (isset($_GET['message'])): ?>
        <p style="color: green;"><?php echo htmlspecialchars($_GET['message']); ?></p>
    <?php endif; ?>

    <table>
        <tr>
            <th>Pacient</th>
            <th>Data</th>
            <th>Ora</th>
            <th>Scop</th>
            <th>Status</th>
            <th>Acțiune</th>
        </tr>
        <?php foreach ($appointments as $appt): ?>
            <tr>
                <td><?php echo htmlspecialchars($appt['nume_pacient'] . ' ' . $appt['prenume_pacient']); ?></td>
                <td><?php echo htmlspecialchars($appt['data_programare']); ?></td>
                <td><?php echo htmlspecialchars($appt['ora_programare']); ?></td>
                <td><?php echo htmlspecialchars($appt['scop']); ?></td>
                <td><?php echo htmlspecialchars($appt['status']); ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id_programare" value="<?php echo $appt['id_programare']; ?>">
                        <select name="status">
                            <option value="programata" <?php if($appt['status']=='programata') echo 'selected'; ?>>Programată</option>
                            <option value="anulata" <?php if($appt['status']=='anulata') echo 'selected'; ?>>Anulată</option>
                            <option value="finalizata" <?php if($appt['status']=='finalizata') echo 'selected'; ?>>Finalizată</option>
                        </select>
                        <button type="submit">Actualizează</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <button onclick="window.location.href='?route=home'">Înapoi Acasă</button>
</div>
</body>
</html>
