<?php
class Appointment {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Returnează programările unui pacient după id_user
    public function getAppointmentsByPatientId($id_user) {
        $stmt = $this->pdo->prepare("SELECT id_pacient FROM pacienti WHERE id_user = :id_user LIMIT 1");
        $stmt->execute([':id_user' => $id_user]);
        $pacient = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$pacient) return [];

        $id_pacient = $pacient['id_pacient'];

        $stmt = $this->pdo->prepare("
            SELECT p.id_programare, p.data_programare, p.ora_programare, p.scop, p.status,
                   d.id_doctor, u.nume, u.prenume, d.specializare
            FROM programari p
            JOIN doctori d ON p.id_doctor = d.id_doctor
            JOIN user u ON d.id_user = u.id_user
            WHERE p.id_pacient = :id_pacient
            ORDER BY p.data_programare ASC, p.ora_programare ASC
        ");
        $stmt->execute([':id_pacient' => $id_pacient]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Returnează lista de doctori
    public function getDoctors() {
        $stmt = $this->pdo->query("
            SELECT d.id_doctor, u.nume, u.prenume, d.specializare
            FROM doctori d
            JOIN user u ON d.id_user = u.id_user
            ORDER BY u.nume, u.prenume
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Creează o programare (status folosește default-ul din DB)
    public function createAppointment($id_pacient, $id_doctor, $data, $ora, $scop) {
        $stmt = $this->pdo->prepare("
            INSERT INTO programari (id_pacient, id_doctor, data_programare, ora_programare, scop)
            VALUES (:id_pacient, :id_doctor, :data, :ora, :scop)
        ");
        return $stmt->execute([
            ':id_pacient' => $id_pacient,
            ':id_doctor' => $id_doctor,
            ':data' => $data,
            ':ora' => $ora,
            ':scop' => $scop
        ]);
    }

    // Obține id_pacient după id_user
    public function getPatientIdByUserId($id_user) {
        $stmt = $this->pdo->prepare("SELECT id_pacient FROM pacienti WHERE id_user = :id_user LIMIT 1");
        $stmt->execute([':id_user' => $id_user]);
        $pacient = $stmt->fetch(PDO::FETCH_ASSOC);
        return $pacient ? $pacient['id_pacient'] : null;
    }
}
