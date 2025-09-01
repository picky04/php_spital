<?php
class MedicalRecord {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Returnează fișele medicale ale unui pacient
    public function getMedicalRecordsByPatientId($id_user) {
        // Mai întâi luăm id_pacient din id_user
        $stmt = $this->pdo->prepare("SELECT id_pacient FROM pacienti WHERE id_user = :id_user LIMIT 1");
        $stmt->execute([':id_user' => $id_user]);
        $pacient = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$pacient) {
            return [];
        }

        $id_pacient = $pacient['id_pacient'];

        // Obținem fișele medicale împreună cu numele doctorului și rețetele
        $stmt = $this->pdo->prepare("
            SELECT f.id_fisa, f.diagnostic, f.observatii, f.data_consultatie,
                   u.nume AS doctor_nume, u.prenume AS doctor_prenume,
                   r.id_reteta, m.denumire AS medicament, r.dozaj, r.durata_zile
            FROM fise_medicale f
            JOIN doctori d ON f.id_doctor = d.id_doctor
            JOIN user u ON d.id_user = u.id_user
            LEFT JOIN retete r ON f.id_fisa = r.id_fisa
            LEFT JOIN medicamente m ON r.id_medicament = m.id_medicament
            WHERE f.id_pacient = :id_pacient
            ORDER BY f.data_consultatie DESC
        ");
        $stmt->execute([':id_pacient' => $id_pacient]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
