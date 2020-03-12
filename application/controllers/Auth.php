<?php 
defined('BASEPATH') or exit('No direct script access allowed');

/*
 * |==============================================================|
 * | Please DO NOT modify this information :                      |
 * |--------------------------------------------------------------|
 * | Author          : Susantokun
 * | Email           : admin@susantokun.com
 * | Filename        : Auth.php
 * | Instagram       : @susantokun
 * | Blog            : http://www.susantokun.com
 * | Info            : http://info.susantokun.com
 * | Demo            : http://demo.susantokun.com
 * | Youtube         : http://youtube.com/susantokun
 * | File Created    : Thursday, 12th March 2020 8:31:02 am
 * | Last Modified   : Thursday, 12th March 2020 8:33:33 am
 * |==============================================================|
 */

class Auth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Auth_model');
    }

    public function register()
    {
      $site = $this->Konfigurasi_model->listing();
      $data = array(
          'title'     => 'Register | '.$site['nama_website'],
          'favicon'   => $site['favicon'],
          'site'      => $site
      );
      $this->template->load('authentication/layout/template','authentication/register',$data);
    }

    public function check_register()
    {
      $site = $this->Konfigurasi_model->listing();
      $data = array(
          'title'     => 'Register | '.$site['nama_website'],
          'favicon'   => $site['favicon'],
          'site'      => $site
      );
      $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[50]');
      $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[50]');
      $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[20]');
      if ($this->form_validation->run() == false) {
        $this->template->load('authentication/layout/template','authentication/register',$data);
      }
      else {
        $this->Auth_model->reg();
        $this->session->set_flashdata('alert', '<p class="box-msg">
          <div class="info-box alert-success">
          <div class="info-box-icon">
          <i class="fa fa-check-circle"></i>
          </div>
          <div class="info-box-content" style="font-size:14">
          <b style="font-size: 20px">SUKSES</b><br>Pendaftaran berhasil, Anda sudah bisa login.</div>
          </div>
          </p>
        ');
        redirect('auth/register','refresh',$data);
      }
    }
  
}
