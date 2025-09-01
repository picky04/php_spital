<?php
require_once __DIR__ . '/../models/AdminDepartmentModel.php';

class AdminDepartmentController {
    private $model;

    public function __construct($pdo) {
        $this->model = new AdminDepartmentModel($pdo);
    }

    public function listDepartments() {
        $departments = $this->model->getAllDepartments();
        require __DIR__ . '/../views/admin/manage_departments.php';
    }

    public function addDepartmentForm() {
        require __DIR__ . '/../views/admin/add_department.php';
    }

    public function saveDepartment() {
        $this->model->addDepartment($_POST);
        header("Location: ?route=manage_departments&message=Departament adăugat cu succes");
        exit;
    }

    public function editDepartmentForm($id) {
        $department = $this->model->getDepartmentById($id);
        require __DIR__ . '/../views/admin/edit_department.php';
    }

    public function updateDepartment($id) {
        $this->model->updateDepartment($id, $_POST);
        header("Location: ?route=manage_departments&message=Departament actualizat cu succes");
        exit;
    }

    public function deleteDepartment($id) {
        $this->model->deleteDepartment($id);
        header("Location: ?route=manage_departments&message=Departament șters cu succes");
        exit;
    }
}
