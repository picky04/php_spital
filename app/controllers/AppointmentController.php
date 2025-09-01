<?php
require_once __DIR__ . "/../models/Appointment.php";

class AppointmentController {
    private $appointmentModel;

    public function __construct($pdo) {
        $this->appointmentModel = new Appointment($pdo);
    }

    // Vizualizare programări
    public function viewAppointments($user) {
        $appointments = $this->appointmentModel->getAppointmentsByPatientId($user['id']);
        require __DIR__ . "/../views/view_appointments.php";
    }

    // Formular solicitare programare
    public function showRequestForm($user, $errors = [], $old = []) {
        $doctors = $this->appointmentModel->getDoctors();
        require __DIR__ . "/../views/request_appointment.php";
    }

    // Creare programare
    public function createAppointment($user, $postData) {
        $id_pacient = $this->appointmentModel->getPatientIdByUserId($user['id']);
        if (!$id_pacient) {
            die("Pacientul nu a fost găsit.");
        }

        $id_doctor = $postData['id_doctor'] ?? null;
        $data = $postData['data'] ?? null;
        $ora = $postData['ora'] ?? null;
        $scop = $postData['scop'] ?? '';

        $errors = [];
        if (!$id_doctor) $errors[] = "Selectează un doctor.";
        if (!$data) $errors[] = "Selectează data programării.";
        if (!$ora) $errors[] = "Selectează ora programării.";

        if (!empty($errors)) {
            $this->showRequestForm($user, $errors, $postData);
            return;
        }

        $success = $this->appointmentModel->createAppointment($id_pacient, $id_doctor, $data, $ora, $scop);

        if ($success) {
            header("Location: ?route=view_appointments");
            exit;
        } else {
            $errors[] = "Eroare la crearea programării.";
            $this->showRequestForm($user, $errors, $postData);
        }
    }
}
