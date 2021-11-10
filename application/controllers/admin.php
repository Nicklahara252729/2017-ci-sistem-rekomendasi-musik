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
  public function pengujian_sistem(){
    $lenght = $this->input->post('lenght');
    if($lenght!=''){

        $get_user = $this->admin_model->get_user()->result();
		      foreach($get_user as $k){
		          $id = $k->reviewerID;
        //---------- insert coverage -------------------
  		      $top_satu = $this->admin_model->top_satu($id);
  		      $cek_tsatu = $this->db->get_where('top_satu',['reviewerID'=>$id])->num_rows();
  		        if($cek_tsatu <=0){
  			           foreach($top_satu->result() as $rs){
  				               $rec_satu = $rs->recommend;
  				                   $ins = $this->admin_model->in_tsatu($id,$rec_satu);
  			                      }
  		        }else{
  			           foreach($top_satu->result() as $rs){
  				               $rec_satu = $rs->recommend;
  				                   $dels = $this->db->delete('top_satu',['reviewerID'=>$id]);
  				                     }
  			          foreach($top_satu->result() as $rs){
  				              $rec_satu = $rs->recommend;
  				                  $ins = $this->admin_model->in_tsatu($id,$rec_satu);
  			                     }
              }

          $top_tiga = $this->admin_model->top_tiga($id);
  		    $cek_ttiga = $this->db->get_where('top_tiga',['reviewerID'=>$id])->num_rows();
  		      if($cek_ttiga <=0){
  			         foreach($top_tiga->result() as $rt){
  				             $rec_tiga = $rt->recommend;
  				                 $int = $this->admin_model->in_ttiga($id,$rec_tiga);
  			                    }
  		      }else{
  			         foreach($top_tiga->result() as $rt){
  				             $rec_tiga = $rt->recommend;
  				             $delt = $this->db->delete('top_tiga',['reviewerID'=>$id]);
  				                  }
  			        foreach($top_tiga->result() as $rt){
  				            $rec_tiga = $rt->recommend;
  				            $int = $this->admin_model->in_ttiga($id,$rec_tiga);
  			                   }
            }

        $top_lima = $this->admin_model->top_lima($id);
  		  $cek_tlima = $this->db->get_where('top_lima',['reviewerID'=>$id])->num_rows();
  		    if($cek_tlima <=0){
  			       foreach($top_lima->result() as $rl){
  				           $rec_lima = $rl->recommend;
  				           $inl = $this->admin_model->in_tlima($id,$rec_lima);
  			              }
  		    }else{
  			       foreach($top_lima->result() as $rl){
  				           $rec_lima = $rl->recommend;
  				           $dell = $this->db->delete('top_lima',['reviewerID'=>$id]);
  				            }
  			      foreach($top_lima->result() as $rl){
  				          $rec_lima = $rl->recommend;
  				          $inl = $this->admin_model->in_tlima($id,$rec_lima);
  			             }
          }


        $top_tujuh = $this->admin_model->top_tujuh($id);
  		  $cek_ttujuh = $this->db->get_where('top_tujuh',['reviewerID'=>$id])->num_rows();
  		    if($cek_ttujuh <=0){
  			       foreach($top_tujuh->result() as $rtj){
  				           $rec_tujuh = $rtj->recommend;
  				           $intj = $this->admin_model->in_ttujuh($id,$rec_tujuh);
  			              }
  		    }else{
  			       foreach($top_tujuh->result() as $rtj){
  				          $rec_tujuh = $rtj->recommend;
  				          $deltj = $this->db->delete('top_tujuh',['reviewerID'=>$id]);
  				            }
  			       foreach($top_tujuh->result() as $rtj){
  				          $rec_tujuh = $rtj->recommend;
  				          $intj = $this->admin_model->in_ttujuh($id,$rec_tujuh);
  			             }
  		    }

        $top_sepuluh = $this->admin_model->top_sepuluh($id);
  		  $cek_tsepuluh = $this->db->get_where('top_sepuluh',['reviewerID'=>$id])->num_rows();
  		    if($cek_tsepuluh <=0){
  			       foreach($top_sepuluh->result() as $rsp){
  				           $rec_sepuluh = $rsp->recommend;
  				           $insp = $this->admin_model->in_tsepuluh($id,$rec_sepuluh);
  			              }
  		    }else{
  			       foreach($top_sepuluh->result() as $rsp){
  				           $rec_sepuluh = $rsp->recommend;
  				           $delsp = $this->db->delete('top_sepuluh',['reviewerID'=>$id]);
  				             }
  			      foreach($top_sepuluh->result() as $rsp){
  				          $rec_sepuluh = $rsp->recommend;
  				          $insp = $this->admin_model->in_tsepuluh($id,$rec_sepuluh);
  			             }
          }
          //---------- end insert coverage -------------------

          //---------- insert hit rate ----------------------
        $hit_satu = $this->admin_model->top_satu($id);
    		$cek_hsatu = $this->db->get_where('hit_satu',['reviewerID'=>$id])->num_rows();

    		  if($cek_hsatu <=0){
    			     foreach($hit_satu->result() as $rhs){
    				         $rec_hs = $rhs->recommend;
    				         $inhs = $this->admin_model->in_hsatu($id,$rec_hs);
    			            }
    		  }else{
    			   foreach($hit_satu->result() as $rhs){
    				       $rec_hs = $rhs->recommend;
    				       $delhs = $this->db->delete('hit_satu',['reviewerID'=>$id]);
    				         }
    			  foreach($hit_satu->result() as $rhs){
    				       $rec_hs = $rhs->recommend;
    				       $inhs = $this->admin_model->in_hsatu($id,$rec_hs);
    			          }
    		  }

        $hit_tiga = $this->admin_model->top_tiga($id);
    		$cek_htiga = $this->db->get_where('hit_tiga',['reviewerID'=>$id])->num_rows();
    		  if($cek_htiga <=0){
    			     foreach($hit_tiga->result() as $rht){
    				         $rec_ht = $rht->recommend;
    				         $inht = $this->admin_model->in_htiga($id,$rec_ht);
    			            }
    		  }else{
    			     foreach($hit_tiga->result() as $rht){
    				         $rec_ht = $rht->recommend;
    				         $delht = $this->db->delete('hit_tiga',['reviewerID'=>$id]);
    				          }
    			    foreach($hit_tiga->result() as $rht){
    				        $rec_ht = $rht->recommend;
    				        $inht = $this->admin_model->in_htiga($id,$rec_ht);
    			            }
          }


        $hit_lima = $this->admin_model->top_lima($id);
    		$cek_hlima = $this->db->get_where('hit_lima',['reviewerID'=>$id])->num_rows();
    		  if($cek_hlima <=0){
    			     foreach($hit_lima->result() as $rhl){
    				         $rec_hl = $rhl->recommend;
    				        $inhl = $this->admin_model->in_hlima($id,$rec_hl);
    			           }
    		  }else{
    			     foreach($hit_lima->result() as $rhl){
    				         $rec_hl = $rhl->recommend;
    				             $delhl = $this->db->delete('hit_lima',['reviewerID'=>$id]);
    				        }
    			     foreach($hit_lima->result() as $rhl){
    				         $rec_hl = $rht->recommend;
    				             $inhl = $this->admin_model->in_hlima($id,$rec_hl);
    			                }
    		  }

        $hit_tujuh = $this->admin_model->top_tujuh($id);
    		$cek_htujuh = $this->db->get_where('hit_tujuh',['reviewerID'=>$id])->num_rows();
    		  if($cek_htujuh <=0){
    			     foreach($hit_tujuh->result() as $rhtj){
    				         $rec_htj = $rhtj->recommend;
    				             $inhtj = $this->admin_model->in_htujuh($id,$rec_htj);
    			                }
    		  }else{
    			       foreach($hit_tujuh->result() as $rhtj){
    				           $rec_htj = $rhtj->recommend;
    				              $delhtj = $this->db->delete('hit_tujuh',['reviewerID'=>$id]);
    				                }
    			       foreach($hit_tujuh->result() as $rhtj){
    				           $rec_htj = $rhtj->recommend;
    				          $inhtj = $this->admin_model->in_htujuh($id,$rec_htj);
    			             }
    		  }

        $hit_sepuluh = $this->admin_model->top_sepuluh($id);
    		$cek_hsepuluh = $this->db->get_where('hit_sepuluh',['reviewerID'=>$id])->num_rows();
    		  if($cek_hsepuluh <=0){
    			     foreach($hit_sepuluh->result() as $rhsp){
    				         $rec_hsp = $rhsp->recommend;
    				             $inhsp = $this->admin_model->in_hsepuluh($id,$rec_hsp);
    			                }
    		  }else{
    			     foreach($hit_sepuluh->result() as $rhtj){
    				         $rec_hsp = $rhtj->recommend;
    				             $delhsp = $this->db->delete('hit_sepuluh',['reviewerID'=>$id]);
    				               }
    			     foreach($hit_sepuluh->result() as $rhtj){
    				         $rec_hsp = $rhtj->recommend;
    				             $inhsp = $this->admin_model->in_hsepuluh($id,$rec_hsp);
    			                }
    		   }
    //---------- end insert hit rate ----------------------
	     }

    //---------- testing sistem ----------------------------

				$user = $this->admin_model->get_user()->result();
				foreach($user as $k ){
				$idu = $k->reviewerID;
				   $num = $this->admin_model->hasil_recom($idu)->num_rows();
           if($num!=0){
					  $get_topnum = $this->admin_model->topn($idu)->num_rows();
					 $get_hitnum = $this->admin_model->hitn($idu)->num_rows();
					 $get_topn= $this->admin_model->cove_satu($idu)->num_rows();
            $get_toptiga= $this->db->get_where('top_tiga',['reviewerID'=>$idu,'top_tiga'=>'YES'])->num_rows();
            $get_toplima= $this->db->get_where('top_lima',['reviewerID'=>$idu,'top_lima'=>'YES'])->num_rows();
            $get_toptujuh= $this->db->get_where('top_tujuh',['reviewerID'=>$idu,'top_tujuh'=>'YES'])->num_rows();
            $get_topsepuluh= $this->db->get_where('top_sepuluh',['reviewerID'=>$idu,'top_sepuluh'=>'YES'])->num_rows();
					 $get_hitn= $this->admin_model->hit_satu($idu)->num_rows();
					 $get_hittiga= $this->db->get_where('hit_tiga',['reviewerID'=>$idu,'hit_tiga'=>'NO'])->num_rows();
            $get_hitlima= $this->db->get_where('hit_lima',['reviewerID'=>$idu,'hit_lima'=>'NO'])->num_rows();
            $get_hittujuh= $this->db->get_where('hit_tujuh',['reviewerID'=>$idu,'hit_tujuh'=>'NO'])->num_rows();
            $get_hitsepuluh= $this->db->get_where('hit_sepuluh',['reviewerID'=>$idu,'hit_sepuluh'=>'NO'])->num_rows();
					 $get_temp = $this->admin_model->temp($idu)->num_rows();
					 $get_htemp = $this->admin_model->temp_hit($idu)->num_rows();
					  $cove = $get_topn/ $get_topnum ;
					  $cove_tiga = $get_toptiga/$get_topnum;
            $cove_lima = $get_toplima/$get_topnum;
            $cove_tujuh = $get_toptujuh/$get_topnum;
            $cove_sepuluh = $get_topsepuluh/$get_topnum;
					  $hit = $get_hitn/$get_hitnum;
					  $hit_tiga = $get_hittiga/$get_hitnum;
            $hit_lima = $get_hitlima/$get_hitnum;
            $hit_tujuh = $get_hittujuh/$get_hitnum;
            $hit_sepuluh = $get_hitsepuluh/$get_hitnum;
					 if($get_temp <= 0){
						 $in_temp = $this->admin_model->in_temp($idu,$num,$cove,$cove_tiga,$cove_lima,$cove_tujuh,$cove_sepuluh);
					  }
					  if($get_htemp <= 0){
						 $in_temp = $this->admin_model->in_htemp($idu,$num,$hit,$hit_tiga,$hit_lima,$hit_tujuh,$hit_sepuluh);
           }
         }

				}
				$get_sum = $this->admin_model->sum_satu($lenght)->row();
				$get_sum_tiga = $this->admin_model->sum_tiga($lenght)->row();
        $get_sum_lima = $this->admin_model->sum_lima($lenght)->row();
        $get_sum_tujuh = $this->admin_model->sum_tujuh($lenght)->row();
        $get_sum_sepuluh = $this->admin_model->sum_sepuluh($lenght)->row();
				$get_bnyk_user = $this->admin_model->b_user_sc($lenght)->num_rows();

				$get_hsum = $this->admin_model->hsum_satu($lenght)->row();
				$get_hsum_tiga = $this->admin_model->hsum_tiga($lenght)->row();
        $get_hsum_lima = $this->admin_model->hsum_lima($lenght)->row();
        $get_hsum_tujuh = $this->admin_model->hsum_tujuh($lenght)->row();
        $get_hsum_sepuluh = $this->admin_model->hsum_sepuluh($lenght)->row();
				$get_hbnyk_user = $this->admin_model->hb_user_sc($lenght)->num_rows();
				if($get_sum->cove_satu >0 and $get_sum_tiga->cove_tiga>0){
				 $sum['sum_satu'] = round(($get_sum->cove_satu/$get_bnyk_user)*100);
				 $sum['sum_tiga'] = round(($get_sum_tiga->cove_tiga/$get_bnyk_user)*100);
         $sum['sum_lima'] = round(($get_sum_lima->cove_lima/$get_bnyk_user)*100);
         $sum['sum_tujuh'] = round(($get_sum_tujuh->cove_tujuh/$get_bnyk_user)*100);
         $sum['sum_sepuluh'] = round(($get_sum_sepuluh->cove_sepuluh/$get_bnyk_user)*100);
				}else{
					$sum['sum_satu'] = 0;
					$sum['sum_tiga'] = 0;
					$sum['sum_lima'] = 0;
					$sum['sum_tujuh'] = 0;
					$sum['sum_sepuluh'] = 0;
				}

				if($get_hsum->hit_satu >0 and $get_hsum_tiga->hit_tiga>0){
				 $sum['hsum_satu'] = round(($get_hsum->hit_satu/$get_hbnyk_user)*100);
				 $sum['hsum_tiga'] = round(($get_hsum_tiga->hit_tiga/$get_hbnyk_user)*100);
				 $sum['hsum_lima'] = round(($get_hsum_lima->hit_lima/$get_hbnyk_user)*100);
				 $sum['hsum_tujuh'] = round(($get_hsum_tujuh->hit_tujuh/$get_hbnyk_user)*100);
				 $sum['hsum_sepuluh'] = round(($get_hsum_sepuluh->hit_sepuluh/$get_hbnyk_user)*100);
				}else{
					$sum['hsum_satu'] = 0;
					$sum['hsum_tiga'] = 0;
					$sum['hsum_lima'] = 0;
					$sum['hsum_tujuh'] = 0;
					$sum['hsum_sepuluh'] = 0;
				}$this->template_admin->load('template_admin','admin/pengujian_sistem',$sum);

    //---------- end testing sistem -----------------------

      }
      else{
          $this->template_admin->load('template_admin','admin/pengujian_sistem');
      }
  }
}
