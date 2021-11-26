<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Globalmodel extends CI_Model {

    public function ca_get_list($table, $where) {

        if ($where) {
            $this->db->where($where);
        }
        return $this->db->get($table)->result();
    }

    public function get_list($table, $where = FALSE) {
        if ($where) {
            $this->db->where($where);
        }
        return $this->db->get($table)->result();
    }

    public function insert($table, $param) {
        $this->db->insert($table, $param);
        return $this->db->insert_id();
    }

    public function update($table, $set, $where) {
        $this->db->where($where);
        $this->db->update($table, $set);
        return $this->db->affected_rows();
    }
    function check_file_exist($upload_path)
    {
        $filesnames = array();

        foreach (glob('./' . $upload_path . '/*.*') as $file_NAMEEXISTS) {
            $file_NAMEEXISTS;
            $filesnames[] = str_replace("./" . $upload_path . "/", "", $file_NAMEEXISTS);
        }
        return $filesnames;
    }

    public function delete($table, $where) {
        $this->db->where($where);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }

    public function check_Holiday($day, $user_id, $firm_id) {
        $k = 0;
        $p = 0;
        $qry1 = $this->db->query("select date from holiday_master_all where firm_id='$firm_id' AND date='$day'");
        if ($this->db->affected_rows() > 0) {
            $k++;
        }
        $query = $this->db->query("select type from attendance_employee_applicable where user_id='$user_id' AND day='$day' AND type='2'");
        if ($this->db->affected_rows() > 0) {
            $p++;
        }
        if ($k > 0 || $p > 0) {
            return 1;
        } else {
            return 2; //if there is no entry in attendance_employee_applicable and holiday_master_All table then Sunday is OFF
        }
    }

    public function check_Holiday_permission($user_id) {
        $qr = $this->db->query("select holiday_working_sts from user_header_all where user_id='$user_id'");
        if ($this->db->affected_rows() > 0) {
            $res = $qr->row();
            $holiday_working_sts = $res->holiday_working_sts;
            return $holiday_working_sts;
        } else {
            return FALSE;
        }
    }
    function upload_file($upload_path, $inputname, $combination = "")
    {
        $combination = (explode(",", $combination));

        $check_file_exist = $this->check_file_exist($upload_path);
        if (isset($_FILES[$inputname]) && $_FILES[$inputname]['error'] != '4') {

            $files = $_FILES;
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = '*';
//            $config['max_size'] = '20000000';    //limit 10000=1 mb
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;

            $this->load->library('upload', $config);

            if (is_array($_FILES[$inputname]['name'])) {

                $count = count($_FILES[$inputname]['name']); // count element
                $files = $_FILES[$inputname];
                $images = array();
                $dataInfo = array();
                if ($count > 0) {

                    if (in_array("1", $combination)) {
                        for ($j = 0; $j < $count; $j++) {
                            $fileName = $files['name'][$j];
                            if (in_array($fileName, $check_file_exist)) {
                                $response['status'] = 201;
                                $response['body'] = $fileName . " Already exist";
                                return $response;
                            }
                        }
                    }
                    $inputname = $inputname . "[]";
                    for ($i = 0; $i < $count; $i++) {
                        $_FILES[$inputname]['name'] = $files['name'][$i];
                        $_FILES[$inputname]['type'] = $files['type'][$i];
                        $_FILES[$inputname]['tmp_name'] = $files['tmp_name'][$i];
                        $_FILES[$inputname]['error'] = $files['error'][$i];
                        $_FILES[$inputname]['size'] = $files['size'][$i];
                        $fileName = $files['name'][$i];
                        //get system generated File name CONCATE datetime string to Filename
                        if (in_array("2", $combination)) {
                            $date = date('Y-m-d H:i:s');
                            $randomdata = strtotime($date);
                            $fileName = $randomdata . $fileName;
                        }
                        $images[] = $fileName;

                        $config['file_name'] = $fileName;

                        $this->upload->initialize($config);
                        $up = $this->upload->do_upload($inputname);
                        //var_dump($up);
                        $dataInfo[] = $this->upload->data();
                    }
                    // var_dump($dataInfo);

                    $file_with_path = array();
                    foreach ($dataInfo as $row) {
                        // print_r($row);exit();
                        $raw_name = $row['raw_name'];
                        $file_ext = $row['file_ext'];
                        $file_name = $raw_name . $file_ext;
                        if(!empty($file_name)){
                            $file_with_path[] = $upload_path . "/" . $file_name;
                        }
                    }
                    // print_r($file_with_path);exit();
                    if (count($file_with_path) > 0) {
                        $response['status'] = 200;
                        $response['body'] = $file_with_path;
                    } else {
                        $response['status'] = 201;
                        $response['body'] = $file_with_path;
                    }
                    return $response;
                } else {
                    $response['status'] = 201;
                    $response['body'] = array();
                    return $response;
                }
            } else {
                $response['status'] = 201;
                $response['body'] = array();
                return $response;
            }
        } else {
            $response['status'] = 201;
            $response['body'] = array();
            return $response;
        }
    }
}
