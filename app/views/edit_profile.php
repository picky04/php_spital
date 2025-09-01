<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Editează Profil</title>
    <link rel="stylesheet" href="/spital/public/css/style2.css">
</head>
<body>
<div class="container">
    <h1>Editează Profil</h1>

    <?php if (!empty($errors)): ?>
        <ul class="error">
            <?php foreach ($errors as $err): ?>
                <li><?= htmlspecialchars($err) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if (!empty($_GET['message'])): ?>
        <p class="success"><?= htmlspecialchars($_GET['message']) ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Nume:</label>
        <input type="text" name="nume" value="<?= htmlspecialchars($old['nume'] ?? $profile['nume']) ?>" required>

        <label>Prenume:</label>
        <input type="text" name="prenume" value="<?= htmlspecialchars($old['prenume'] ?? $profile['prenume']) ?>" required>

        <label>Parolă (lasă gol dacă nu vrei să schimbi):</label>
        <input type="password" name="password">

        <label>CNP:</label>
        <input type="text" name="cnp" value="<?= htmlspecialchars($old['cnp'] ?? $profile['cnp']) ?>" required>

        <label>Grupa Sânge:</label>
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
        </select>

        <label>Alergii:</label>
        <textarea name="alergii"><?= htmlspecialchars($old['alergii'] ?? $profile['alergii']) ?></textarea>

        <label>Istoric Medical:</label>
        <textarea name="istoric_medical"><?= htmlspecialchars($old['istoric_medical'] ?? $profile['istoric_medical']) ?></textarea>

        <button type="submit">Salvează</button>
    </form>

    <button onclick="window.location.href='?route=home'">Înapoi la Home</button>
</div>
</body>
</html>
