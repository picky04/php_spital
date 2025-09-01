<h1>Editează Doctor</h1>
<form method="POST">
    <h3>Detalii User</h3>
    Nume: <input type="text" name="nume" value="<?= htmlspecialchars($doctor['nume']) ?>" required><br>
    Prenume: <input type="text" name="prenume" value="<?= htmlspecialchars($doctor['prenume']) ?>" required><br>
    Email: <input type="email" name="email" value="<?= htmlspecialchars($doctor['email']) ?>" required><br>
    CNP: <input type="text" name="cnp" value="<?= htmlspecialchars($doctor['cnp']) ?>" required><br>

    <h3>Detalii Doctor</h3>
    Departament:
    <select name="id_departament" required>
        <?php foreach ($departments as $dep): ?>
            <option value="<?= $dep['id_departament'] ?>"
                <?= $dep['id_departament'] == $doctor['id_departament'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($dep['nume_departament']) ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    Specializare: <input type="text" name="specializare" value="<?= htmlspecialchars($doctor['specializare']) ?>" required><br>
    Grad Medical: <input type="text" name="grad_medical" value="<?= htmlspecialchars($doctor['grad_medical']) ?>" required><br>

    <input type="submit" value="Salvează">
</form>
<a href="?route=manage_doctors">Înapoi</a>
