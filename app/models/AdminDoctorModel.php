<?php
class AdminDoctorModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Preia toți doctorii (cu join ca să luăm date user + departament)
    public function getAllDoctors() {
        $stmt = $this->pdo->query("
            SELECT d.id_doctor, u.nume, u.prenume, u.email, u.cnp,
                   d.id_departament, dep.nume_departament, d.specializare, d.grad_medical
            FROM doctori d
            JOIN user u ON d.id_user = u.id_user
            JOIN departamente dep ON d.id_departament = dep.id_departament
            ORDER BY u.nume ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDoctorById($id_doctor) {
        $stmt = $this->pdo->prepare("
            SELECT d.id_doctor, u.id_user, u.nume, u.prenume, u.email, u.cnp,
                   d.id_departament, dep.nume_departament, d.specializare, d.grad_medical
            FROM doctori d
            JOIN user u ON d.id_user = u.id_user
            JOIN departamente dep ON d.id_departament = dep.id_departament
            WHERE d.id_doctor = ?
        ");
        $stmt->execute([$id_doctor]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addDoctor($data) {
        // 1. Creează user-ul
        $stmtUser = $this->pdo->prepare("
        INSERT INTO user (nume, prenume, email, password, cnp, rol)
        VALUES (?, ?, ?, ?, ?, 'admin')
    ");

        // Hash parola, dacă există sau pune una default
        $passwordHash = password_hash($data['password'] ?? 'parola123', PASSWORD_DEFAULT);

        $stmtUser->execute([
            $data['nume'],
            $data['prenume'],
            $data['email'],
            $passwordHash,
            $data['cnp']
        ]);

        $userId = $this->pdo->lastInsertId();

        // 2. Creează doctorul
        $stmtDoctor = $this->pdo->prepare("
        INSERT INTO doctori (id_user, id_departament, specializare, grad_medical)
        VALUES (?, ?, ?, ?)
    ");
        $stmtDoctor->execute([
            $userId,
            $data['id_departament'],
            $data['specializare'],
            $data['grad_medical']
        ]);
    }


    public function updateDoctor($id_doctor, $data) {
        // Update user
        $stmtUser = $this->pdo->prepare("
            UPDATE user u
            JOIN doctori d ON u.id_user = d.id_user
            SET u.nume = ?, u.prenume = ?, u.email = ?, u.cnp = ?
            WHERE d.id_doctor = ?
        ");
        $stmtUser->execute([
            $data['nume'],
            $data['prenume'],
            $data['email'],
            $data['cnp'],
            $id_doctor
        ]);

        // Update doctor
        $stmtDoctor = $this->pdo->prepare("
            UPDATE doctori
            SET id_departament = ?, specializare = ?, grad_medical = ?
            WHERE id_doctor = ?
        ");
        $stmtDoctor->execute([
            $data['id_departament'],
            $data['specializare'],
            $data['grad_medical'],
            $id_doctor
        ]);
    }

    public function deleteDoctor($id_doctor) {
        // 1. Obține id_user din doctori
        $stmt = $this->pdo->prepare("SELECT id_user FROM doctori WHERE id_doctor = ?");
        $stmt->execute([$id_doctor]);
        $doctor = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($doctor) {
            $id_user = $doctor['id_user'];

            // 2. Șterge user-ul; rândul din doctori se va șterge automat prin ON DELETE CASCADE
            $stmt = $this->pdo->prepare("DELETE FROM user WHERE id_user = ?");
            $stmt->execute([$id_user]);
        }
    }


    public function getAllDepartments() {
        $stmt = $this->pdo->query("SELECT * FROM departamente ORDER BY nume_departament ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
