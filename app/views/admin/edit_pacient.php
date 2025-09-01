<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Editează Pacient</title>
    <link rel="stylesheet" href="/spital/public/css/style2.css">
</head>
<body>
<div class="container">
    <h1>Editează Pacient</h1>

    <form method="POST" action="?route=edit_pacient&id=<?= $pacient['id_user'] ?>">
        <label>Nume:</label>
        <input type="text" name="nume" value="<?= htmlspecialchars($pacient['nume']) ?>" required>

        <label>Prenume:</label>
        <input type="text" name="prenume" value="<?= htmlspecialchars($pacient['prenume']) ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($pacient['email']) ?>" required>

        <label>Parola: (lasați gol dacă nu schimbați)</label>
        <input type="password" name="password">

        <label>CNP:</label>
        <input type="text" name="cnp" value="<?= htmlspecialchars($pacient['cnp']) ?>" required>

        <label>Grupa Sânge:</label>
        <select name="grupa_sange" required>
            <option value="">Alege grupa</option>
            <?php
            $grupe = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
            foreach ($grupe as $grupa) {
                $selected = ($pacient['grupa_sange'] === $grupa) ? 'selected' : '';
                echo "<option value='$grupa' $selected>$grupa</option>";
            }
            ?>
        </select>

        <label>Alergii:</label>
        <textarea name="alergii"><?= htmlspecialchars($pacient['alergii']) ?></textarea>

        <button type="submit">Salvează Modificările</button>
    </form>

    <a href="?route=manage_pacients">Înapoi la Gestionare Pacienți</a>
</div>
</body>
</html>
