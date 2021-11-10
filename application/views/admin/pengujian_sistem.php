<script type="text/javascript">
function cek(){
	var pass = document.getElementById("inpt").value;
	hasil = pass %2 ;
	if (hasil == 0){
		document.getElementById("msgfoto").style="color:red;";
		document.getElementById("msgfoto").innerHTML="Angka Harus Ganjil";
		document.getElementById("inpt").focus();
		document.getElementById("submit").style="display:none";
		document.getElementById("submi").style="display:block";
		return false;
	}else{
		document.getElementById("msgfoto").style="color:#0000ff;";
		document.getElementById("msgfoto").innerHTML=" ";
		document.getElementById("submit").style="display:block";
		document.getElementById("submi").style="display:none";
	}
	return true;

}
</script>
<?php if(!defined('BASEPATH')) exit ('no file allowed'); ?>
<div class="container padding">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
    <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 no-padding">
        <blockquote class="bg-abu bg-magenta color-white ">Pengujian Sistem</blockquote>
    </div>
  </div>
    <?php echo anchor('admin/recommendation','Make Recommendation',['class'=>'btn btn-warning mar-bot-20']); ?>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding ">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12  padding bg-abu">
      <?php
      echo form_open_multipart('admin/pengujian_sistem');
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
      <?php if(isset($sum_satu)){ ?>
    <table class="table  f-15 zebra-cross table-bordered">
      <tr>
        <th>Top N</th>
        <th>Hit Rate Length</th>
        <th>Coverage Length</th>
      </tr>
      <tr>
        <td>10</td>
        <td><?php echo $hsum_satu; ?>%</td>
        <td><?php echo $sum_satu; ?>%</td>
      </tr>
      <tr>
        <td>30</td>
        <td><?php echo $hsum_tiga; ?>%</td>
        <td><?php echo $sum_satu; ?>%</td>
      </tr>
        <tr>
        <td>50</td>
        <td><?php echo $hsum_lima; ?>%</td>
        <td><?php echo $sum_satu; ?>%</td>
      </tr>
        <tr>
        <td>70</td>
        <td><?php echo $hsum_tujuh; ?>%</td>
        <td><?php echo $sum_satu; ?>%</td>
      </tr>
        <tr>
        <td>100</td>
        <td><?php echo $hsum_sepuluh; ?>%</td>
        <td><?php echo $sum_satu; ?>%</td>
      </tr>
    </table>
      <?php }else{
    ?><table class="table  f-15 zebra-cross table-bordered">
      <tr>
        <th>Top N</th>
        <th>Hit Rate Length</th>
        <th>Coverage Length</th>
      </tr>
      <tr>
        <td>10</td>
        <td>0%</td>
        <td>0%</td>
      </tr>
      <tr>
        <td>30</td>
        <td>0%</td>
        <td>0%</td>
      </tr>
        <tr>
        <td>50</td>
        <td>0%</td>
        <td>0%</td>
      </tr>
        <tr>
        <td>70</td>
        <td>0%</td>
        <td>0%</td>
      </tr>
        <tr>
        <td>100</td>
        <td>0%</td>
        <td>0%</td>
      </tr>
    </table>
      <?php
}?>
  </div>
</div>
