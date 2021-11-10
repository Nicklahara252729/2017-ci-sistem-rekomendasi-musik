<?php if(!defined('BASEPATH')) exit('no file allowed');?>
<div class="container-fluid padding bg-darkblue mar-top-min-20">
  <div class="container">
    <div class="rows">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 f-raleway bg-skyblue padding color-white bor-color-gray bor-left-solid-3">
          List Genre Musik
        </div>
      </div>
    </div>

    <div class="rows">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mar-top-20">
        <table class="table f-raleway f-14 zebra-cross ">
            <tr>
              <th width=50>No</th>
              <th>Genre</th>
              <th>Jumlah Musik</th>
              <th>option</tH>
            </tr>
            <?php
            $no =1;
            foreach ($data as $row ) {
              ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $row->root_genre; ?></td>
                <td><?php echo $row->jumlah_data; ?></td>
                <td><?php
                $key = $row->root_genre;
                $pisah = explode(" ",$key);
                 $sambung = $pisah[0];
                 echo anchor('general/genre_view/'.$sambung,'<span class="glyphicon glyphicon-folder-open"></span> &nbsp; view',['class'=>'btn btn-warning btn-sm']); ?></td>
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
