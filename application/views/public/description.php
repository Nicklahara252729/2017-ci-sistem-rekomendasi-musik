<div class="w-h-100 pos-absolute scroll-active padding bg-darkblue mar-top-min-20">
  <div class="container mar-top-100">
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
              <tr>
                <td>Rates </td>
                <td>:</td>
                <td><?php echo $data->rate; ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
