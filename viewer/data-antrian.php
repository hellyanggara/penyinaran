<?php
session_start();
$leveldir = '../';
include $leveldir.'config/connection.config.php';
include $leveldir . 'config/function.php';

$kdRuangan = $_GET['kdRuangan'];
$kelompok = $_GET['kelompok'];
$tinggiTabel = $_GET['tinggiTabel'];
$tinggiRowAtas = $_GET['tinggiRowAtas'];
$tinggiRowBawah = $_GET['tinggiRowBawah'];
$maksimalPasien = $_GET['maksimalPasien'];
$count = sqlsrv_fetch_object(sqlsrv_query($connection, "SELECT COUNT(DATA.NoPendaftaran) as jml FROM
(
SELECT
	RegistrasiRJ.NoCM,
	RegistrasiRJ.NoPendaftaran,
	RegistrasiRJ.TglMasuk,
	Pasien.Title,
	Pasien.NamaLengkap,
	KelompokAntrianPenyinaran.Kelompok,
	( SELECT COUNT ( NoPendaftaran ) FROM CPPT LEFT JOIN MappingPegawaiNakes ON cppt.IdUser = MappingPegawaiNakes.IdPegawai LEFT JOIN MasterPPA ON MasterPPA.KdPPA = MappingPegawaiNakes.JenisPegawai WHERE NoPendaftaran = RegistrasiRJ.NoPendaftaran AND JenisPegawai = '2') AS jml_cppt_perawat,
	( SELECT COUNT ( NoPendaftaran ) FROM CPPT LEFT JOIN MappingPegawaiNakes ON cppt.IdUser = MappingPegawaiNakes.IdPegawai LEFT JOIN MasterPPA ON MasterPPA.KdPPA = MappingPegawaiNakes.JenisPegawai WHERE NoPendaftaran = RegistrasiRJ.NoPendaftaran AND JenisPegawai IN ('15','10','10')) AS jml_cppt_rad
FROM
	RegistrasiRJ
	LEFT JOIN Pasien ON Pasien.NoCM = RegistrasiRJ.NoCM
	LEFT JOIN KelompokAntrianPenyinaran ON RegistrasiRJ.NoCM = KelompokAntrianPenyinaran.NoRM 
	WHERE
    -- CAST ( RegistrasiRJ.TglMasuk AS DATE ) = CAST ( GETDATE() AS DATE )
	CAST ( TglMasuk AS DATE ) BETWEEN '2021-10-20' AND '2022-11-09' 
	AND KdRuangan = '$kdRuangan' 
	AND KelompokAntrianPenyinaran.Kelompok = '$kelompok' 
	) as DATA
	WHERE DATA.jml_cppt_perawat > 0 AND DATA.jml_cppt_rad < 1
"));
$sql = "SELECT * FROM
(
SELECT
	RegistrasiRJ.NoCM,
	RegistrasiRJ.NoPendaftaran,
	RegistrasiRJ.TglMasuk,
	Pasien.Title,
	Pasien.NamaLengkap,
	KelompokAntrianPenyinaran.Kelompok,
	( SELECT COUNT ( NoPendaftaran ) FROM CPPT LEFT JOIN MappingPegawaiNakes ON cppt.IdUser = MappingPegawaiNakes.IdPegawai LEFT JOIN MasterPPA ON MasterPPA.KdPPA = MappingPegawaiNakes.JenisPegawai WHERE NoPendaftaran = RegistrasiRJ.NoPendaftaran AND JenisPegawai = '2') AS jml_cppt_perawat,
	( SELECT COUNT ( NoPendaftaran ) FROM CPPT LEFT JOIN MappingPegawaiNakes ON cppt.IdUser = MappingPegawaiNakes.IdPegawai LEFT JOIN MasterPPA ON MasterPPA.KdPPA = MappingPegawaiNakes.JenisPegawai WHERE NoPendaftaran = RegistrasiRJ.NoPendaftaran AND JenisPegawai IN ('15','10','10')) AS jml_cppt_rad
FROM
	RegistrasiRJ
	LEFT JOIN Pasien ON Pasien.NoCM = RegistrasiRJ.NoCM
	LEFT JOIN KelompokAntrianPenyinaran ON RegistrasiRJ.NoCM = KelompokAntrianPenyinaran.NoRM 
WHERE
    -- CAST ( RegistrasiRJ.TglMasuk AS DATE ) = CAST ( GETDATE() AS DATE ) 
    CAST ( TglMasuk AS DATE ) BETWEEN '2021-10-20' AND '2022-11-09' 
    AND KdRuangan = '$kdRuangan' 
    AND KelompokAntrianPenyinaran.Kelompok = '$kelompok'
	) as DATA
	WHERE DATA.jml_cppt_perawat > 0 AND DATA.jml_cppt_rad < 1
ORDER BY
	DATA.TglMasuk DESC";
$query = sqlsrv_query($connection, $sql);
$urut = 1;
// echo $sql;
?>
<div class="card-body table-responsive pt-0 overflow-hidden" id="patientCardBody<?php echo $kelompok ?>" style="height: <?php echo $tinggiTabel ?>px;">
    <table class="table table-head-fixed text-nowrap" id="patientTable<?php echo $kelompok ?>">
        <thead>
            <tr>
            <th>Antrian</th>
            <th>No.RM</th>
            <th>Inisial</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if($count->jml > $maksimalPasien){
                echo '
                <tr style="height: '.$tinggiRowAtas.'px;">
                    <td><h5></h5></td>
                    <td><h5></h5></td>
                    <td><h5></h5></td>
                </tr>';
            }
            while($dt = sqlsrv_fetch_object($query)){
                $names = preg_split("/\s+/", $dt->NamaLengkap);
                $inisial = "";

                foreach ($names as $nama) {
                    $inisial .= substr($nama, 0, 1);
                }
                echo '
                    <tr >
                        <td><h5>'.$kelompok.$urut++.'</h5></td>
                        <td><h5>'.$dt->NoCM.'</h5></td>
                        <td><h5>'.$dt->Title.' '.$inisial.'</h5></td>
                    </tr>';
            }
            if($count->jml > $maksimalPasien){
                echo '
                <tr style="height: '.$tinggiRowBawah.'px;">
                    <td><h5></h5></td>
                    <td><h5></h5></td>
                    <td><h5></h5></td>
                </tr>';
            }
        ?>
        </tbody>
    </table>
</div>
<div class="card-footer"><span class="h5 font-weight-bold">TOTAL KELOMPOK <?php echo $kelompok ?> <span><?php echo $count->jml ?></span> PASIEN</span></div>
<script>
<?php
if($count->jml > 0){
    if($count->jml > $maksimalPasien){?>
        var jqSpeed<?php echo $kelompok ?> = 25000;
        var jqSpeedPatientWeb<?php echo $kelompok ?> = 5000;
        var jqHeightPatientWeb<?php echo $kelompok ?> = 140;
        jqSpeed<?php echo $kelompok ?> = jqSpeedPatientWeb<?php echo $kelompok ?> * <?php echo $count->jml ?>;
        if(jqSpeed<?php echo $kelompok ?> > 100000){
            jqSpeed<?php echo $kelompok ?> = 100000
        }
        scroll<?php echo $kelompok ?>()
        function scroll<?php echo $kelompok ?>(hFinish = ($('#patientTable<?php echo $kelompok ?>').height())) {
            $('#patientCardBody<?php echo $kelompok ?>').animate({
                scrollTop: hFinish
            }, jqSpeed<?php echo $kelompok ?>, 'linear', function() {
                // $(this).animate({ scrollTop: 0 }, 0);
                // loadPatient();
            });
        }
        var intervalWebId<?php echo $kelompok ?> = window.setInterval(function() {
            // console.group('Counting <?php echo $kelompok ?>');
            // console.log($('#patientTable<?php echo $kelompok ?>').height())
            // console.log($('#patientCardBody<?php echo $kelompok ?>').scrollTop() + $('#patientCardBody<?php echo $kelompok ?>').height())
            // console.groupEnd();
            if($('#patientTable<?php echo $kelompok ?>').height() <= $('#patientCardBody<?php echo $kelompok ?>').scrollTop() + $('#patientCardBody<?php echo $kelompok ?>').height()){
                // $('#data-antrian<?php echo $kelompok ?>').html('<div class="m-3 d-flex justify-content-center"><div class="line-wobble"></div></div>');
                $('#patientCardBody<?php echo $kelompok ?>').stop();
                clearInterval(intervalWebId<?php echo $kelompok ?>);
                $('#data-antrian<?php echo $kelompok ?>').load("viewer/data-antrian.php?kdRuangan=<?php echo $kdRuangan?>&kelompok=<?php echo $kelompok ?>&tinggiTabel=<?php echo $tinggiTabel?>&tinggiRowAtas=<?php echo $tinggiRowAtas ?>&tinggiRowBawah=<?php echo $tinggiRowBawah ?>&maksimalPasien=<?php echo $maksimalPasien ?>");    
            }
        }, 1000)
<?php
    }else{
?>
    window.setTimeout(function() {
        $('#data-antrian<?php echo $kelompok ?>').load("viewer/data-antrian.php?kdRuangan=<?php echo $kdRuangan?>&kelompok=<?php echo $kelompok ?>&tinggiTabel=<?php echo $tinggiTabel?>&tinggiRowAtas=<?php echo $tinggiRowAtas ?>&tinggiRowBawah=<?php echo $tinggiRowBawah ?>&maksimalPasien=<?php echo $maksimalPasien ?>"); 
    }, (3000));
<?php
    }
}else{
?>
    window.setTimeout(function() {
        // console.group('Counting <?php echo $kelompok ?>');
        // console.log('tidak ada pasien')
        // console.groupEnd();
        $('#data-antrian<?php echo $kelompok ?>').load("viewer/data-antrian.php?kdRuangan=<?php echo $kdRuangan?>&kelompok=<?php echo $kelompok ?>&tinggiTabel=<?php echo $tinggiTabel?>&tinggiRowAtas=<?php echo $tinggiRowAtas ?>&tinggiRowBawah=<?php echo $tinggiRowBawah ?>&maksimalPasien=<?php echo $maksimalPasien ?>"); 
    }, (3000));
<?php
}
?>
</script>
</div>