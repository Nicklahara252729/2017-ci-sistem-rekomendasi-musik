<div class="container  padding">
<?php
if(!defined('BASEPATH')) exit ('no file allowed');
$uri_3 = $this->uri->segment(3);
$uri_4 = $this->uri->segment(4);
if($uri_3!=''){
  if($uri_3=='tambah_lagu'){
    $title = 'Tambah Data Lagu';
  }else{
    $title = 'Edit Data Lagu';
  }
?>

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
    <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 no-padding">
        <blockquote class="bg-abu bg-magenta color-white "><?php echo $title; ?></blockquote>
    </div>
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding bg-abu">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12  no-padding">
      <?php
      if($uri_3=='tambah_lagu'){
        echo form_open_multipart('admin/tambah_lagu');
        $inpt_1 = ['name'=>'judul_lagu','placeholder'=>'Judul Lagu','required'=>'required','class'=>'form-control'];
        $inpt_2 = ['name'=>'artis','placeholder'=>'Nama Artis','required'=>'required','class'=>'form-control'];
        $inpt_3 = ['name'=>'genre','placeholder'=>'Genre','required'=>'required','class'=>'form-control'];
        $inpt_4 = ['name'=>'tahun','placeholder'=>'Tahun','required'=>'required','class'=>'form-control'];
        $inpt_5 = ['name'=>'label','placeholder'=>'Label','required'=>'required','class'=>'form-control'];
      }else{
        echo form_open_multipart('admin/edit_lagu');
        $inpt_1 = ['name'=>'judul_lagu','placeholder'=>'Judul Lagu','required'=>'required','class'=>'form-control','value'=>$data->title];
        $inpt_2 = ['name'=>'artis','placeholder'=>'Nama Artis','required'=>'required','class'=>'form-control','value'=>$data->artist];
        $inpt_3 = ['name'=>'genre','placeholder'=>'Genre','required'=>'required','class'=>'form-control','value'=>$data->root_genre];
        $inpt_4 = ['name'=>'tahun','placeholder'=>'Tahun','required'=>'required','class'=>'form-control','value'=>$data->first_release_year];
        $inpt_5 = ['name'=>'label','placeholder'=>'Label','required'=>'required','class'=>'form-control','value'=>$data->label];
        $inpt_6 = ['name'=>'id','value'=>$data->id,'type'=>'hidden'];
        echo form_input($inpt_6);
      }
       ?>
      <div class="rows">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
          <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 no-padding">
            <blockquote class="f-15 bor-color-magenta ">Judul Lagu</blockquote>
          </div>
          <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
             <?php echo form_input($inpt_1); ?>
          </div>
        </div>
      </div>
      <div class="rows">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
          <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 no-padding">
            <blockquote class="f-15 bor-color-magenta ">Nama Artis</blockquote>
          </div>
          <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
             <?php echo form_input($inpt_2); ?>
          </div>
        </div>
      </div>
      <div class="rows">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
          <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 no-padding">
            <blockquote class="f-15 bor-color-magenta ">Genre</blockquote>
          </div>
          <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
             <?php echo form_input($inpt_3); ?>
          </div>
        </div>
      </div>
      <div class="rows">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
          <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 no-padding">
            <blockquote class="f-15 bor-color-magenta ">Tahun</blockquote>
          </div>
          <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
             <?php echo form_input($inpt_4); ?>
          </div>
        </div>
      </div>
      <div class="rows">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
          <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 no-padding">
            <blockquote class="f-15 bor-color-magenta ">Label</blockquote>
          </div>
          <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
             <?php echo form_input($inpt_5); ?>
          </div>
        </div>
      </div>
      <div class="rows">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
          <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 no-padding">
            <blockquote class="f-15 bor-color-magenta ">Cover</blockquote>
          </div>
          <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
              <label for="cover_buku" class="btn btn-warning mar-top-2"><span class="glyphicon glyphicon-picture"></span> &nbsp; Cover Buku</label>
              <input type="file" name="cover" id="cover_buku" class="hide">
          </div>
        </div>
      </div>
      <div class="rows">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
          <?php echo form_submit('enter_add_music','Submit',['class'=>'btn btn-primary col-lg-3 col-md-3 col-sm-12 col-xs-12 mar-2']); ?>
        </div>
      </div>
      <?php echo form_close(); ?>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12  padding">
      <div class="img-cover-add ">
        <img id="preview-image" src="#" alt=" " class="img-cover-prev">
      </div>
    </div>
  </div>
  <?php } ?>
</div>
