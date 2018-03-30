<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('common_helper');
        $this->load->model('common');
    }

    public function index()
    {
        $data['base_url'] = $this->config->item('base_url');
        $data['title'] = 'Dashboard';
        $data['active_menu'] = 'dashboard';


        /** Session */
        if (base64_decode(urldecode($this->input->get('user_level_8')))) {
            $this->session->set_userdata('user_level_8', base64_decode(urldecode($this->input->get('user_level_8'))));
            $this->session->set_userdata('associated_id_8', base64_decode(urldecode($this->input->get('associated_id_8'))));
            $this->session->set_userdata('program_id_8', base64_decode(urldecode($this->input->get('program_id_8'))));
            $this->session->set_userdata('user_id', base64_decode(urldecode($this->input->get('user_id'))));
        }
        
        
        if (!in_array($this->session->userdata('user_level_8'), $this->common->csiUserRole())) {
            redirect('auth');
        }

        savelogdata("801",$this->session->userdata('user_id'));


        /**
         * Project with project code
         */
        $dabi_project_code = 15;
        $bcup_project_code = 279;
        $progoti_project_code = 60;
        $ncdp_project_code = 104;
        $scdp_project_code = 351;

        $enrollmentInd = [
            0 => [
                'indicator' => 'No. of loan disbursed',
                'data_source' => 'csi_product_apidata.loan_disbursed', //will change come from trendx
                'sum' => true,
                'table' => 'csi_product_apidata',
                'psr' => false
            ],
            1 => [
                'indicator' => 'Total no. of policies',
                'data_source' => 'csi_project_data.xy1',
                'sum' => true,
                'table' => 'csi_project_data',
                'psr' => false
            ],
            2 => [
                'indicator' => 'Policy success rate',
                'data_source' => '(SUM(xy1)/(SELECT SUM(loan_disbursed) FROM csi_product_apidata))*100', //will change
                'sum' => false,
                'table' => 'csi_project_data',
                'psr' => true
            ]
        ];

        $policyType = [
            0 => [
                'indicator' => 'Total no. of polices',
                'data_source' => 'csi_project_data.xy1',
                'sum' => true
            ],
            1 => [
                'indicator' => 'No. of single policies',
                'data_source' => 'csi_project_data.xy2',
                'sum' => true
            ],
            2 => [
                'indicator' => 'No. of dual policies',
                'data_source' => 'csi_project_data.xy3',
                'sum' => true
            ],
            3 => [
                'indicator' => 'Single policy success rate',
                'data_source' => '(sum(csi_project_data.xy2::decimal)/sum(NULLIF(csi_project_data.xy1,0)))*100',
                'sum' => false
            ],
            4 => [
                'indicator' => 'Dual policy success rate',
                'data_source' => '(sum(csi_project_data.xy3::decimal)/sum(NULLIF(csi_project_data.xy1,0)))*100',
                'sum' => false
            ]
        ];

        $premiumInd = [
            0 => [
                'indicator' => 'Total premium amount',
                'data_source' => 'csi_project_data.xy51',
                'sum' => true
            ],
            1 => [
                'indicator' => 'Amount of single policies premium',
                'data_source' => 'csi_project_data.xy53',
                'sum' => true
            ],
            2 => [
                'indicator' => 'Amount of dual policies premium',
                'data_source' => 'csi_project_data.xy54',
                'sum' => true
            ],
            3 => [
                'indicator' => 'Single to Total Premium Amount %',
                'data_source' => '(sum(csi_project_data.xy53)/sum(NULLIF(csi_project_data.xy51, 0)))*100',
                'sum' => false
            ],
            4 => [
                'indicator' => 'Dual to Total Premium Amount %',
                'data_source' => '(sum(csi_project_data.xy54)/sum(NULLIF(csi_project_data.xy51, 0)))*100',
                'sum' => false
            ]
        ];

        $claimInd = [
            0 => [
                'indicator' => 'Total No. of claims',
                'data_source' => 'xy101',
                'sum' => true
            ],
            1 => [
                'indicator' => 'Claim Amount',
                'data_source' => 'xy108',
                'sum' => true
            ],
            2 => [
                'indicator' => 'Earned Premium Amount',
                'data_source' => 'xy57',
                'sum' => true
            ],
            3 => [
                'indicator' => 'Claim to Earned Premium %',
                'data_source' => 'xy110',
                'sum' => true
            ],
            4 => [
                'indicator' => 'Average Claim Amount',
                'data_source' => 'sum(xy108)/sum(NULLIF(xy101, 0))',
                'sum' => false
            ]
        ];

        $monthTo = $this->db
            ->select('date')
            ->from('csi_branch_data')
            ->order_by('date', 'DESC')
            ->limit(1)
            ->get()
            ->row()
            ->date;

        $monthTo = date('Y-m-d', strtotime($monthTo));
        $monthFrom = date('Y-m-d', strtotime($monthTo . " -12 month"));

        $start = (new DateTime($monthFrom))->modify('first day of this month');
        $end = (new DateTime($monthTo))->modify('first day of next month');

        $interval = DateInterval::createFromDateString('1 month');
        $period = new DatePeriod($start, $interval, $end);
        $data['monthlist'] = [];

        foreach ($period as $dt) {
            array_push($data['monthlist'], $dt->format("M-y"));
        }

        /**
         * Indicators
         */
        $data['enrollmentInd'] = $enrollmentInd;
        $data['policyType'] = $policyType;
        $data['premiumInd'] = $premiumInd;
        $data['claimInd'] = $claimInd;

        /**
         * Global
         */
        $data['global_enrollment_data'] = $this->getPolicyEnrollmentData($enrollmentInd, $period);
        $data['global_policytype_data'] = $this->getData($policyType, $period);
        $data['global_premium_data'] = $this->getData($premiumInd, $period);
        $data['global_claim_data'] = $this->getData($claimInd, $period);

        /**
         * Dabi
         */
        $data['dabi_enrollment_data'] = $this->getPolicyEnrollmentData($enrollmentInd, $period, $dabi_project_code);
        $data['dabi_policytype_data'] = $this->getData($policyType, $period, $dabi_project_code);
        $data['dabi_premium_data'] = $this->getData($premiumInd, $period, $dabi_project_code);
        $data['dabi_claim_data'] = $this->getData($claimInd, $period, $dabi_project_code);

        /**
         * BCUP
         */
        $data['bcup_enrollment_data'] = $this->getPolicyEnrollmentData($enrollmentInd, $period, $bcup_project_code);
        $data['bcup_policytype_data'] = $this->getData($policyType, $period, $bcup_project_code);
        $data['bcup_premium_data'] = $this->getData($premiumInd, $period, $bcup_project_code);
        $data['bcup_claim_data'] = $this->getData($claimInd, $period, $bcup_project_code);

        /**
         * Progoti
         */
        $data['progoti_enrollment_data'] = $this->getPolicyEnrollmentData($enrollmentInd, $period, $progoti_project_code);
        $data['progoti_policytype_data'] = $this->getData($policyType, $period, $progoti_project_code);
        $data['progoti_premium_data'] = $this->getData($premiumInd, $period, $progoti_project_code);
        $data['progoti_claim_data'] = $this->getData($claimInd, $period, $progoti_project_code);

        /**
         * NCDP
         */
        $data['ncdp_enrollment_data'] = $this->getPolicyEnrollmentData($enrollmentInd, $period, $ncdp_project_code);
        $data['ncdp_policytype_data'] = $this->getData($policyType, $period, $ncdp_project_code);
        $data['ncdp_premium_data'] = $this->getData($premiumInd, $period, $ncdp_project_code);
        $data['ncdp_claim_data'] = $this->getData($claimInd, $period, $ncdp_project_code);

        /**
         * SCDP
         */
        $data['scdp_enrollment_data'] = $this->getPolicyEnrollmentData($enrollmentInd, $period, $scdp_project_code);
        $data['scdp_policytype_data'] = $this->getData($policyType, $period, $scdp_project_code);
        $data['scdp_premium_data'] = $this->getData($premiumInd, $period, $scdp_project_code);
        $data['scdp_claim_data'] = $this->getData($claimInd, $period, $scdp_project_code);

        /**
         * Assets
         */
        add_asset("css", 'custom/css/dashboard.css');
        add_asset("css", 'mCustomScrollbar/jquery.mCustomScrollbar.min.css');
        add_assets('js', [
            'highChart/highcharts.js',
            'highChart/exporting.js',
            'mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js',
            'custom/js/dashboard.js'
        ]);

        /**
         * Rendering Views
         *
         */



        $this->load->view('common/header', $data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('dashboard/dashboard', $data);
        $this->load->view('common/footer', $data);
        $this->load->view('dashboard/graphjs', $data);
    }

    private function getData($ind, $period, $projectcode = false)
    {
        if (!in_array($this->session->userdata('user_level_8'), $this->common->csiUserRole())) {
            redirect('auth');
        }

        $data['data'] = [];

        for ($i = 0; $i < sizeof($ind); $i++) {
            $query = '';
            $data_source = $ind[$i]['sum'] ? "SUM(" . $ind[$i]['data_source'] . ")" : $ind[$i]['data_source'];

            $projectCodeFilter = $projectcode ? " AND project_code = $projectcode" : '';

            foreach ($period as $dt) {
                $dateForQuery = $dt->format('Y-m');
                $query .= "SELECT $data_source as total from csi_project_data WHERE to_char(date, 'YYYY-mm') = '$dateForQuery' $projectCodeFilter UNION ALL ";
            }

            $query = substr($query, 0, -11);
            $info = $this->db->query($query);
            $data['data'][] = $info->result();
        }

        return $data['data'];
    }

    private function getPolicyEnrollmentData($ind, $period, $projectcode = false)
    {
        if (!in_array($this->session->userdata('user_level_8'), $this->common->csiUserRole())) {
            redirect('auth');
        }

        $data['data'] = [];

        for ($i = 0; $i < sizeof($ind); $i++) {
            $query = '';
            $data_source = $ind[$i]['sum'] ? "SUM(" . $ind[$i]['data_source'] . ")" : $ind[$i]['data_source'];
            $table = $ind[$i]['table'];

            $projectCodeFilter = $projectcode ? " AND project_code = $projectcode" : '';

            foreach ($period as $dt) {
                $dateForQuery = $dt->format('Y-m');

                if (!$ind[$i]['psr']) {
                    $query .= "SELECT $data_source as total from $table WHERE to_char(date, 'YYYY-mm') = '$dateForQuery' $projectCodeFilter UNION ALL ";
                } else {
                    $query .= "SELECT (SUM(xy1)/(SELECT SUM(loan_disbursed) FROM csi_product_apidata WHERE to_char(date, 'YYYY-mm') = '$dateForQuery' $projectCodeFilter))*100 as total 
FROM $table 
WHERE to_char(date, 'YYYY-mm') = '$dateForQuery' $projectCodeFilter UNION ALL ";
                }
            }

            $query = substr($query, 0, -11);
            $info = $this->db->query($query);
            $data['data'][] = $info->result();
        }

        return $data['data'];
    }
    public function savelogdata()
    {
        $user_id=$this->input->post('user_id');
        $action=$this->input->post('action');
        var_dump($user_id);
        var_dump($action);
        savelogdata("$action",$user_id);
    }

}
