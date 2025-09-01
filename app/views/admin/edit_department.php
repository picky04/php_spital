<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Editează Departament</title>
    <link rel="stylesheet" href="/spital/public/css/style2.css">
</head>
<body>
<div class="container">
<h1>Editează Departament</h1>

<form method="post" action="?route=edit_department&id=<?= $department['id_departament'] ?>">
    Nume Departament: <input type="text" name="nume_departament" value="<?= htmlspecialchars($department['nume_departament']) ?>" required>
    <br>
    Etaj: <input type="number" name="etaj" value="<?= htmlspecialchars($department['etaj']) ?>" required>
    <br><br>
    <button type="submit">Salvează</button>
</form>

<br>
<a href="?route=manage_departments">Înapoi la Gestionare Departamente</a>
</div>
</body>
</html>
