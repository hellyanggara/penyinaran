<?php
    @session_start();
    $notification = (@$_SESSION['WXpKc2RHTnVUVDA9__notification'] == '') ? null : $_SESSION['WXpKc2RHTnVUVDA9__notification'];
    $leveldir = '';
    include $leveldir.'config/connection.config.php';
    include $leveldir.'config/function.php';

    $sqlMaster = "SELECT * FROM master_kelompok_penyinaran WHERE viewer = '1'";
    $queryMaster = sqlsrv_query($connection, $sqlMaster);
    $setting = "SELECT * FROM master_setting_layar_penyinaran";
    $dtSetting = sqlsrv_fetch_object(sqlsrv_query($connection, $setting));
?>
<div class="row">
<?php
while ($dtMaster = sqlsrv_fetch_object($queryMaster)) {?>
    <div class="col-6 d-flex align-items-stretch flex-column">
        <div class="card card-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
                <div class="d-flex justify-content-between">
                    <h2>KELOMPOK <?php echo $dtMaster->nama ?></h2>
                    <h2><?php echo date("H:i", dateNormalize($dtMaster->jam_mulai)).' - '.date("H:i", dateNormalize($dtMaster->jam_akhir)) ?></h2>
                </div>
            </div>
            <div id="data-antrian<?php echo $dtMaster->nama ?>"></div>
        </div>
    </div>
    <script>
        $.ajax({
            beforeSend: function () {
                $('#data-antrian<?php echo $dtMaster->nama ?>').html('<div class="m-3 d-flex justify-content-center"><div class="line-wobble"></div></div>');
            },
            success: function(response) {
                $('#data-antrian<?php echo $dtMaster->nama ?>').load("viewer/data-antrian.php?kdRuangan=<?php echo $dtSetting->kd_ruangan?>&kelompok=<?php echo $dtMaster->nama ?>&tinggiTabel=<?php echo $dtSetting->tinggi_tabel?>&tinggiRowAtas=<?php echo $dtSetting->tinggi_row_atas ?>&tinggiRowBawah=<?php echo $dtSetting->tinggi_row_bawah ?>&maksimalPasien=<?php echo $dtSetting->maksimal_pasien ?>");    
            }
        });
    </script>
<?php }
?>
</div>