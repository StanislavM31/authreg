<?php require_once __DIR__ . '/classes/UserDbHandler.php';


$login = $_COOKIE['login'];
$session_id = $_COOKIE['session_id'];



try {
    $delete = new userDbHandler();
    $deleteResult = $delete->deleteUser($session_id);
    if ($deleteResult) {
        $response = array('status' => 'success', 'message' => 'Данные пользователя успешно удалены.');
        http_response_code(200);
    } else {
        $response = array("status" => "error", "message" => 'Ошибка. Пользователь не удален');
        http_response_code(500);
    }
} catch (Exception $eror) {
    $response = array("status" => "error", "message" => $error->getMessage());
    http_response_code(500);
}
header('Content-Type: application/json');
echo json_encode($response);

?>
