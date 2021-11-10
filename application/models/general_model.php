<?php
if(!defined('BASEPATH')) exit('no file allowed');
class General_model extends CI_Model{
  function __construct(){
    parent::__construct();
  }

  public function regis($nama,$username,$password){
    $text="ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $panjangText= strlen($text);
    $hasil="";
    for($i=0;$i<=13;$i++){
    	$hasil = trim($hasil).substr($text,mt_rand(0,$panjangText),1);
    }
    $checking = $this->db->insert('user',['reviewerID'=>$hasil,'Nama_user'=>$nama,'Username'=>$username,'Password'=>$password,'Status'=>'member']);
    if($checking){
      return TRUE;
    }else{
      return FALSE;
    }
  }

  public function login($user,$pass){
    $checking = $this->db->get_where('user',['Username'=>$user,'Password'=>$pass]);
    if($checking->num_rows() > 0){
      return 1;
    }else{
      return 0;
    }
  }

  public function take_sess($user,$pass){
    return $checking = $this->db->get_where('user',['Username'=>$user,'Password'=>$pass]);
  }

  public function some_new_song(){
    return $this->db->from('metadata')
                    ->order_by('id','desc')
                    ->limit('8')
                    ->get();
  }

  public function some_popular_song(){
    return $this->db->from('metadata')
                    ->order_by('view','desc')
                    ->limit('4')
                    ->get();
  }

  public function popular_song_page(){
    $query = "select * from metadata order by view desc limit 15";
    return $this->db->query($query);
  }

  public function update_view($uri){
    $query = "update metadata set view = view+1 where id=$uri";
    return $this->db->query($query);
  }

  public function description($uri){
    return $this->db->get_where('metadata',['id'=>$uri]);
  }

  public function cari_music($keyword){
    $query = "select * from metadata where title like '%$keyword%' or artist like '%$keyword%' or root_genre like '%$keyword%' or first_release_year like '%$keyword%' or label like '%$keyword%'";
    return $this->db->query($query);
  }

  public function new_song(){
    return $this->db->order_by('id','desc')
                    ->get('metadata');
  }

  public function new_song_page($page,$batas){
    $query = "select * from metadata order by id desc limit $page,$batas";
    return $this->db->query($query);
  }

  public function preference(){
    $query = "select * from metadata where rate='0' or rate < 3 order by rand()";
    return $this->db->query($query);
  }

  public function genre(){
    $query = "select root_genre, count(*) jumlah_data from metadata group by root_genre";
    return $this->db->query($query);
  }

  public function genre_views($key){
    $query ="select * from metadata where root_genre like '%$key%' ";
    return $this->db->query($query);
  }
}
