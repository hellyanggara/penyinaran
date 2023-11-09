<?php
session_start();
$leveldir = '../';
include $leveldir.'config/connection.config.php';
include $leveldir . 'config/function.php';
$kdRuangan = $_GET['kdRuangan'];
$sql = "SELECT
	RegistrasiRJ.NoCM,
    Pasien.Title,
	Pasien.NamaLengkap,
	KelompokAntrianPenyinaran.Kelompok	
FROM
    RegistrasiRJ 
	LEFT JOIN Pasien ON Pasien.NoCM = RegistrasiRJ.NoCM
    LEFT JOIN KelompokAntrianPenyinaran ON RegistrasiRJ.NoCM = KelompokAntrianPenyinaran.NoRM
WHERE
    -- CAST ( TglMasuk AS DATE ) = CAST ( GETDATE() AS DATE ) 
	CAST ( RegistrasiRJ.TglMasuk AS DATE ) BETWEEN '2021-11-06' AND '2023-11-09'
	AND RegistrasiRJ.KdRuangan = '$kdRuangan'
    AND KelompokAntrianPenyinaran.Kelompok = 'A'
ORDER BY TglMasuk DESC";
$query = sqlsrv_query($connection, $sql);
$countA = sqlsrv_fetch_object(sqlsrv_query($connection, "SELECT
	count(RegistrasiRJ.NoPendaftaran) as jml
FROM
	RegistrasiRJ
	LEFT JOIN KelompokAntrianPenyinaran ON RegistrasiRJ.NoCM = KelompokAntrianPenyinaran.NoRM 
WHERE
	CAST ( RegistrasiRJ.TglMasuk AS DATE ) BETWEEN '2021-11-06' 
	AND '2023-11-09' 
	AND KdRuangan = '290' 
	AND KelompokAntrianPenyinaran.Kelompok = 'A' "));
?>
<div class="d-flex align-items-stretch flex-column">
    <div class="card card-light d-flex flex-fill">
        <div class="card-header text-muted border-bottom-0">
            <div class="d-flex justify-content-between">
                <h1>KELOMPOK A</h1>
                <h2>08:30 - 10:30</h2>
            </div>
        </div>
        <div class="card-body table-responsive pt-0" id="patientCardBody" style="height: 340px;">
            <table class="table table-head-fixed text-nowrap" id="patientTable">
                <thead>
                <tr>
                    <th>Antrian</th>
                    <th>No.RM</th>
                    <th>Inisial</th>
                </tr>
                </thead>
                <tbody>
                <?php if($countA->jml >= 5){
                    echo '
                    <tr style="height: 250px;">
                        <td><h5></h5></td>
                        <td><h5></h5></td>
                        <td><h5></h5></td>
                    </tr>';
                }
                $urutA = 1;
                while ($a = sqlsrv_fetch_object($query)) {
                    $namaA = preg_split("/\s+/", $a->NamaLengkap);
                    $inisialA = "";

                    foreach ($namaA as $nama) {
                        $inisialA .= substr($nama, 0, 1);
                    }
                    echo '
                    <tr>
                        <td><h5>A'.$urutA++.'</h5></td>
                        <td><h5>'.$a->NoCM.'</h5></td>
                        <td><h5>'.$a->Title.' '.$inisialA.'</h5></td>
                    </tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    var ajqSpeed = 0;
    var ajqSpeedPatientWeb = 5000;
    var ajqHeightPatientWeb = 140;
    $(document).ready(function () {
        ajqSpeed = ajqSpeedPatientWeb * <?php echo $countA->jml ?>;
        scrollA()
    })
    function scrollA(hFinish = ($('#patientTable').height())) {
        $('#patientCardBody').animate({
            scrollTop: hFinish
        }, ajqSpeed, 'linear', function() {
            // $(this).animate({ scrollTop: 0 }, 0);
            // loadPatient();
        });
    }
</script>