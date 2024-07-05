<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
    <script>
        async function logout() {
            try {
                const response = await fetch('http://localhost/logout.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });
                const data = await response.json();
                if (data.error === '') {
                    alert('로그아웃 되었습니다.');
                    window.location.href = 'index.php'; // 로그아웃 후 리다이렉트
                } else {
                    alert('로그아웃에 실패했습니다.');
                }
            } catch (error) {
                console.error('로그아웃 요청 중 에러 발생:', error);
                alert('로그아웃 요청 중 에러 발생');
            }
        }
    </script>
</head>
<body>
    <h1>Index Page</h1>
    <button onclick="logout()">Logout</button>
</body>
</html>
