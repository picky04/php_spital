<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Editează Pacient</title>
</head>
<body>
<h1>Editează Pacient</h1>

<form method="POST" action="?route=edit_pacient&id=<?= $pacient['id_user'] ?>">
    <label>Nume:</label><br>
    <input type="text" name="nume" value="<?= htmlspecialchars($pacient['nume']) ?>" required><br><br>

    <label>Prenume:</label><br>
    <input type="text" name="prenume" value="<?= htmlspecialchars($pacient['prenume']) ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($pacient['email']) ?>" required><br><br>

    <label>Parola: (lasați gol dacă nu schimbați)</label><br>
    <input type="password" name="password"><br><br>

    <label>CNP:</label><br>
    <input type="text" name="cnp" value="<?= htmlspecialchars($pacient['cnp']) ?>" required><br><br>

    <label>Grupa Sânge:</label><br>
    <select name="grupa_sange" required>
        <option value="">Alege grupa</option>
        <?php
        $grupe = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        foreach ($grupe as $grupa) {
            $selected = ($pacient['grupa_sange'] === $grupa) ? 'selected' : '';
            echo "<option value='$grupa' $selected>$grupa</option>";
        }
        ?>
    </select><br><br>

    <label>Alergii:</label><br>
    <textarea name="alergii"><?= htmlspecialchars($pacient['alergii']) ?></textarea><br><br>

    <button type="submit">Salvează Modificările</button>
</form>

<br>
<a href="?route=manage_pacients">Înapoi la Gestionare Pacienți</a>
</body>
</html>
