<div class="container-fluid  padding">
<?php if(!defined('BASEPATH')) exit ('no file allowed'); ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 no-padding">
          <blockquote class="bg-abu bg-magenta color-white ">Kelola Data Musik</blockquote>
      </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
      <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 padding right bg-abu bor-radius-50px">
          <?php
          echo form_open('admin/kelola_music/pencarian/',['method'=>'get']);
          ?>
          <div class="col-lg-1 col-md-1 col-sm-4  col-xs-4">
            <button type="submit" class="btn bg-transparan"><span class="glyphicon glyphicon-search"></span></button>
          </div>
          <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
            <?php
            $input = ['name'=>'sch_music','placeholder'=>'Cari Data','type'=>'search','class'=>'no-border bg-transparan no-box form-control'];
            echo form_input($input);
            ?>
          </div>
          <?php
          echo form_close();
           ?>
      </div>
    </div>
    <?php
    $uri_3 = $this->uri->segment(3);
    if($uri_3=='pencarian'){
      ?>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding mar-top-20">
        <blockquote class="f-15">Data Ditemukan : <?php echo $sumdata; ?></blockquote>
        <table class="table f-13 zebra-cross table-bordered">
          <tr>
            <th>NO</th>
            <th>ID</th>
            <th>Judul</th>
            <th>Artis</th>
            <th>Genre</th>
            <th>Tahun</th>
            <th>Label</th>
            <th>Cover</th>
            <th>Rating</th>
            <th width=200>Action</th>
          </tr>
          <?php
          $no=1;
          foreach ($record->result() as $row) {
            ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $row->amazon_id; ?></td>
              <td><?php echo $row->title; ?></td>
              <td><?php echo $row->artist; ?></td>
              <td><?php echo $row->root_genre; ?></td>
              <td><?php echo $row->first_release_year; ?></td>
              <td><?php echo $row->label; ?></td>
              <td><?php echo $row->imUrl; ?></td>
              <td><?php echo $row->rate; ?></td>
              <td>
                <a href="<?php echo base_url(); ?>admin/hapus_music/<?php echo $row->id; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Hapus</a> &nbsp;
                <?php
                echo anchor('admin/music_form/edit/'.$row->id,'<span class="glyphicon glyphicon-edit"></span> Edit',['class'=>'btn btn-warning']);?>
              </td>
            </tr>
            <?php
            $no++;
          }
           ?>
        </table>
        <?php
        echo anchor('admin/music_form/tambah_lagu','<span class="glyphicon glyphicon-plus"></span> &nbsp; Tambah Lagu',['class'=>'btn btn-primary']);
        echo"<br>";
        //echo $paging;
        ?>
      </div>
      <?php
    }else{
     ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding mar-top-20">
      <table class="table f-13 zebra-cross table-bordered">
        <tr>
          <th>NO</th>
          <th>ID</th>
          <th>Judul</th>
          <th>Artis</th>
          <th>Genre</th>
          <th>Tahun</th>
          <th>Label</th>
          <th>Cover</th>
          <th>Rating</th>
          <th width=200>Action</th>
        </tr>
        <?php
        $no=1+$this->uri->segment(3);
        foreach ($record->result() as $row) {
          ?>
          <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $row->amazon_id; ?></td>
            <td><?php echo $row->title; ?></td>
            <td><?php echo $row->artist; ?></td>
            <td><?php echo $row->root_genre; ?></td>
            <td><?php echo $row->first_release_year; ?></td>
            <td><?php echo $row->label; ?></td>
            <td><?php echo $row->imUrl; ?></td>
            <td><?php echo $row->rate; ?></td>
            <td>
              <a href="<?php echo base_url(); ?>admin/hapus_music/<?php echo $row->id; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Hapus</a> &nbsp;
              <?php
              echo anchor('admin/music_form/edit/'.$row->id,'<span class="glyphicon glyphicon-edit"></span> Edit',['class'=>'btn btn-warning']);?>
            </td>
          </tr>
          <?php
          $no++;
        }
         ?>
      </table>
      <?php
      echo anchor('admin/music_form/tambah_lagu','<span class="glyphicon glyphicon-plus"></span> &nbsp; Tambah Lagu',['class'=>'btn btn-primary']);
      echo"<br>".$paging;
      ?>
    </div>
    <?php
}
  ?>
</div>
