<?php
require_once __DIR__ . "/../models/DoctorAppointments.php";

class DoctorAppointmentsController {
    private $model;

    public function __construct($pdo) {
        $this->model = new DoctorAppointments($pdo);
    }

    // Afișează lista programărilor și permite schimbarea statusului
    public function manageAppointments($user, $postData = []) {
        $doctor = $this->model->getDoctorByUserId($user['id']);
        if (!$doctor) {
            echo "Doctorul nu a fost găsit!";
            return;
        }

        $id_doctor = $doctor['id_doctor'];

        // Actualizare status programare dacă s-a trimis formularul
        if (!empty($postData['id_programare']) && isset($postData['status'])) {
            $this->model->updateAppointmentStatus($postData['id_programare'], $postData['status']);
            header("Location: ?route=manage_appointments&message=Status actualizat");
            exit;
        }

        $appointments = $this->model->getAppointmentsByDoctorId($id_doctor);

        require __DIR__ . "/../views/doctor/doctor_appointments.php";
    }
}
