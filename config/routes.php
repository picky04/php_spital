<?php
require_once __DIR__ . "/pdo.php";
require_once __DIR__ . "/../app/controllers/AuthController.php";

session_start(); // sesiunea este disponibilă pentru toate rutele

$auth = new AuthController($pdo);
$route = $_GET['route'] ?? 'login';

//debug
//echo "<pre>ROUTE: "; var_dump($route); echo "</pre>";
$message = "";
//echo '<pre>';
//print_r($_SESSION['user']);
//echo '</pre>';
//exit;

switch ($route) {

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($auth->login($email, $password)) {
                header("Location: ?route=home"); // redirecționare clară în subfolder
                exit;
            } else {
                $message = "❌ Email sau parolă incorecte!";
            }
        }
        require __DIR__ . "/../app/views/login.php";
        break;

    case 'register':
        require_once __DIR__ . "/../app/controllers/AuthController.php";
        $auth = new AuthController($pdo);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth->register($_POST);
        } else {
            $message = '';
            require __DIR__ . "/../app/views/register.php";
        }
        break;

    case 'logout':
        $auth->logout();
        session_start();
        session_unset(); // șterge toate variabilele din sesiune
        session_destroy(); // distruge sesiunea
        header("Location: ?route=login"); // redirect la login
        exit;


    case 'home':
        if (!$auth->isAuthenticated()) {
            header("Location: ?route=login");
            exit;
        }
        $user = $_SESSION['user'];
        require __DIR__ . "/../app/views/home.php";
        break;

    case 'view_appointments':
        if (!$auth->isAuthenticated()) {
            header("Location: ?route=login");
            exit;
        }

        $user = $_SESSION['user']; // <<< trebuie definit înainte de verificarea rolului
        if ($user['rol'] !== 'pacient') {
            header("Location: ?route=login");
            exit;
        }

        require_once __DIR__ . "/../app/controllers/AppointmentController.php";
        $appointmentController = new AppointmentController($pdo);
        $appointmentController->viewAppointments($user);
        break;

    case 'medical_records':
        if (!$auth->isAuthenticated()) {
            header("Location: ?route=login");
            exit;
        }

        $user = $_SESSION['user']; // definim userul din sesiune

        // verificăm rolul pacient
        if ($user['rol'] !== 'pacient') {
            header("Location: ?route=login");
            exit;
        }

        require_once __DIR__ . "/../app/controllers/MedicalRecordController.php";
        $medicalRecordController = new MedicalRecordController($pdo);
        $medicalRecordController->viewMedicalRecords($user);
        break;

    case 'request_appointment':
        if (!$auth->isAuthenticated() || $_SESSION['user']['rol'] !== 'pacient') {
            header("Location: ?route=login");
            exit;
        }

        require_once __DIR__ . "/../app/controllers/AppointmentController.php";
        $appointmentController = new AppointmentController($pdo);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $appointmentController->createAppointment($_SESSION['user'], $_POST);
        } else {
            $appointmentController->showRequestForm($_SESSION['user']);
        }
        break;

    case 'edit_profile':
        if (!$auth->isAuthenticated()) {
            header("Location: ?route=login");
            exit;
        }

        $user = $_SESSION['user'];

        // verificăm rolul pacient
        if ($user['rol'] !== 'pacient') {
            header("Location: ?route=login");
            exit;
        }

        require_once __DIR__ . "/../app/controllers/ProfileController.php";
        $profileController = new ProfileController($pdo);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $profileController->updateProfile($user, $_POST);
        } else {
            $profileController->editProfileForm($user);  // <--- aici
        }
        break;

    case 'doctor_schedule':
        if (!$auth->isAuthenticated()) {
            header("Location: ?route=login");
            exit;
        }

        require_once __DIR__ . "/../app/controllers/DoctorScheduleController.php";
        $controller = new DoctorScheduleController($pdo);
        $controller->viewForm($_POST);
        break;

    case 'download_records':
        if (!$auth->isAuthenticated()) {
            header("Location: ?route=login");
            exit;
        }
        $user = $_SESSION['user'];
        require_once __DIR__ . "/../app/controllers/MedicalRecordController.php";
        $controller = new MedicalRecordController($pdo);
        $controller->downloadRecordsCSV($user);
        break;

    case 'manage_pacients':
        if (!$auth->isAuthenticated()) {
            header("Location: ?route=login");
            exit;
        }

        $user = $_SESSION['user']; // <<< foarte important
        if ($user['rol'] !== 'admin') {
            header("Location: ?route=home");
            exit;
        }

        require_once __DIR__ . "/../app/controllers/AdminPacientController.php";
        $controller = new AdminPacientController($pdo);
        $controller->listPacients();
        break;

    case 'add_pacient':
        if (!$auth->isAuthenticated()) {
            header("Location: ?route=login");
            exit;
        }

        $user = $_SESSION['user'];
        if ($user['rol'] !== 'admin') {
            header("Location: ?route=home");
            exit;
        }

        require_once __DIR__ . "/../app/controllers/AdminPacientController.php";
        $controller = new AdminPacientController($pdo);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->savePacient();
        } else {
            $controller->addPacientForm();
        }
        break;

    case 'edit_pacient':
        if (!$auth->isAuthenticated()) {
            header("Location: ?route=login");
            exit;
        }

        $user = $_SESSION['user'];
        if ($user['rol'] !== 'admin') {
            header("Location: ?route=home");
            exit;
        }

        require_once __DIR__ . "/../app/controllers/AdminPacientController.php";
        $controller = new AdminPacientController($pdo);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->updatePacient($_GET['id']);
        } else {
            $controller->editPacientForm($_GET['id']);
        }
        break;

    case 'delete_pacient':
        if (!$auth->isAuthenticated()) {
            header("Location: ?route=login");
            exit;
        }

        $user = $_SESSION['user'];
        if ($user['rol'] !== 'admin') {
            header("Location: ?route=home");
            exit;
        }

        require_once __DIR__ . "/../app/controllers/AdminPacientController.php";
        $controller = new AdminPacientController($pdo);
        $controller->deletePacient($_GET['id']);
        break;

    case 'manage_departments':
        if (!$auth->isAuthenticated()) {
            header("Location: ?route=login");
            exit;
        }

        $user = $_SESSION['user'];
        if ($user['rol'] !== 'admin') {
            header("Location: ?route=home");
            exit;
        }

        require_once __DIR__ . "/../app/controllers/AdminDepartmentController.php";
        $controller = new AdminDepartmentController($pdo);
        $controller->listDepartments();
        break;

    case 'add_department':
        if (!$auth->isAuthenticated()) {
            header("Location: ?route=login");
            exit;
        }

        $user = $_SESSION['user'];
        if ($user['rol'] !== 'admin') {
            header("Location: ?route=home");
            exit;
        }

        require_once __DIR__ . "/../app/controllers/AdminDepartmentController.php";
        $controller = new AdminDepartmentController($pdo);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->saveDepartment();
        } else {
            $controller->addDepartmentForm();
        }
        break;

    case 'edit_department':
        if (!$auth->isAuthenticated()) {
            header("Location: ?route=login");
            exit;
        }

        $user = $_SESSION['user'];
        if ($user['rol'] !== 'admin') {
            header("Location: ?route=home");
            exit;
        }

        require_once __DIR__ . "/../app/controllers/AdminDepartmentController.php";
        $controller = new AdminDepartmentController($pdo);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->updateDepartment($_GET['id']);
        } else {
            $controller->editDepartmentForm($_GET['id']);
        }
        break;

    case 'delete_department':
        if (!$auth->isAuthenticated()) {
            header("Location: ?route=login");
            exit;
        }

        $user = $_SESSION['user'];
        if ($user['rol'] !== 'admin') {
            header("Location: ?route=home");
            exit;
        }

        require_once __DIR__ . "/../app/controllers/AdminDepartmentController.php";
        $controller = new AdminDepartmentController($pdo);
        $controller->deleteDepartment($_GET['id']);
        break;

    case 'manage_doctors':
        if (!$auth->isAuthenticated()) {
            header("Location: ?route=login");
            exit;
        }

        $user = $_SESSION['user'];
        if ($user['rol'] !== 'admin') {
            header("Location: ?route=home");
            exit;
        }

        require_once __DIR__ . "/../app/controllers/AdminDoctorController.php";
        $controller = new AdminDoctorController($pdo);
        $controller->listDoctors();
        break;

    case 'add_doctor':
        if (!$auth->isAuthenticated()) {
            header("Location: ?route=login");
            exit;
        }

        $user = $_SESSION['user'];
        if ($user['rol'] !== 'admin') {
            header("Location: ?route=home");
            exit;
        }

        require_once __DIR__ . "/../app/controllers/AdminDoctorController.php";
        $controller = new AdminDoctorController($pdo);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->saveDoctor();
        } else {
            $controller->addDoctorForm();
        }
        break;

    case 'edit_doctor':
        if (!$auth->isAuthenticated()) {
            header("Location: ?route=login");
            exit;
        }

        $user = $_SESSION['user'];
        if ($user['rol'] !== 'admin') {
            header("Location: ?route=home");
            exit;
        }

        require_once __DIR__ . "/../app/controllers/AdminDoctorController.php";
        $controller = new AdminDoctorController($pdo);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->updateDoctor($_GET['id']);
        } else {
            $controller->editDoctorForm($_GET['id']);
        }
        break;

    case 'delete_doctor':
        if (!$auth->isAuthenticated()) {
            header("Location: ?route=login");
            exit;
        }

        $user = $_SESSION['user'];
        if ($user['rol'] !== 'admin') {
            header("Location: ?route=home");
            exit;
        }

        require_once __DIR__ . "/../app/controllers/AdminDoctorController.php";
        $controller = new AdminDoctorController($pdo);
        $controller->deleteDoctor($_GET['id']);
        break;

    case 'manage_schedule':
        if (!$auth->isAuthenticated()) {
            header("Location: ?route=login");
            exit;
        }

        $user = $_SESSION['user']; // IMPORTANT: ia user din sesiune
        if ($user['rol'] !== 'admin') {
            header("Location: ?route=home");
            exit;
        }

        require_once __DIR__ . '/../app/controllers/DoctorModifyScheduleController.php';
        $controller = new DoctorModifyScheduleController($pdo);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->viewScheduleForm($user['id'], $_POST);
        } else {
            $controller->viewScheduleForm($user['id']);
        }
        break;

    case 'manage_appointments':
        if (!$auth->isAuthenticated()) {
            header("Location: ?route=login");
            exit;
        }

        $user = $_SESSION['user'];
        if ($user['rol'] !== 'admin') { // doctorul e logat ca admin aici
            header("Location: ?route=home");
            exit;
        }

        require_once __DIR__ . '/../app/controllers/DoctorAppointmentsController.php';
        $controller = new DoctorAppointmentsController($pdo);
        $controller->manageAppointments($user, $_POST);
        break;

    case 'create_medical_record':
        if (!$auth->isAuthenticated()) {
            header("Location: ?route=login");
            exit;
        }

        $user = $_SESSION['user'];
        if ($user['rol'] !== 'doctor' && $user['rol'] !== 'admin') {
            header("Location: ?route=home");
            exit;
        }

        require_once __DIR__ . '/../app/controllers/DoctorMedicalRecordController.php';
        $controller = new DoctorMedicalRecordController($pdo);
        $controller->createForm($user);
        break;

    case 'save_medical_record':
        if (!$auth->isAuthenticated()) {
            header("Location: ?route=login");
            exit;
        }

        $user = $_SESSION['user'];
        if ($user['rol'] !== 'doctor' && $user['rol'] !== 'admin') {
            header("Location: ?route=home");
            exit;
        }

        require_once __DIR__ . '/../app/controllers/DoctorMedicalRecordController.php';
        $controller = new DoctorMedicalRecordController($pdo);
        $controller->saveRecord($user, $_POST);
        break;

        // Arată formularul
        if ($_GET['route'] === 'send_mail') {
            $mailController = new MailController($pdo);
            $mailController->showForm();
        }

// Trimite mailurile
        if ($_GET['route'] === 'send_mail_action' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $mailController = new MailController($pdo);
            $mailController->sendToAll($_POST);
        }

    case 'send_mail':
        if (!$auth->isAuthenticated()) {
            header("Location: ?route=login");
            exit;
        }

        $user = $_SESSION['user'];
        if ($user['rol'] !== 'doctor' && $user['rol'] !== 'admin') {
            header("Location: ?route=home");
            exit;
        }

        require_once __DIR__ . '/../app/controllers/MailController.php';
        $mailController = new MailController($pdo);
        $mailController->showForm();
        break;

    case 'send_mail_action':
        if (!$auth->isAuthenticated()) {
            header("Location: ?route=login");
            exit;
        }

        $user = $_SESSION['user'];
        if ($user['rol'] !== 'doctor' && $user['rol'] !== 'admin') {
            header("Location: ?route=home");
            exit;
        }

        require_once __DIR__ . '/../app/controllers/MailController.php';
        $mailController = new MailController($pdo);
        $mailController->sendToAll($_POST);
        break;


    default:
        echo "404 - Pagina nu există";
}
