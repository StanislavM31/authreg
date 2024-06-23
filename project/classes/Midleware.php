<?php
require_once 'classes/Registration.php';
require_once 'classes/Login.php';
require_once 'classes/UserDBHandler.php';

class Middleware
{
    private $isAjax;
    private $login;
    private $password;
    private $confirmPassword;
    private $email;
    private $session_id;

    private $formName;
    private $response;


    public function __construct()
    {
        $this->isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
        $this->login = isset($_POST['login']) ? $_POST['login'] : '';
        $this->password = isset($_POST['password']) ? $_POST['password'] : '';
        $this->confirmPassword = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : null;
        $this->email = isset($_POST['email']) ? $_POST['email'] : null;
        $this->session_id = session_id();

        $this->formName = 'myForm'; 
    }

    public function isAjax()
    {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            $this->isAjax = true;
            return $this->isAjax;
        } else {
            $this->response = ['status' => 'error', 'message' => "Error. это не ajax"];
        }
    }

    public function registration()
    {
        if ($this->confirmPassword == $this->password) {
            $this->response = ['status' => 'error', 'message' => "не совпадают пароли"];
        }

        if ($this->email) {
            //нет @ или email короткий
            $this->response = ['status' => 'error', 'message' => "проблемы с email"];
        }

        $registration = new Registration($this->login, $this->password, $this->confirmPassword, $this->email, $this->session_id);
        $registrationResult = $registration->register();

        if ($registrationResult === true) {
            $_SESSION['login'] = $this->login;
            setcookie('login', $this->login, time() + 30);
            $response = array("status" => "success", "message" => "Регистрация успешна");
        } else {
            session_destroy();
            $response = array("status" => "error", "message" => $registrationResult);
        }

        header('Content-Type: application/json');
        echo json_encode($response);

 
        header("Location: index.php");
        exit();
    }
    public function getResponse()
    {
        header('Content-Type: application/json');
        
        return json_encode($this->response);
        exit();
    }
}
