<?php
    @session_start();
    $notification = (@$_SESSION['WXpKc2RHTnVUVDA9__notification'] == '') ? null : $_SESSION['WXpKc2RHTnVUVDA9__notification'];
    $leveldir = '';
    include $leveldir.'config/connection.config.php';
    include $leveldir.'config/function.php';

    $setting = "SELECT * FROM master_setting_layar_penyinaran";
    $dtSetting = sqlsrv_fetch_object(sqlsrv_query($connection, $setting));
?>
<div class="col-md-6 mx-auto">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Setting Viewer Penyinaran</h3>
        </div>
        <form id="formSetting" method="post" autocomplete="off">
            <div class="card-body">
                <div class="form-group">
                    <label>Tinggi Tabel</label>
                    <input type="number" class="form-control" name="tinggi_tabel" placeholder="Tinggi Tabel" value="<?php echo $dtSetting->tinggi_tabel ?>">
                </div>
                <div class="form-group">
                    <label>Tinggi Row Tambahan Atas</label>
                    <input type="number" class="form-control" name="tinggi_row_atas" placeholder="Tinggi Row Tambahan untuk scrolling" value="<?php echo $dtSetting->tinggi_row_atas ?>">
                </div>
                <div class="form-group">
                    <label>Tinggi Row Tambahan Bawah</label>
                    <input type="number" class="form-control" name="tinggi_row_bawah" placeholder="Tinggi Row Tambahan untuk scrolling" value="<?php echo $dtSetting->tinggi_row_bawah ?>">
                </div>
                <div class="form-group">
                    <label>Maksimal Pasien</label>
                    <input type="number" class="form-control" name="maksimal_pasien" placeholder="Jumlah pasien tampil tanpa rolling" value="<?php echo $dtSetting->maksimal_pasien ?>">
                </div>
            </div>
            <div class="card-footer">
                <a id="batal" role="button" class="btn btn-danger">Batal</a>
                <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </div>
        </form>
    </div>
</div>
<script>
    $("#batal").click(function() {
        loadAwal()
    })
    $("#formSetting").submit(function(e) {
        e.preventDefault();
        let data = $("#formSetting").serialize()
        $.ajax({
            type: "POST",
            url: "simpanSetting.php",
            data: data,
            dataType: "json",
            beforeSend: function () {
                Swal.fire({
                    icon: 'info',
                    title: 'LOADING',
                    text: 'Silahkan menunggu!',
                    footer: '<div class="d-flex justify-content-center"><div class="line-wobble"></div></div>',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                });
            },
            success: function(response) {
                Swal.close();
                Swal.fire({
                    icon: 'success',
                    title: '<strong>Status Penyimpanan</strong>' + '<br><p style="font-size: 50% !important;"><i class="fa fa-square text-success"></i> Tersimpan</p>',
                    html: '<span class="badge badge-success">'+response.status+'</span>',
                    showConfirmButton: true,
                    showCloseButton: false,
                    allowOutsideClick: true,
                    timer: 2500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
                loadAwal();
            },
        });
    });
</script>