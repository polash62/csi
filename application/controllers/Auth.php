<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->logout();
    }

    public function logout()
    {
        $this->session->unset_userdata('user_level_8');
        $this->session->unset_userdata('associated_id_8');
        $this->session->unset_userdata('program_id_8');
        $this->session->sess_destroy();

        redirect($this->config->item('trendxUrl'). '/dashboard/logout');
    }

}
