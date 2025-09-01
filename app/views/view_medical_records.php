<?php
// $records vine din controller
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Fișe Medicale</title>
</head>
<body>
<h1>Fișe Medicale - <?= htmlspecialchars($user['prenume'] . ' ' . $user['nume']) ?></h1>

<?php if (empty($records)): ?>
    <p>Nu există fișe medicale.</p>
<?php else: ?>
    <?php
    $current_fisa = null;
    foreach ($records as $record):
        // afișăm fișa doar o dată și grupăm rețetele
        if ($current_fisa !== $record['id_fisa']):
            if ($current_fisa !== null) echo "<hr>";
            $current_fisa = $record['id_fisa'];
            ?>
            <h2>Data consultatiei: <?= htmlspecialchars($record['data_consultatie']) ?></h2>
            <p><strong>Doctor:</strong> <?= htmlspecialchars($record['doctor_prenume'] . ' ' . $record['doctor_nume']) ?></p>
            <p><strong>Diagnostic:</strong> <?= htmlspecialchars($record['diagnostic']) ?></p>
            <p><strong>Observații:</strong> <?= htmlspecialchars($record['observatii']) ?></p>

            <h3>Rețete:</h3>
            <ul>
        <?php endif; ?>
        <?php if ($record['id_reteta']): ?>
        <li>
            <?= htmlspecialchars($record['medicament']) ?> - <?= htmlspecialchars($record['dozaj']) ?>, pentru <?= htmlspecialchars($record['durata_zile']) ?> zile
        </li>
    <?php endif; ?>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>

<br>
<br>
<a href="?route=download_records">
    <button>Descarcă fișe medicale CSV</button>
</a>

<a href="?route=home">Înapoi la Home</a>
</body>
</html>
