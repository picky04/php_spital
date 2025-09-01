<?php
require_once __DIR__ . "/../models/User.php";

class AuthController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    public function login($email, $password) {
        $user = $this->userModel->verifyCredentials($email, $password);

        if ($user) {
            // pornim sesiunea
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // salvăm datele în sesiune
            $_SESSION['user'] = [
                'id' => $user['id_user'],
                'email' => $user['email'],
                'nume' => $user['nume'],
                'prenume' => $user['prenume'],
                'rol' => $user['rol']
            ];

            return true;
        }

        return false;
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();
        return true;
    }

    public function isAuthenticated() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['user']);
    }

    public function register($data) {
        $result = $this->userModel->registerUser(
            $data['prenume'],
            $data['nume'],
            $data['email'],
            $data['password'],
            $data['cnp']
        );

        if ($result['success']) {
            // login automat după înregistrare
            $this->login($data['email'], $data['password']);
            header("Location: ?route=home");
            exit;
        } else {
            // mesaj personalizat în funcție de eroare
            if ($result['error'] === 'email') {
                $message = "❌ Acest email este deja folosit!";
            } elseif ($result['error'] === 'cnp') {
                $message = "❌ Acest CNP este deja folosit!";
            } else {
                $message = "❌ Eroare necunoscută la înregistrare!";
            }

            require __DIR__ . "/../views/register.php";
        }
    }

}
