<?php

class Middleware
{

    /* fetch("registration_process.php", {
    method: "POST",
    body: formData,
    headers: {
        "X-Requested-With": "xmlhttprequest",
        "X-Form-Name": "your-form-name"
    }
}) */
    private function parseRequest($requestData)
    {
        $login = $requestData['login'] ?? '';
        $password = $requestData['password'] ?? '';
        
        $formName = $_SERVER['HTTP_X_FORM_NAME'] ?? '';
    
    
        return [
            'login' => $login,
            'password' => $password
        ];
    }

    public function handleRequest()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
                    $action = $_POST['action'];
                    $login = $_POST['login'];
                    $password = $_POST['password'];

                    if ($action === 'login') {
                        $response = $this->handleLogin($login, $password);
                    } elseif ($action === 'register') {
                        $confirmPassword = $_POST['confirm_password'];
                        $email = $_POST['email'];
                        $session_id = session_id();
                        $response = $this->handleRegistration($login, $password, $confirmPassword, $email, $session_id);
                    } else {
                        throw new Exception("Неверное действие");
                    }

                    $this->sendJsonResponse($response);
                } else {
                    throw new Exception("Ошибка. Это не Ajax-запрос");
                }
            } else {
                throw new Exception("Неверный метод запроса");
            }
        } catch (Exception $error) {
            http_response_code(400);
            $this->sendJsonResponse([
                'status' => 'error',
                'message' => $error->getMessage()
            ]);
        }
    }

    private function handleLogin($login, $password)
    {
        $loginObject = new Login();
        return $loginObject->authenticateUser($login, $password);
    }

    private function handleRegistration($login, $password, $confirmPassword, $email, $session_id)
    {
        $registration = new Registration($login, $password, $confirmPassword, $email, $session_id);
        $registrationResult = $registration->register();

        if ($registrationResult === true) {
            $_SESSION['login'] = $login;
            setcookie('login', $login, time() + 30);
            return [
                'status' => 'success',
                'message' => 'Регистрация успешна'
            ];
        } else {
            session_destroy();
            return [
                'status' => 'error',
                'message' => $registrationResult
            ];
        }
    }

    private function sendJsonResponse($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}

$middleware = new Middleware();
$middleware->handleRequest();
