<?php
if(!defined('BASEPATH')) exit ('no file allowed');
class Auth extends CI_Controller{
	function __construct(){
		parent::__construct();
	}

	function index(){
		$this->theme->load('theme','login');
	}

	function logout(){
		session_destroy();
		redirect(site_url('auth/index'));
	}
	
	function anakayam(){
		for($i=10;$i>=1;$i--){
			$hasil = $i-1;
			if($i==10){
				echo "ayam".$i."<br>";
				echo "mati satu tinggal".$hasil."<br>";
			}else if($i==9){
				echo "ayam".$i."<br>";
				echo "mati satu tinggal".$hasil."<br>";
			}else if($i==8){
				echo "ayam".$i."<br>";
				echo "mati satu tinggal".$hasil."<br>";
			}else if($i==7){
				echo "ayam".$i."<br>";
				echo "mati satu tinggal".$hasil."<br>";
			}else if($i==6){
				echo "ayam".$i."<br>";
				echo "mati satu tinggal".$hasil."<br>";
			}else if($i==5){
				echo "ayam".$i."<br>";
				echo "mati satu tinggal".$hasil."<br>";
			}else if($i==4){
				echo "ayam".$i."<br>";
				echo "mati satu tinggal".$hasil."<br>";
			}else if($i==3){
				echo "ayam".$i."<br>";
				echo "mati satu tinggal".$hasil."<br>";
			}else if($i==2){
				echo "ayam".$i."<br>";
				echo "mati satu tinggal".$hasil."<br>";
			}else if($i==1){
				echo "ayam".$i."<br>";
				echo "mati satu tinggal induknya";
			}
		}
	}

	function login(){
		$user = $this->input->post('username');
		$pass = $this->input->post('password');
		if(isset($_POST['enter'])){
        $checked = $this->model_app->login($user,$pass);
        if($checked==1){          
          $result = $this->model_app->take_sess($user,$pass)->row();
  				$this->session->set_userdata(array('status_login'=>TRUE,'reviewer_id'=>$result->reviewerID,'username'=>$result->username));
			redirect(site_url('auth/home'));
        }else{
          redirect(site_url('auth'));
        }
      }else{
      }
	}

	function home(){
		//check_session_login();
		
		$this->theme->load('theme','home');
	}

	//--------------------------------------------------------------------------------------------------------
	public function top_five(){
		$get_user = $this->model_app->get_user()->result();
		foreach($get_user as $k){
		$id = $k->reviewerID;
		$top_five = $this->model_app->top_five($id);
			foreach($top_five->result() as $r){
				$rec = $r->recommend;
				$cek_top = $this->db->get_where('top_five',['reviewerID'=>$id])->num_rows();
				$in = $this->model_app->in_tfive($id,$rec);
				/*if($cek_top <=0){
					
				}else{
					$up = $this->model_app->up_tfive($id,$rec);
				}*/
				
			}
		}
		echo"oke";
		//redirect(site_url('berita/top_nine'));
	}
	function hasil(){
		$user = $this->session->userdata('reviewer_id');
		$res['reslt'] = $this->db->order_by('hasil','desc')
							     ->get_where('hasil_recom',['reviewerID'=>$user,'recommend'=>'YES']);
		$this->theme->load('theme','hasil',$res);
	}

