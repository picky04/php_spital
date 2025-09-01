<?php
class AdminPacient {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // ================== READ ==================
    // Ia toți pacienții (din user + pacienti)
    public function getAllPacients() {
        $stmt = $this->pdo->query("
            SELECT u.id_user, u.nume, u.prenume, u.email, u.cnp,
                   p.id_pacient, p.grupa_sange, p.alergii, p.istoric_medical
            FROM user u
            JOIN pacienti p ON u.id_user = p.id_user
            ORDER BY u.nume, u.prenume
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ia un pacient după id_user
    public function getPacientById($id_user) {
        $stmt = $this->pdo->prepare("
            SELECT u.id_user, u.nume, u.prenume, u.email, u.cnp,
                   p.id_pacient, p.grupa_sange, p.alergii, p.istoric_medical
            FROM user u
            JOIN pacienti p ON u.id_user = p.id_user
            WHERE u.id_user = :id_user
            LIMIT 1
        ");
        $stmt->execute([':id_user' => $id_user]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ================== CREATE ==================
    public function addPacient($data) {
        // inserăm user-ul
        $stmt = $this->pdo->prepare("
            INSERT INTO user (nume, prenume, email, password, cnp, rol) 
            VALUES (:nume, :prenume, :email, :password, :cnp, 'pacient')
        ");
        $stmt->execute([
            ':nume' => $data['nume'],
            ':prenume' => $data['prenume'],
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_BCRYPT), // criptăm parola
            ':cnp' => $data['cnp']
        ]);

        $id_user = $this->pdo->lastInsertId();

        // inserăm în tabelul pacienti
        $stmt = $this->pdo->prepare("
            INSERT INTO pacienti (id_user, grupa_sange, alergii, istoric_medical) 
            VALUES (:id_user, :grupa_sange, :alergii, :istoric_medical)
        ");
        $stmt->execute([
            ':id_user' => $id_user,
            ':grupa_sange' => $data['grupa_sange'],
            ':alergii' => $data['alergii'],
            ':istoric_medical' => $data['istoric_medical']
        ]);
    }

    // ================== UPDATE ==================
    public function updatePacient($id_user, $data) {
        // actualizare tabel user
        $stmt = $this->pdo->prepare("
            UPDATE user 
            SET nume = :nume, prenume = :prenume, email = :email, cnp = :cnp
            WHERE id_user = :id_user
        ");
        $stmt->execute([
            ':nume' => $data['nume'],
            ':prenume' => $data['prenume'],
            ':email' => $data['email'],
            ':cnp' => $data['cnp'],
            ':id_user' => $id_user
        ]);

        // actualizare tabel pacienti
        $stmt = $this->pdo->prepare("
            UPDATE pacienti 
            SET grupa_sange = :grupa_sange, alergii = :alergii, istoric_medical = :istoric_medical
            WHERE id_user = :id_user
        ");
        $stmt->execute([
            ':grupa_sange' => $data['grupa_sange'],
            ':alergii' => $data['alergii'],
            ':istoric_medical' => $data['istoric_medical'],
            ':id_user' => $id_user
        ]);
    }

    // ================== DELETE ==================
    public function deletePacient($id_user) {
        // datorită ON DELETE CASCADE din DB, ștergerea user-ului șterge și pacientul
        $stmt = $this->pdo->prepare("DELETE FROM user WHERE id_user = :id_user AND rol = 'pacient'");
        $stmt->execute([':id_user' => $id_user]);
    }
}
