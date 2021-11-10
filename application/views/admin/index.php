<?php if(!defined('BASEPATH')) exit ('no file allowed'); ?>
<div class="w-h-100 pos-fixed  padding bg-img-adm ">
    <div class="container pos-relative padding  mar-top-100">
        <div class="rows">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding ">
                <div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-3 col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
                    <div class=" w-h-px-200 mar-center ">
                        <img src="<?php echo base_url(); ?>/uploads/user/konsumen.png" class="w-h-100 bor-radius-50">
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  no-padding ">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center color-white f-30 no-padding">
                        <span class="glyphicon glyphicon-triangle-top"></span>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-putih mar-top-min-20 padding text-center microsoft bor-radius-3 ">
                        <?php echo $this->session->userdata('nama'); ?>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rows">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  padding">
                <div class="col-lg-offset-3 col-lg-2 col-md-4 col-sm-4 col-xs-12 padding">
                  <?php
                  echo anchor('admin/kelola_akun','
                  <div class="w-h-px-150 mar-center bor-radius-50  bg-magenta text-center color-white f-25 f-microsoft pad-top-30 transparent">
                      <span class="glyphicon glyphicon-user"></span><br>
                      Kelola User
                  </div>');

                echo anchor('admin/kelola_music','</div>
                <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12  padding">
                    <div class="w-h-px-150 mar-center bor-radius-50  bg-skyblue text-center color-white f-25 f-microsoft pad-top-30 transparent">
                        <span class="glyphicon glyphicon-music"></span><br>
                        Kelola Musik
                    </div>
                </div>');

                echo anchor('admin/pengujian_sistem','<div class="col-lg-2 col-md-4 col-sm-4 col-xs-12  padding">
                    <div class="w-h-px-150 mar-center bor-radius-50 bg-ligtgreen text-center color-white f-25 f-microsoft pad-top-30 transparent">
                      <span class="glyphicon glyphicon-cog"></span><br>
                      Pengujian Sistem
                    </div>
                </div>');
                ?>
            </div>
        </div>
    </div>
</div>
