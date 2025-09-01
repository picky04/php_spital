<?php
class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function verifyCredentials($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user; // întoarce toate datele utilizatorului
        }

        return false;
    }

    // Obține datele unui pacient după id_user
    public function getPatientProfile($id_user) {
        $stmt = $this->pdo->prepare("
        SELECT u.nume, u.prenume, u.password, u.cnp,
               p.grupa_sange, p.alergii, p.istoric_medical
        FROM user u
        JOIN pacienti p ON u.id_user = p.id_user
        WHERE u.id_user = :id_user
        LIMIT 1
    ");
        $stmt->execute([':id_user' => $id_user]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

// Actualizează profilul pacientului
    public function updatePatientProfile($id_user, $nume, $prenume, $password, $cnp, $grupa_sange, $alergii, $istoric_medical) {
        $setPassword = '';
        $params = [
            ':id_user' => $id_user,
            ':nume' => $nume,
            ':prenume' => $prenume,
            ':cnp' => $cnp,
            ':grupa_sange' => $grupa_sange,
            ':alergii' => $alergii,
            ':istoric_medical' => $istoric_medical
        ];

        if (!empty($password)) {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $setPassword = ", password = :password";
            $params[':password'] = $hashed;
        }

        $stmt = $this->pdo->prepare("
        UPDATE user u
        JOIN pacienti p ON u.id_user = p.id_user
        SET u.nume = :nume,
            u.prenume = :prenume
            $setPassword,
            u.cnp = :cnp,
            p.grupa_sange = :grupa_sange,
            p.alergii = :alergii,
            p.istoric_medical = :istoric_medical
        WHERE u.id_user = :id_user
    ");

        return $stmt->execute($params);
    }

    public function registerUser($prenume, $nume, $email, $password, $cnp, $rol = 'pacient') {
        // verificăm dacă email-ul există deja
        $stmt = $this->pdo->prepare("SELECT id_user FROM user WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        if ($stmt->fetch()) {
            return ['success' => false, 'error' => 'email'];
        }

        // verificăm dacă CNP-ul există deja
        $stmt = $this->pdo->prepare("SELECT id_user FROM user WHERE cnp = :cnp LIMIT 1");
        $stmt->execute([':cnp' => $cnp]);
        if ($stmt->fetch()) {
            return ['success' => false, 'error' => 'cnp'];
        }

        // criptăm parola
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        // inserăm în tabelul user
        $stmt = $this->pdo->prepare("
        INSERT INTO user (prenume, nume, email, password, cnp, rol)
        VALUES (:prenume, :nume, :email, :password, :cnp, :rol)
    ");
        $stmt->execute([
            ':prenume' => $prenume,
            ':nume'    => $nume,
            ':email'   => $email,
            ':password'=> $hashed,
            ':cnp'     => $cnp,
            ':rol'     => $rol
        ]);

        $id_user = $this->pdo->lastInsertId();

        // dacă e pacient, inserăm și în tabela pacienti
        if ($rol === 'pacient') {
            $stmt = $this->pdo->prepare("
            INSERT INTO pacienti (id_user, grupa_sange, alergii, istoric_medical)
            VALUES (:id_user, '', '', '')
        ");
            $stmt->execute([':id_user' => $id_user]);
        }

        return ['success' => true, 'id_user' => $id_user];
    }



}
