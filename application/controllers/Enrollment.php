<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Enrollment extends CI_Controller
{
    private $reportType;

    public function __construct()
    {
        parent::__construct();
        $this->reportType = 1;
        $this->load->helper('common_helper');
        $this->load->model('common');
    }

    public function index()
    {
        if (!in_array($this->session->userdata('user_level_8'), $this->common->csiUserRole())) {
            redirect('auth');
        }

        /** Datas */
        $data['title'] = 'Enrolment Report';
        $data['active_menu'] = 'enrollment';
        $data['showTable'] = $data['admin'] = false;

        $this->db->select_max('date');
        $query = $this->db->get('csi_branch_data');
        $result = $query->row();

        $data['user_id']=$this->session->userdata('user_id');
        $data['action']='805';
        $data['actionExcel']='807';

        savelogdata($data['action'],$data['user_id']);

        $data['maxdate'] = $this->common->getMaxDate();

        $data['project'] = $this->common->all('csi_project');
        $data['trend_indicator'] = $this->common->getIndicators($this->reportType);

        $customIndicator = $this->common->getFormulas();

        /**
         * User role
         */
        if ($this->session->userdata('user_level_8') == 274) {
            $data['divisiondata'] = $this->common->findRow('csi_division', 'id', $this->session->userdata('associated_id_8'));
            $data['divisionRows'] = $this->common->find('csi_division', 'project_id', $this->session->userdata('program_id_8'), 'division_name');
            $data['associateproject'] = $this->common->findRow('csi_project', 'id', $this->session->userdata('program_id_8'));
            $data['showTable'] = true;
        } elseif ($this->session->userdata('user_level_8') == 273) {
            $data['regiondata'] = $this->common->findRow('csi_region', 'id', $this->session->userdata('associated_id_8'));
            $data['regionRows'] = $this->common->find('csi_region', 'division_id', $data['regiondata']->division_id, 'region_name');
            $data['divisiondata'] = $data['associatedivision'] = $this->common->findRow('csi_division', 'id', $data['regiondata']->division_id);
            $data['associateproject'] = $this->common->findRow('csi_project', 'id', $this->session->userdata('program_id_8'));
            $data['showTable'] = true;
        } elseif ($this->session->userdata('user_level_8') == 272) {
            $data['areadata'] = $this->common->findRow('csi_area', 'id', $this->session->userdata('associated_id_8'));
            $data['areaRows'] = $this->common->find('csi_area', 'region_id', $data['areadata']->region_id, 'area_name');
            $data['regiondata'] = $data['associateregion'] = $this->common->findRow('csi_region', 'id', $data['areadata']->region_id);
            $data['regionRows'] = $this->common->find('csi_region', 'division_id', $data['regiondata']->division_id, 'region_name');
            $data['divisiondata'] = $data['associatedivision'] = $this->common->findRow('csi_division', 'id', $data['regiondata']->division_id);
            $data['associateproject'] = $this->common->findRow('csi_project', 'id', $this->session->userdata('program_id_8'));
            $data['showTable'] = true;
        } elseif ($this->session->userdata('user_level_8') == 271) {
            $data['branchdata'] = $this->common->findRow('csi_branch', 'branch_code', $this->session->userdata('associated_id_8'));
            $data['branchRows'] = $this->common->find('csi_branch', 'area_id', $data['branchdata']->area_id, 'branch_name');
            $data['areadata'] = $data['associatearea'] = $this->common->findRow('csi_area', 'id', $data['branchdata']->area_id);
            $data['areaRows'] = $this->common->find('csi_area', 'region_id', $data['areadata']->region_id, 'area_name');
            $data['regiondata'] = $data['associateregion'] = $this->common->findRow('csi_region', 'id', $data['areadata']->region_id);
            $data['regionRows'] = $this->common->find('csi_region', 'division_id', $data['regiondata']->division_id, 'region_name');
            $data['divisiondata'] = $data['associatedivision'] = $this->common->findRow('csi_division', 'id', $data['regiondata']->division_id);
            $data['associateproject'] = $this->common->findRow('csi_project', 'id', $this->session->userdata('program_id_8'));
            $data['showTable'] = true;
        } else {
            $data['admin'] = true;
        }

        if ($this->input->post('enroll-rep-submit')) {
            $data['showTable'] = true;
        }

        if ($this->input->post('prog_selector')) {
            $projectId = explode(',', $this->input->post('prog_selector'))[0];
            $projectCode = explode(',', $this->input->post('prog_selector'))[1];
        } else {
            $projectId = isset($data['associateproject']) ? $data['associateproject']->id : '';
            $projectCode = isset($data['associateproject']) ? $data['associateproject']->project_code : '';
        }

        $productCode = '';
        if (!empty($this->input->post('prod_selector'))):
            $productCode = $this->input->post('prod_selector');

            $productNos = $this->common->find('csi_product', 'product_master_id', $productCode);

            $productCodes = [];
            foreach ($productNos as $pn) {
                array_push($productCodes, $pn->product_no);
            }

            $procodes = count($productNos) ? " AND product_no IN ( ". implode(',', $productCodes) ." ) " : '';

        else:
            $productCode = $procodes = '';
        endif;

        /**
         * Processing data for the query
         */
        $divId = $this->input->post('enroll-rep-submit')
            ? $this->input->post('div_selector')
            : (isset($data['divisiondata']) ? $data['divisiondata']->id : '');
        $regId = $this->input->post('enroll-rep-submit')
            ? $this->input->post('reg_selector')
            : (isset($data['regiondata']) ? $data['regiondata']->id : '');
        $areaId = $this->input->post('enroll-rep-submit')
            ? $this->input->post('area_selector')
            : (isset($data['areadata']) ? $data['areadata']->id : '');
        $branchCode = $this->input->post('enroll-rep-submit')
            ? $this->input->post('branch_selector')
            : (isset($data['branchdata']) ? $data['branchdata']->branch_code : '');

        /**
         * For deselecting in the view page
         */
        if ($this->input->post('div_selector') == '') {
            unset($data['divisiondata']);
            unset($data['regiondata']);
            unset($data['regionRows']);
            unset($data['areadata']);
            unset($data['areaRows']);
            unset($data['branchdata']);
            unset($data['branchRows']);
        } elseif ($this->input->post('reg_selector') == '') {
            unset($data['regiondata']);
            unset($data['areadata']);
            unset($data['areaRows']);
            unset($data['branchdata']);
            unset($data['branchRows']);
        } elseif ($this->input->post('area_selector') == '') {
            unset($data['areadata']);
            unset($data['branchdata']);
            unset($data['branchRows']);
        } elseif ($this->input->post('branch_selector') == '') {
            unset($data['branchdata']);
        }

        if (!in_array($this->session->userdata('user_level_8'), [275, 276, 277, 278, 279, 280, 281, 282]) || $this->input->post('prog_selector')) {
            $data['projectdata'] = $this->common->findRow('csi_project', 'project_code', $projectCode);
        }

        $data['from'] = $this->input->post('from');
        $data['to'] = $this->input->post('to');

        $monthFrom = $this->input->post('from')
            ? date('Y-m-d', strtotime($this->input->post('from')))
            : date('Y-m', strtotime($data['maxdate'] . "-12 months"));
        $monthTo = $this->input->post('to')
            ? date('Y-m-d', strtotime($this->input->post('to')))
            : date('Y-m', strtotime($data['maxdate']));

        $start = (new DateTime($monthFrom))->modify('first day of this month');
        $end = (new DateTime($monthTo))->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 month');
        $period = new DatePeriod($start, $interval, $end);

        $data['monthlist'] = $data['project_master'] = [];

        foreach ($period as $dt) {
            array_push($data['monthlist'], $dt->format("M-Y"));
        }

        if ($productCode) {
            $data['productdata'] = $productCode ? $this->common->findRow('csi_product_master', 'id', $productCode) : '';
        }

        if (!in_array($this->session->userdata('user_level_8'), [275, 276, 277, 278, 279, 280, 281, 282]) || $this->input->post('prog_selector')) {
            $data['productRows'] = $this->common->find('csi_product_master', 'project_code', $projectCode, 'product_name');
        }

        if ($branchCode != '') { /** Search Operation by Branch Code, Project Code and Product Code */

            /**
             * @var object $data['branchdata']     Fetch selected Branch Row Data
             */
            $data['branchdata'] = $this->common->findRow('csi_branch', 'branch_code', $branchCode);

            /**
             * @var object $data['branchRows']     Fetch all Branch Rows Data
             */
            $data['branchRows'] = $this->common->find('csi_branch', 'area_id', $areaId, 'branch_name');

            /**
             * @var object $data['areadata']     Fetch selected Area Row Data
             */
            $data['areadata'] = $this->common->findRow('csi_area', 'id', $areaId);

            /**
             * @var object $data['areaRows']     Fetch all Area Rows Data
             */
            $data['areaRows'] = $this->common->find('csi_area', 'region_id', $regId, 'area_name');

            /**
             * @var object $data['regiondata']       Fetch selected Region Row Data
             */
            $data['regiondata'] = $this->common->findRow('csi_region', 'id', $regId);

            /**
             * @var object $data['regionRows']       Fetch all Region Rows Data
             */
            $data['regionRows'] = $this->common->find('csi_region', 'division_id', $divId, 'region_name');

            /**
             * @var object $data['divisiondata']     Fetch selected Division Row Data
             */
            $data['divisiondata'] = $this->common->findRow('csi_division', 'id', $divId);

            /**
             * @var object $data['divisionRows']     Fetch all Division Rows Data
             */
            $data['divisionRows'] = $this->common->find('csi_division', 'project_id', $projectId, 'division_name');

            $table = 'csi_branch_data';
            $condition = "branch_code = $branchCode AND project_code = $projectCode";
        } elseif ($areaId != '') { /** Search Operation by Area Id, Project Code and Product Code */

            /**
             * @var object $data['branchRows']       Fetch all Branch Rows Data
             * @var object $data['areadata']         Fetch selected Area Row Data
             * @var object $data['areaRows']         Fetch all Area Rows Data
             * @var object $data['regiondata']       Fetch selected Region Row Data
             * @var object $data['regionRows']       Fetch all Region Rows Data
             * @var object $data['divisiondata']     Fetch selected Division Row Data
             * @var object $data['divisionRows']     Fetch all Division Rows Data
             */
            $data['branchRows'] = $this->common->find('csi_branch', 'area_id', $areaId, 'branch_name');
            $data['areadata'] = $this->common->findRow('csi_area', 'id', $areaId);
            $data['areaRows'] = $this->common->find('csi_area', 'region_id', $regId, 'area_name');
            $data['regiondata'] = $this->common->findRow('csi_region', 'id', $regId);
            $data['regionRows'] = $this->common->find('csi_region', 'division_id', $divId, 'region_name');
            $data['divisiondata'] = $this->common->findRow('csi_division', 'id', $divId);
            $data['divisionRows'] = $this->common->find('csi_division', 'project_id', $projectId, 'division_name');

            $table = 'csi_area_data';
            $condition = "area_id = $areaId AND project_code = $projectCode";
        } elseif ($regId != '') { /** Search Operation by Region Id, Project Code and Product Code */

            /**
             * @var object $data['areaRows']         Fetch all Area Rows Data
             * @var object $data['regiondata']       Fetch selected Region Row Data
             * @var object $data['regionRows']       Fetch all Region Rows Data
             * @var object $data['divisiondata']     Fetch selected Division Row Data
             * @var object $data['divisionRows']     Fetch all Division Rows Data
             */
            $data['areaRows'] = $this->common->find('csi_area', 'region_id', $regId, 'area_name');
            $data['regiondata'] = $this->common->findRow('csi_region', 'id', $regId);
            $data['regionRows'] = $this->common->find('csi_region', 'division_id', $divId, 'region_name');
            $data['divisiondata'] = $this->common->findRow('csi_division', 'id', $divId);
            $data['divisionRows'] = $this->common->find('csi_division', 'project_id', $projectId, 'division_name');

            $table = 'csi_region_data';
            $condition = "region_id = $regId AND project_code = $projectCode";
        } elseif ($divId != '') { /** Search Operation by Division Id, Project Code and Product Code */

            /**
             * @var object $data['regionRows']       Fetch all Region Rows Data
             * @var object $data['divisiondata']     Fetch selected Division Row Data
             * @var object $data['divisionRows']     Fetch all Division Rows Data
             */
            $data['regionRows'] = $this->common->find('csi_region', 'division_id', $divId, 'region_name');
            $data['divisiondata'] = $this->common->findRow('csi_division', 'id', $divId);
            $data['divisionRows'] = $this->common->find('csi_division', 'project_id', $projectId, 'division_name');

            $table = 'csi_division_data';
            $condition = "division_id = $divId AND project_code = $projectCode";
        } elseif ($projectCode != '') {
            /**
             * @var object $data['divisionRows']     Fetch all Division Rows Data
             */
            $data['divisionRows'] = $this->common->find('csi_division', 'project_id', $projectId, 'division_name');

            $table = 'csi_project_data';
            $condition = "project_code = $projectCode";
        } else {
            $table = 'csi_project_data';
            $condition = '';
        }

        foreach ($data['trend_indicator'] as $i => $indicator) {
            $query = $datasource = $found = '';

            if (array_key_exists (trim($indicator->data_source), $customIndicator)) {
                $datasource = $customIndicator[trim($indicator->data_source)];
            } else {
                $datasource = "SUM($indicator->data_source)";
            }

            $and = ($condition == '' && $procodes == '') ? '' : 'AND';

            foreach ($period as $dt) {
                $dateForQuery = $dt->format('Y-m');
                $query .= "SELECT $datasource as total from $table WHERE $condition $procodes $and to_char(date, 'YYYY-mm') = '$dateForQuery' UNION ALL ";
            }

            $query = substr($query, 0, -11);

            $info = $this->db->query($query);

            $data['project_master'][] = $info->result();
        }

        $data['csiProject'] = $this->session->userdata('program_id_8');

        /** Assets */
        add_asset("css", 'global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css');
        add_asset("css", 'global/plugins/bootstrap-table/bootstrap-table.min.css');
        add_asset("css", 'custom/css/enrollment.css');
        add_assets('js', [
            'global/plugins/moment.min.js',
            'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
            'pages/scripts/components-date-time-pickers.min.js',
            'global/plugins/bootstrap-table/bootstrap-table.min.js',
            'custom/js/custom_datepicker.js',
            'custom/js/jspdf.min.js',
            'custom/js/enrollment.js'
        ]);

        /** Rendering Views */

        $this->load->view('common/header', $data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('enrollment/enrollment', $data);
        $this->load->view('common/footer', $data);
    }

    /**
     * Fetch CSI Product rows
     *
     * Fetch CSI Product rows according to the project code
     *
     * @param string $_GET['code']     Project Code
     *
     * @return JSON
     */
    public function getProduct()
    {
        if (!in_array($this->session->userdata('user_level_8'), $this->common->csiUserRole())) {
            redirect('auth');
        }

        $projectCode = $this->input->get('code');
        $rows = $this->common->find('csi_product_master', 'project_code', $projectCode, 'product_name');
        echo json_encode($rows);
    }

    /**
     * Fetch CSI Division rows
     *
     * Fetch CSI Division rows according to the project Id
     *
     * @param string $_GET['id']     Project Id
     *
     * @return JSON
     */
    public function getDivision()
    {
        if (!in_array($this->session->userdata('user_level_8'), $this->common->csiUserRole())) {
            redirect('auth');
        }

        $projectId = $this->input->get('id');
        $rows = $this->common->find('csi_division', 'project_id', $projectId, 'division_name');
        echo json_encode($rows);
    }

    /**
     * Fetch CSI Region rows
     *
     * Fetch CSI Region rows according to the division id
     *
     * @param string $_GET['id']     Division id
     *
     * @return JSON
     */
    public function getRegion()
    {
        if (!in_array($this->session->userdata('user_level_8'), $this->common->csiUserRole())) {
            redirect('auth');
        }

        $divisionId = $this->input->get('id');
        $rows = $this->common->find('csi_region', 'division_id', $divisionId, 'region_name');
        echo json_encode($rows);
    }

    /**
     * Fetch CSI Area rows
     *
     * Fetch CSI Area rows according to the region id
     *
     * @param string $_GET['id']     Region Id
     *
     * @return JSON
     */
    public function getArea()
    {
        if (!in_array($this->session->userdata('user_level_8'), $this->common->csiUserRole())) {
            redirect('auth');
        }

        $regionId = $this->input->get('id');
        $rows = $this->common->find('csi_area', 'region_id', $regionId, 'area_name');
        echo json_encode($rows);
    }

    /**
     * Fetch CSI Branch rows
     *
     * Fetch CSI Branch rows according to the area id
     *
     * @param string $_GET['id']     Area Id
     *
     * @return JSON
     */
    public function getBranch()
    {
        if (!in_array($this->session->userdata('user_level_8'), $this->common->csiUserRole())) {
            redirect('auth');
        }

        $areaId = $this->input->get('id');
        $rows = $this->common->find('csi_branch', 'area_id', $areaId, 'branch_name');
        echo json_encode($rows);
    }

}
