<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Adaugă Doctor</title>
    <link rel="stylesheet" href="/spital/public/css/style2.css">
</head>
<body>
<div class="container">
    <h1>Adaugă Doctor</h1>
    <form method="POST">
        <h3>Detalii User</h3>
        <label>Nume:</label>
        <input type="text" name="nume" required>

        <label>Prenume:</label>
        <input type="text" name="prenume" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>CNP:</label>
        <input type="text" name="cnp" required>

        <label>Parola:</label>
        <input type="password" name="password" required>

        <h3>Detalii Doctor</h3>
        <label>Departament:</label>
        <select name="id_departament" required>
            <?php foreach ($departments as $dep): ?>
                <option value="<?= $dep['id_departament'] ?>"><?= htmlspecialchars($dep['nume_departament']) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Specializare:</label>
        <input type="text" name="specializare" required>

        <label>Grad Medical:</label>
        <input type="text" name="grad_medical" required>

        <button type="submit">Adaugă</button>
    </form>

    <br>
    <a href="?route=manage_doctors">Înapoi</a>
</div>
</body>
</html>
