<?php
require_once __DIR__ . "/../models/MedicalRecordAdmin.php";

class DoctorMedicalRecordController {
    private $model;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->model = new MedicalRecordAdmin($pdo);
    }

    // Formular creare fișă
    public function createForm($user) {
        $pacienti = $this->model->getAllPacients();
        $medicamente = $this->model->getAllMedications();
        require __DIR__ . "/../views/doctor/create_medical_record.php";
    }

    // Salvare fișă
    public function saveRecord($user, $data) {
        $id_doctor = $this->getDoctorIdByUserId($user['id']); // doctorul logat
        if (!$id_doctor) {
            die("Eroare: nu există doctor asociat acestui utilizator.");
        }

        $id_pacient = $data['id_pacient'];
        $diagnostic = $data['diagnostic'];
        $observatii = $data['observatii'];
        $data_consultatie = date("Y-m-d");

        // inserăm fișa medicală
        $id_fisa = $this->model->createMedicalRecord($id_pacient, $id_doctor, $diagnostic, $observatii, $data_consultatie);

        // inserăm rețetele (dacă sunt medicamente selectate)
        if (!empty($data['medicamente'])) {
            foreach ($data['medicamente'] as $i => $id_medicament) {
                $dozaj = $data['dozaj'][$i];
                $durata = $data['durata'][$i];
                $this->model->addPrescription($id_fisa, $id_medicament, $dozaj, $durata);
            }
        }

        header("Location: ?route=home&message=Fisa+medicala+creata+cu+succes");
        exit;
    }

    // Helper: obținem id_doctor pe baza id_user (cel logat)
    private function getDoctorIdByUserId($id_user) {
        $stmt = $this->pdo->prepare("SELECT id_doctor FROM doctori WHERE id_user = :id_user LIMIT 1");
        $stmt->execute([':id_user' => $id_user]);
        $doctor = $stmt->fetch(PDO::FETCH_ASSOC);
        return $doctor ? $doctor['id_doctor'] : null;
    }
}
