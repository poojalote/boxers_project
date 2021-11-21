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

}
