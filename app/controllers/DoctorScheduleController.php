<?php
require_once __DIR__ . "/../models/DoctorSchedule.php";

class DoctorScheduleController {
    private $model;

    public function __construct($pdo) {
        $this->model = new DoctorSchedule($pdo);
    }

    public function viewForm($postData = []) {
        $departments = $this->model->getDepartments();
        $doctors = [];
        $schedule = [];

        $selectedDepartment = $postData['departament'] ?? null;
        $selectedDoctor = $postData['doctor'] ?? null;

        if ($selectedDepartment) {
            $doctors = $this->model->getDoctorsByDepartment($selectedDepartment);
        }
        if ($selectedDoctor) {
            $schedule = $this->model->getDoctorSchedule($selectedDoctor);
        }

        require __DIR__ . "/../views/doctor_schedule.php";
    }
}
