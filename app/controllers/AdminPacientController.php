<?php
require_once __DIR__ . "/../models/AdminPacient.php";

class AdminPacientController {
    private $model;

    public function __construct($pdo) {
        $this->model = new AdminPacient($pdo);
    }

    // Listare pacienți
    public function listPacients() {
        $pacienti = $this->model->getAllPacients();
        require __DIR__ . "/../views/admin/manage_pacients.php";
    }

    // Formular adăugare pacient
    public function addPacientForm() {
        require __DIR__ . "/../views/admin/add_pacient.php";
    }

    // Salvare pacient nou
    public function savePacient() {
        $this->model->addPacient($_POST);
        header("Location: ?route=manage_pacients&message=Pacient adăugat cu succes!");
        exit;
    }

    // Formular editare pacient
    public function editPacientForm($id_user) {
        $pacient = $this->model->getPacientById($id_user);
        require __DIR__ . "/../views/admin/edit_pacient.php";
    }

    // Update pacient
    public function updatePacient($id_user) {
        $this->model->updatePacient($id_user, $_POST);
        header("Location: ?route=manage_pacients&message=Date pacient actualizate!");
        exit;
    }

    // Ștergere pacient
    public function deletePacient($id_user) {
        $this->model->deletePacient($id_user);
        header("Location: ?route=manage_pacients&message=Pacient șters!");
        exit;
    }
}
