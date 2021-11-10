<?php
if(!defined('BASEPATH')) exit('no file allowed');
class Theme{
  var $n_theme_data = array();
  function set($n_name, $n_value){
    $this->n_theme_data[$n_name] = $n_value;
  }

  function load($n_theme = '', $n_view = '', $n_view_data = array(), $n_return = FALSE){
    $this->CI =& get_instance();
    $this->set('n_contents',$this->CI->load->view($n_view,$n_view_data,TRUE));
    return $this->CI->load->view($n_theme, $this->n_theme_data, $n_return);
  }
}
