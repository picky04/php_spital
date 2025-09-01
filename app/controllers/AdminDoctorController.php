<?php
require_once __DIR__ . '/../models/AdminDoctorModel.php';

class AdminDoctorController {
    private $model;

    public function __construct($pdo) {
        $this->model = new AdminDoctorModel($pdo);
    }

    public function listDoctors() {
        $doctors = $this->model->getAllDoctors();
        require __DIR__ . '/../views/admin/manage_doctors.php';
    }

    public function addDoctorForm() {
        $departments = $this->model->getAllDepartments();
        require __DIR__ . '/../views/admin/add_doctor.php';
    }

    public function saveDoctor() {
        $this->model->addDoctor($_POST);
        header("Location: ?route=manage_doctors&message=Doctor adăugat cu succes");
        exit;
    }

    public function editDoctorForm($id) {
        $doctor = $this->model->getDoctorById($id);
        $departments = $this->model->getAllDepartments();
        require __DIR__ . '/../views/admin/edit_doctor.php';
    }

    public function updateDoctor($id) {
        $this->model->updateDoctor($id, $_POST);
        header("Location: ?route=manage_doctors&message=Doctor actualizat cu succes");
        exit;
    }

    public function deleteDoctor($id) {
        $this->model->deleteDoctor($id);
        header("Location: ?route=manage_doctors&message=Doctor șters cu succes");
        exit;
    }
}
