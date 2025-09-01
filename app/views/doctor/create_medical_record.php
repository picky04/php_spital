<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Creare Fișă Medicală</title>
</head>
<body>
<h1>Creare Fișă Medicală</h1>

<form method="POST" action="?route=save_medical_record">
    <label>Alege Pacient:</label>
    <select name="id_pacient" required>
        <?php foreach ($pacienti as $p): ?>
            <option value="<?= $p['id_pacient'] ?>">
                <?= htmlspecialchars($p['prenume'] . " " . $p['nume'] . " (CNP: " . $p['cnp'] . ")") ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <label>Diagnostic:</label><br>
    <textarea name="diagnostic" required></textarea><br><br>

    <label>Observații:</label><br>
    <textarea name="observatii"></textarea><br><br>

    <h3>Rețete Medicale</h3>
    <div id="retete">
        <div class="reteta">
            <label>Medicament:</label>
            <select name="medicamente[]">
                <option value="">-- selectează --</option>
                <?php foreach ($medicamente as $m): ?>
                    <option value="<?= $m['id_medicament'] ?>">
                        <?= htmlspecialchars($m['denumire']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <label>Dozaj:</label>
            <input type="text" name="dozaj[]">
            <label>Durata (zile):</label>
            <input type="number" name="durata[]">
        </div>
    </div>
    <button type="button" onclick="adaugaReteta()">Adaugă alt medicament</button>

    <br><br>
    <button type="submit">Salvează Fișa</button>
</form>

<script>
    function adaugaReteta() {
        const div = document.createElement("div");
        div.classList.add("reteta");
        div.innerHTML = `
        <label>Medicament:</label>
        <select name="medicamente[]">
            <option value="">-- selectează --</option>
            <?php foreach ($medicamente as $m): ?>
                <option value="<?= $m['id_medicament'] ?>">
                    <?= htmlspecialchars($m['denumire']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <label>Dozaj:</label>
        <input type="text" name="dozaj[]">
        <label>Durata (zile):</label>
        <input type="number" name="durata[]">
    `;
        document.getElementById("retete").appendChild(div);
    }
</script>

<br>
<a href="?route=home">Înapoi la Home</a>
</body>
</html>
