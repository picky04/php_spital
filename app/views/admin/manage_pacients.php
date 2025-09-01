<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Gestionare Pacienți</title>
</head>
<body>
<h1>Gestionare Pacienți</h1>

<?php if (!empty($_GET['message'])): ?>
    <p style="color:green;"><?= htmlspecialchars($_GET['message']) ?></p>
<?php endif; ?>

<button onclick="window.location.href='?route=add_pacient'">Adaugă Pacient</button>
<br><br>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Nume</th>
        <th>Prenume</th>
        <th>Email</th>
        <th>CNP</th>
        <th>Grupa Sânge</th>
        <th>Alergii</th>
        <th>Acțiuni</th>
    </tr>
    <?php foreach ($pacienti as $p): ?>
        <tr>
            <td><?= htmlspecialchars($p['nume']) ?></td>
            <td><?= htmlspecialchars($p['prenume']) ?></td>
            <td><?= htmlspecialchars($p['email']) ?></td>
            <td><?= htmlspecialchars($p['cnp']) ?></td>
            <td><?= htmlspecialchars($p['grupa_sange']) ?></td>
            <td><?= htmlspecialchars($p['alergii']) ?></td>
            <td>
                <a href="?route=edit_pacient&id=<?= $p['id_user'] ?>">Editează</a> |
                <a href="?route=delete_pacient&id=<?= $p['id_user'] ?>" onclick="return confirm('Sigur vrei să ștergi acest pacient?')">Șterge</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<br>
<a href="?route=home">Înapoi la Home</a>
</body>
</html>
