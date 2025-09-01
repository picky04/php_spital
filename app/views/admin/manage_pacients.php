<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Gestionare Pacienți</title>
    <link rel="stylesheet" href="/spital/public/css/style2.css">
</head>
<body>
<div class="container">
    <h1>Gestionare Pacienți</h1>

    <?php if (!empty($_GET['message'])): ?>
        <p style="color:green;"><?= htmlspecialchars($_GET['message']) ?></p>
    <?php endif; ?>

    <div style="text-align: center;">
        <button onclick="window.location.href='?route=add_pacient'">Adaugă Pacient</button>
    </div>

    <br><br>

    <table>
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
    <div style="text-align: center;">
        <a href="?route=home">Înapoi la Home</a>
    </div>
</div>
</body>
</html>
