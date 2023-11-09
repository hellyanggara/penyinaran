<?php
session_start();
$leveldir = '../';
include $leveldir.'config/connection.config.php';
include $leveldir . 'config/function.php';
$kdRuangan = '290';
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
	CAST ( TglMasuk AS DATE ) BETWEEN '2021-11-06' AND '2023-11-09'
	AND KdRuangan = '$kdRuangan'
ORDER BY TglMasuk DESC";
$query = sqlsrv_query($connection, $sql);
$kelompokA = array();
$kelompokB = array();
$kelompokC = array();
$kelompokD = array();
while ($dt = sqlsrv_fetch_object($query)) {
    switch ($dt->Kelompok) {
        case 'A':
            $kelompokA[] = $dt;
            break;
        case 'B':
            $kelompokB[] = $dt;
            break;
        case 'C':
            $kelompokB[] = $dt;
            break;
        case 'D':
            $kelompokB[] = $dt;
            break;
    }
}
// $words = preg_split("/\s+/", "Community College District");
// $acronym = "";

// foreach ($words as $w) {
//   $acronym .= substr($w, 0, 1);
// }
?>
<div class="row">
    <div class="col-6 d-flex align-items-stretch flex-column">
        <div class="card card-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
                <div class="d-flex justify-content-between">
                    <h1>KELOMPOK B</h1>
                    <h2>10:30 - 12:00</h2>
                </div>
            </div>
            <div class="card-body table-responsive pt-0" id="patientCardBodyB" style="height: 340px;">
                <table class="table table-head-fixed text-nowrap" id="patientTableB">
                  <thead>
                    <tr>
                      <th>Antrian</th>
                      <th>No.RM</th>
                      <th>Inisial</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $urutB = 1;
                    foreach ($kelompokB as $b) {
                        $namaB = preg_split("/\s+/", $b->NamaLengkap);
                        $inisialB = "";

                        foreach ($namaB as $nama) {
                          $inisialB .= substr($nama, 0, 1);
                        }
                        echo '
                        <tr>
                            <td>B'.$urutB++.'</h5></td>
                            <td><h5>'.$b->NoCM.'</h5></td>
                            <td><h5>'.$b->Title.' '.$inisialB.'</h5></td>
                        </tr>';
                    }
                    ?>
                  </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-6 d-flex align-items-stretch flex-column">
        <div class="card card-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
                <div class="d-flex justify-content-between">
                    <h1>KELOMPOK C</h1>
                    <h2>13:00 - 14:00</h2>
                </div>
            </div>
            <div class="card-body table-responsive pt-0" style="height: 340px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Antrian</th>
                      <th>No.RM</th>
                      <th>Inisial</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $urutC = 1;
                    foreach ($kelompokC as $c) {
                        $namaC = preg_split("/\s+/", $c->NamaLengkap);
                        $inisialC = "";

                        foreach ($namaC as $nama) {
                          $inisialC .= substr($nama, 0, 1);
                        }
                        echo '
                        <tr>
                            <td>C'.$urutC++.'</h5></td>
                            <td><h5>'.$c->NoCM.'</h5></td>
                            <td><h5>'.$c->Title.' '.$inisialC.'</h5></td>
                        </tr>';
                    }
                    ?>
                  </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-6 d-flex align-items-stretch flex-column">
        <div class="card card-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
                <div class="d-flex justify-content-between">
                    <h1>KELOMPOK D</h1>
                    <h2>14:00 - 15:00</h2>
                </div>
            </div>
            <div class="card-body table-responsive pt-0" style="height: 340px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Antrian</th>
                      <th>No.RM</th>
                      <th>Inisial</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $urutD = 1;
                    foreach ($kelompokD as $d) {
                        $namaD = preg_split("/\s+/", $d->NamaLengkap);
                        $inisialD = "";

                        foreach ($namaD as $nama) {
                          $inisialD .= substr($nama, 0, 1);
                        }
                        echo '
                        <tr>
                            <td>D'.$urutD++.'</h5></td>
                            <td><h5>'.$d->NoCM.'</h5></td>
                            <td><h5>'.$d->Title.' '.$inisialD.'</h5></td>
                        </tr>';
                    }
                    ?>
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    var jqSpeed = 0;
    var jqSpeedPatientWeb = 5000;
    var jqHeightPatientWeb = 140;
    $(document).ready(function () {
        jqSpeed = jqSpeedPatientWeb * <?php echo count($kelompokA) ?>;
        scrollA()
        scrollB()
    })
    function scrollA(hFinish = ($('#patientTableA').height())) {
        $('#patientCardBodyA').animate({
            scrollTop: hFinish
        }, jqSpeed, 'linear', function() {
            // $(this).animate({ scrollTop: 0 }, 0);
            // loadPatient();
        });
    }
    function scrollB(hFinish = ($('#patientTableB').height())) {
        $('#patientCardBodyB').animate({
            scrollTop: hFinish
        }, jqSpeed, 'linear', function() {
            // $(this).animate({ scrollTop: 0 }, 0);
            // loadPatient();
        });
    }
</script>