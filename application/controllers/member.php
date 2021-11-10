<?php
if(!defined('BASEPATH')) exit ('no file allowed');
class Member extends CI_Controller{
  function __construct(){
    parent::__construct();
    check_session();
  }

  public function welcome(){
    error_reporting(0);
   echo anchor('member/','Welcome '.$this->session->userdata('nama').'...Click To Continue',['style'=>'text-decoration:none;font-size:40px;background:#f8f8f8; padding:10px; border:solid 1px lightgray; position:absolute;
    margin-top:20px;margin-left:50px;width:auto;text-align:center;border-radius:5px;color:#616161;']);
    $session = $this->session->userdata('reviewer_id');
$jlhu = $this->db->get('user')->num_rows();
  $jlhi = $this->db->get('metadata')->num_rows();
  $s = $jlhu + $jlhi;
$drate = $this->db->get('reviews')->result();
$duser = $this->db->get('user')->result();
$ditem = $this->db->get('metadata')->result();
$awal = [];
$matrix = [];
$matrix1 = [];
$trans = [];
$kali = [];
$pangkat = [];
$hasil = [];
//$drate_sc = $this->db->get_where('n_rate',['Amazon_id'=>'i7'])->row();
$o = 0;
foreach($drate as $rates){
  $ama[$o] = $rates->amazon_id;
  $rev[$o] = $rates->reviewerID;
  $rat[$o] = $rates->Rating;
  $o++;
}
$i=0;
foreach($duser as $usr){
  $user[$i] = $usr->reviewerID;
  $i++;
}
$j= 0;
foreach($ditem as $itm){
  $item[$j] = $itm->amazon_id;
  $j++;
}
//for($f=0;$f<sizeof($a);$f++){
  //echo $a[$f];
//}

//$a = ['u1','u2','u3'];
//$b = ['ss','pp','qq'];
/*for($l=0;$l<$u;$l++){
  for($y=0;$y<$i;$y++){
     if($a[$l]==$rev[$y]){
       for($m=0;$m<sizeof($b);$m++){
         if($b[$m] == $ama[$y]){
           echo $d[$m] = $rat[$y];
         }else{
           echo $d[$m] = 0;
         }
       }
     }
  }
}*/
for ($i=0; $i < $jlhu; $i++) {
  $id_user=$user[$i];
  for ($j=0; $j < $jlhi; $j++) {
    $id_item=$item[$j];
    //$query = "SELECT rating from n_rate where reviewerID='$id_user' and Amazon_id='$id_item' limit 1";
    //$t_item = $this->db->get_where('n_rate','reviewerID'=>'id_user', 'Amazon_id' => 'id_item');
    $nilai = $this->db->query("select Rating from reviews where reviewerID='$id_user' and amazon_id='$id_item' limit 1")->row();
    //$this->db->select('rating')->from('n_rate')->where('reviewerID',$id_user)->where('Amazon_id',$id_item)->limit(1);
    //$nilai = $this->model_app->rating($id_user, $id_item);
    if($nilai==null){
      $rating= 0;
    }
    else
    {
      $rating= $nilai->Rating;
    }
     $awal[$i][$j] = $rating;
  }
}

"<table >";
  "<table>";
   "<table border=1>";
  "
  <tr>
  <td colspan=13>TAHAP 6</td>
  </tr>";
  for($i=0;$i<$jlhu;$i++){
   "<tr>";
        for($j=0;$j<$jlhi;$j++){
       "<td>";

       $awal[$i][$j];
       "</td>";
    }
     "</tr>";
  }
  "</table> <br><br>";


//---- tahap 1--------------
 "<table border=1>";
"
<tr>
<td colspan=13>TAHAP 1</td>
</tr>";
  for($i=0;$i<$s;$i++){
   "<tr>";
      if($i >= $jlhu){
    for($j=0;$j<$s;$j++){
      "<td>";
      if($j >= $jlhu){
         $nilai = 0;
      }else{
         $nilai = $awal[$j][($i-$jlhu)%$jlhi];
      }
      "</td>";
      $matrix[$i][$j] = $nilai;
    }
    }
    else{
          for($j=0;$j<$s;$j++){
      "<td>";
      if($j >= $jlhu){
         $nilai = $awal[$i][$j-$jlhu];
      }else{
         $nilai = 0;
      }
      "</td>";
      $matrix[$i][$j] = $nilai;
    }
       }
     "</tr>";
}
 "</table><br><br>";
  //------------------- end tahap 1 -------------------



  //-------------------- tahap 3 ----------------------

   "<table border=1>";
  "
  <tr>
  <td colspan=13>TAHAP 3</td>
  </tr>";
  for($i=0;$i<$s;$i++){
     "<tr>";
    if($i >= $jlhu){
     for($j=0;$j<$s;$j++){
       "<td>";
       if($j >= $jlhu){
         $nilai = 0;
       }else{
        if ($matrix[$i][$j]>=3){
             $nilai = 1 * -1;
        }
        else if($matrix[$i][$j]<=2 && $matrix[$i][$j]!=0){
           $nilai = -1;
        }
        else{
           $nilai = 0;
        }
       }
        "</td>";
        $matrix1[$i][$j] = $nilai;
     }
    }
    else{
      for($j=0;$j<$s;$j++){
         "<td>";
         if($j >= $jlhu){
          if ($matrix[$i][$j]>=3){
               $nilai = 1;
          }
          else if($matrix[$i][$j]<=2 && $matrix[$i][$j]!=0){
             $nilai = -1;
          }
          else{
             $nilai = 0;
          }
         }else{
            $nilai = 0;
         }
         $matrix1[$i][$j] = $nilai;
        "</td>";
      }
      }
       "</tr>";
    }
   "</table><br><br>";

  //-------------------- end tahap 3 ------------------

  //-------------------- tahap 4 = k -------------------
   $t_item = $this->db->get_where('reviews',['reviewerID'=>$session])->num_rows();
   "<table border=1>";
  "
  <tr>
  <td colspan=13>TAHAP 4</td>
  </tr>
  <tr>
  <td>";
   "Penentuan K & N <br>";
  if($t_item%2==0){
     "nilai K = ";
      $k = $t_item - 1;
     "<br>";
  }else{
     "nilai K = ";
      $k = $t_item;
     "<br>";

  }
      "nilai N = ";
        $n = ($k - 1)/2;

      "</td></tr></table><br><br>";

  //-------------------- end tahap 4--------------------


  //----------- transpose -----------------------------

  for($i=0;$i<$s;$i++){
   "<tr>";
        for($j=0;$j<$s;$j++){
       "<td>";

       $trans[$i][$j] = $matrix1[$j][$i];
       "</td>";
    }
     "</tr>";
  }
  "</table>";

  "<table border=1>";
  "<table>";
   "<table border=1>";
  "
  <tr>
  <td colspan=13>TAHAP 5 TRANSPOSE</td>
  </tr>";
  for($i=0;$i<$s;$i++){
   "<tr>";
        for($j=0;$j<$s;$j++){
       "<td>";

       $trans[$i][$j];
       "</td>";
    }
     "</tr>";
  }
  "</table> <br><br>";
  //------------------- end transpose----------

  //------------------ pangkat ----------------
  for($i=0;$i<$s;$i++){
        for($j=0;$j<$s;$j++){
      $kali[$i][$j] = 0;
      for($k=0;$k<$s;$k++){
        $temp = $matrix1[$i][$k] * $trans[$k][$j];
        $kali[$i][$j] = $kali[$i][$j] + $temp;
      }
        $pangkat[$i][$j] = pow($kali[$i][$j],$n);
    }
  }

  "<table border=1>";
  "<table>";
   "<table border=1>";
  "
  <tr>
  <td colspan=13>TAHAP 6</td>
  </tr>";
  for($i=0;$i<$s;$i++){
   "<tr>";
        for($j=0;$j<$s;$j++){
       "<td>";

       $pangkat[$i][$j];
       "</td>";
    }
     "</tr>";
  }
  "</table> <br><br>";
  //------------------ end pangkat ------------

  //--------------------- hasil akhir ---------
  for($i=0;$i<$s;$i++){
        for($j=0;$j<$s;$j++){
      $hasil[$i][$j] = 0;
      for($k=0;$k<$s;$k++){
        $temp = $pangkat[$i][$k]* $matrix1[$k][$j];
        $hasil[$i][$j] = $hasil[$i][$j] + $temp;
      }
    }
  }



  "<table border=1>";
  "<table>";
   "<table border=1>";
  "
  <tr>
  <td colspan=13>TAHAP 7</td>
  </tr>";
  for($i=0;$i<$s;$i++){
   "<tr>";
        for($j=0;$j<$s;$j++){
       "<td>";
      //echo $user[$i];
       $hasil[$i][$j];
       "</td>";

    }

     "</tr>";
  }
  "</table> <br><br>";
  //----------------------- end hasil -------------

  //----------------------- hasil final ------------
  //echo $session;
  for($u=0;$u<$jlhu;$u++){
     $user[$u];
    if($user[$u] == $session){
      $z = 1;
    }
  }

  for($p=0;$p<sizeof($hasil);$p++){

    if($p == $z){

      for($h=0;$h<sizeof($hasil);$h++){

       //$us = $user[$i];
        //$hs = $hasil[$i][$j];
       //$itm = $item[$j];
        //$rt = $awal[$i][$j];
       /*if ($awal[$i][$j]>0){
             $rc = "YES";
        }else{
           $rc = "NO";
        }*/
        if($j >= $jlhu){
           $recom[$h-$jlhu] = $hasil[$p][$h];
        }
      //$this->db->insert('temp_recom',['reviewerID'=>$us,'amazon_id'=>$itm,'rating'=>$rt,'recommend'=>$rc,'hasil'=>$hs]);
       "</td>";
      }
    }

  }

  for($k=0;$k<sizeof($recom);$k++){
    for($e=0;$e<sizeof($item);$e++){
      if($k==$e){
         $temp = $item[$e];
      }
    }
  }
  //echo sizeof($recom);
  for($y=0;$y<sizeof($recom);$y++){
    if($y >= $jlhu){
          //echo $rt = $awal[$y];
            $recom1 = $recom[$y-$jlhu];
           //$this->db->insert('temp_recom',['hasil'=>$recom1]);
    }

    //echo $rec = $recom1[$y];
  }

  for($k=0;$k<sizeof($recom);$k++){
         //$temp = $item[$k];
           //$recom1 = $recom[$k];
           //$rt = $awal[$k];
          //$this->db->insert('temp_recom',['reviewerID'=>$session,'amazon_id'=>$temp,'hasil'=>$recom1]);
          //redirect(site_url('berita/new'));
  }

   /*sizeof($recom1);
  for($q=0;$q<sizeof($recom);$q++){
    $itm = $item[$q];
    echo $rec = $recom1[$q];
    //$this->db->insert('temp_recom',['amazon_id'=>$rec]);

  }
  //echo sizeof($recom);
  for($i=0;$i<sizeof($recom);$i++){
    for($d=0;$j<sizeof($recom);$j++){
      if($recom[$i] < $recom[$j]){
        $item = $j;
        $temp = $recom1[$i];
        $recom[$i] = $recom[$j];
        $recom[$j] = $temp;
      }
    }
     $allitem[$x] = $item;

  }*/
  for($i=0;$i<sizeof($recom);$i++){
    for($j=0;$j<6;$j++){
      if($j==0){
         $nl = $i;
      }elseif($j==1){
        $nl = $session;
      }elseif($j==2){
        $nl = $item[$i];
      }elseif($j==3){
         $nl = $awal[$z][$i];
      }elseif($j==4){
        if($awal[$z][$i] > 0){
           $nl = "NO";
        }else{
           $nl = "YES";
        }
      }else{
        $nl = $recom[$i];
      }
      $arr_recom [$i][$j] = $nl;
      //$this->db->insert('temp_recom',['reviewerID'=>$session]);
    }

  }

      $cek_hrecom = $this->db->get_where('hasil_recom',['reviewerID'=>$session])->num_rows();
      if($cek_hrecom > 0){
          $deletehrecom = $this->db->delete('hasil_recom',['reviewerID'=>$session]);
          if($deletehrecom){
              for($i=0;$i<sizeof($recom);$i++){
       $arr_recom [$i][0];
       $arr_recom [$i][1];
       $arr_recom [$i][2];
       $arr_recom [$i][3];
       $arr_recom [$i][4];
       $arr_recom [$i][5];
      $this->db->insert('hasil_recom',['reviewerID'=>$session,'amazon_id'=>$arr_recom [$i][2],'Rating'=>$arr_recom [$i][3],'recommend'=>$arr_recom [$i][4],'hasil'=>$arr_recom [$i][5]]);
    }
          }
      }else{
          for($i=0;$i<sizeof($recom);$i++){
       $arr_recom [$i][0];
       $arr_recom [$i][1];
       $arr_recom [$i][2];
       $arr_recom [$i][3];
       $arr_recom [$i][4];
       $arr_recom [$i][5];
      $this->db->insert('hasil_recom',['reviewerID'=>$session,'amazon_id'=>$arr_recom [$i][2],'Rating'=>$arr_recom [$i][3],'recommend'=>$arr_recom [$i][4],'hasil'=>$arr_recom [$i][5]]);
    }
  }
 //$this->template_umum->load('template_umum','member/welcome');
	}




  public function index(){
    $hasil['recom'] = $this->member_model->some_recom_song()->result();
    $hasil['new_song'] = $this->member_model->some_new_song()->result();
    $hasil['popular_song'] = $this->member_model->some_popular_song()->result();
    $this->template_umum->load('template_umum','member/index',$hasil);
}

  public function tambah_rating(){
		if ($this->input->post('rating')!=''){
          $data = $this->member_model->get_amazon($this->input->post('id'))->row();
          $user = $this->session->userdata('reviewer_id');
          if($data){
          $id   = $data->amazon_id;
	        $datas = array('reviewerID'=>$this->session->userdata('reviewer_id'),'amazon_id'=>$id,'nama_user'=>$this->session->userdata('nama'),'Rating'=>$this->input->post('rating'));
          $cek_rate = $this->member_model->cek_rate($user,$id)->num_rows();
          $get_id = $this->member_model->cek_rate($user,$id)->row();
          if($cek_rate > 0){
            $del_cek =  $this->member_model->del_rate($get_id->id_rev);
            if($del_cek == TRUE){
              $check = $this->member_model->in_rate('reviews', $datas);
            }
          }else{
              $check = $this->member_model->in_rate('reviews', $datas);
          }
          if($check){
            $rater = $this->member_model->rater($id)->num_rows();
            $numrate = $this->member_model->numrate($id)->row();
            $hasil = number_format($numrate->total / $rater,1);
            $this->member_model->rate_up($hasil,$id);
          }
            }
		      }
	    }

  public function pencarian(){
    $keyword = strip_tags(trim($this->input->get('sch_member')));
    $hasil['sumdata']= $this->member_model->cari_music($keyword)->num_rows();
    $hasil['record']= $this->member_model->cari_music($keyword);
    $this->template_umum->load('template_umum','member/index',$hasil);
  }

  public function lagu_baru(){
    $config['total_rows']= $this->member_model->new_song()->num_rows();
    $this->load->library('pagination');
    $config['base_url'] = base_url().'member/lagu_baru/';
    $config['per_page'] = 48;
    $this->pagination->initialize($config);
    $result['paging'] = $this->pagination->create_links();
    $page = $this->uri->segment(3);
    $page = $page==''?0:$page;
    $result['record_new_song'] = $this->member_model->new_song_page($page,$config['per_page']);
    $this->template_umum->load('template_umum','member/index',$result);
  }

  public function lagu_populer(){
    $hasil['popular'] = $this->member_model->popular_song_page()->result();
    $this->template_umum->load('template_umum','member/index',$hasil);
  }

  public function description(){
    $uri = $this->uri->segment(3);
    $up_view = $this->member_model->update_view($uri);
    $hasil['recom'] = $this->member_model->some_recom_song()->result();
    $hasil['data'] = $this->member_model->description($uri)->row();
    $this->template_umum->load('template_umum','member/description',$hasil);
  }

  public function about(){
    $this->template_umum->load('template_umum','member/about');
  }

  public function genre(){
    $record['data'] = $this->general_model->genre()->result();
    $this->template_umum->load('template_umum','member/genre',$record);
  }

  public function genre_view(){
    $key = $this->uri->segment(3);
    $record = $this->general_model->genre_views($key);
    if($record){
      $hasil['data'] = $this->general_model->genre_views($key)->result();
      $hasil['root'] = $this->general_model->genre_views($key)->row();
      $hasil['num'] = $this->general_model->genre_views($key)->num_rows();
      $this->template_umum->load('template_umum','member/genre_view',$hasil);
    }else{
      echo"n";
    }
  }
//-----------------------------------------------------------------------------------------------



  public function logout(){
    $this->session->unset_userdata(['status_login','reviewer_id','nama','username','email','gender','tgl','status']);
    $des = $this->session->sess_destroy();
    redirect(site_url('general'));
  }

  public function logout_sec(){
    $this->session->unset_userdata(['status_login','reviewer_id','nama','username','email','gender','tgl','status']);
    $des = $this->session->sess_destroy();
    redirect(site_url('general/login'));
  }
}
