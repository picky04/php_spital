<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Creare Fișă Medicală</title>
    <link rel="stylesheet" href="/spital/public/css/style2.css">
</head>
<body>
<div class="container">
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

        <label>Diagnostic:</label>
        <textarea name="diagnostic" required></textarea>

        <label>Observații:</label>
        <textarea name="observatii"></textarea>

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
        <button type="submit">Salvează Fișa</button>
    </form>

    <a class="back-button" href="?route=home">Înapoi la Home</a>
</div>

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
</body>
</html>
