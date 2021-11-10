<?php 
if(!defined('BASEPATH')) exit ('no file allowed');
class Model_app extends CI_model{
  
  //---------------------------------------------------------------------------
  
  public function login($user,$pass){
    $checking = $this->db->get_where('n_user',['Username'=>$user,'Password'=>$pass]);
    if($checking->num_rows() > 0){
      return 1;
    }else{
      return 0;
    }
  }

  public function take_sess($user,$pass){
    return $checking = $this->db->get_where('n_user',['Username'=>$user,'Password'=>$pass]);
  }
  
  //---------------------------------------------------------------------------
  public function get_user(){
	  return $this->db->get('pengguna');
  }
  public function topn($id){
	  return $this->db->order_by('hasil','desc')
					  ->get_where('hasil_recom',['reviewerID'=>$id,]);
  }
  
  public function hitn($id){
	  return $this->db->order_by('hasil','desc')
					  ->get_where('hasil_recom',['reviewerID'=>$id,'recommend'=>'NO']);
  }
  
  public function top_five($id){
	  return $this->db->order_by('hasil','desc')
					  ->limit(5)
					  ->get_where('hasil_recom',['reviewerID'=>$id]);
  }
  
  public function top_nine($id){
	  return $this->db->order_by('hasil','desc')
					  ->limit(9)
					  ->get_where('hasil_recom',['reviewerID'=>$id]);
  }
  
  public function cove_five($id){
	  return $this->db->get_where('top_five',['reviewerID'=>$id,'top_five'=>'YES']);
  }
  public function hit_five($id){
	  return $this->db->get_where('hit_five',['reviewerID'=>$id,'hit_five'=>'NO']);
  }
  public function cove_nine($id){
	  return $this->db->get_where('top_nine',['reviewerID'=>$id,'top_nine'=>'YES']);
  }
  
  public function in_tfive($id,$rec){
	  $cek =$this->db->insert('top_five',['reviewerID'=>$id,'top_five'=>$rec]);
	  if($cek){
		  return TRUE;
	  }else{
		  return FALSE;
	  }
  }
  
  public function in_hfive($id,$rec){
	  $cek =$this->db->insert('hit_five',['reviewerID'=>$id,'hit_five'=>$rec]);
	  if($cek){
		  return TRUE;
	  }else{
		  return FALSE;
	  }
  }
  
  function up_tfive($id,$rec){
    $n_data = array(
      'top_five'=>$rec
    );
    return $this->db->where('reviewerID',$id)
                    ->update('top_five',$n_data);
  }
  
  public function in_tnine($id,$rec){
	  $cek = $this->db->insert('top_nine',['reviewerID'=>$id,'top_nine'=>$rec]);
	  if($cek){
		  return TRUE;
	  }else{
		  return FALSE;
	  }
  }

   public function in_hnine($id,$rec){
	  $cek = $this->db->insert('hit_nine',['reviewerID'=>$id,'hit_nine'=>$rec]);
	  if($cek){
		  return TRUE;
	  }else{
		  return FALSE;
	  }
  }
   
  public function user(){
	  return $this->db->get('pengguna');
  }
  
  public function hasil_recom($id){
	  return $this->db->get_where('hasil_recom',['reviewerID'=>$id, 'recommend'=>'NO']);
  }

  public function temp($id){
	  return $this->db->get_where('temp',['reviewerID'=>$id]);
  }
  public function temp_hit($id){
	  return $this->db->get_where('temp_hit',['reviewerID'=>$id]);
  }
  
  public function in_temp($id,$num,$cove,$cove_nine){
	  $cek = $this->db->insert('temp',['reviewerID'=>$id,'k'=>$num,'cove_five'=>$cove,'cove_nine'=>$cove_nine]);
	  if($cek){
		  return TRUE;
	  }else{
		  return FALSE;
	  }
  }
  public function in_htemp($id,$num,$cove,$cove_nine){
	  $cek = $this->db->insert('temp_hit',['reviewerID'=>$id,'k'=>$num,'hit_five'=>$cove,'hit_nine'=>$cove_nine]);
	  if($cek){
		  return TRUE;
	  }else{
		  return FALSE;
	  }
  }
  
  public function sum_five(){
	  $query = "select sum(cove_five) as 'cove_lima' from temp where k=3 or k=4";
	  return $this->db->query($query);
  }
  public function sum_nine(){
	  $query = "select sum(cove_nine) as 'cove_nine' from temp where k=3 or k=4";
	  return $this->db->query($query);
  }
  
  public function sum_five_sc(){
	  $query = "select sum(cove_five) as 'cove_lima' from temp where k=5 or k=6";
	  return $this->db->query($query);
  }
  public function sum_nine_sc(){
	  $query = "select sum(cove_nine) as 'cove_nine' from temp where k=5 or k=6";
	  return $this->db->query($query);
  }
  public function sum_five_rd(){
	  $query = "select sum(cove_five) as 'cove_lima' from temp where k=7 or k=8";
	  return $this->db->query($query);
  }
  public function sum_nine_rd(){
	  $query = "select sum(cove_nine) as 'cove_nine' from temp where k=7 or k=8";
	  return $this->db->query($query);
  }
  public function sum_five_fth(){
	  $query = "select sum(cove_five) as 'cove_lima' from temp where k=9 or k=10";
	  return $this->db->query($query);
  }
  public function sum_nine_fth(){
	  $query = "select sum(cove_nine) as 'cove_nine' from temp where k=9 or k=10";
	  return $this->db->query($query);
  }
  
  public function hsum_five(){
	  $query = "select sum(hit_five) as 'hit_lima' from temp_hit where k=3 or k=4";
	  return $this->db->query($query);
  }
  public function hsum_nine(){
	  $query = "select sum(hit_nine) as 'hit_nine' from temp_hit where k=3 or k=4";
	  return $this->db->query($query);
  }
  public function hsum_five_sc(){
	  $query = "select sum(hit_five) as 'hit_lima' from temp_hit where k=5 or k=6";
	  return $this->db->query($query);
  }
  public function hsum_nine_sc(){
	  $query = "select sum(hit_nine) as 'hit_nine' from temp_hit where k=5 or k=6";
	  return $this->db->query($query);
  }
  public function hsum_five_rd(){
	  $query = "select sum(hit_five) as 'hit_lima' from temp_hit where k=7 or k=8";
	  return $this->db->query($query);
  }
  public function hsum_nine_rd(){
	  $query = "select sum(hit_nine) as 'hit_nine' from temp_hit where k=7 or k=8";
	  return $this->db->query($query);
  }
    public function hsum_five_fth(){
	  $query = "select sum(hit_five) as 'hit_lima' from temp_hit where k=9 or k=10";
	  return $this->db->query($query);
  }
  public function hsum_nine_fth(){
	  $query = "select sum(hit_nine) as 'hit_nine' from temp_hit where k=9 or k=10";
	  return $this->db->query($query);
  }
  
  public function b_user(){
	  $query = "select * from temp where k=3 or k=4";
	  return $this->db->query($query);
  }
  public function b_user_sc(){
	  $query = "select * from temp where k=5 or k=6";
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
  
  public function hb_user(){
	  $query = "select * from temp_hit where k=3 or k=4";
	  return $this->db->query($query);
  }
  public function hb_user_sc(){
	  $query = "select * from temp_hit where k=5 or k=6";
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
  
  public function del($id){
	  return $this->db->delete('temp',['reviewerID'=>$id]);
  }
  public function del_hit($id){
	  return $this->db->delete('temp_hit',['reviewerID'=>$id]);
  }
  
  
}