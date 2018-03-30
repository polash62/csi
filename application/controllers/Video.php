<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common');
    }

    public function index() {
        if (!in_array($this->session->userdata('user_level_8'), $this->common->csiUserRole())) {
            redirect('auth');
        }
        /*** Data for view files***/
        $data['base_url'] = $this->config->item('base_url');
        $data['title'] = 'Video';
        $data['active_menu'] = 'video';
        $data['active_sub_menu'] = '';

        /** Assets */
        add_asset("css", 'custom/css/dashboard.css');
        add_asset("css", 'mCustomScrollbar/jquery.mCustomScrollbar.min.css');

        add_assets('js', [
            'mCustomScrollbar/jquery.mCustomScrollbar.min.js',
        ]);

        /** Rendering Views */
        $this->load->view('common/header', $data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('video', $data);
        $this->load->view('common/footer', $data);
    }

}

