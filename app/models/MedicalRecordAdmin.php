<?php
class MedicalRecordAdmin {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Luăm lista pacienților pentru dropdown
    public function getAllPacients() {
        $stmt = $this->pdo->query("
            SELECT p.id_pacient, u.nume, u.prenume, u.cnp
            FROM pacienti p
            JOIN user u ON p.id_user = u.id_user
            ORDER BY u.nume, u.prenume
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Luăm lista medicamentelor pentru dropdown
    public function getAllMedications() {
        $stmt = $this->pdo->query("SELECT id_medicament, denumire FROM medicamente ORDER BY denumire");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Creăm o fișă medicală nouă
    public function createMedicalRecord($id_pacient, $id_doctor, $diagnostic, $observatii) {
        $stmt = $this->pdo->prepare("
            INSERT INTO fise_medicale (id_pacient, id_doctor, diagnostic, observatii, data_consultatie)
            VALUES (:id_pacient, :id_doctor, :diagnostic, :observatii, CURDATE())
        ");
        $stmt->execute([
            ':id_pacient' => $id_pacient,
            ':id_doctor' => $id_doctor,
            ':diagnostic' => $diagnostic,
            ':observatii' => $observatii
        ]);

        return $this->pdo->lastInsertId();
    }

    // Adăugăm medicamente pe rețetă pentru fișa respectivă
    public function addPrescription($id_fisa, $id_medicament, $dozaj, $durata_zile) {
        $stmt = $this->pdo->prepare("
            INSERT INTO retete (id_fisa, id_medicament, dozaj, durata_zile)
            VALUES (:id_fisa, :id_medicament, :dozaj, :durata_zile)
        ");
        return $stmt->execute([
            ':id_fisa' => $id_fisa,
            ':id_medicament' => $id_medicament,
            ':dozaj' => $dozaj,
            ':durata_zile' => $durata_zile
        ]);
    }
}
