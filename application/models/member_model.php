<?php
if(!defined('BASEPATH')) exit ('no file allowed');
class Member_model extends CI_Model{
  function __construct(){
    parent::__construct();
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
                    ->limit('5')
                    ->get();
  }

  public function some_recom_song(){
    $query = "select * from hasil_recom join metadata on(hasil_recom.amazon_id = metadata.amazon_id) where hasil_recom.recommend ='YES' order by hasil desc limit 8";
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

  public function popular_song_page(){
    $query = "select * from metadata order by view desc limit 15";
    return $this->db->query($query);
  }

  public function cari_music($keyword){
    $query = "select * from metadata where title like '%$keyword%' or artist like '%$keyword%' or root_genre like '%$keyword%' or first_release_year like '%$keyword%' or label like '%$keyword%'";
    return $this->db->query($query);
  }

  public function update_view($uri){
    $query = "update metadata set view = view+1 where id=$uri";
    return $this->db->query($query);
  }

  public function description($uri){
    return $this->db->get_where('metadata',['id'=>$uri]);
  }

  public function get_amazon($id){
    return $this->db->get_where('metadata',['id'=>$id]);
  }

  public function cek_rate($user,$id){
    return  $this->db->get_where('reviews',['reviewerID'=>$user,'amazon_id'=>$id]);
  }
  public function in_rate($table, $data){
        return $this->db->insert($table, $data);
    }

    public function del_rate($id){
      $check = $this->db->delete('reviews',['id_rev'=>$id]);
      if($check){
        return TRUE;
      }else{
        return FALSE;
      }
    }

  public function rater($id){
    return $this->db->get_where('reviews',['amazon_id'=>$id]);
  }

  public function numrate($id){
    $query = "select sum(Rating) as 'total' from reviews where amazon_id='$id'";
    return $this->db->query($query);
  }
  public function rate_up($hasil,$id){
    return $this->db->where('amazon_id',$id)
                    ->update('metadata',['rate'=>$hasil]);
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
