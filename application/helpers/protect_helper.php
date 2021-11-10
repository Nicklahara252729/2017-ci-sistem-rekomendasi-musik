<?php
if(!defined('BASEPATH')) exit('no file allowed');
function check_session(){
	$Ci =& get_instance();
	$session = $Ci->session->userdata('status_login');
	if($session!=TRUE){
		redirect(site_url('auth'));
	}
}

function check_session_login(){
	$Ci =& get_instance();
	$session = $Ci->session->userdata('status_login');
	$status = $Ci->session->userdata('status');

			redirect(site_url('auth/home'));
	
}
