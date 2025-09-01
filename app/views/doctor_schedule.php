<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Program Doctori</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
<h1>Program Doctori</h1>

<form method="POST" action="">
    <label>Departament:</label>
    <select name="departament" id="departament" onchange="this.form.submit()">
        <option value="">-- Alege departament --</option>
        <?php foreach ($departments as $dep): ?>
            <option value="<?= $dep['id_departament'] ?>" <?= ($selectedDepartment==$dep['id_departament'])?'selected':'' ?>>
                <?= htmlspecialchars($dep['nume_departament']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <br><br>

    <label>Doctor:</label>
    <select name="doctor" id="doctor" onchange="this.form.submit()">
        <option value="">-- Alege doctor --</option>
        <?php foreach ($doctors as $doc): ?>
            <option value="<?= $doc['id_doctor'] ?>" <?= ($selectedDoctor==$doc['id_doctor'])?'selected':'' ?>>
                <?= htmlspecialchars($doc['nume'].' '.$doc['prenume'].' - '.$doc['specializare']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

<br>

<?php if (!empty($schedule)): ?>
    <table>
        <tr>
            <th>Ziua</th>
            <th>Ora Start</th>
            <th>Ora End</th>
        </tr>
        <?php foreach ($schedule as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['zi_saptamana']) ?></td>
                <td><?= htmlspecialchars($row['ora_start']) ?></td>
                <td><?= htmlspecialchars($row['ora_end']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<br>
<a href="?route=home">Înapoi la Home</a>
</body>
</html>
