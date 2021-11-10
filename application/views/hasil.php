<div class="container padding" style="margin-top: 20px;">
<?php echo anchor('auth/home','HOME',['class'=>'btn btn-warning']); ?>
<blockquote  style="margin-top:20px;">Rekomendasi Untuk : <?php echo $this->session->userdata('username'); ?></blockquote>
<?php
foreach ($reslt->result() as $key) {
	?>
	<div class="col-lg-1" style="padding: 50px;"><div class="col-lg-12 bg-success" style="padding:20px;">
	<?php echo $key->amazon_id; ?>

	</div></div>
	<?php
}
 ?>
</div>