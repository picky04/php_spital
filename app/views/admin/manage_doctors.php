<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Gestionare Doctori</title>
    <link rel="stylesheet" href="/spital/public/css/style2.css">
</head>
<body>
<div class="container">
    <h1>Gestionare Doctori</h1>

    <?php if (!empty($_GET['message'])): ?>
        <p style="color:green;"><?= htmlspecialchars($_GET['message']) ?></p>
    <?php endif; ?>

    <button onclick="window.location.href='?route=add_doctor'">Adaugă Doctor</button>

    <table>
        <tr>
            <th>Nume</th>
            <th>Prenume</th>
            <th>Email</th>
            <th>Departament</th>
            <th>Specializare</th>
            <th>Grad Medical</th>
            <th>Acțiuni</th>
        </tr>
        <?php foreach ($doctors as $d): ?>
            <tr>
                <td><?= htmlspecialchars($d['nume']) ?></td>
                <td><?= htmlspecialchars($d['prenume']) ?></td>
                <td><?= htmlspecialchars($d['email']) ?></td>
                <td><?= htmlspecialchars($d['nume_departament']) ?></td>
                <td><?= htmlspecialchars($d['specializare']) ?></td>
                <td><?= htmlspecialchars($d['grad_medical']) ?></td>
                <td>
                    <a href="?route=edit_doctor&id=<?= $d['id_doctor'] ?>">Editează</a> |
                    <a href="?route=delete_doctor&id=<?= $d['id_doctor'] ?>" onclick="return confirm('Sigur vrei să ștergi acest doctor?')">Șterge</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="?route=home">Înapoi la Home</a>
</div>
</body>
</html>
