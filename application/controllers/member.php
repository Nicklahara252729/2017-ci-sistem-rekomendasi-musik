<?php
if(!defined('BASEPATH')) exit ('no file allowed');
class Member extends CI_Controller{
  function __construct(){
    parent::__construct();
    check_session();
  }

  public function index(){
    $hasil['new_song'] = $this->member_model->some_new_song()->result();
    $hasil['popular_song'] = $this->member_model->some_popular_song()->result();
    $this->template_umum->load('template_umum','member/index',$hasil);
  }

  public function tambah_rating(){
		if ($this->input->post('rating')!=''){
          $data = $this->member_model->get_amazon($this->input->post('id'))->row();
          if($data){
          $id   = $data->amazon_id;
	        $data = array('ID_User'=>$this->session->userdata('reviewer_id'),'Amazon_id'=>$id,'Nama_user'=>$this->session->userdata('nama'),'Rating'=>$this->input->post('rating'));
			    $check = $this->member_model->in_rate('rating', $data);
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
