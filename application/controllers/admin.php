<?php
if(!defined('BASEPATH')) exit('no file allowed');
class Admin extends CI_Controller{
    function __construct(){
        parent::__construct();
        check_session();
    }

    public function index(){
        $this->template_admin->load('template_admin','admin/index');
    }

    public function kelola_akun(){
      $uri = $this->uri->segment(3);
      if($uri=='pencarian'){
        /*$keyword = $this->input->get('sch_akun');
        $hasil['sumdata']= $this->admin_model->cari_akun($keyword)->num_rows();
        $config['total_rows']= $this->admin_model->cari_akun($keyword)->num_rows();
        $this->load->library('pagination');
         $uri5 = $this->uri->segment(5);
         $uri4 = $this->uri->segment(4);
        if($uri4){
            $config['base_url'] = base_url().'admin/kelola_akun/pencarian/'.$uri4.'/';
        }else{
            $config['base_url'] = base_url().'admin/kelola_akun/pencarian/'.$keyword.'/';
        }
        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        $hasil['paging'] = $this->pagination->create_links();
        $page = 1;
        $page = $page==''?0:$page;
        $hasil['record'] = $this->admin_model->akun_paging($page,$config['per_page']);
        $this->template_admin->load('template_admin','admin/kelola_akun',$hasil);*/
        $keyword = strip_tags(trim($this->input->get('sch_akun')));
        $hasil['sumdata']= $this->admin_model->cari_akun($keyword)->num_rows();
        $hasil['record']= $this->admin_model->cari_akun($keyword);
        $this->template_admin->load('template_admin','admin/kelola_akun',$hasil);
      }else{
        $config['total_rows']= $this->admin_model->akun()->num_rows();
        $this->load->library('pagination');
        $config['base_url'] = base_url().'admin/kelola_akun/';
        $config['per_page'] = 50;
        $this->pagination->initialize($config);
        $result['paging'] = $this->pagination->create_links();
        $page = $this->uri->segment(3);
        $page = $page==''?0:$page;
        $result['record'] = $this->admin_model->akun_paging($page,$config['per_page']);
        $this->template_admin->load('template_admin','admin/kelola_akun',$result);
      }
    }

    public function kelola_music(){
      $uri = $this->uri->segment(3);
      if($uri=='pencarian'){
        /*$keyword = $this->input->get('sch_music');
        $hasil['sumdata']= $this->admin_model->cari_music($keyword)->num_rows();
        $config['total_rows']= $this->admin_model->cari_music($keyword)->num_rows();
        $this->load->library('pagination');
        $uri5 = $this->uri->segment(5);
        $uri4 = $this->uri->segment(4);
        if($uri4){
            $config['base_url'] = base_url().'admin/kelola_music/pencarian/'.$uri4.'/';
        }else{
            $config['base_url'] = base_url().'admin/kelola_music/pencarian/'.$keyword.'/';
        }
        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        $hasil['paging'] = $this->pagination->create_links();
        $page = 1;
        $page = $page==''?0:$page;
        $hasil['record'] = $this->admin_model->music_paging($page,$config['per_page']);
        $this->template_admin->load('template_admin','admin/kelola_music',$hasil);*/
        $keyword = strip_tags(trim($this->input->get('sch_music')));
        $hasil['sumdata']= $this->admin_model->cari_music($keyword)->num_rows();
        $hasil['record']= $this->admin_model->cari_music($keyword);
        $this->template_admin->load('template_admin','admin/kelola_music',$hasil);
      }else{
        $config['total_rows']= $this->admin_model->music()->num_rows();
        $this->load->library('pagination');
        $config['base_url'] = base_url().'admin/kelola_music/';
        $config['per_page'] = 50;
        $this->pagination->initialize($config);
        $result['paging'] = $this->pagination->create_links();
        $page = $this->uri->segment(3);
        $page = $page==''?0:$page;
        $result['record'] = $this->admin_model->music_paging($page,$config['per_page']);
        $this->template_admin->load('template_admin','admin/kelola_music',$result);
      }

    }

    public function pengujian_sistem(){
      $this->template_admin->load('template_admin','admin/pengujian_sistem');
    }
    public function logout(){
      $this->session->unset_userdata(['status_login','reviewer_id','nama','username','email','gender','tgl','status']);
      $des = $this->session->sess_destroy();
      redirect(site_url('general/login'));
    }

