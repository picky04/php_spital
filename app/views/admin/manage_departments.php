<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Gestionare Departamente</title>
    <link rel="stylesheet" href="/spital/public/css/style2.css">
</head>
<body>
<div class="container">
    <h1>Gestionare Departamente</h1>

    <?php if (!empty($_GET['message'])): ?>
        <p style="color:green;"><?= htmlspecialchars($_GET['message']) ?></p>
    <?php endif; ?>

    <button onclick="window.location.href='?route=add_department'">Adaugă Departament</button>

    <table>
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

    <a href="?route=home">Înapoi la Home</a>
</div>
</body>
</html>
