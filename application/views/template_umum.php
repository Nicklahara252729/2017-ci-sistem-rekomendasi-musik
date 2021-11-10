<?php if(!defined('BASEPATH')) exit ('no file allowed'); ?>
<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php
  if($this->session->userdata('nama')){
    $tag = "-";
  }else{
    $tag = " ";
  }
   ?>
<title>Music Tune  <?php echo $tag; echo" ".$this->session->userdata('nama'); ?></title>
<?php
    echo link_tag('assets/css/bootstrap.css');
    echo link_tag('assets/css/default.css');
    echo link_tag('assets/css/responsive_manual.css');
    echo link_tag('assets/js/jquery-ui.css');
    echo link_tag('assets/js/jquery-ui.theme.css');
    echo link_tag('assets/css/owl.carousel.css');
    echo link_tag('assets/css/jquery.raty.css');
    echo link_tag('assets/css/font-awesome.css');
 ?>
 <link href="<?php echo base_url(); ?>/assets/img/logo.png" rel="shortcut icon">
 <style>
 ul{ margin:0; padding:0; }
 li{ cursor:pointer; list-style-type: none; display: inline-block; color: #F0F0F0;  font-size:20px; }
 .highlight, .selected { color:#F4B30A; }
 </style>
 <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.4.js"></script>
 <script>
 	function highlightStar(obj,id) {
 		removeHighlight(id);
 		$('#rate-'+id+' li').each(function(index) {
 			$(this).addClass('highlight');
 			if(index == $('#rate-'+id+' li').index(obj)) {
 				return false;
 			}
 		});
 	}

 	// event yang terjadi pada saat kita mengarahkan kursor kita ke sebuah object
 	function removeHighlight(id) {
 		$('#rate-'+id+' li').removeClass('selected');
 		$('#rate-'+id+' li').removeClass('highlight');
 	}

 	function addRating(obj,id) {
 		$('#rate-'+id+' li').each(function(index) {
 			$(this).addClass('selected');
 			$('#rate-'+id+' #rating').val((index+1));
 			if(index == $('#rate-'+id+' li').index(obj)) {
 				return false;
 			}
 		});
 		$.ajax({
 		url: "<?php echo base_url('member/tambah_rating'); ?>",
 		data:'id='+id+'&rating='+$('#rate-'+id+' #rating').val(),
 		type: "POST"
 		});
 	}

 	function resetRating(id) {
 		if($('#rate-'+id+' #rating').val() != 0) {
 			$('#rate-'+id+' li').each(function(index) {
 				$(this).addClass('selected');
 				if((index+1) == $('#rate-'+id+' #rating').val()) {
 					return false;
 				}
 			});
 		}
 	}

 	// saat mengarahkan kursor ke bintang maka bintang akan kuning
 	function highlightStar(obj,id) {
 		removeHighlight(id);
 		$('#rate-'+id+' li').each(function(index) {
 			$(this).addClass('highlight');
 			if(index == $('#rate-'+id+' li').index(obj)) {
 				return false;
 			}
 		});
 	}

 	// saat mengarahkan kursor ke bintang maka bintang akan transparant
 	function removeHighlight(id) {
 		$('#rate-'+id+' li').removeClass('selected');
 		$('#rate-'+id+' li').removeClass('highlight');
 	}

 	// Aksi untuk proses rating ke database di saat bintang diklik
 	function addRating(obj,id) {
 		$('#rate-'+id+' li').each(function(index) {
 			$(this).addClass('selected');
 			$('#rate-'+id+' #rating').val((index+1));
 			if(index == $('#rate-'+id+' li').index(obj)) {
 				return false;
 			}
 		});
 		$.ajax({
 		url: "<?php echo base_url('member/tambah_rating'); ?>",
 		data:'id='+id+'&rating='+$('#rate-'+id+' #rating').val(),
 		type: "POST"
 		});
 	}

 	// Ketika Kursor meninggalkan bintang maka kembali kepada keaadan awal
 	function resetRating(id) {
 		if($('#rate-'+id+' #rating').val() != 0) {
 			$('#rate-'+id+' li').each(function(index) {
 				$(this).addClass('selected');
 				if((index+1) == $('#rate-'+id+' #rating').val()) {
 					return false;
 				}
 			});
 		}
 	}
 </script>
</head>
<body >
    <?php
    $uri_1 = $this->uri->segment(1);
    $uri_2 = $this->uri->segment(2);
    if(isset($uri_1)){
      if($uri_1=='member'){
          if($uri_2!='welcome'){
        ?>
<nav class="navbar navbar-default bg-abu no-border" style="border-radius:0;">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
       <?php echo anchor('member/','<img src="'.base_url().'assets/img/logo.png" width=30 height=30 >',['class'=>'navbar-brand  padding']); ?> <span class=" navbar-brand">Music Tune</span>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="txt-shadow-none f-15 f-raleway">
          <?php echo anchor('member/','Home <span class="sr-only">(current)</span>'); ?>
				<li class="txt-shadow-none f-15 f-raleway"><?php echo anchor('member/genre','Genre <span class="sr-only">(current)</span>'); ?></li>
				<li class="txt-shadow-none f-15 f-raleway"><?php echo anchor('member/about','About <span class="sr-only">(current)</span>'); ?></li>
			</ul>
      <?php echo form_open('member/pencarian/',['method'=>'get','role'=>'search','class'=>'navbar-form navbar-left']) ?>
				<div class=" form-input-2 bg-gray pad-left bor-radius-50px pad-right">
					<input type="text" name="sch_member" class="form-control bg-transparan no-border" placeholder="Cari Lagu" style="border-radius:0;">
          <button type="submit" class="btn bg-transparan"><span class="glyphicon glyphicon-search"></span></button>
				</div>

			</form>
			<ul class="nav navbar-nav navbar-right">
				<li class="txt-shadow-none f-14 f-raleway"><a href=""><span class="glyphicon glyphicon-user"></span> <?php echo $this->session->userdata('nama'); ?></a></li>
				<li class="txt-shadow-none f-14 f-raleway"><?php echo anchor('member/logout','<span class="glyphicon glyphicon-log-out"></span> Logout') ?></li>
			</ul>
		</div>
	</div>
</nav>
        <?php
          }
      }elseif($uri_1=='general' || $uri_1==''){
          if($uri_2!='register' && $uri_2!='login' && $uri_2!='preference'){
        ?>
      <nav class="navbar navbar-default bg-putih no-border" style="border-radius:0;">
      	<div class="container">
      		<div class="navbar-header">
      			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
      				<span class="sr-only">Toggle navigation</span>
      				<span class="icon-bar"></span>
      				<span class="icon-bar"></span>
      				<span class="icon-bar"></span>
      			</button>
             <?php echo anchor('general/','<img src="'.base_url().'assets/img/logo.png" width=30 height=30 >',['class'=>'navbar-brand  padding']); ?> <span class=" navbar-brand">Music Tune</span>
      		</div>
      		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      			<ul class="nav navbar-nav">
      				<li class="f-15 f-raleway">
                <?php echo anchor('general/','Home <span class="sr-only">(current)</span>'); ?>
      				<li class="f-15 f-raleway"><?php echo anchor('general/genre','Genre <span class="sr-only">(current)</span>'); ?></li>
      				<li class="f-15 f-raleway"><?php echo anchor('general/about','About <span class="sr-only">(current)</span>'); ?></li>
      			</ul>
            <?php echo form_open('general/pencarian/',['method'=>'get','role'=>'search','class'=>'navbar-form navbar-left']) ?>
      				<div class=" form-input-2 bg-gray pad-left bor-radius-50px pad-right">
      					<input type="text" name="sch_general" class="form-control bg-transparan no-border" placeholder="Cari Lagu" style="border-radius:0;">
                <button type="submit" class="btn bg-transparan"><span class="glyphicon glyphicon-search"></span></button>
      				</div>

      			</form>
      			<ul class="nav navbar-nav navbar-right">
      				<li class="f-15 f-raleway"><?php echo anchor('general/register','<span class="glyphicon glyphicon-log-out"></span> Daftar') ?></li>
      				<li class="f-15 f-raleway"><?php echo anchor('general/login','<span class="glyphicon glyphicon-log-in"></span> Login') ?></li>
      			</ul>
      		</div>
      	</div>
      </nav>
        <?php
        }else{

        }
      }
    }
     ?>
    <?php echo $contens; ?>

    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/owl.carousel.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.raty.js"></script>
    <script>
    $( "#datepicker" ).datepicker({
    	inline: true
    });
    $(document).ready(function(){

				$('#mySlide1').carousel();

			});
      $(document).ready(function() {

  $("#owl-demo").owlCarousel({
    items : 4,
    lazyLoad : true,
    autoPlay : true,
    navigation : true,
  navigationText : ["",""],
  rewindNav : false,
  scrollPerPage : false,
  pagination : false,
  paginationNumbers: false,
  });

});

$(function(){
  //$('.div').raty();
  $('.div').raty({
    score: function() {
      return $(this).attr('data-score');
    }
  });

});
    </script>

</body>
</html>
