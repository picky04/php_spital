<?php
require_once __DIR__ . "/../models/MedicalRecord.php";

class MedicalRecordController {
    private $medicalRecordModel;

    public function __construct($pdo) {
        $this->medicalRecordModel = new MedicalRecord($pdo);
    }

    public function viewMedicalRecords($user) {
        $records = $this->medicalRecordModel->getMedicalRecordsByPatientId($user['id']);
        require __DIR__ . "/../views/view_medical_records.php";
    }

    public function downloadRecordsCSV($user) {
        $records = $this->medicalRecordModel->getMedicalRecordsByPatientId($user['id']);

        // Setăm header pentru descărcare CSV
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="fise_medicale.csv"');

        $output = fopen('php://output', 'w');

        // Antet CSV
        fputcsv($output, ['Data Consultatie', 'Doctor', 'Diagnostic', 'Observatii', 'Retete']);

        $current_fisa = null;
        $retete = [];

        foreach ($records as $record) {
            if ($current_fisa !== $record['id_fisa']) {
                // Dacă nu e prima fișă, scriem fișa precedentă în CSV
                if ($current_fisa !== null) {
                    fputcsv($output, [
                        $prev['data_consultatie'],
                        $prev['doctor_prenume'] . ' ' . $prev['doctor_nume'],
                        $prev['diagnostic'],
                        $prev['observatii'],
                        implode('; ', $retete)
                    ]);
                }
                $current_fisa = $record['id_fisa'];
                $retete = [];
            }

            if ($record['id_reteta']) {
                $retete[] = $record['medicament'] . ' (' . $record['dozaj'] . ', ' . $record['durata_zile'] . ' zile)';
            }

            $prev = $record;
        }

        // Scriem ultima fișă
        if ($current_fisa !== null) {
            fputcsv($output, [
                $prev['data_consultatie'],
                $prev['doctor_prenume'] . ' ' . $prev['doctor_nume'],
                $prev['diagnostic'],
                $prev['observatii'],
                implode('; ', $retete)
            ]);
        }

        fclose($output);
        exit;
    }

}
