<?php
class DoctorSchedule {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getDepartments() {
        $stmt = $this->pdo->query("SELECT * FROM departamente ORDER BY nume_departament");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDoctorsByDepartment($id_departament) {
        $stmt = $this->pdo->prepare("
            SELECT d.id_doctor, u.nume, u.prenume, d.specializare
            FROM doctori d
            JOIN user u ON d.id_user = u.id_user
            WHERE d.id_departament = :id_departament
            ORDER BY u.nume, u.prenume
        ");
        $stmt->execute([':id_departament' => $id_departament]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDoctorSchedule($id_doctor) {
        $stmt = $this->pdo->prepare("
            SELECT zi_saptamana, ora_start, ora_end
            FROM program
            WHERE id_doctor = :id_doctor
            ORDER BY FIELD(zi_saptamana,'Luni','Marti','Miercuri','Joi','Vineri','Sambata','Duminica'), ora_start
        ");
        $stmt->execute([':id_doctor' => $id_doctor]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
