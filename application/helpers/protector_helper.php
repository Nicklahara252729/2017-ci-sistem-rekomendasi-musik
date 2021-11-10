<?php
if(!defined('BASEPATH')) exit('no file allowed');
function check_session(){
	$Ci =& get_instance();
	$session = $Ci->session->userdata('status_login');
	if($session!=TRUE){
		redirect(site_url('general/login'));
	}
}

function check_session_login(){
	$Ci =& get_instance();
	$session = $Ci->session->userdata('status_login');
	$status = $Ci->session->userdata('status');
	if($session==TRUE){
		if($status=='member'){
				redirect(site_url('member/'));
		}elseif($status=='admin'){
				redirect(site_url('admin/'));
		}
	}
}
