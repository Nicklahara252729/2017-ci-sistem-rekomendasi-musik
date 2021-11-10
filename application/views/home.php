<?php if(!defined('BASEPATH')) exit ('no file allowed'); ?>
<div class="container" style="margin-top:50px;">
	<div class="col-lg-offset-3 col-lg-6">
		<div class="col-lg-6" style="padding:10px;">
			<?php
			echo anchor('auth/new_recom_empat','<div class="col-lg-12 bg-primary" style="border-radius: 5px; padding: 20px;text-align: center;">Hasil Rekomendasi</div>'); ?>
		</div>
		<div class="col-lg-6" style="padding:10px;">
			<?php
			echo anchor('auth/ops','<div class="col-lg-12 bg-primary" style="border-radius: 5px; padding: 20px;text-align: center;">Pengujian Sistem</div>'); ?>
		</div>
		<div class="col-lg-6" style="padding:10px;">
			<?php
			echo anchor('auth/logout','<div class="col-lg-12 bg-primary" style="border-radius: 5px; padding: 20px;text-align: center;">LOGOUT</div>'); ?>
		</div>
	</div>
</div>