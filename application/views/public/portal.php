<?php if(!defined('BASEPATH')) exit ('no file allowed');
$uri_2 = $this->uri->segment(2);
if(isset($uri_2)){
  if($uri_2=='login'){
    $offset = 'col-lg-offset-2 col-md-offset-2';
  }else{
    $offset = 'col-lg-offset-1 col-md-offset-1';
  }
}
?>
<div class="w-h-100 bg-img-login pos-fixed scroll-active">
  <div class="container pos-relative padding ">
      <div class="rows">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  padding">
              <?php
              $uri_2 = $this->uri->segment(2);
              if(isset($uri_2)){
                if($uri_2=='login'){
                  ?>
                  <div class="col-lg-offset-3 col-lg-6 col-md-4 col-sm-6 col-xs-12 mar-2">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding bg-putih bor-radius-3">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding bor-dash-bot bor-color-gray">
                            <img src="<?php echo base_url(); ?>/assets/img/logo.png" class="w-h-px-150">
                            <span class="f-50 f-raleway">MUSIC TUNE</span>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding bg-abu">
                          <img src="<?php echo base_url(); ?>/assets/img/title-login.png" class="img-responsive mar-center">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding  bg-abu  form_input">
                            <?php
                            echo form_open('general/process_login');
                            $inpt_1 = ['name'=>'username_login','placeholder'=>'Username','required'=>'required','class'=>'form-control ','value'=>get_cookie('username')];
                            $inpt_2 = ['name'=>'password_login','placeholder'=>'Password','required'=>'required','class'=>'form-control ','value'=>get_cookie('password')];
                            $inpt_3 = ['name'=>'remember'];
                             ?>
                             <div class="rows">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                 <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 padding f-15 ">
                                   Username
                                 </div>
                                 <div class="col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-lg-9 col-md-9 col-sm-8 col-xs-12 no-pad mar-1">
                                    <?php echo form_input($inpt_1); ?>
                                 </div>
                               </div>
                             </div>
                             <div class="rows">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding mar-top-10">
                                 <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 padding f-15 ">
                                   Password
                                 </div>
                                 <div class="col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-lg-9 col-md-9 col-sm-8 col-xs-12 no-pad mar-1">
                                    <?php echo form_password($inpt_2); ?>
                                 </div>
                               </div>
                             </div>
                             <div class="rows">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad-left mar-top-10">
                                 <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-4 col-xs-offset-0 col-lg-9 col-md-9 col-sm-8 col-xs-12 no-pad-right no-pad mar-1">
                                    <?php echo form_checkbox($inpt_3); ?> &nbsp; Remeber Me
                                    <?php echo form_submit('enter_login','Login',['class'=>'btn bg-primary right float-right']); ?>
                                  </div>
                               </div>
                             </div>
                             <div class="rows">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad-left ">
                                  <?php echo anchor('general/','<span class="glyphicon glyphicon-home"></span>',['class'=>'btn btn-warning btn-xs  ']);  ?>  | Belum punya akun ? <?php echo anchor('general/register','Buat Akun'); ?>
                               </div>
                             </div>
                        </div>
                      </div>
                  </div>
                  <?php
                }else{
                  $offset = 'col-lg-offset-1 col-md-offset-1';
                  ?>
                  <div class="col-lg-offset-3 col-lg-6 col-md-4 col-sm-6 col-xs-12 mar-2 ">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding bg-putih bor-radius-3">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding bor-dash-bot bor-color-gray">
                            <img src="<?php echo base_url(); ?>/assets/img/logo.png" class="w-h-px-150">
                            <span class="f-50 f-raleway">MUSIC TUNE</span>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding bg-abu">
                          <img src="<?php echo base_url(); ?>/assets/img/register.png" class="img-responsive mar-center">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding form-input bg-abu">
                            <?php
                            echo form_open('general/process_register');
                            $inpt_1 = ['name'=>'nama','placeholder'=>'Nama Lengkap','required'=>'required','class'=>'form-control'];
                            $inpt_2 = ['name'=>'username','placeholder'=>'Username','required'=>'required','class'=>'form-control'];
                            $inpt_3 = ['name'=>'email','placeholder'=>'Email','required'=>'required','class'=>'form-control'];
                            $inpt_4 = ['name'=>'password','placeholder'=>'Password','required'=>'required','class'=>'form-control'];
                            $inpt_6 = ['name'=>'tgl_lahir','placeholder'=>'DD-MM-YYYY','id'=>'datepicker','required'=>'required','class'=>'form-control'];
                             ?>
                             <div class="rows">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 padding f-15 text-right">
                                   Nama Lengkap
                                 </div>
                                 <div class=" col-lg-8 col-md-8 col-sm-8 col-xs-12 no-pad mar-1 ">
                                    <?php echo form_input($inpt_1); ?>
                                 </div>
                               </div>
                             </div>
                             <div class="rows">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding mar-top-10">
                                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 padding f-15 text-right">
                                   Username
                                 </div>
                                 <div class=" col-lg-8 col-md-8 col-sm-8 col-xs-12 no-pad mar-1">
                                    <?php echo form_input($inpt_2); ?>
                                 </div>
                               </div>
                             </div>
                             <div class="rows">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding mar-top-10">
                                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 padding f-15 text-right">
                                   Email
                                 </div>
                                 <div class=" col-lg-8 col-md-8 col-sm-8 col-xs-12 no-pad mar-1">
                                    <?php echo form_input($inpt_3); ?>
                                 </div>
                               </div>
                             </div>
                             <div class="rows">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding mar-top-10">
                                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 padding f-15 text-right">
                                   Password
                                 </div>
                                 <div class=" col-lg-8 col-md-8 col-sm-8 col-xs-12 no-pad mar-1">
                                    <?php echo form_password($inpt_4); ?>
                                 </div>
                               </div>
                             </div>
                             <div class="rows">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding mar-top-10">
                                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 padding f-15 text-right">
                                   Gender
                                 </div>
                                 <div class=" col-lg-8 col-md-8 col-sm-8 col-xs-12 no-pad mar-1 color-gray">
                                    <select name="gender" class="form-control">
                                      <option disabled selected >- Pilih Salah Satu -</option>
                                      <option value="laki - laki"> Laki - laki</option>
                                      <option value="perempuan">Perempuan</option>
                                    </select>
                                 </div>
                               </div>
                             </div>
                             <div class="rows">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding mar-top-10">
                                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 padding f-15 text-right">
                                   Tanggal Lahir
                                 </div>
                                 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 no-pad mar-1">
                                    <?php echo form_input($inpt_6); ?>
                                 </div>
                               </div>
                             </div>
                             <div class="rows">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad-left mar-top-10">
                                 <?php echo anchor('general/','<span class="glyphicon glyphicon-home"></span>',['class'=>'btn btn-warning btn-xs']);  ?>
                                    | Sudah punya akun ?
                                    <?php
                                      echo anchor('general/login','Login');

                                     echo form_submit('enter_register','Daftar',['class'=>'btn bg-primary right']);
                                      ?>
                               </div>
                             </div>
                        </div>
                      </div>
                  </div>
                  <?php
                }
              }
               ?>

          </div>
      </div>
  </div>
</div>
