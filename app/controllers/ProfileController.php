<?php
require_once __DIR__ . "/../models/User.php";

class ProfileController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    // Afișează formularul de editare profil
    public function editProfileForm($user, $errors = [], $old = []) {
        $profile = $this->userModel->getPatientProfile($user['id']);
        require __DIR__ . "/../views/edit_profile.php";
    }

    // Procesează submit-ul formularului
    public function updateProfile($user, $postData) {
        $nume = $postData['nume'] ?? '';
        $prenume = $postData['prenume'] ?? '';
        $password = $postData['password'] ?? '';
        $cnp = $postData['cnp'] ?? '';
        $grupa_sange = $postData['grupa_sange'] ?? '';
        $alergii = $postData['alergii'] ?? '';
        $istoric_medical = $postData['istoric_medical'] ?? '';

        $errors = [];

        if (empty($nume)) $errors[] = "Numele este obligatoriu.";
        if (empty($prenume)) $errors[] = "Prenumele este obligatoriu.";
        if (empty($cnp)) $errors[] = "CNP-ul este obligatoriu.";

        if (!empty($errors)) {
            $this->editProfileForm($user, $errors, $postData);
            return;
        }

        $success = $this->userModel->updatePatientProfile(
            $user['id'], $nume, $prenume, $password, $cnp, $grupa_sange, $alergii, $istoric_medical
        );

        if ($success) {
            header("Location: ?route=edit_profile&message=Profil actualizat cu succes");
            exit;
        } else {
            $errors[] = "Eroare la actualizarea profilului.";
            $this->editProfileForm($user, $errors, $postData);
        }
    }
}
