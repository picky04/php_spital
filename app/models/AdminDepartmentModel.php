<?php
class AdminDepartmentModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllDepartments() {
        $stmt = $this->pdo->query("SELECT * FROM departamente ORDER BY nume_departament ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDepartmentById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM departamente WHERE id_departament = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addDepartment($data) {
        $stmt = $this->pdo->prepare("INSERT INTO departamente (nume_departament, etaj) VALUES (?, ?)");
        $stmt->execute([$data['nume_departament'], $data['etaj'] ?? null]);
    }

    public function updateDepartment($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE departamente SET nume_departament = ?, etaj = ? WHERE id_departament = ?");
        $stmt->execute([$data['nume_departament'], $data['etaj'] ?? null, $id]);
    }

    public function deleteDepartment($id) {
        $stmt = $this->pdo->prepare("DELETE FROM departamente WHERE id_departament = ?");
        $stmt->execute([$id]);
    }
}
