<?php if(!defined('BASEPATH')) exit ('no file allowed'); ?>
<div class="w-h-100 no-padding bg-img-wel pos-absolute">
    <div class="container padding  mar-top-20">
        <div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-3  col-lg-4 col-md-4 col-sm-6 col-xs-12 padding">
            <img src="<?php echo base_url(); ?>assets/img/default-user.png" class="img-responsive">
            <p class="bg-putih padding text-center f-raleway mar-top-20 bor-radius-3 f-20">Hi.. <?php echo $this->session->userdata('nama');?></p>
            <p class="padding text-center f-raleway mar-top-20 f-20">
                <?php echo anchor('member/','Have Fun',['class'=>'btn btn-warning padding h-40 form-control']); ?>
            </p>
        </div>
    </div>
</div>