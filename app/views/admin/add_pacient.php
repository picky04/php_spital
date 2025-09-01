<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Adaugă Pacient</title>
    <link rel="stylesheet" href="/spital/public/css/style2.css">
</head>
<body>
<div class="container">
<h1>Adaugă Pacient</h1>

<form method="POST" action="?route=add_pacient">
    <label>Nume:</label><br>
    <input type="text" name="nume" required><br><br>

    <label>Prenume:</label><br>
    <input type="text" name="prenume" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Parola:</label><br>
    <input type="password" name="password" required><br><br>

    <label>CNP:</label><br>
    <input type="text" name="cnp" required><br><br>

    <label>Grupa Sânge:</label><br>
    <select name="grupa_sange" required>
        <option value="">Alege grupa</option>
        <option value="A+">A+</option>
        <option value="A-">A-</option>
        <option value="B+">B+</option>
        <option value="B-">B-</option>
        <option value="AB+">AB+</option>
        <option value="AB-">AB-</option>
        <option value="O+">O+</option>
        <option value="O-">O-</option>
    </select><br><br>

    <label>Alergii:</label><br>
    <textarea name="alergii"></textarea><br><br>

    <button type="submit">Adaugă Pacient</button>
</form>

<br>
<a href="?route=manage_pacients">Înapoi la Gestionare Pacienți</a>
</div>
</body>
</html>
