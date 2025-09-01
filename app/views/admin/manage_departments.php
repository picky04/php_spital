<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Gestionare Departamente</title>
</head>
<body>
<h1>Gestionare Departamente</h1>

<?php if (!empty($_GET['message'])): ?>
    <p style="color:green;"><?= htmlspecialchars($_GET['message']) ?></p>
<?php endif; ?>

<button onclick="window.location.href='?route=add_department'">Adaugă Departament</button>
<br><br>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Nume Departament</th>
        <th>Etaj</th>
        <th>Acțiuni</th>
    </tr>
    <?php foreach ($departments as $d): ?>
        <tr>
            <td><?= htmlspecialchars($d['nume_departament']) ?></td>
            <td><?= htmlspecialchars($d['etaj']) ?></td>
            <td>
                <a href="?route=edit_department&id=<?= $d['id_departament'] ?>">Editează</a> |
                <a href="?route=delete_department&id=<?= $d['id_departament'] ?>" onclick="return confirm('Sigur vrei să ștergi acest departament?')">Șterge</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<br>
<a href="?route=home">Înapoi la Home</a>
</body>
</html>
