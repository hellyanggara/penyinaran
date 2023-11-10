<?php
    @session_start();
    $notification = (@$_SESSION['WXpKc2RHTnVUVDA9__notification'] == '') ? null : $_SESSION['WXpKc2RHTnVUVDA9__notification'];
    $leveldir = '';
    include $leveldir.'config/connection.config.php';
    include $leveldir.'config/function.php';
    $judul = sqlsrv_fetch_object(sqlsrv_query($connection, "SELECT * FROM Ruangan WHERE KdRuangan = (SELECT kd_ruangan FROM master_setting_layar_penyinaran)"));
?>
<!DOCTYPE html>
<html lang="id, in">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Antrian | <?php echo $judul->NamaRuangan ?></title>
    <link rel="icon" href="vendor/dist/img/rskd.png" type="image/x-icon">
    <?php include($leveldir . 'include/_style.php'); ?>
</head>

<body class="body layout-fixed layout-navbar-fixed sidebar-collapse overflow-hidden">
    <div class="wrapper">
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="dist/img/rskd.png" alt="RS DR.KANUJOSO DJATIWIBOWO" height="60" width="60">
        </div>   -->
        <nav class="main-header navbar navbar-expand navbar-light navbar-white text-sm">
            <ul class="navbar-nav">
            <li class="nav-item">
                <img src="vendor/dist/img/rskd.png" class="img-circle ml-2" width="42px" height="42px">
            </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item h2 d-block d-md-block d-lg-block d-xl-block text-center">
                    ANTRIAN PASIEN RUANG <?php echo strtoupper($judul->NamaRuangan) ?><br>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)" id="homeButton" role="button">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="javascript:void(0);" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="content-wrapper">
            <section class="content pt-3">
                <div class="container-fluid pt-0 pb-1 px-0">
                    <div class="card mb-3">
                        <center>
                            <h4 class="mt-3"><?php echo indonesiandate(date("Y/m/d"), 1) ?> <br><text id="clock"></text></h4>
                        </center>
                        <div class="card-body" id="bodyUtama">
                            <!-- <div class="row">
                                <div class="col-6" id="groupA"></div>
                                <div class="col-6" id="groupB"></div>
                                <div class="col-6" id="groupC"></div>
                                <div class="col-6" id="groupD"></div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php include($leveldir . 'include/_scripts.php'); ?>
    <script>
        // setInterval(function() {
            // $('#data-antrian').load("data-antrian.php");
        // }, 1000);
        
        $("#homeButton").click(function() {
            loadAwal()
        })
        $(document).ready(function() {
            loadAwal()
        })
        function loadSetting(){
        }
        function loadAwal(){
            $.ajax({
                beforeSend: function () {
                    $('#bodyUtama').html('<div class="m-3 d-flex justify-content-center"><div class="line-wobble"></div></div>');
                },
                success: function(response) {
                    $('#bodyUtama').load("pilihan.php");    
                }
            });
        }
        function showTime() {
            var a_p = "";
            var today = new Date();
            var curr_hour = today.getHours();
            var curr_minute = today.getMinutes();
            var curr_second = today.getSeconds();
            /* if (curr_hour < 12) {
                a_p = "AM";
            } else {
                a_p = "PM";
            }
            if (curr_hour == 0) {
                curr_hour = 12;
            }
            if (curr_hour > 12) {
                curr_hour = curr_hour - 12;
            } */
            curr_hour = checkTime(curr_hour);
            curr_minute = checkTime(curr_minute);
            curr_second = checkTime(curr_second);
            document.getElementById('clock').innerHTML = curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }
        setInterval(showTime, 500);
    </script>
</body>

</html>