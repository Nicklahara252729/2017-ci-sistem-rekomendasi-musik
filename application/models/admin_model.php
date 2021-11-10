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
    $query = "select * from user where Nama_user like '%$keyword%' or Username like '%$keyword%' ";
    return $this->db->query($query);
  }

  public function akun_paging($page,$batas){
    $keyword= $this->uri->segment(4);
    $query = "select * from user where Nama_user like '%$keyword%' or Username like '%$keyword%'  limit $page,$batas";
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

  public function tester(){
    return $this->db->get_where('rating');
  }

  public function t_item(){
    return $this->db->get('metadata');
  }


    //--------------------------------------------------------------------------- pengujian sistem --------------------------------------------------------------------------------
    public function get_user(){
	  return $this->db->get('user');
  }
    public function hasil_recom($idu){
	  return $this->db->get_where('hasil_recom',['reviewerID'=>$idu, 'recommend'=>'NO']);
  }
    public function topn($idu){
	  return $this->db->order_by('hasil','desc')
					  ->get_where('hasil_recom',['reviewerID'=>$idu]);
  }
    public function hitn($idu){
	  return $this->db->order_by('hasil','desc')
					  ->get_where('hasil_recom',['reviewerID'=>$idu,'recommend'=>'NO']);
  }
    public function temp($idu){
	  return $this->db->get_where('temp',['reviewerID'=>$idu]);
  }
    public function temp_hit($idu){
	  return $this->db->get_where('temp_hit',['reviewerID'=>$idu]);
  }
    public function in_temp($idu,$num,$cove,$cove_tiga,$cove_lima,$cove_tujuh,$cove_sepuluh){
	  $cek = $this->db->insert('temp',['reviewerID'=>$idu,'k'=>$num,'cove_satu'=>$cove,'cove_tiga'=>$cove_tiga,'cove_lima'=>$cove_lima,'cove_tujuh'=>$cove_tujuh,'cove_sepuluh'=>$cove_tujuh]);
	  if($cek){
		  return TRUE;
	  }else{
		  return FALSE;
	  }
  }
  public function in_htemp($idu,$num,$hit,$hit_tiga,$hit_lima,$hit_tujuh,$hit_sepuluh){
	  $cek = $this->db->insert('temp_hit',['reviewerID'=>$idu,'k'=>$num,'hit_satu'=>$hit,'hit_tiga'=>$hit_tiga,'hit_lima'=>$hit_lima,'hit_tujuh'=>$hit_tujuh,'hit_sepuluh'=>$hit_sepuluh]);
	  if($cek){
		  return TRUE;
	  }else{
		  return FALSE;
	  }
  }
   public function b_user(){
	  $query = "select * from temp where k=3 or k=4";
	  return $this->db->query($query);
  }
  public function b_user_sc($lenght){
	  $query = "select * from temp where k=$lenght or k=($lenght+1)";
	  return $this->db->query($query);
  }
  public function b_user_rd(){
	  $query = "select * from temp where k=7 or k=8";
	  return $this->db->query($query);
  }
  public function b_user_fth(){
	  $query = "select * from temp where k=9 or k=10";
	  return $this->db->query($query);
  }
    //------------------------------------------------
    public function hb_user(){
	  $query = "select * from temp_hit where k=3 or k=4";
	  return $this->db->query($query);
  }
  public function hb_user_sc($lenght){
	  $query = "select * from temp_hit where k=$lenght or k=($lenght+1)";
	  return $this->db->query($query);
  }
  public function hb_user_rd(){
	  $query = "select * from temp_hit where k=7 or k=8";
	  return $this->db->query($query);
  }
  public function hb_user_fth(){
	  $query = "select * from temp_hit where k=9 or k=10";
	  return $this->db->query($query);
  }
//---------------------------------
    public function cove_satu($idu){
	  return $this->db->get_where('top_satu',['reviewerID'=>$idu,'top_satu'=>'YES']);
  }
   public function hit_satu($idu){
	  return $this->db->get_where('hit_satu',['reviewerID'=>$idu,'hit_satu'=>'NO']);
  }
    public function sum_satu($lenght){
	  $query = "select sum(cove_satu) as 'cove_satu' from temp where k=$lenght or k=($lenght+1)";
	  return $this->db->query($query);
  }
    public function sum_tiga($lenght){
	  $query = "select sum(cove_tiga) as 'cove_tiga' from temp where k=$lenght or k=($lenght+1)";
	  return $this->db->query($query);
  }
    public function sum_lima($lenght){
	  $query = "select sum(cove_lima) as 'cove_lima' from temp where k=$lenght or k=($lenght+1)";
	  return $this->db->query($query);
  }
    public function sum_tujuh($lenght){
	  $query = "select sum(cove_tujuh) as 'cove_tujuh' from temp where k=$lenght or k=($lenght+1)";
	  return $this->db->query($query);
  }
    public function sum_sepuluh($lenght){
	  $query = "select sum(cove_sepuluh) as 'cove_sepuluh' from temp where k=$lenght or k=($lenght+1)";
	  return $this->db->query($query);
  }
    //-------------------------------------
    public function hsum_satu($lenght){
	  $query = "select sum(hit_satu) as 'hit_satu' from temp_hit where k=$lenght or k=($lenght+1)";
	  return $this->db->query($query);
  }
    public function hsum_tiga($lenght){
	  $query = "select sum(hit_tiga) as 'hit_tiga' from temp_hit where k=$lenght or k=($lenght+1)";
	  return $this->db->query($query);
  }
    public function hsum_lima($lenght){
	  $query = "select sum(hit_lima) as 'hit_lima' from temp_hit where k=$lenght or k=($lenght+1)";
	  return $this->db->query($query);
  }
    public function hsum_tujuh($lenght){
	  $query = "select sum(hit_tujuh) as 'hit_tujuh' from temp_hit where k=$lenght or k=($lenght+1)";
	  return $this->db->query($query);
  }
    public function hsum_sepuluh($lenght){
	  $query = "select sum(hit_sepuluh) as 'hit_sepuluh' from temp_hit where k=$lenght or k=($lenght+1)";
	  return $this->db->query($query);
  }
//---------------------------------
//-------- coverage ----------------
    public function top_satu($id){
	  return $this->db->order_by('hasil','desc')
					  ->limit(10)
					  ->get_where('hasil_recom',['reviewerID'=>$id]);
  }
    public function top_tiga($id){
	  return $this->db->order_by('hasil','desc')
					  ->limit(30)
					  ->get_where('hasil_recom',['reviewerID'=>$id]);
  }
    public function top_lima($id){
	  return $this->db->order_by('hasil','desc')
					  ->limit(50)
					  ->get_where('hasil_recom',['reviewerID'=>$id]);
  }
    public function top_tujuh($id){
	  return $this->db->order_by('hasil','desc')
					  ->limit(70)
					  ->get_where('hasil_recom',['reviewerID'=>$id]);
  }
    public function top_sepuluh($id){
	  return $this->db->order_by('hasil','desc')
					  ->limit(100)
					  ->get_where('hasil_recom',['reviewerID'=>$id]);
  }

    public function in_tsatu($id,$rec_satu){
	  $cek =$this->db->insert('top_satu',['reviewerID'=>$id,'top_satu'=>$rec_satu]);
	  if($cek){
		  return TRUE;
	  }else{
		  return FALSE;
	  }
    }

    public function in_ttiga($id,$rec_tiga){
	  $cek =$this->db->insert('top_tiga',['reviewerID'=>$id,'top_tiga'=>$rec_tiga]);
	  if($cek){
		  return TRUE;
	  }else{
		  return FALSE;
	  }
  }

    public function in_tlima($id,$rec_lima){
	  $cek =$this->db->insert('top_lima',['reviewerID'=>$id,'top_lima'=>$rec_lima]);
	  if($cek){
		  return TRUE;
	  }else{
		  return FALSE;
	  }
    }

    public function in_ttujuh($id,$rec_tujuh){
	  $cek =$this->db->insert('top_tujuh',['reviewerID'=>$id,'top_tujuh'=>$rec_tujuh]);
	  if($cek){
		  return TRUE;
	  }else{
		  return FALSE;
	  }
  }

     public function in_tsepuluh($id,$rec_sepuluh){
	  $cek =$this->db->insert('top_sepuluh',['reviewerID'=>$id,'top_sepuluh'=>$rec_sepuluh]);
	  if($cek){
		  return TRUE;
	  }else{
		  return FALSE;
	  }
  }
//-------- end coverage--------------
//--------- hit rate ----------------
public function in_hsatu($id,$rec_hs){
	  $cek =$this->db->insert('hit_satu',['reviewerID'=>$id,'hit_satu'=>$rec_hs]);
	  if($cek){
		  return TRUE;
	  }else{
		  return FALSE;
	  }
  }

public function in_htiga($id,$rec_ht){
	  $cek =$this->db->insert('hit_tiga',['reviewerID'=>$id,'hit_tiga'=>$rec_ht]);
	  if($cek){
		  return TRUE;
	  }else{
		  return FALSE;
	  }
  }

public function in_hlima($id,$rec_hl){
	  $cek =$this->db->insert('hit_lima',['reviewerID'=>$id,'hit_lima'=>$rec_hl]);
	  if($cek){
		  return TRUE;
	  }else{
		  return FALSE;
	  }
  }

public function in_htujuh($id,$rec_htj){
	  $cek =$this->db->insert('hit_tujuh',['reviewerID'=>$id,'hit_tujuh'=>$rec_htj]);
	  if($cek){
		  return TRUE;
	  }else{
		  return FALSE;
	  }
  }

public function in_hsepuluh($id,$rec_hsp){
	  $cek =$this->db->insert('hit_sepuluh',['reviewerID'=>$id,'hit_sepuluh'=>$rec_hsp]);
	  if($cek){
		  return TRUE;
	  }else{
		  return FALSE;
	  }
  }
}