    public function hapus_akun(){
      $id = $this->uri->segment(3);
      $checked = $this->admin_model->hapus_akun($id);
      if($checked==TRUE){
        redirect(site_url('admin/kelola_akun'));
      }else{
        echo"fail";
      }
    }

    public function music_form(){
      $uri_4 = $this->uri->segment(4);
      if(isset($uri_4)){
        $result['data'] = $this->admin_model->selected_music($uri_4)->row();
        $this->template_admin->load('template_admin','admin/music_form',$result);
      }else{
        $this->template_admin->load('template_admin','admin/music_form');
      }

    }

    public function tambah_lagu(){
      $judul  = $this->input->post('judul_lagu');
      $artis  = $this->input->post('artis');
      $genre  = $this->input->post('genre');
      $tahun  = $this->input->post('tahun');
      $label = $this->input->post('label');
      $config['upload_path'] = './uploads/cover';
      $config['allowed_types'] = 'gif|jpg|png';
      $this->load->library('upload', $config);
      $n_upld = $this->upload->do_upload('cover');
      if($n_upld){
        $hasil = $this->upload->data();
        $name_img = $hasil['file_name'];
        $n_hsl = $this->admin_model->add_music($judul,$artis,$genre,$tahun,$label,$name_img);
          if($n_hsl==TRUE){
            redirect('admin/kelola_music');
          }else{
            echo"fail insert";
          }
        }else{
          echo "fail";
        }
      }

  public function hapus_music(){
    $uri_id = $this->uri->segment(3);
    $cord = $this->admin_model->take_music($uri_id)->row();
    $id = $cord->id;
    $n_hsldel = $this->admin_model->hps_music($id);
    if($n_hsldel==TRUE){
      redirect('admin/kelola_music');
    }else{
      echo"fail";
    }
  }

  public function edit_lagu(){
    $id     = $this->input->post('id');
    $judul  = $this->input->post('judul_lagu');
    $artis  = $this->input->post('artis');
    $genre  = $this->input->post('genre');
    $tahun  = $this->input->post('tahun');
    $label = $this->input->post('label');
    if($_FILES['cover']['name']!=''){
      $config['upload_path'] = './uploads/cover';
      $config['allowed_types'] = 'gif|jpg|png';
      $this->load->library('upload', $config);
      $n_uptd_music = $this->upload->do_upload('cover');
      if($n_uptd_music){
        $hasil = $this->upload->data();
        $name_cover = $hasil['file_name'];
        $n_gtt  = $this->admin_model->get_cover($id)->row();
        $n_hsl = $this->admin_model->update_music($judul,$artis,$genre,$tahun,$label,$name_cover,$id);
        $n_pict = $n_gtt->imUrl;
        if($n_hsl==TRUE){
          $unlink = unlink("uploads/cover/".$n_pict);
          redirect('admin/kelola_music');
        }else{
          echo"fail update";
        }
      }else{
        echo "totality fail";
      }
    }else{
          $n_hsl = $this->admin_model->update_music_sec($judul,$artis,$genre,$tahun,$label,$id);
      if($n_hsl==TRUE){
        redirect('admin/kelola_music');
      }else{
        echo"totality fail";
      }
    }
  }

