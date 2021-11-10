<?php if(!defined('BASEPATH')) exit ('no file allowed'); ?>
<div class="w-h-100 bg-img-login pos-fixed scroll-active">
  <div class="container pos-relative padding  mar-top-100">
    <div class="col-lg-offset-2 col-md-offset-2  col-lg-8 col-md-8 col-sm-12  col-xs-12 bg-putih padding bor-radius-3">
      <div class="rows">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 color-magenta  bor-color-magenta bor-bot-3 padding  text-center f-20">
            PREFERENCE<br>
            <span class="f-13">Berikan rating pada 5 lagu berikut</span>
        </div>
      </div>
      <div class="rows">
          <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 col-xs-12 padding">
            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 no-padding ">
              <img src="<?php echo base_url(); ?>/uploads/cover/1.png" class="img-responsive ">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                <audio id="player2" preload="none" controls style="max-width:100%;">
                    <source src="<?php echo base_url(); ?>/uploads/file/Adele - All I Ask.mp3" type="audio/mp3">
                </audio>
              </div>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12 mar-2 no-padding ">
              <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 col-xs-12 padding bor-left-solid-3 bor-color-magenta">
                <table class="table">
                  <tr>
                    <td>Judul</td>
                    <td>:</td>
                    <td><?php echo $data->title; ?></td>
                  </tr>
                  <tr>
                    <td>Nama Artis</td>
                    <td>:</td>
                    <td><?php echo $data->artist; ?></td>
                  </tr>
                  <tr>
                    <td>Genre</td>
                    <td>:</td>
                    <td><?php  echo $data->root_genre; ?></td>
                  </tr>
                  <tr>
                    <td colspan="3" class="bg-darkgray">
                      <?php echo"<div id='rate-$data->id' >
                    				<input type='hidden' name='rating' id='rating' value='$data->rate'>
                    					<ul  onMouseOut=\"resetRating($data->id)\">";
                    					  	for($i=1; $i<=5; $i++) {
                    						  if($i <= $data->rate){ $selected = "selected"; }else{ $selected = ""; }
                    					  		echo "<li  class='$selected' onmouseover=\"highlightStar(this,$data->id)\" onmouseout=\"removeHighlight($data->id);\" onClick=\"addRating(this,$data->id)\">&#9733;</li>";
                    					  	}
                    					echo "<ul>
                    				</div>" ?>
                    </td>
                  </tr>
                </table>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 col-xs-12 padding mar-top-10">
                <?php
                $uri_3 = $this->uri->segment(3);
                if($uri_3==''){
                  $uri_3 = 1;
                }else{
                  $uri_3 = $uri_3 + 1;
                }

                $uri = $this->uri->segment(3);
                if($uri=='' or $uri=='1' or $uri=='2' or $uri=='3'){
                  echo anchor('general/preference/'.$uri_3,'Lanjut',['class'=>'btn btn-primary form-control']);
                }elseif($uri=='4'){
                  echo anchor('member/logout_sec','Selesai',['class'=>'btn btn-primary form-control']);
                }
                  ?>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
