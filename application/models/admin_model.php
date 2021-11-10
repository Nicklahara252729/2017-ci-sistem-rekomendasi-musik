<?php
if(!defined('BASEPATH')) exit('no file allowed');
class Admin_model extends CI_Model{
  function __construct(){
    parent::__construct();
  }

  public function akun(){
    return $this->db->get('user');
  }

  public function cari_akun($keyword){
    $query = "select * from user where Nama_user like '%$keyword%' or Username like '%$keyword%' or Email like '%$keyword%'";
    return $this->db->query($query);
  }

  public function akun_paging($page,$batas){
    $keyword= $this->uri->segment(4);
    $query = "select * from user where Nama_user like '%$keyword%' or Username like '%$keyword%' or Email like '%$keyword%' limit $page,$batas";
    return $this->db->query($query);
  }

  public function hapus_akun($id){
    $checking = $this->db->delete('user',['reviewerID'=>$id]);
    if($checking){
      return TRUE;
    }else{
      return FALSE;
    }
  }

  public function music(){
    return $this->db->from('metadata')
                    ->get();
  }

  public function cari_music($keyword){
    $query = "select * from metadata where title like '%$keyword%' or artist like '%$keyword%' or root_genre like '%$keyword%' or first_release_year like '%$keyword%' or label like '%$keyword%'";
    return $this->db->query($query);
  }

  public function music_paging($page,$batas){
    $keyword= $this->uri->segment(4);
    $query = "select * from metadata where title like '%$keyword%' or artist like '%$keyword%' or root_genre like '%$keyword%' or first_release_year like '%$keyword%' or label like '%$keyword%' order by id desc limit $page,$batas";
    return $this->db->query($query);
  }

  public function add_music($judul,$artis,$genre,$tahun,$label,$name_img){
    $text="ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $panjangText= strlen($text);
    $hasil="";
    for($i=0;$i<=2;$i++){
    	$hasil = trim($hasil).substr($text,mt_rand(0,$panjangText),1);
    }
    $n_check = $this->db->insert('metadata',['amazon_id'=>'B000000'.$hasil,'title'=>$judul,'artist'=>$artis,'root_genre'=>$genre,'Label'=>$label,'first_release_year'=>$tahun,'imUrl'=>$name_img,'rate'=>'0']);
    if($n_check){
      return TRUE;
    }else{
      return FALSE;
    }
  }

  public function take_music($uri_id){
    return $this->db->get_where('metadata',['id'=>$uri_id]);
  }

  public function hps_music($id){
    $n_cord = $this->db->get_where('metadata',['id'=>$id])->row();
    $n_do = $this->db->delete('metadata',['id'=>$id]);
    $n_pic = $n_cord->imUrl;
    if($n_do){
      return TRUE;
    }else{
      return FALSE;
    }
  }

  public function selected_music($uri_4){
    return $this->db->get_where('metadata',['id'=>$uri_4]);
  }

  public function get_cover($id){
    return $this->db->get_where('metadata',['id'=>$id]);
  }

  public function update_music($judul,$artis,$genre,$tahun,$label,$name_cover,$id){
    $n_check = $this->db->where('id',$id)
                        ->update('metadata',['title'=>$judul,'artist'=>$artis,'root_genre'=>$genre,'label'=>$label,'first_release_year'=>$tahun,'imUrl'=>$name_cover]);
    if($n_check){
      return TRUE;
    }else{
      return FALSE;
    }
  }

  public function update_music_sec($judul,$artis,$genre,$tahun,$label,$id){
    $n_check = $this->db->where('id',$id)
                        ->update('metadata',['title'=>$judul,'artist'=>$artis,'root_genre'=>$genre,'label'=>$label,'first_release_year'=>$tahun]);
    if($n_check){
      return TRUE;
    }else{
      return FALSE;
    }
  }

}
