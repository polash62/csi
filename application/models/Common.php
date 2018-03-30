<?php

class Common extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function all($table)
    {
        return $this->db
            ->get($table)
            ->result();
    }

    public function find($table, $col, $val, $orderBy = false)
    {
        $this->db
            ->select('*')
            ->where($col, $val);

        if ($orderBy) {
            $this->db
                ->order_by($orderBy, 'ASC');
        }

        return $this->db
            ->get($table)
            ->result();
    }

    public function findWithTwo($table, $col1, $val1, $col2, $val2, $orderBy = false)
    {
        $this->db
            ->select('*')
            ->where($col1, $val1)
            ->where($col2, $val2);

        if ($orderBy) {
            $this->db
                ->order_by($orderBy, 'ASC');
        }

        return $this->db
            ->get($table)
            ->result();
    }

    public function findRowWithTwo($table, $col1, $val1, $col2, $val2, $orderBy = false)
    {
        $this->db
            ->select('*')
            ->where($col1, $val1)
            ->where($col2, $val2);

        if ($orderBy) {
            $this->db
                ->order_by($orderBy, 'ASC');
        }

        return $this->db
            ->get($table)
            ->row();
    }

    public function findWithThree($table, $col1, $val1, $col2, $val2, $col3, $val3, $orderBy = false)
    {
        $this->db
            ->select('*')
            ->where($col1, $val1)
            ->where($col2, $val2)
            ->where($col3, $val3);

        if ($orderBy) {
            $this->db
                ->order_by($orderBy, 'ASC');
        }

        return $this->db
            ->get($table)
            ->result();
    }

    public function findRowWithThree($table, $col1, $val1, $col2, $val2, $col3, $val3, $orderBy = false)
    {
        $this->db
            ->select('*')
            ->where($col1, $val1)
            ->where($col2, $val2)
            ->where($col3, $val3);

        if ($orderBy) {
            $this->db
                ->order_by($orderBy, 'ASC');
        }

        return $this->db
            ->get($table)
            ->row();
    }

    public function findRow($table, $col, $val)
    {
        $this->db
            ->select('*')
            ->where($col, $val);

        return $this->db
            ->get($table)
            ->row();
    }

    public function findWhereIn($table, $col, $val, $orderBy = false)
    {
        $this->db
            ->select('*')
            ->where_in($col, $val);

        if ($orderBy) {
            $this->db
                ->order_by($orderBy, 'ASC');
        }

        return $this->db
            ->get($table)
            ->result();
    }

    public function getIndicators($rType)
    {
        return $this->db
            ->select('csi_trend_indicatordetails.*')
            ->from('csi_trend_indicatordetails')
            ->join('csi_trend_indicatormaster', 'csi_trend_indicatormaster.id = csi_trend_indicatordetails.indicatormaster_id', 'inner')
            ->where('csi_trend_indicatormaster.report_type', $rType)
            ->order_by('csi_trend_indicatordetails.order_by', 'ASC')
            ->get()
            ->result();
    }

    public function getDetailIndicators($rType)
    {
        return $this->db
            ->select('csi_detail_indicatordetails.*')
            ->select('csi_detail_indicatormaster.indicatormaster_name')
            ->from('csi_detail_indicatordetails')
            ->join('csi_detail_indicatormaster', 'csi_detail_indicatordetails.indicatormaster_id = csi_detail_indicatormaster.id')
            ->where('csi_detail_indicatormaster.report_type', $rType)
            ->order_by('csi_detail_indicatordetails.order_by', 'ASC')
            ->get()
            ->result();
    }

    public function getMaxDate()
    {
        return $this->db
            ->select_max('date')
            ->get('csi_branch_data')
            ->row()
            ->date;
    }

    public function distinctValue($col, $updatedCol, $table)
    {
        return $this->db
            ->select($col.' as '.$updatedCol)
            ->from($table)
            ->where($col.' !=', null)
            ->distinct()
            ->get()
            ->result();
    }

    public function getLoanDuration($col, $updatedCol, $table)
    {
        return $this->db
            ->select($col.' as '.$updatedCol)
            ->from($table)
            ->where($col.' !=', null)
            ->where('t !=', null)
            ->or_where('y !=', null)
            ->distinct()
            ->get()
            ->result();
    }

    public function csiUserRole()
    {
        return [271, 272, 273, 274, 275, 276, 277, 278, 279, 280, 281, 282];
    }

    public function getFormulas()
    {
        return [
            'xy5'   => '(sum(xy1::decimal)/sum(NULLIF(tx1,0)))*100',
            'xy6'   => '(sum(xy2::decimal)/sum(NULLIF(xy1,0)))*100',
            'xy7'   => '(sum(xy3::decimal)/sum(NULLIF(xy1,0)))*100',
            'xy9'   => '(sum(xy8::decimal)/sum(NULLIF(xy1,0)))',
            'xy14'  => '(sum(xy12::decimal)/sum(NULLIF(xy1,0)))*100',
            'xy15'  => '(sum(xy13::decimal)/sum(NULLIF(xy1,0)))*100',
            'xy102' => '(sum(xy101::decimal)/sum(NULLIF(xy1,0)))*100',
            'xy110' => 'sum((xy108 + xy109)::decimal)/sum(NULLIF(xy57, 0))',
            'xy116' => '(sum(xy114::decimal)/sum((NULLIF(xy114, 0)+NULLIF(xy115, 0))))*100',
            'xy117' => '(sum(xy115::decimal)/sum((NULLIF(xy114, 0)+NULLIF(xy115, 0))))*100',
            'xy111' => 'sum((xy108 + xy109)::decimal)/sum(NULLIF(xy57, 0))'
        ];
    }

    public function callApi($method, $url, $data = false)
    {
        $curl = curl_init();

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data) {
                    $url = sprintf("%s?%s", $url, http_build_query($data));
                }
        }

        /** Optional Authentication: */
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "username:password");

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        if (!curl_errno($curl)) {
            $result = json_decode($result);
            $result = json_encode($result, JSON_PRETTY_PRINT);
        }

        curl_close($curl);
        return $result;
    }
}
