<?php
class DoctorAppointments {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Ia doctorul după id_user
    public function getDoctorByUserId($id_user) {
        $stmt = $this->pdo->prepare("SELECT * FROM doctori WHERE id_user = ?");
        $stmt->execute([$id_user]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Obține programările doctorului
    public function getAppointmentsByDoctorId($id_doctor) {
        $stmt = $this->pdo->prepare("
            SELECT p.id_programare, u.nume AS nume_pacient, u.prenume AS prenume_pacient,
                   p.data_programare, p.ora_programare, p.scop, p.status
            FROM programari p
            JOIN pacienti pac ON pac.id_pacient = p.id_pacient
            JOIN user u ON u.id_user = pac.id_user
            WHERE p.id_doctor = ?
            ORDER BY p.data_programare ASC, p.ora_programare ASC
        ");
        $stmt->execute([$id_doctor]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Actualizează statusul unei programări
    public function updateAppointmentStatus($id_programare, $status) {
        $stmt = $this->pdo->prepare("UPDATE programari SET status = ? WHERE id_programare = ?");
        return $stmt->execute([$status, $id_programare]);
    }
}
