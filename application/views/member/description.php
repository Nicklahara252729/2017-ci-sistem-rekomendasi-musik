<div class="container-fluid padding bg-img-def mar-top-min-20">
  <div class="container">
    <div class="rows">
      <div class="col-lg-3 col-md-3 col-sm-5 col-xs-12 f-raleway bg-skyblue padding bor-color-white color-white bor-left-solid-3">
        <strong><?php echo $data->title; ?></strong>
      </div>
    </div>

    <div class="rows">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding mar-top-10">
        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-12 no-padding">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
            <img src="<?php echo base_url(); ?>/uploads/cover/1.png" class="img-responsive">
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding color-white">
            <div class="media-wrapper">
                <audio id="player2" preload="none" controls style="max-width:100%;">
                    <source src="<?php echo base_url(); ?>/uploads/file/Adele - All I Ask.mp3" type="audio/mp3">
                </audio>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding color-white">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <?php echo"<div id='rate-$data->id' >
                      <input type='hidden' name='rating' id='rating' value='$data->rate'>
                        <ul  onMouseOut=\"resetRating($data->id)\">";
                            for($i=1; $i<=5; $i++) {
                            if($i <= $data->rate){ $selected = "selected"; }else{ $selected = ""; }
                              echo "<li  class='$selected' onmouseover=\"highlightStar(this,$data->id)\" onmouseout=\"removeHighlight($data->id);\" onClick=\"addRating(this,$data->id)\">&#9733;</li>";
                            }
                        echo "<ul>
                      </div>";?>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad-top-5">
                <strong><?php echo $data->rate; ?></strong>
              </div>
          </div>
        </div>

        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding bg-abu bor-radius-3">
            <table class="table f-raleway">
              <tr>
                <td width=100>Judul</td>
                <td width=50>:</td>
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
                <td><?php echo $data->root_genre; ?></td>
              </tr>
              <tr>
                <td>Label</td>
                <td>:</td>
                <td><?php echo $data->label; ?></td>
              </tr>
              <tr>
                <td>Tahun </td>
                <td>:</td>
                <td><?php echo $data->first_release_year; ?></td>
              </tr>
              <tr>
                <td>Views </td>
                <td>:</td>
                <td><?php echo $data->view; ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container ">
  <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 f-raleway bg-skyblue mar-top-10 padding bor-color-gray color-white bor-left-solid-3">
    Rekomendasi Lagu
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding bg-putih bor-radius-3 mar-top-10">
    <div class="wrap">
    <div id="owl-demo" class="owl-carousel">
      <div class="item">
        <div class="cau_left">
          <img class="lazyOwl img-responsive" data-src="<?php echo base_url(); ?>/uploads/cover/1.png" alt="Lazy Owl Image">
        </div>
        <div class="cau_left mar-top-10">
          <blockquote class="f-15 f-raleway no-pad-top no-pad-bot pad-left-5 no-pad-right ">
          All I Ask<br>
          Adele<br>
          Country<br>
          4.5
        </blockquote>
        <div class="div"></div>
        </div>
      </div>
      <div class="item">
        <div class="cau_left">
          <img class="lazyOwl img-responsive" data-src="<?php echo base_url(); ?>/uploads/cover/2.png" alt="Lazy Owl Image">
        </div>
        <div class="cau_left mar-top-10">
          <blockquote class="f-15  f-raleway no-pad-top no-pad-bot pad-left-5 no-pad-right ">
          All I Ask<br>
          Adele<br>
          Country<br>
          4.5
        </blockquote>
        <div class="div"></div>
        </div>
      </div>
      <div class="item">
        <div class="cau_left">
          <img class="lazyOwl img-responsive" data-src="<?php echo base_url(); ?>/uploads/cover/3.png" alt="Lazy Owl Image">
        </div>
        <div class="cau_left mar-top-10">
          <blockquote class="f-15  f-raleway no-pad-top no-pad-bot pad-left-5 no-pad-right ">
          All I Ask<br>
          Adele<br>
          Country<br>
          4.5
        </blockquote>
        <div class="div"></div>
        </div>
      </div>
      <div class="item">
        <div class="cau_left">
          <img class="lazyOwl img-responsive" data-src="<?php echo base_url(); ?>/uploads/cover/4.png" alt="Lazy Owl Image">
        </div>
        <div class="cau_left mar-top-10">
          <blockquote class="f-15  f-raleway no-pad-top no-pad-bot pad-left-5 no-pad-right ">
          All I Ask<br>
          Adele<br>
          Country<br>
          4.5
        </blockquote>
        <div class="div"></div>
        </div>
      </div>
      <div class="item">
        <div class="cau_left">
          <img class="lazyOwl img-responsive" data-src="<?php echo base_url(); ?>/uploads/cover/1.png" alt="Lazy Owl Image">
        </div>
        <div class="cau_left mar-top-10">
          <blockquote class="f-15  f-raleway no-pad-top no-pad-bot pad-left-5 no-pad-right ">
          All I Ask<br>
          Adele<br>
          Country<br>
          4.5
        </blockquote>
        <div class="div"></div>
        </div>
      </div>
      <div class="item">
        <div class="cau_left">
          <img class="lazyOwl img-responsive" data-src="<?php echo base_url(); ?>/uploads/cover/2.png" alt="Lazy Owl Image">
        </div>
        <div class="cau_left mar-top-10">
          <blockquote class="f-15  f-raleway no-pad-top no-pad-bot pad-left-5 no-pad-right ">
          All I Ask<br>
          Adele<br>
          Country<br>
          4.5
        </blockquote>
        <div class="div"></div>
        </div>
      </div>
      <div class="item">
        <div class="cau_left">
          <img class="lazyOwl img-responsive" data-src="<?php echo base_url(); ?>/uploads/cover/3.png" alt="Lazy Owl Image">
        </div>
        <div class="cau_left mar-top-10">
          <blockquote class="f-15  f-raleway no-pad-top no-pad-bot pad-left-5 no-pad-right ">
          All I Ask<br>
          Adele<br>
          Country<br>
          4.5
        </blockquote>
        <div class="div"></div>
        </div>
      </div>
      <div class="item">
        <div class="cau_left">
          <img class="lazyOwl img-responsive" data-src="<?php echo base_url(); ?>/uploads/cover/4.png" alt="Lazy Owl Image">
        </div>
        <div class="cau_left mar-top-10">
          <blockquote class="f-15  f-raleway no-pad-top no-pad-bot pad-left-5 no-pad-right ">
          All I Ask<br>
          Adele<br>
          Country<br>
          4.5
        </blockquote>
        <div class="div"></div>
        </div>
      </div>
      <div class="item">
        <div class="cau_left">
          <img class="lazyOwl img-responsive" data-src="<?php echo base_url(); ?>/uploads/cover/1.png" alt="Lazy Owl Image">
        </div>
        <div class="cau_left mar-top-10">
          <blockquote class="f-15  f-raleway no-pad-top no-pad-bot pad-left-5 no-pad-right ">
          All I Ask<br>
          Adele<br>
          Country<br>
          4.5
        </blockquote>
        <div class="div"></div>
        </div>
      </div>
      <div class="item">
        <div class="cau_left">
          <img class="lazyOwl img-responsive" data-src="<?php echo base_url(); ?>/uploads/cover/2.png" alt="Lazy Owl Image">
        </div>
        <div class="cau_left mar-top-10">
          <blockquote class="f-15  f-raleway no-pad-top no-pad-bot pad-left-5 no-pad-right ">
          All I Ask<br>
          Adele<br>
          Country<br>
          4.5
        </blockquote>
        <div class="div"></div>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>
