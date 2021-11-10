<?php if(!defined('BASEPATH')) exit ('no file allowed'); ?>
<div class="container" style="margin-top:20px;">
<div class="col-lg-offset-4 col-lg-4" style="border-radius: 3px;border: solid 1px lightgray;padding:10px;">
	<?php
		echo form_open('auth/login');
		$inpt = ['name'=>'username','class'=>'form-control','placeholder'=>'Username'];
		$inpt2 = ['name'=>'password','class'=>'form-control','placeholder'=>'Password','style'=>'margin-top:10px'];
		echo form_input($inpt);
		echo form_password($inpt2);
		echo form_submit('enter','login',['class'=>'btn btn-primary form-control','style'=>'margin-top:10px']);
		echo form_close();
	?>
</div>
</div>
