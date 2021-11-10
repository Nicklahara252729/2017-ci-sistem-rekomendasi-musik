<?php
if(!defined('BASEPATH')) exit('no file allowed');
class General extends CI_Controller{
    function __construct(){
        parent::__construct();

    }

    public function index(){
      check_session_login();
      $hasil['new_song'] = $this->general_model->some_new_song()->result();
      $hasil['popular_song'] = $this->general_model->some_popular_song()->result();
      $this->template_umum->load('template_umum','public/index',$hasil);
    }

    public function login(){
      check_session_login();
        $this->template_umum->load('template_umum','public/portal');
    }
    public function register(){
      check_session_login();
        $this->template_umum->load('template_umum','public/portal');
    }
    public function preference(){
      check_session();
      $record['data'] = $this->general_model->preference()->row();
        $this->template_umum->load('template_umum','public/preference',$record);
    }
    public function pencarian(){
      check_session_login();
      $keyword = strip_tags(trim($this->input->get('sch_general')));
      $hasil['sumdata']= $this->general_model->cari_music($keyword)->num_rows();
      $hasil['record']= $this->general_model->cari_music($keyword);
      $this->template_umum->load('template_umum','public/index',$hasil);
    }

    public function lagu_baru(){
      check_session_login();
      $config['total_rows']= $this->general_model->new_song()->num_rows();
      $this->load->library('pagination');
      $config['base_url'] = base_url().'general/lagu_baru/';
      $config['per_page'] = 48;
      $this->pagination->initialize($config);
      $result['paging'] = $this->pagination->create_links();
      $page = $this->uri->segment(3);
      $page = $page==''?0:$page;
      $result['record_new_song'] = $this->general_model->new_song_page($page,$config['per_page']);
      $this->template_umum->load('template_umum','public/index',$result);
    }

    public function lagu_populer(){
      check_session_login();
      $hasil['popular'] = $this->member_model->popular_song_page()->result();
      $this->template_umum->load('template_umum','public/index',$hasil);
    }

    public function description(){
      check_session_login();
      $uri = $this->uri->segment(3);
      $up_view = $this->general_model->update_view($uri);
      $hasil['data'] = $this->general_model->description($uri)->row();
      $this->template_umum->load('template_umum','public/description',$hasil);
    }

    public function process_register(){
      $nama       = $this->input->post('nama');
      $username   = $this->input->post('username');
      $email      = $this->input->post('email');
      $password   = sha1($this->input->post('password'));
      $gender     = $this->input->post('gender');
      $tgl_lahir  = $this->input->post('tgl_lahir');
      if(isset($_POST['enter_register'])){
        $checked = $this->general_model->regis($nama,$username,$email,$password,$gender,$tgl_lahir);
        if($checked==TRUE){
          $checked = $this->general_model->login($username,$password);
          if($checked==1){
            $result = $this->general_model->take_sess($username,$password)->row();
    				$this->session->set_userdata(array('status_login'=>TRUE,'reviewer_id'=>$result->reviewerID,'nama'=>$result->Nama_user,'username'=>$result->Username,'email'=>$result->Email,'gender'=>$result->Gender,'tgl'=>$result->Tanggal_lahir,'status'=>$result->Status));
            $status= $this->session->userdata('status');
            redirect(site_url('general/preference'));
          }
        }else{
          echo"failed";
        }
      }else{
        echo"totality fail";
      }
    }

    public function process_login(){
      if(isset($_POST['enter_login'])){
        $user = $this->input->post('username_login');
        $pass = sha1($this->input->post('password_login'));
        $pass2 = $this->input->post('password_login');
        $remember = $this->input->post('remember');
        $checked = $this->general_model->login($user,$pass);
        if($checked==1){
          if(isset($remember)){
            //$key = random_string('alnum', 64);
                set_cookie('username', $user, (3600 * 24) * 30);
                set_cookie('password', $pass2, (3600 * 24) * 30);
          }else{
              delete_cookie('username');
              delete_cookie('password');
          }
          $result = $this->general_model->take_sess($user,$pass)->row();
  				$this->session->set_userdata(array('status_login'=>TRUE,'reviewer_id'=>$result->reviewerID,'nama'=>$result->Nama_user,'username'=>$result->Username,'email'=>$result->Email,'gender'=>$result->Gender,'tgl'=>$result->Tanggal_lahir,'status'=>$result->Status));
          $status= $this->session->userdata('status');
          if($status=='member'){
            redirect(site_url('member'));
          }elseif(site_url('admin')){
            redirect(site_url('admin'));
          }else{
            echo"fail";
          }
        }else{

          redirect(site_url('general/login'));
        }
      }else{
        check_session_login();
      }
    }

    public function genre(){
      check_session_login();
      $record['data'] = $this->general_model->genre()->result();
      $this->template_umum->load('template_umum','public/genre',$record);
    }

    public function genre_view(){
      check_session_login();
      $key = $this->uri->segment(3);
      $record = $this->general_model->genre_views($key);
      if($record){
        $hasil['data'] = $this->general_model->genre_views($key)->result();
        $hasil['root'] = $this->general_model->genre_views($key)->row();
        $hasil['num'] = $this->general_model->genre_views($key)->num_rows();
        $this->template_umum->load('template_umum','public/genre_view',$hasil);
      }else{
        echo"n";
      }
    }
    public function about(){
      check_session_login();
      $this->template_umum->load('template_umum','public/about');
    }


}