	function new_recom_empat(){
		error_reporting(0);
		echo anchor('auth/hasil','Hasil Rekomendasi >>');
	 echo $session = $this->session->userdata('reviewer_id');
	$jlhu = $this->db->get('n_user')->num_rows();
    $jlhi = $this->db->get('n_item')->num_rows();
    $s = $jlhu + $jlhi;
	$drate = $this->db->get('n_rate')->result();
	$duser = $this->db->get('n_user')->result();
	$ditem = $this->db->get('n_item')->result();
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
		$ama[$o] = $rates->Amazon_id;
		$rev[$o] = $rates->reviewerID;
		$rat[$o] = $rates->rating;
		$o++;
	}
	$i=0;
	foreach($duser as $usr){
		$user[$i] = $usr->reviewerID;
		$i++;
	}
	$j= 0;
	foreach($ditem as $itm){
		$item[$j] = $itm->Amazon_id;
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
			$nilai = $this->db->query("select rating from n_rate where reviewerID='$id_user' and Amazon_id='$id_item' limit 1")->row();
			//$this->db->select('rating')->from('n_rate')->where('reviewerID',$id_user)->where('Amazon_id',$id_item)->limit(1);
			//$nilai = $this->model_app->rating($id_user, $id_item);
			if($nilai==null){
				$rating= 0;
			}
			else
			{
				$rating= $nilai->rating;
			}
			 $awal[$i][$j] = $rating;
		}
	}

	echo"<table >";
		echo"<table>";
		echo "<table border=1>";
		echo"
		<tr>
		<td colspan=13>TAHAP 6</td>
		</tr>";
		for($i=0;$i<$jlhu;$i++){
		echo "<tr>";
      		for($j=0;$j<$jlhi;$j++){
				echo "<td>";
				
				echo $awal[$i][$j];
				echo "</td>";
			}				
		  echo "</tr>";
		}
		echo"</table> <br><br>";
				
	
	//---- tahap 1--------------
	echo "<table border=1>";
	echo"
	<tr>
	<td colspan=13>TAHAP 1</td>
	</tr>";
    for($i=0;$i<$s;$i++){
		echo "<tr>";
      	if($i >= $jlhu){
		 	for($j=0;$j<$s;$j++){
			 	echo"<td>";
				if($j >= $jlhu){
					echo $nilai = 0; 
				}else{
					echo $nilai = $awal[$j][($i-$jlhu)%$jlhi];
				}			
				echo"</td>";
				$matrix[$i][$j] = $nilai;
		 	}
	  	}
	  	else{
            for($j=0;$j<$s;$j++){
				echo"<td>";
				if($j >= $jlhu){
					echo $nilai = $awal[$i][$j-$jlhu];
				}else{
					echo $nilai = 0;
				}			
				echo"</td>";
				$matrix[$i][$j] = $nilai;
			}				
         }
		  echo "</tr>";
	}
	echo "</table><br><br>";
		//------------------- end tahap 1 -------------------
		
		
		
		//-------------------- tahap 3 ----------------------
		
		echo "<table border=1>";
		echo"
		<tr>
		<td colspan=13>TAHAP 3</td>
		</tr>";
		for($i=0;$i<$s;$i++){
			echo "<tr>";
		  if($i >= $jlhu){
			 for($j=0;$j<$s;$j++){
				 echo"<td>";
				 if($j >= $jlhu){
					echo $nilai = 0; 
				 }else{
				 	if ($matrix[$i][$j]>=3){
					  	echo $nilai = 1 * -1;
				 	}
				 	else if($matrix[$i][$j]<=2 && $matrix[$i][$j]!=0){
				 		echo $nilai = -1;
				 	}
				 	else{
				 		echo $nilai = 0;
				 	}
				 }			
				  echo"</td>";
				  $matrix1[$i][$j] = $nilai;
			 }
		  }
		  else{
				for($j=0;$j<$s;$j++){
					 echo"<td>";
					 if($j >= $jlhu){
						if ($matrix[$i][$j]>=3){
						  	echo $nilai = 1;
					 	}
					 	else if($matrix[$i][$j]<=2 && $matrix[$i][$j]!=0){
					 		echo $nilai = -1;
					 	}
					 	else{
					 		echo $nilai = 0;
					 	}
					 }else{
						 echo $nilai = 0;
					 }
					 $matrix1[$i][$j] = $nilai;			
					echo"</td>";
				}				
			  }
			  echo "</tr>";
			}
		echo "</table><br><br>";
		
		//-------------------- end tahap 3 ------------------
		
		//-------------------- tahap 4 = k -------------------
		 $t_item = $this->db->get_where('n_rate',['reviewerID'=>$session])->num_rows();
		echo "<table border=1>";
		echo"
		<tr>
		<td colspan=13>TAHAP 4</td>
		</tr>
		<tr>
		<td>";
		echo "Penentuan K & N <br>";
		if($t_item%2==0){
			echo "nilai K = ";
			 echo $k = $t_item - 1;
			 echo"<br>";
		}else{
			echo "nilai K = ";
			 echo $k = $t_item;
			 echo"<br>";

		}
			 echo "nilai N = ";
		     echo $n = ($k - 1)/2;
			 
			 echo "</td></tr></table><br><br>";
		
		//-------------------- end tahap 4--------------------
		
		
		//----------- transpose -----------------------------
		
		for($i=0;$i<$s;$i++){
		echo "<tr>";
      		for($j=0;$j<$s;$j++){
				echo "<td>";
				
				 $trans[$i][$j] = $matrix1[$j][$i];
				echo "</td>";
			}				
		  echo "</tr>";
		}
		echo"</table>";
		
		echo"<table border=1>";
		echo"<table>";
		echo "<table border=1>";
		echo"
		<tr>
		<td colspan=13>TAHAP 5 TRANSPOSE</td>
		</tr>";
		for($i=0;$i<$s;$i++){
		echo "<tr>";
      		for($j=0;$j<$s;$j++){
				echo "<td>";
				
				echo $trans[$i][$j];
				echo "</td>";
			}				
		  echo "</tr>";
		}
		echo"</table> <br><br>";
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
		
		echo"<table border=1>";
		echo"<table>";
		echo "<table border=1>";
		echo"
		<tr>
		<td colspan=13>TAHAP 6</td>
		</tr>";
		for($i=0;$i<$s;$i++){
		echo "<tr>";
      		for($j=0;$j<$s;$j++){
				echo "<td>";
				
				echo $pangkat[$i][$j];
				echo "</td>";
			}				
		  echo "</tr>";
		}
		echo"</table> <br><br>";
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
		
		
		
		echo"<table border=1>";
		echo"<table>";
		echo "<table border=1>";
		echo"
		<tr>
		<td colspan=13>TAHAP 7</td>
		</tr>";
		for($i=0;$i<$s;$i++){
		echo "<tr>";
      		for($j=0;$j<$s;$j++){
				echo "<td>";
				//echo $user[$i];
				echo $hasil[$i][$j];
				echo "</td>";
				
			}	
			 			
		  echo "</tr>";
		}
		echo"</table> <br><br>";
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
				echo "</td>";
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
						 $nl = "YES";
					}else{
						 $nl = "NO";
					}
				}else{
					$nl = $recom[$i];
				}
				$arr_recom [$i][$j] = $nl;
				//$this->db->insert('temp_recom',['reviewerID'=>$session]);
			}
			
		}
        
        $cek_hrecom = $this->db->get_where('temp_recom',['reviewerID'=>$id_user])->num_rows();
        if($cek_hrecom > 0){
            $deletehrecom = $this->db->delete('temp_recom',['reviewerID'=>$session]);
            if($deletehrecom){
                for($i=0;$i<sizeof($recom);$i++){
				 $arr_recom [$i][0];
				 $arr_recom [$i][1];
				 $arr_recom [$i][2];
				 $arr_recom [$i][3];
				 $arr_recom [$i][4];
				 $arr_recom [$i][5];
				$this->db->insert('temp_recom',['reviewerID'=>$session,'amazon_id'=>$arr_recom [$i][2],'rating'=>$arr_recom [$i][3],'recommend'=>$arr_recom [$i][4],'hasil'=>$arr_recom [$i][5]]);
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
				$this->db->insert('temp_recom',['reviewerID'=>$session,'amazon_id'=>$arr_recom [$i][2],'rating'=>$arr_recom [$i][3],'recommend'=>$arr_recom [$i][4],'hasil'=>$arr_recom [$i][5]]);
		  }
        }
		
		
		
		//--------------------- end hasil final ---------------

	}
	
	public function hit_five(){
		$get_user = $this->model_app->get_user()->result();
		foreach($get_user as $k){
		$id = $k->reviewerID;
		$top_five = $this->model_app->top_five($id);
			foreach($top_five->result() as $r){
				$rec = $r->recommend;
				$cek_top = $this->db->get_where('hit_five',['reviewerID'=>$id])->num_rows();
				$in = $this->model_app->in_hfive($id,$rec);
				/*if($cek_top <=0){
					
				}else{
					$up = $this->model_app->up_tfive($id,$rec);
				}*/
				
			}
		}
		echo"oke";
		//redirect(site_url('berita/top_nine'));
	}
	
	public function top_nine(){
		$get_user = $this->model_app->get_user()->result();
		foreach($get_user as $k){
		$id = $k->reviewerID;
		$top_nine = $this->model_app->top_nine($id);
			foreach($top_nine->result() as $r){
				$rec = $r->recommend;
				$in = $this->model_app->in_tnine($id,$rec);
			}
		}
		//echo"oke";
		redirect(site_url('auth/ops'));
	}
	
	public function hit_nine(){
		$get_user = $this->model_app->get_user()->result();
		foreach($get_user as $k){
		$id = $k->reviewerID;
		$top_nine = $this->model_app->top_nine($id);
			foreach($top_nine->result() as $r){
				$rec = $r->recommend;
				$in = $this->model_app->in_hnine($id,$rec);
			}
		}
		//echo"oke";
		redirect(site_url('auth/ops'));
	}
	
	
	public function ops(){
		error_reporting(0);
		if(isset($_POST['submit'])){
			$inpt = $this->input->post('lenght');
			if($inpt==3){				
				$user = $this->model_app->user()->result();
				foreach($user as $k ){
				$id = $k->reviewerID;
				 $num = $this->model_app->hasil_recom($id)->num_rows()."<br>";
				if($num==3 or $num==4){
					 $get_topnum = $this->model_app->topn($id)->num_rows();
					 $get_hitnum = $this->model_app->hitn($id)->num_rows();
					 $get_topn= $this->model_app->cove_five($id)->num_rows();
					 $get_hitn= $this->model_app->hit_five($id)->num_rows();
					 $get_topnine= $this->db->get_where('top_nine',['reviewerID'=>$id,'top_nine'=>'YES'])->num_rows();
					 $get_hitnine= $this->db->get_where('hit_nine',['reviewerID'=>$id,'hit_nine'=>'NO'])->num_rows();
					 $get_temp = $this->model_app->temp($id)->num_rows();
					 $get_htemp = $this->model_app->temp_hit($id)->num_rows();
					  $cove = $get_topn/$get_topnum ;
					  $cove_nine = $get_topnine/$get_topnum;
					  $hit = $get_hitn/$get_hitnum;
					  $hit_nine = $get_hitnine/$get_hitnum;
					 if($get_temp <= 0){
						 $in_temp = $this->model_app->in_temp($id,$num,$cove,$cove_nine);
					  }
					  if($get_htemp <= 0){
						 $in_temp = $this->model_app->in_htemp($id,$num,$hit,$hit_nine);
					  }
					  
					}
				}
				$get_sum = $this->model_app->sum_five()->row();
				$get_sum_n = $this->model_app->sum_nine()->row();
				$get_bnyk_user = $this->model_app->b_user()->num_rows();
				
				$get_hsum = $this->model_app->hsum_five()->row();
				$get_hsum_n = $this->model_app->hsum_nine()->row();
				$get_hbnyk_user = $this->model_app->hb_user()->num_rows();
				if($get_sum->cove_lima >0 and $get_sum_n->cove_nine>0){
				 $sum['sum_lima'] = round(($get_sum->cove_lima/$get_bnyk_user)*100);
				 $sum['sum_nine'] = round(($get_sum_n->cove_nine/$get_bnyk_user)*100);
				}else{
					$sum['sum_lima'] = 0;
					$sum['sum_nine'] = 0;
				}
				
				if($get_hsum->hit_lima >0 and $get_hsum_n->hit_nine>0){
				 $sum['hsum_lima'] = round(($get_hsum->hit_lima/$get_hbnyk_user)*100);
				 $sum['hsum_nine'] = round(($get_hsum_n->hit_nine/$get_hbnyk_user)*100);
				}else{
					$sum['hsum_lima'] = 0;
					$sum['hsum_nine'] = 0;
				}
				$this->theme->load('theme','test',$sum);
			}
			elseif($inpt==5){
				$user = $this->model_app->user()->result();
				foreach($user as $k ){
				$id = $k->reviewerID;
				 $num = $this->model_app->hasil_recom($id)->num_rows()."<br>";
				if($num==5 or $num==6){
					 $get_topnum = $this->model_app->topn($id)->num_rows();
					 $get_hitnum = $this->model_app->hitn($id)->num_rows();
					 $get_topn= $this->model_app->cove_five($id)->num_rows();
					 $get_hitn= $this->model_app->hit_five($id)->num_rows();
					 $get_topnine= $this->db->get_where('top_nine',['reviewerID'=>$id,'top_nine'=>'YES'])->num_rows();
					 $get_hitnine= $this->db->get_where('hit_nine',['reviewerID'=>$id,'hit_nine'=>'NO'])->num_rows();
					 $get_temp = $this->model_app->temp($id)->num_rows();
					 $get_htemp = $this->model_app->temp_hit($id)->num_rows();
					  $cove = $get_topn/$get_topnum ;
					  $cove_nine = $get_topnine/$get_topnum;
					  $hit = $get_hitn/$get_hitnum;
					  $hit_nine = $get_hitnine/$get_hitnum;
					 if($get_temp <= 0){
						 $in_temp = $this->model_app->in_temp($id,$num,$cove,$cove_nine);
					  }else{
						  $del = $this->model_app->del($id);
						  if($del){
							  $in_temp = $this->model_app->in_temp($id,$num,$cove,$cove_nine);
						  }
					  }
					  
					  if($get_htemp <= 0){
						 $in_temp = $this->model_app->in_htemp($id,$num,$hit,$hit_nine);
					  }else{
						  $del = $this->model_app->del_hit($id);
						  if($del){
							  $in_temp = $this->model_app->in_htemp($id,$num,$hit,$hit_nine);
						  }
					  }
					}
				}
				$get_sum = $this->model_app->sum_five_sc()->row();
				$get_sum_n = $this->model_app->sum_nine_sc()->row();
				$get_bnyk_user = $this->model_app->b_user_sc()->num_rows();
				
				$get_hsum = $this->model_app->hsum_five_sc()->row();
				$get_hsum_n = $this->model_app->hsum_nine_sc()->row();
				$get_hbnyk_user = $this->model_app->hb_user_sc()->num_rows();
				if($get_sum->cove_lima >0 and $get_sum_n->cove_nine>0){
				 $sum['sum_lima'] = round(($get_sum->cove_lima/$get_bnyk_user)*100);
				 $sum['sum_nine'] = round(($get_sum_n->cove_nine/$get_bnyk_user)*100);
				}else{
					$sum['sum_lima'] = 0;
					$sum['sum_nine'] = 0;
				}
				
				if($get_hsum->hit_lima >0 and $get_hsum_n->hit_nine>0){
				 $sum['hsum_lima'] = round(($get_hsum->hit_lima/$get_hbnyk_user)*100);
				 $sum['hsum_nine'] = round(($get_hsum_n->hit_nine/$get_hbnyk_user)*100);
				}else{
					$sum['hsum_lima'] = 0;
					$sum['hsum_nine'] = 0;
				}
				$this->theme->load('theme','test',$sum);
			}
			elseif($inpt==7){
				$user = $this->model_app->user()->result();
				foreach($user as $k ){
				$id = $k->reviewerID;
				 $num = $this->model_app->hasil_recom($id)->num_rows()."<br>";
				if($num==7 or $num==8){
					 $get_topnum = $this->model_app->topn($id)->num_rows();
					 $get_hitnum = $this->model_app->hitn($id)->num_rows();
					 $get_topn= $this->model_app->cove_five($id)->num_rows();
					 $get_hitn= $this->model_app->hit_five($id)->num_rows();
					 $get_topnine= $this->db->get_where('top_nine',['reviewerID'=>$id,'top_nine'=>'YES'])->num_rows();
					 $get_hitnine= $this->db->get_where('hit_nine',['reviewerID'=>$id,'hit_nine'=>'NO'])->num_rows();
					 $get_temp = $this->model_app->temp($id)->num_rows();
					 $get_htemp = $this->model_app->temp_hit($id)->num_rows();
					  $cove = $get_topn/$get_topnum ;
					  $cove_nine = $get_topnine/$get_topnum;
					  $hit = $get_hitn/$get_hitnum;
					  $hit_nine = $get_hitnine/$get_hitnum;
					 if($get_temp <= 0){
						 $in_temp = $this->model_app->in_temp($id,$num,$cove,$cove_nine);
					  }else{
						  $del = $this->model_app->del($id);
						  if($del){
							  $in_temp = $this->model_app->in_temp($id,$num,$cove,$cove_nine);
						  }
					  }
					  
					  if($get_htemp <= 0){
						 $in_temp = $this->model_app->in_htemp($id,$num,$hit,$hit_nine);
					  }else{
						  $del = $this->model_app->del_hit($id);
						  if($del){
							  $in_temp = $this->model_app->in_htemp($id,$num,$hit,$hit_nine);
						  }
					  }
					}
				}
				$get_sum = $this->model_app->sum_five_rd()->row();
				$get_sum_n = $this->model_app->sum_nine_rd()->row();
				$get_bnyk_user = $this->model_app->b_user_rd()->num_rows();
				
				$get_hsum = $this->model_app->hsum_five_rd()->row();
				$get_hsum_n = $this->model_app->hsum_nine_rd()->row();
				$get_hbnyk_user = $this->model_app->hb_user_rd()->num_rows();
				if($get_sum->cove_lima >0 and $get_sum_n->cove_nine>0){
				 $sum['sum_lima'] = round(($get_sum->cove_lima/$get_bnyk_user)*100);
				 $sum['sum_nine'] = round(($get_sum_n->cove_nine/$get_bnyk_user)*100);
				}else{
					$sum['sum_lima'] = 0;
					$sum['sum_nine'] = 0;
				}
				
				if($get_hsum->hit_lima >0 and $get_hsum_n->hit_nine>0){
				 $sum['hsum_lima'] = round(($get_hsum->hit_lima/$get_hbnyk_user)*100);
				 $sum['hsum_nine'] = round(($get_hsum_n->hit_nine/$get_hbnyk_user)*100);
				}else{
					$sum['hsum_lima'] = 0;
					$sum['hsum_nine'] = 0;
				}
				$this->theme->load('theme','test',$sum);
			}
			elseif($inpt==9){
				$user = $this->model_app->user()->result();
				foreach($user as $k ){
				$id = $k->reviewerID;
				 $num = $this->model_app->hasil_recom($id)->num_rows()."<br>";
				if($num==9 or $num==10){
					 $get_topnum = $this->model_app->topn($id)->num_rows();
					 $get_topn= $this->model_app->cove_five($id)->num_rows();
					 $get_topnine= $this->db->get_where('top_nine',['reviewerID'=>$id,'top_nine'=>'YES'])->num_rows();
					 $get_temp = $this->model_app->temp($id)->num_rows();
					  $cove = $get_topn/$get_topnum ;
					  $cove_nine = $get_topnine/$get_topnum;
					 if($get_temp <= 0){
						 $in_temp = $this->model_app->in_temp($id,$num,$cove,$cove_nine);
					  }else{
						  $del = $this->model_app->del($id);
						  if($del){
							  $in_temp = $this->model_app->in_temp($id,$num,$cove,$cove_nine);
						  }
					  }
					  
					  if($get_htemp <= 0){
						 $in_temp = $this->model_app->in_htemp($id,$num,$hit,$hit_nine);
					  }else{
						  $del = $this->model_app->del_hit($id);
						  if($del){
							  $in_temp = $this->model_app->in_htemp($id,$num,$hit,$hit_nine);
						  }
					  }
					}
				}
				$get_sum = $this->model_app->sum_five_fth()->row();
				$get_sum_n = $this->model_app->sum_nine_fth()->row();
				$get_bnyk_user = $this->model_app->b_user_fth()->num_rows();
				
				$get_hsum = $this->model_app->hsum_five_fth()->row();
				$get_hsum_n = $this->model_app->hsum_nine_fth()->row();
				$get_hbnyk_user = $this->model_app->hb_user_fth()->num_rows();
				if($get_sum->cove_lima >0 and $get_sum_n->cove_nine>0){
				 $sum['sum_lima'] = round(($get_sum->cove_lima/$get_bnyk_user)*100);
				 $sum['sum_nine'] = round(($get_sum_n->cove_nine/$get_bnyk_user)*100);
				}else{
					$sum['sum_lima'] = 0;
					$sum['sum_nine'] = 0;
				}
				if($get_hsum->hit_lima >0 and $get_hsum_n->hit_nine>0){
				 $sum['hsum_lima'] = round(($get_hsum->hit_lima/$get_hbnyk_user)*100);
				 $sum['hsum_nine'] = round(($get_hsum_n->hit_nine/$get_hbnyk_user)*100);
				}else{
					$sum['hsum_lima'] = 0;
					$sum['hsum_nine'] = 0;
				}
				$this->theme->load('theme','test',$sum);
			}
		}else{
			$this->theme->load('theme','test',$sum);
		}
		
	}
}