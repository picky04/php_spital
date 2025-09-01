<?php
require_once __DIR__ . '/../models/DoctorModifySchedule.php';

class DoctorModifyScheduleController {
    private $model;

    public function __construct($pdo) {
        $this->model = new DoctorModifySchedule($pdo);
    }

    public function viewScheduleForm($id_user, $postData = []) {
        // aici luăm id_doctor direct din tabela doctori după id_user
        $id_doctor = $this->model->getDoctorIdByUserId($id_user);
        if (!$id_doctor) {
            echo "Nu există doctor asociat acestui utilizator.";
            return;
        }

        // Dacă a venit POST => salvăm
        if (!empty($postData)) {
            $this->model->updateSchedule($id_doctor, $postData);
            header("Location: ?route=manage_schedule&message=Program actualizat");
            exit;
        }

        // Aducem programul doctorului
        $schedule = $this->model->getScheduleByDoctorId($id_doctor);

        // Mapăm toate zilele
        $zile = ['Luni','Marti','Miercuri','Joi','Vineri','Sambata','Duminica'];
        $scheduleMap = [];
        foreach ($zile as $zi) {
            $scheduleMap[$zi] = ['ora_start'=>'', 'ora_end'=>''];
        }
        foreach ($schedule as $row) {
            $scheduleMap[$row['zi_saptamana']] = [
                'ora_start' => $row['ora_start'] ? substr($row['ora_start'], 0, 5) : '',
                'ora_end'   => $row['ora_end']   ? substr($row['ora_end'], 0, 5) : '',
            ];
        }

        require __DIR__ . '/../views/doctor/doctor_schedule_modify.php';
    }
}
