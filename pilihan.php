<?php
    @session_start();
    $notification = (@$_SESSION['WXpKc2RHTnVUVDA9__notification'] == '') ? null : $_SESSION['WXpKc2RHTnVUVDA9__notification'];
    $leveldir = '';
    include $leveldir.'config/connection.config.php';
    include $leveldir.'config/function.php';
?>
<div class="row">
    <div class="col-lg-6 col-6">
        <!-- small card -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><i class="fas fa-tv"></i></h3>

                <p>Layar Antrian</p>
            </div>
            <div class="icon">
                <i class="fas fa-tv"></i>
            </div>
            <div href="javascript:void(0)" class="small-box-footer" role="button" id="goViewer">
                Go <i class="fas fa-arrow-circle-right"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-6 col-6">
        <!-- small card -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><i class="fas fa-cog"></i></h3>

                <p>Setting</p>
            </div>
            <div class="icon">
                <i class="fas fa-cog"></i>
            </div>
            <div href="javascript:void(0)" class="small-box-footer" role="button" id="goSetting">
                Go <i class="fas fa-arrow-circle-right"></i>
            </div>
        </div>
        <!-- ./col -->
    </div>
</div>
<script>
    $("#goViewer").click(function() {
        $.ajax({
            beforeSend: function () {
                $('#bodyUtama').html('<div class="m-3 d-flex justify-content-center"><div class="line-wobble"></div></div>');
            },
            success: function(response) {
                $('#bodyUtama').load("layar.php");    
            }
        });
    })
    $("#goSetting").click(function() {
        $.ajax({
            beforeSend: function () {
                $('#bodyUtama').html('<div class="m-3 d-flex justify-content-center"><div class="line-wobble"></div></div>');
            },
            success: function(response) {
                $('#bodyUtama').load("setting.php");    
            }
        });
    })
</script>