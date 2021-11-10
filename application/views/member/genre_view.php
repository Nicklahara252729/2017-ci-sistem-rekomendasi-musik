<?php if(!defined('BASEPATH')) exit('no file allowed');?>
<div class="container-fluid padding bg-darkblue mar-top-min-20">
  <div class="container">
    <div class="rows">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 f-raleway bg-skyblue padding color-white bor-color-gray bor-left-solid-3">
          <?php echo $root->root_genre." : "; echo $num; ?>
        </div>
      </div>
    </div>

    <div class="rows">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mar-top-20">
        <table class="table f-raleway f-14 zebra-cross ">
            <tr>
              <th width=50>No</th>
              <th>Judul</th>
              <th >Artis</th>
              <th width=150>Genre</th>
              <th>Rating</th>
              <th width=100>Play</th>
            </tr>
            <?php
            $no =1;
            foreach ($data as $row ) {
              ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $row->title; ?></td>
                <td><?php echo $row->artist; ?></td>
                <td><?php echo $row->root_genre; ?></td>
                <td><?php echo $row->rate; ?></td>
                <td><?php echo anchor('member/description/'.$row->id,'<span class="glyphicon glyphicon-music"></span> Play',['class'=>'btn btn-success']); ?></td>
              </tr>
              <?php
              $no++;
            }
             ?>
        <table>
      </div>
    </div>
  </div>
</div>