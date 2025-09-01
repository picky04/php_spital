<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Editează Profil</title>
</head>
<body>
<h1>Editează Profil</h1>

<?php if (!empty($errors)): ?>
    <ul style="color:red;">
        <?php foreach ($errors as $err): ?>
            <li><?= htmlspecialchars($err) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php if (!empty($_GET['message'])): ?>
    <p style="color:green;"><?= htmlspecialchars($_GET['message']) ?></p>
<?php endif; ?>

<form method="POST" action="">
    <label>Nume:</label><br>
    <input type="text" name="nume" value="<?= htmlspecialchars($old['nume'] ?? $profile['nume']) ?>" required><br><br>

    <label>Prenume:</label><br>
    <input type="text" name="prenume" value="<?= htmlspecialchars($old['prenume'] ?? $profile['prenume']) ?>" required><br><br>

    <label>Parolă (lasă gol dacă nu vrei să schimbi):</label><br>
    <input type="password" name="password"><br><br>

    <label>CNP:</label><br>
    <input type="text" name="cnp" value="<?= htmlspecialchars($old['cnp'] ?? $profile['cnp']) ?>" required><br><br>

    <label>Grupa Sânge:</label><br>
    <select name="grupa_sange" required>
        <option value="">-- Alege grupa de sânge --</option>
        <?php
        $grupe = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        $current = $old['grupa_sange'] ?? $profile['grupa_sange'];
        foreach ($grupe as $grupa):
            $selected = ($current === $grupa) ? 'selected' : '';
            ?>
            <option value="<?= $grupa ?>" <?= $selected ?>><?= $grupa ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Alergii:</label><br>
    <textarea name="alergii"><?= htmlspecialchars($old['alergii'] ?? $profile['alergii']) ?></textarea><br><br>

    <label>Istoric Medical:</label><br>
    <textarea name="istoric_medical"><?= htmlspecialchars($old['istoric_medical'] ?? $profile['istoric_medical']) ?></textarea><br><br>

    <button type="submit">Salvează</button>
</form>

<br>
<a href="?route=home">Înapoi la Home</a>
</body>
</html>
