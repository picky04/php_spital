<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Adaugă Departament</title>
    <link rel="stylesheet" href="/spital/public/css/style2.css">
</head>
<body>
<div class="container">
    <h1>Adaugă Departament</h1>

    <form method="post" action="?route=add_department">
        <label>Nume Departament:</label>
        <input type="text" name="nume_departament" required>

        <label>Etaj:</label>
        <input type="number" name="etaj">

        <button type="submit">Adaugă</button>
    </form>

    <a href="?route=manage_departments">Înapoi</a>
</div>
</body>
</html>
