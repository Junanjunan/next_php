<?php
// 세션 시작
session_start();

// 세션 변수 모두 제거
$_SESSION = array();

// 세션 쿠키 삭제
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 세션 종료
session_destroy();


// 로그아웃 완료 응답
echo json_encode(['error' => '']);
?>
