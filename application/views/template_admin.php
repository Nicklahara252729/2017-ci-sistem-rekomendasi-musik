<?php if(!defined('BASEPATH')) exit ('no file allowed'); ?>
<!DOCTYPE html>
<html lang='en'>
<head>
<title>Admin - <?php echo $this->session->userdata('nama'); ?> </title>
<?php
    echo link_tag('assets/css/bootstrap.css');
    echo link_tag('assets/css/default.css');
    echo link_tag('assets/css/responsive_manual.css');
 ?>
 <link href="<?php echo base_url(); ?>/assets/img/logo.png" rel="shortcut icon">
</head>
<body>
  <?php
  $uri_2 = $this->uri->segment(2);
  if($uri_2!=''){
    if($uri_2=='kelola_akun'){
      $background1 = 'bg-skyblue';
      $background2 = '';
      $background3 = '';
    }elseif ($uri_2=='kelola_music' ) {
      $background2 = 'bg-skyblue';
      $background1 = '';
      $background3 = '';
    }elseif ($uri_2=='music_form' ) {
      $background2 = 'bg-skyblue';
      $background1 = '';
      $background3 = '';
    }
    elseif ($uri_2=='pengujian_sistem') {
      $background3 = 'bg-skyblue';
      $background1 = '';
      $background2 = '';
    }
    ?>
    <div class="container-fluid bg-img-adm padding ">
        <div class="container no-padding f-13">
          <div class="col-lg-5 col-md-6 col-sm-8 col-xs-12 padding text-center microsoft ">
            <?php
            echo anchor('admin/kelola_akun','
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 padding bg-primary  bor-left-radius-5 '.$background1.'">
              <span class="glyphicon glyphicon-user"></span> &nbsp; Kelola Akun
            </div>');

            echo anchor('admin/kelola_music','
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 padding bg-primary '.$background2.'">
              <span class="glyphicon glyphicon-music"></span> &nbsp; Kelola Music
            </div>');

            echo anchor('admin/pengujian_sistem','
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 padding bg-primary bor-right-radius-5 '.$background3.'">
              <span class="glyphicon glyphicon-cog"></span> &nbsp; Pengujian Sistem
            </div>');
            ?>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 padding right text-center ">
              <strong class="color-white"><?php echo $this->session->userdata('nama'); ?></strong> &nbsp;
              <?php
              echo anchor('admin/logout','<span class="glyphicon glyphicon-log-out"></span> &nbsp; Logout',['class'=>'btn btn-warning']);
               ?>
          </div>
        </div>
    </div>
    <?php
  }
   ?>

    <?php echo $contens; ?>
    <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.4.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
    <script>
    function previewImage(input) {

  			if (input.files && input.files[0]) {
  				var fileReader = new FileReader();
  				var imageFile = input.files[0];

  				if(imageFile.type == "image/png" || imageFile.type == "image/jpeg") {
  					fileReader.readAsDataURL(imageFile);

  					fileReader.onload = function (e) {
  						$('#preview-image').attr('src', e.target.result);

  					}
  				}
  				else {
  					alert("your file is not image");
  				}
  			}
  		}

  		$("[name='cover']").change(function(){

  			previewImage(this);
  		});
    </script>
</body>
</html>