  //=================================================================================================================================
  public function tester(){
    /*
    //---------------- step 1 ----------------
    $data1 = array(array(1,2,3),array(4,5,6));
    $data2 = array(array(7,8,9),array(10,11,12));
    $temp = array(4,5,6);
    array_push($data2, $temp);
    $temp = array(10,11,12);
    array_push($data2, $temp);
    echo "<p>Hasil penjumlahannya :</p>";
    echo "<table cellpadding='5' border='5'>";

    for($f=0;$f<=1;$f++){
      echo "<tr>";

      for($g=0;$g<=2;$g++){

      echo "<td>",($data1[$f][$g] + $data2[$f][$g]), "</td>";

      }
      print"</tr>";
    }
    echo "</table>";


    //------------------- step 2 ----------------------------------------
    $matriksA = array();
    $matriksB = array();
    //Matriks C untuk menyimpan hasil penjumlahan antara Matriks A dan B
    $matriksC = array();

    //inisialiasi jumlah baris dan kolom. Untuk penjumlahan matriks jumlah baris dan kolom kedua-dua matriksnya harus sama
    $baris = 2;
    $kolom = 2;
    //inisialisasi nilai masing-masing matriks A dan B
    $matriksA[0][0] = 2;
    $matriksA[0][1] = 3;
    $matriksA[1][0] = 1;
    $matriksA[1][1] = 2;
    $matriksB[0][0] = 4;
    $matriksB[0][1] = 2;
    $matriksB[1][0] = 1;
    $matriksB[1][1] = 2;

    for( $i = 0; $i < $baris; $i++ ) :
        for( $j = 0; $j < $kolom; $j++ ) :
            $matriksC[$i][$j] = $matriksA[$i][$j] + $matriksB[$i][$j];
        endfor;
    endfor;

    //Menampilkan hasil penjumlahan matriks yang telah disimpan di dalam Matriks C
    for( $i = 0; $i < $baris; $i++ ) :
        for( $j = 0; $j < $kolom; $j++ ) :
            echo $matriksC[$i][$j]."&nbsp;&nbsp;&nbsp";
        endfor;
        echo "
    ";
  endfor;


  $A = array();
    $A[0] = 3;
    $A[1] = 5;
    $A[2] = 1;
    $A[3] = 9;
    $A[4] = 8;
    $A[5] = 7;
    $A[6] = 7;
    $A[7] = 4;
    $A[8] = 3;

    $B = array();
    $B[0] = 3;
    $B[1] = 3;
    $B[2] = 3;
    $B[3] = 3;
    $B[4] = 3;
    $B[5] = 3;
    $B[6] = 3;
    $B[7] = 3;
    $B[8] = 3;

    $C = array();
    $C[0] = ($A[0]*$B[0])+($A[1]*$B[3])+($A[2]*$B[6]);
    $C[1] = ($A[0]*$B[1])+($A[1]*$B[4])+($A[2]*$B[7]);
    $C[2] = ($A[0]*$B[2])+($A[1]*$B[5])+($A[2]*$B[8]);
    $C[3] = ($A[3]*$B[0])+($A[4]*$B[3])+($A[5]*$B[6]);
    $C[4] = ($A[3]*$B[1])+($A[4]*$B[4])+($A[5]*$B[7]);
    $C[5] = ($A[3]*$B[2])+($A[4]*$B[5])+($A[5]*$B[8]);
    $C[6] = ($A[6]*$B[0])+($A[7]*$B[3])+($A[8]*$B[6]);
    $C[7] = ($A[6]*$B[1])+($A[7]*$B[4])+($A[8]*$B[7]);
    $C[8] = ($A[6]*$B[2])+($A[7]*$B[5])+($A[8]*$B[8]);
    ?>

    <table border="1" align="center" width="200" >
    <?php
    echo "<tr>";
    for($k=0; $k<=2; $k+=1)
    {
        echo "<td>$C[$k]</td>";
    }
    echo "</tr><tr>";
    for($k=3; $k<=5; $k+=1)
    {
         echo "<td>$C[$k]</td>";
    }
    echo "</tr><tr>";
    for($k=6; $k<=8; $k+=1)
    {
         echo "<td>$C[$k]</td>";
    }*/
    $num =  $this->admin_model->tester()->num_rows();
    $num_sec =  $this->admin_model->t_item()->num_rows();
    $ber = $this->admin_model->tester()->result();
    $num_sec =  $this->admin_model->t_item()->num_rows();
    $n=0;
    foreach ($ber as $key ) {
      $angka[$n] = $key->Rating;
      $n++;
    }
   //$angka = array();
      $no=0;

      echo "<table border=1>";
      for($i=0; $i <$num_sec; $i++){
           echo "<tr>";
           for($j=0; $j<$num_sec; $j++){
                 echo "<td>";
                 $angkabaru[$i][$j]=$angka[$no];
                 $angkabaru1[$j][$i]=$angkabaru[$i][$j];
                 echo $angkabaru[$i][$j];
                 echo "</td>";
                 $no++;
           }
      }
      echo "</table>";

      echo "Nilai Maksimal berdasarakan kolom: <br>";
      for($i=0; $i < 2; $i++){
           $jumlah[$i]=array_sum($angkabaru1[$i]);
           echo $jumlah[$i]. ",";
      }
  }

}
