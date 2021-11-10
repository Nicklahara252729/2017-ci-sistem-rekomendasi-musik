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
}
