<?php
    @session_start();
    $notification = (@$_SESSION['WXpKc2RHTnVUVDA9__notification'] == '') ? null : $_SESSION['WXpKc2RHTnVUVDA9__notification'];
    $leveldir = '';
    include $leveldir.'config/connection.config.php';
    include $leveldir.'config/function.php';

    $tinggi_tabel = $_POST['tinggi_tabel'];
    $tinggi_row_atas = $_POST['tinggi_row_atas'];
    $tinggi_row_bawah = $_POST['tinggi_row_bawah'];
    $maksimal_pasien = $_POST['maksimal_pasien'];
    
    $sql = "UPDATE master_setting_layar_penyinaran SET tinggi_tabel = '$tinggi_tabel', tinggi_row_atas = '$tinggi_row_atas', tinggi_row_bawah = '$tinggi_row_bawah', maksimal_pasien = '$maksimal_pasien'";
    $query = sqlsrv_query($connection, $sql);
    if($query){
        $data = array(
            // 'sql' => $sqlDetail,
            'status' => 'Setting berhasil disimpan',
        );
    }
    
    echo json_encode($data);
?>