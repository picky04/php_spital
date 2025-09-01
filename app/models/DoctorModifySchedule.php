<?php
class DoctorModifySchedule {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getDoctorByUserId($id_user) {
        $stmt = $this->pdo->prepare("SELECT * FROM doctori WHERE id_user = ?");
        $stmt->execute([$id_user]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getScheduleByDoctorId($id_doctor) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM program 
            WHERE id_doctor = ? 
            ORDER BY FIELD(zi_saptamana, 'Luni','Marti','Miercuri','Joi','Vineri','Sambata','Duminica'), ora_start ASC
        ");
        $stmt->execute([$id_doctor]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateSchedule($id_doctor, $data) {
        // Șterge toate orele existente
        $stmt = $this->pdo->prepare("DELETE FROM program WHERE id_doctor = ?");
        $stmt->execute([$id_doctor]);

        // Adaugă noile intervale
        if (!empty($data['zi_saptamana'])) {
            foreach ($data['zi_saptamana'] as $index => $zi) {
                $ora_start = $data['ora_start'][$index] ?: null;
                $ora_end = $data['ora_end'][$index] ?: null;
                $stmt = $this->pdo->prepare("INSERT INTO program (id_doctor, zi_saptamana, ora_start, ora_end) VALUES (?, ?, ?, ?)");
                $stmt->execute([$id_doctor, $zi, $ora_start, $ora_end]);
            }
        }
    }

    public function getDoctorIdByUserId($id_user) {
        $stmt = $this->pdo->prepare("SELECT id_doctor FROM doctori WHERE id_user = ?");
        $stmt->execute([$id_user]);
        return $stmt->fetchColumn(); // returnează direct id_doctor sau false
    }
}
