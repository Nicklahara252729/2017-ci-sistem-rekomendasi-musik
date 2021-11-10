<?php if(!defined('BASEPATH')) exit('no file allowed');
$uri_2 = $this->uri->segment(2);
if($uri_2==''){
  ?><!-- Tampilan Default Untuk Beranda Musik-->
  <div class="container mar-bot-50">
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 f-raleway bg-skyblue padding color-white bor-color-gray bor-left-solid-3">
      Rekomendasi Lagu
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding bg-putih bor-radius-3 mar-top-10">
      <div class="wrap">
      <div id="owl-demo" class="owl-carousel">
        <?php
        foreach ($recom as $row) {
         ?>
        <div class="item">
          <div class="cau_left">
            <img class="lazyOwl img-responsive" data-src="<?php echo $row->imUrl ?>" alt="Lazy Owl Image">
          </div>
          <div class="cau_left mar-top-10">
            <blockquote class="f-15 f-raleway no-pad-top no-pad-bot pad-left-5 no-pad-right ">
            <?php echo $row->title; ?><br>
            <?php echo $row->artist; ?><br>
            <?php echo $row->root_genre; ?><br>
            <?php echo $row->rate; ?>
          </blockquote>
          <div class="div"></div>
          </div>
        </div>
        <?php
      }
          ?>
      </div>
    </div>
    </div>
  </div>
  <div class="container-fluid padding bg-darkblue ">
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
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 no-padding hide-bg-abu bntg">
                    <?php

                    $img = substr($rows->imUrl,0,4);
                    if($img=='http'){
                        echo anchor('member/description/'.$rows->id,'<img src="'.$rows->imUrl.'" class="img-cover">');
                    }else{
                        echo anchor('member/description/'.$rows->id,'<img src="'.base_url().'/uploads/cover/'.$rows->imUrl.'" class="img-cover">');
                    }
                    echo"<div id='rate-$rows->id' >
                  				<input type='hidden' name='rating' id='rating' value='$rows->rate'>
                  					<ul  onMouseOut=\"resetRating($rows->id)\">";
                  					  	for($i=1; $i<=5; $i++) {
                  						  if($i <= $rows->rate){ $selected = "selected"; }else{ $selected = ""; }
                  					  		echo "<li  class='$selected' onmouseover=\"highlightStar(this,$rows->id)\" onmouseout=\"removeHighlight($rows->id);\" onClick=\"addRating(this,$rows->id)\">&#9733;</li>";
                  					  	}
                  					echo "<ul>
                  				</div>"
                    ?>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 f-raleway f-13 no-padding color-white hide-bg-abu hide-bor-bot">
                    <p><strong><?php echo $rows->title; ?></strong></p>
                    <p><?php echo $rows->artist; ?></p>
                    <p><?php echo $rows->root_genre; ?> </p>
                    <p><?php echo $rows->first_release_year; ?> </p>
                    <p><?php echo $rows->rate; ?></p>
                  </div>
                </div>
              </div>
              <?php
            }
             ?>

          </div>

          <?php echo anchor('member/lagu_baru','<div class="rows">
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
                      echo anchor('member/description/'.$rows->id,'<img src="'.$rows->imUrl.'" class="img-cover">');
                  }else{
                      echo anchor('member/description/'.$rows->id,'<img src="'.base_url().'/uploads/cover/'.$rows->imUrl.'" class="img-cover">');
                  }
                   ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 f-raleway f-13 no-padding color-white hide-bg-gray hide-bor-bot">
                  <p><strong><?php echo $rows->title; ?></strong><br>
                  <?php echo $rows->artist; ?><br>
                  <?php echo $rows->root_genre; ?><br>
                  <?php echo $rows->first_release_year; ?><br>
                  <strong><?php echo $rows->rate; ?></strong><?php echo"<div id='rate-$rows->id' >
                  				<input type='hidden' name='rating' id='rating' value='$rows->rate'>
                  					<ul  onMouseOut=\"resetRating($rows->id)\">";
                  					  	for($i=1; $i<=5; $i++) {
                  						  if($i <= $rows->rate){ $selected = "selected"; }else{ $selected = ""; }
                  					  		echo "<li  class='$selected' onmouseover=\"highlightStar(this,$rows->id)\" onmouseout=\"removeHighlight($rows->id);\" onClick=\"addRating(this,$rows->id)\">&#9733;</li>";
                  					  	}
                  					echo "<ul>
                  				</div>";?></p>
                </div>
            </div>
            <?php
          }
           ?>
          </div>

          <?php echo anchor('member/lagu_populer','<div class="rows">
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
                    echo anchor('member/description/'.$row->id,'<img src="'.$row->imUrl.'" class="img-cover">');
                }else{
                    echo anchor('member/description/'.$row->id,'<img src="'.base_url().'/uploads/cover/'.$row->imUrl.'" class="img-cover">');
                }
                 ?>
                <p>
                  <?php echo"<div id='rate-$row->id' >
                  				<input type='hidden' name='rating' id='rating' value='$row->rate'>
                  					<ul  onMouseOut=\"resetRating($row->id)\">";
                  					  	for($i=1; $i<=5; $i++) {
                  						  if($i <= $row->rate){ $selected = "selected"; }else{ $selected = ""; }
                  					  		echo "<li  class='$selected' onmouseover=\"highlightStar(this,$row->id)\" onmouseout=\"removeHighlight($row->id);\" onClick=\"addRating(this,$row->id)\">&#9733;</li>";
                  					  	}
                  					echo "<ul>
                  				</div>";?>
                </p>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 f-raleway f-13 no-padding color-white hide-bg-abu hide-bor-bot">
                <p ><strong><?php echo $row->title; ?></strong></p>
                <p ><?php echo $row->artist; ?></p>
                <p ><?php echo $row->root_genre; ?> </p>
                <p ><?php echo $row->first_release_year; ?> </p>
                <p ><?php echo $row->rate; ?></p>
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
                    echo anchor('member/description/'.$row->id,'<img src="'.$row->imUrl.'" class="img-cover">');
                }else{
                    echo anchor('member/description/'.$row->id,'<img src="'.base_url().'/uploads/cover/'.$row->imUrl.'" class="img-cover">');
                }
                 ?>
                <p>
                  <?php echo"<div id='rate-$row->id' >
                  				<input type='hidden' name='rating' id='rating' value='$row->rate'>
                  					<ul  onMouseOut=\"resetRating($row->id)\">";
                  					  	for($i=1; $i<=5; $i++) {
                  						  if($i <= $row->rate){ $selected = "selected"; }else{ $selected = ""; }
                  					  		echo "<li  class='$selected' onmouseover=\"highlightStar(this,$row->id)\" onmouseout=\"removeHighlight($row->id);\" onClick=\"addRating(this,$row->id)\">&#9733;</li>";
                  					  	}
                  					echo "<ul>
                  				</div>";?>
                </p>
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
                      echo anchor('member/description/'.$row->id,'<img src="'.$row->imUrl.'" class="img-cover">');
                  }else{
                      echo anchor('member/description/'.$row->id,'<img src="'.base_url().'/uploads/cover/'.$row->imUrl.'" class="img-cover">');
                  }
                   ?>
                  <p>
                    <?php echo"<div id='rate-$row->id' >
                    				<input type='hidden' name='rating' id='rating' value='$row->rate'>
                    					<ul  onMouseOut=\"resetRating($row->id)\">";
                    					  	for($i=1; $i<=5; $i++) {
                    						  if($i <= $row->rate){ $selected = "selected"; }else{ $selected = ""; }
                    					  		echo "<li  class='$selected' onmouseover=\"highlightStar(this,$row->id)\" onmouseout=\"removeHighlight($row->id);\" onClick=\"addRating(this,$row->id)\">&#9733;</li>";
                    					  	}
                    					echo "<ul>
                    				</div>";?>
                  </p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 f-raleway f-13 no-padding color-white hide-bg-abu hide-bor-bot">
                  <p ><strong><?php echo $row->title; ?></strong>
                    <br><?php echo $row->artist; ?>
                    <br><?php echo $row->root_genre; ?>
                    <br><?php echo $row->first_release_year; ?>
                    <br><?php echo $row->rate; ?>
                  </p>

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
