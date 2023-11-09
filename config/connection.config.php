<?php
	// $lifetime = 3600 * 24;
	// @session_set_cookie_params($lifetime, '/');
    @session_start();
	// @setcookie(session_name(), session_id(), time() + $lifetime);

    date_default_timezone_set('Asia/Singapore');

    $globalUri = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    if (strpos($globalUri, 'penyinaran_test/') !== false) {
        $_SESSION['WXpKc2RHTnVUVDA9__globalSource'] = 'penyinaran_test';
    } else {
        $_SESSION['WXpKc2RHTnVUVDA9__globalSource'] = 'penyinaran';
    }

    $httpHost = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ? 'https' : 'http')).'://'.$_SERVER['HTTP_HOST'].'/'.($_SESSION['WXpKc2RHTnVUVDA9__globalSource'] ?? 'penyinaran').'/';
    $documentRoot = $_SERVER['DOCUMENT_ROOT'].'/'.($_SESSION['WXpKc2RHTnVUVDA9__globalSource'] ?? 'penyinaran').'/';
    
    include $documentRoot.'config/variable.config.php';
    
    $connection = sqlsrv_connect($globalHostname,
        array(
            'UID' => $globalUsername,
            'PWD' => $globalPassword,
            'Database' => $globalDatabase,
            'CharacterSet' => 'UTF-8',
        )
    );
?>