
<?php if(!defined('BASEPATH')) exit ('no file allowed'); ?>
<div class="container padding">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
    <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 no-padding">
        <blockquote class="bg-abu bg-magenta color-white ">Pengujian Sistem</blockquote>
    </div>
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding ">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12  padding bg-abu">
      <?php
      echo form_open_multipart('admin/sistem_test');
       ?>
      <div class="rows">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 no-padding">
            <blockquote class="f-15 bor-color-magenta ">CORLP Length</blockquote>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
		  <input type="text" name="lenght" id="inpt" placeholder="Lenght" required onBlur="cek();" onFocus="cek();" class="form-control">
		  <div id="msgfoto"></div>
          </div>
        </div>
      </div>
      <div class="rows">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
		<input type="submit" id="submit" name="enter_add_music" value="Submit" style="display:block;" class="btn btn-primary col-lg-3 col-md-3 col-sm-12 col-xs-12 mar-2">
		<input type="submit" id="submi" name="enter_add_music" value="Submit" style="display:none;" disabled class="btn btn-primary col-lg-3 col-md-3 col-sm-12 col-xs-12 mar-2">
        </div>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding mar-top-20">
    <table class="table  f-15 zebra-cross">
      <tr>
        <th>Top N</th>
        <th>Hit Rate Length</th>
        <th>Coverage Length</th>
      </tr>
      <tr>
        <td>10</td>
        <td>35%</td>
        <td>33%</td>
      </tr>
      <tr>
        <td>20</td>
        <td>36%</td>
        <td>41%</td>
      </tr>
    </table>
  </div>
</div>
