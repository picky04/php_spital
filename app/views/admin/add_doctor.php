<h1>Adaugă Doctor</h1>
<form method="POST">
    <h3>Detalii User</h3>
    Nume: <input type="text" name="nume" required><br>
    Prenume: <input type="text" name="prenume" required><br>
    Email: <input type="email" name="email" required><br>
    CNP: <input type="text" name="cnp" required><br>
    Parola: <input type="password" name="password" required><br>

    <h3>Detalii Doctor</h3>
    Departament:
    <select name="id_departament" required>
        <?php foreach ($departments as $dep): ?>
            <option value="<?= $dep['id_departament'] ?>"><?= htmlspecialchars($dep['nume_departament']) ?></option>
        <?php endforeach; ?>
    </select><br>

    Specializare: <input type="text" name="specializare" required><br>
    Grad Medical: <input type="text" name="grad_medical" required><br>

    <input type="submit" value="Adaugă">
</form>
<a href="?route=manage_doctors">Înapoi</a>
