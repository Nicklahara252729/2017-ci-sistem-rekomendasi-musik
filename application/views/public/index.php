<?php if(!defined('BASEPATH')) exit('no file allowed');
$uri1 = $this->uri->segment(1);
if($uri1=="general"){

}else{
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
}
?>

<?php
$uri_2 = $this->uri->segment(2);
if($uri_2==''){
  ?><!-- Tampilan Default Untuk Beranda Musik-->
  <div class="container-fluid padding bg-darkblue mar-top-min-20">
    <div class="container">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
        <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12 no-padding ">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 f-raleway bg-skyblue padding color-white bor-left-solid-3 mar-top-20">
              Lagu Baru
            </div>
          </div>
          <div class="rows">
            <?php
            foreach ($new_song as $rows) {
              ?>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad-left mar-top-10">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding ">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 no-padding hide-bg-abu color-white">
                    <?php
                    $img = substr($rows->imUrl,0,4);
                    if($img=='http'){
                        echo anchor('general/description/'.$rows->id,'<img src="'.$rows->imUrl.'" class="img-cover">');
                    }else{
                        echo anchor('general/description/'.$rows->id,'<img src="'.base_url().'/uploads/cover/'.$rows->imUrl.'" class="img-cover">');
                    }
                     ?>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 f-raleway f-13 no-padding color-white hide-bg-abu hide-bor-bot">
                    <p><strong><?php echo $rows->title; ?></strong></p>
                    <p><?php echo $rows->artist; ?></p>
                    <p><?php echo $rows->root_genre; ?> </p>
                    <p><?php echo $rows->first_release_year; ?> </p>
                    <p><?php echo $rows->rate; ?> </p>
                  </div>
                </div>
              </div>
              <?php
            }
             ?>

          </div>

          <?php echo anchor('general/lagu_baru','<div class="rows">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding color-white mar-top-10 text-center f-15">
              <div class="padding bor-dash-top bor-color-white col-lg-offset-4 col-md-offset-4 col-sm-offset-3 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                Tampilkan Lebih Banyak<br>
                <span  class="glyphicon glyphicon-chevron-down"></span>
              </div>
            </div>
          </div>'); ?>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 hide-bor-left-dash">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 f-raleway bg-skyblue padding color-white bor-left-solid-3 mar-top-20">
              Lagu Populer
            </div>
          </div>
          <div class="rows">
            <?php
            foreach ($popular_song as $rows) {
              ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding mar-top-10 ">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-padding">
                  <?php
                  $img = substr($rows->imUrl,0,4);
                  if($img=='http'){
                      echo anchor('general/description/'.$rows->id,'<img src="'.$rows->imUrl.'" class="img-cover">');
                  }else{
                      echo anchor('general/description/'.$rows->id,'<img src="'.base_url().'/uploads/cover/'.$rows->imUrl.'" class="img-cover">');
                  }
                   ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 f-raleway f-13 no-padding color-white hide-bg-gray hide-bor-bot">
                  <p><strong><?php echo $rows->title; ?></strong></p>
                  <p><?php echo $rows->artist; ?></p>
                  <p><?php echo $rows->root_genre; ?> </p>
                  <p><?php echo $rows->first_release_year; ?> </p>
                  <p><strong><?php echo $rows->rate; ?> </strong></p>
                </div>
            </div>
            <?php
          }
           ?>
          </div>

          <?php echo anchor('general/lagu_populer','<div class="rows">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding color-white mar-top-10 text-center f-15 bor-dash-top">
                Tampilkan Lebih Banyak<br>
                <span  class="glyphicon glyphicon-chevron-down"></span>
            </div>
          </div>'); ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}elseif($uri_2!=''){
  if($uri_2=='lagu_baru'){
    ?>
<!--- Tampilan Lebih Banyak Lagu Baru -->
<div class="container-fluid padding bg-darkblue mar-top-min-20">
  <div class="container">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 f-raleway bg-skyblue padding color-white bor-left-solid-3 mar-top-20">
            Lagu Baru
          </div>
        </div>
        <div class="rows">
          <?php
          foreach ($record_new_song->result() as $row ) {
            ?>
          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 no-pad-left mar-top-10">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding ">
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 no-padding hide-bg-abu ">
                <?php
                $img = substr($row->imUrl,0,4);
                if($img=='http'){
                    echo anchor('general/description/'.$row->id,'<img src="'.$row->imUrl.'" class="img-cover">');
                }else{
                    echo anchor('general/description/'.$row->id,'<img src="'.base_url().'/uploads/cover/'.$row->imUrl.'" class="img-cover">');
                }
                 ?>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 f-raleway f-13 no-padding color-white hide-bg-abu hide-bor-bot ">
                <p><strong><?php echo $row->title; ?></strong><br>
                  <?php echo $row->artist; ?><br>
                  <?php echo $row->root_genre; ?><br>
                  <?php echo $row->first_release_year; ?><br>
                  <?php echo $row->rate; ?></p>
              </div>
            </div>
          </div>
          <?php
        }
           ?>
        </div>

        <div class="rows">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding color-white mar-top-10 text-center f-15 f-raleway">
            <?php echo $paging; ?>
          </div>
        </div>
    </div>
  </div>
</div>
<?php
  }elseif($uri_2=='lagu_populer'){
    ?>
<!---  Tampilan Lebih Banyak Lagu Populer -->
<div class="container-fluid padding bg-darkblue mar-top-min-20">
  <div class="container">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 f-raleway bg-skyblue padding color-white bor-left-solid-3 mar-top-20">
            Lagu Populer
          </div>
        </div>
        <div class="rows">
          <?php
          foreach ($popular as $row ) {
            ?>

          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 no-pad-left mar-top-10">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding ">
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 no-padding hide-bg-abu ">
                <?php
                $img = substr($row->imUrl,0,4);
                if($img=='http'){
                    echo anchor('general/description/'.$row->id,'<img src="'.$row->imUrl.'" class="img-cover">');
                }else{
                    echo anchor('general/description/'.$row->id,'<img src="'.base_url().'/uploads/cover/'.$row->imUrl.'" class="img-cover">');
                }
                 ?>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 f-raleway f-13 no-padding color-white hide-bg-abu hide-bor-bot">
                <p ><strong><?php echo $row->title; ?></strong>
                <br><?php echo $row->artist; ?>
                <br><?php echo $row->root_genre; ?>
                <br><?php echo $row->first_release_year; ?>
                <br><?php echo $row->rate; ?></p>
              </div>
            </div>
          </div>
          <?php
        }
         ?>
        </div>

    </div>
  </div>
</div>
<?php
  }elseif($uri_2=='pencarian'){
    ?>
<!-- Tampilan Hasil Pencarian Untuk Musik -->
<div class="container-fluid padding bg-darkblue mar-top-min-20">
  <div class="container">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 f-raleway bg-skyblue padding color-white bor-left-solid-3 mar-top-20">
            Hasil Pencarian : <?php echo $sumdata; ?>
          </div>
        </div>
        <div class="rows">
          <?php
          foreach ($record->result() as $row) {
            ?>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 no-pad-left mar-top-10">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding ">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 no-padding hide-bg-abu ">
                  <?php
                  $img = substr($row->imUrl,0,4);
                  if($img=='http'){
                      echo anchor('general/description/'.$row->id,'<img src="'.$row->imUrl.'" class="img-cover">');
                  }else{
                      echo anchor('general/description/'.$row->id,'<img src="'.base_url().'/uploads/cover/'.$row->imUrl.'" class="img-cover">');
                  }
                   ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 f-raleway f-13 no-padding color-white hide-bg-abu hide-bor-bot">
                  <p><strong><?php echo $row->title; ?></strong><br>
                  <?php echo $row->artist; ?><br>
                  <?php echo $row->root_genre; ?><br>
                  <?php echo $row->first_release_year; ?><br><?php echo $row->rate; ?> </p>

                </div>
              </div>
            </div>
            <?php
          }
           ?>

        </div>
    </div>
  </div>
</div>
<?php
  }
}
?>
