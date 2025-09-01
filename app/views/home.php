<?php
// presupunem că $user este deja definit în routes.php
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
<h1>Bun venit, <?= htmlspecialchars($user['prenume']) ?>!</h1>
<p>Rol: <?= htmlspecialchars($user['rol']) ?></p>

<?php if ($user['rol'] === 'admin'): ?>
    <h2>Panou Admin</h2>
    <button onclick="window.location.href='?route=manage_pacients'">Gestionare Pacienti</button>
    <button onclick="window.location.href='?route=manage_departments'">Gestionare Departamente</button>
    <button onclick="window.location.href='?route=manage_doctors'">Gestionare Doctori</button>
    <button onclick="window.location.href='?route=manage_schedule'">Gestionare Orar</button>
    <button onclick="window.location.href='?route=manage_appointments'">Gestionare Programări</button>
    <button onclick="window.location.href='?route=create_medical_record'">Creare Fișă Medicală</button> <!-- nou -->
    <button onclick="window.location.href='?route=send_mail'">Trimite Email</button> <!-- nou -->

<?php elseif ($user['rol'] === 'pacient'): ?>
    <h2>Panou Pacient</h2>
    <button onclick="window.location.href='?route=view_appointments'">Vezi Programări</button>
    <button onclick="window.location.href='?route=medical_records'">Fișe Medicale</button>
    <button onclick="window.location.href='?route=request_appointment'">Solicită Programare</button>
    <button onclick="window.location.href='?route=edit_profile'">Editează Date Personale</button>
    <button onclick="window.location.href='?route=doctor_schedule'">Program Doctori</button>
<?php endif; ?>

<br><br>
<a href="?route=logout">Logout</a>
</body>
</html>
