<?php
require_once 'HexaController.php';

class PayrollController extends HexaController
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('designation_model');
        $this->load->model('Globalmodel');
    }

    function inlineTble()
    {
        $this->load->view('PayrollComponent/inlineTableEdit');
    }

    function getLeaveTypes()
    {
        $id = $this->session->user_session->id;//from session id

        $query = $this->db->query("SELECT * FROM `user_header_all` WHERE `id`= '$id'");
        $data = array();
        if ($query->num_rows() > 0) {
            $option = "";
            foreach ($query->result() as $row) {
                $data['type1'] = $row->type1;
                $data['type2'] = $row->type2;
                $data['type3'] = $row->type3;
                $data['type4'] = $row->type4;
                $data['type5'] = $row->type5;
                $data['type6'] = $row->type6;
                $data['type7'] = $row->type7;
            }
            foreach ($data as $d) {
                $exp = explode(":", $d);
                if ($exp[0] != "") {
                    $option .= "<option value='" . $exp[0] . "'>" . $exp[0] . "</option>";
                }

            }
            $response['option'] = $option;
            $response['status'] = 200;
        } else {
            $response['option'] = "";
            $response['status'] = 201;
        }
        echo json_encode($response);
    }

    public function get_firm_id()
    {
        $user_id = $this->session->user_session->user_id;//from session id
        $result = $this->db->query("SELECT * FROM `user_header_all` WHERE `user_id`='$user_id'");
        if ($result->num_rows() > 0) {
            $data = $result->row();
            $user_data = array(
                'user_id' => $data->user_id,
                'firm_id' => $data->firm_id,
                'boss_id' => $data->linked_with_boss_id,
                'senior_user_id' => $data->senior_user_id,
            );
            return $user_data;
        } else {
            return FALSE;
        }
    }

    function add_leave_request()
    {
        $leave_id = $this->generate_leave_id();
        $leave_type = $this->input->post('leave_type');
        $day_type = $this->input->post('day_type');
        $leave_date_single = $this->input->post('leave_date_multiple_first');
        $senior_id = $this->input->post('senior_id');
        $leave_date_multiple_first = $this->input->post('leave_date_multiple_first');
        $leave_date_multiple_second = $this->input->post('leave_date_multiple_second');
        $leave_requested_on = date('y-m-d');
        $today_date = date("Y-m-d");
        $result = $this->get_firm_id();

        if ($result !== false) {
            $firm_id = $result['firm_id'];
            $boss_id = $result['boss_id'];
            $user_id = $result['user_id'];
            $senior_id = $result['senior_user_id'];
        }


        if ($day_type == 0) {
            if (empty($leave_date_single)) {
                $response['id'] = 'leave_date_multiple_first';
                $response['error'] = 'Please Select Date';
                echo json_encode($response);
                exit();
            } else {
                $leave_date = $leave_date_single;
                $check_leave_taken = $this->check_leave_taken($leave_date, $user_id);
                if ($check_leave_taken == TRUE) {
                    $response['id'] = 'leave_date_multiple_first';
                    $response['error'] = 'You have alredy Applied leave on ' . $leave_date;
                    echo json_encode($response);
                    exit();
                }
                $data = array(
                    'leave_id' => $leave_id,
                    'firm_id' => $firm_id,
                    'boss_id' => $boss_id,
                    'user_id' => $user_id,
                    'leave_type' => $leave_type,
                    'leave_requested_on' => $leave_requested_on,
                    'approved_deny_by' => $senior_id,
                    'leave_date' => $leave_date,
                    'status' => 1
                );
                $add_leave = $this->designation_model->add_leave_rqst($data);
                if ($add_leave == TRUE) {

                    $check_alreday_login = $this->db->query("select date from employee_attendance_leave where date ='$leave_date' AND `user_id`= '$user_id'");

                    if ($this->db->affected_rows() > 0) {
                        $this->db->query("UPDATE `employee_attendance_leave` SET `leave_status` = 1,`leave_id` = '$leave_id' WHERE `user_id`= '$user_id' && date ='$leave_date'");
                    } else {
                        $data1 = array(
                            'firm_id' => $firm_id,
                            'leave_id' => $leave_id,
                            'user_id' => $user_id,
                            'date' => $leave_date,
                            'leave_status' => 1
                        );
                        $add_leave_attendance = $this->db->insert("employee_attendance_leave", $data1);
                    }
                    $response['message'] = 'success';
                    $response['code'] = 200;
                    $response['status'] = true;
                } else {
                    $response['message'] = 'No data to display';
                    $response['code'] = 204;
                    $response['status'] = false;
                }
                echo json_encode($response);
            }
        }
        if ($day_type == 1) {

            if (empty($leave_date_multiple_first)) {
                $response['id'] = 'leave_date_multiple_first';
                $response['error'] = 'Please Select From Date';
                echo json_encode($response);
                exit();
            } else if (empty($leave_date_multiple_second)) {
                $response['id'] = 'leave_date_multiple_second';
                $response['error'] = 'Please Select To Date';
                echo json_encode($response);
                exit();
            } else {
                $date_from1 = date("Y-m-d", strtotime($leave_date_multiple_first));
                $date_to1 = date("Y-m-d", strtotime($leave_date_multiple_second));
                $k = 1;
                $j = 1;
                $diff1 = date_diff(date_create($date_from1), date_create($date_to1));
                $date_diff1 = $diff1->format("%R%a") + 1;
                for ($i = 1; $i <= $date_diff1; $i++) {
                    $check_leave_taken = $this->check_leave_taken($date_from1, $user_id);
                    if ($check_leave_taken == TRUE) {
                        $response['id'] = 'leave_date_multiple_first';
                        $response['error'] = 'You have alredy Applied leave on ' . $date_from1;
                        echo json_encode($response);
                        exit();
                    }
                    $date_from1 = date('Y-m-d', strtotime($date_from1 . ' + 1 days'));
                }
                $date_from = date("Y-m-d", strtotime($leave_date_multiple_first));
                $date_to = date("Y-m-d", strtotime($leave_date_multiple_second));
                $diff = date_diff(date_create($date_from), date_create($date_to));
                $date_diff = $diff->format("%R%a") + 1;
                for ($i = 1; $i <= $date_diff; $i++) {

                    $data = array(
                        'leave_id' => $leave_id,
                        'firm_id' => $firm_id,
                        'boss_id' => $boss_id,
                        'user_id' => $user_id,
                        'leave_type' => $leave_type,
                        'leave_requested_on' => $leave_requested_on,
                        'approved_deny_by' => $senior_id,
                        'leave_date' => $date_from,
                        'status' => 1
                    );
                    $add_leave = $this->designation_model->add_leave_rqst($data);
                    if ($add_leave == TRUE) {
                        $k++;

                        $check_alreday_login = $this->db->query("select date from employee_attendance_leave where date ='$date_from' AND `user_id`= '$user_id'");
                        if ($this->db->affected_rows() > 0) {
                            $result = $this->db->query("UPDATE `employee_attendance_leave` SET `leave_status` = 1 WHERE `user_id`= '$user_id' && date ='$date_from'");
                            if ($this->db->affected_rows() > 0) {
                                $response['message'] = 'success';
                                $response['code'] = 200;
                                $response['status'] = true;
                            } else {
                                $response['message'] = 'No data to display';
                                $response['code'] = 204;
                                $response['status'] = false;
                            }
                        } else {
                            $data1 = array(
                                'firm_id' => $firm_id,
                                'user_id' => $user_id,
                                'date' => $date_from,
                                'leave_status' => 1
                            );
                            $add_leave_attendance = $this->db->insert("employee_attendance_leave", $data1);
                        }
                    }
                    $date_from = date('Y-m-d', strtotime($date_from . ' + 1 days'));
                }
                if ($k > 1) {
                    $response['message'] = 'success';
                    $response['code'] = 200;
                    $response['status'] = true;
                } else {
                    $response['message'] = 'No data to display';
                    $response['code'] = 204;
                    $response['status'] = false;
                }
                echo json_encode($response);
            }
        }
    }

    public function check_leave_taken($leave_date, $user_id)
    {
        $query = $this->db->query("select user_id from leave_transaction_all where leave_date='$leave_date' AND user_id='$user_id' AND status != 4");
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function generate_leave_id()
    {
        $leave_id = 'Leave_' . rand(100, 1000);
        $this->db->select('*');
        $this->db->from('leave_transaction_all');
        $this->db->where('leave_id', $leave_id);
        $this->db->get();
        if ($this->db->affected_rows() > 0) {
            return generate_leave_id();
        } else {
            return $leave_id;
        }
    }

    public function AddMissingPunch()
    {
        $user_id = $this->session->user_session->user_id;//from session id
        $shortaddress = $this->input->post_get('srtaddress');
        $longtaddress = $this->input->post_get('longaddress');
        $result = $this->get_firm_id();
        if ($result !== false) {
            $firm_id = $result['firm_id'];
        }
        $punch_in_time = $this->input->post('date_selected') . " " . $this->input->post('punch_in_time');

        $punch_out_time = $this->input->post('date_selected') . " " . $this->input->post('punch_out_time');
        $reason_missing = $this->input->post('reason_missing');
        $date_selected = $this->input->post('date_selected');
        $get_hr = $this->db->query("select user_id from user_header_all where hr_authority='$firm_id'");
        if ($this->db->affected_rows() > 0) {
            $res = $get_hr->row();
            $hr_user_id = $res->user_id;
        } else {
            $hr_user_id = '';
        }

        $data = array(
            'user_id' => $user_id,
            'missing_punchin' => $punch_in_time,
            'missing_punchout' => $punch_out_time,
            'date' => $date_selected,
            'reason' => $reason_missing,
            'punch_regularised_status' => 1,
            'firm_id' => $firm_id,
            'activity_status' => 0,
            'shortinaddress' => $shortaddress,
            'longinaddress' => $longtaddress,
            'shortoutaddress' => $shortaddress,
            'longoutaddress' => $longtaddress


        );
        $check_alreday_login = $this->db->query("select date from employee_attendance_leave where date ='$date_selected' and user_id='$user_id'");
        if ($this->db->affected_rows() > 0) {
            $data_update = array(
                'missing_punchin' => $punch_in_time,
                'missing_punchout' => $punch_out_time,
                'punch_regularised_status' => 1,
                'activity_status' => 0,
                'shortoutaddress' => $shortaddress,
                'longoutaddress' => $longtaddress

            );
            $update = $this->db->update('employee_attendance_leave', $data_update, array('user_id' => $user_id, 'date' => $date_selected));
            if ($update !== FALSE) {
                $response['message'] = 'success';
                $response['body'] = 'Request added successfully1.';
            } else {
                $response['message'] = 'fail';
                $response['body'] = 'Something went wrong';
            }
        } else {
            $insert = $this->db->insert('employee_attendance_leave', $data);
            if ($insert !== FALSE) {
                $response['message'] = 'success';
                $response['body'] = 'Request added successfully.';
            } else {
                $response['message'] = 'fail';
                $response['body'] = 'Something went wrong';
            }
        }
        echo json_encode($response);
    }

    public function GetCalendarData()
    {
        $user_id = $this->input->post('user_id');
        $id = $this->input->post('id');
        $date = $this->input->post('date');
        if ($user_id == null) {
            $user_id = $this->session->user_session->user_id;//from session id
        }
        if (empty($date)) {
            $date = 0;
        } else {
            $date = date('Y-d-m', strtotime($date));
        }

        $result = $this->get_firm_id();
        if ($result !== false) {
            $firm_id = $result['firm_id'];
            $boss_id = $result['boss_id'];
            $senior_id = $result['senior_user_id'];
        }
        $get_All_attendance = $this->getAttData($user_id, $date);
        $get_All_Holidays = $this->getHolidayData($firm_id);
        $get_All_Events = $this->getEventsData($id, $date);

        if ($get_All_attendance == false) {
            $get_All_attendance = array();
        }
        if ($get_All_Holidays == false) {
            $get_All_Holidays = array();
        }
        if ($get_All_Events == false) {
            $get_All_Events = array();
        }

        $response['status'] = 200;
        $response['data'] = array_merge($get_All_Holidays, $get_All_attendance, $get_All_Events);
        $response['data_1'] = array_merge($get_All_attendance, $get_All_Events);


        echo json_encode($response);
    }

    function getHolidayData($firm_id)
    {
        $query = $this->db->query("select * from holiday_master_all where firm_id='" . $firm_id . "'");
        if ($this->db->affected_rows() > 0) {
            $new_Array = array();
            $result = $query->result();
            foreach ($result as $row) {
                $object = new stdClass();

                $object->start = $row->date;

                $object->color = "#f9f9f9";
                $object->textColor = "#ffff";
                $object->eventDisplay = "list-item";
                $object->backgroundColor = "#e8636f";
                // $object->rendering='background';
                if (is_numeric($row->holiday_name)) {
                    $object->title = "Week Off";
                } else {
                    $object->title = $row->holiday_name;

                }
                array_push($new_Array, $object);
            }
//            var_dump($new_Array);
//            exit;
            return $new_Array;
        } else {
            return false;
        }
    }

    function getEventsData($user_id, $date)
    {
        $id = $this->session->user_session->id;
        if ($date == 0) {
            $query = $this->db->query("select *,(select user_name from user_header_all u where u.id=create_by) as create_by_name from event_master where status=1 AND user_id='" . $user_id . "' AND status=1");
        } else {
            $query = $this->db->query("select *,(select user_name from user_header_all u where u.id=create_by) as create_by_name from event_master where status=1 AND (date(start_date) >= '" . $date . "' and date(end_date) <= '" . $date . "') AND user_id='" . $user_id . "' AND status=1");
        }
        // echo $this->db->last_query();
        if ($this->db->affected_rows() > 0) {
            $new_Array = array();
            $result = $query->result();
            foreach ($result as $row) {
                $object = new stdClass();
                $dtl = preg_replace('/<[^>]*>/', '', $row->event_details);
                $dtl = str_replace("&nbsp;", " ", $dtl);
                $dtl = str_replace("?", " ", $dtl);
                $object->start = $row->start_date;
                $object->end = $row->end_date;
                $object->id = $row->id;
                $object->master_event_id = $row->master_id;
                $object->color = "#f9f9f9";
                $object->textColor = "#ffff";
                $object->eventDisplay = "list-item";
                $object->createdBy = $row->create_by_name;
                if ($id == $row->create_by) {
                    $b_color = "#3c94f3";
                } else {
                    $b_color = "#d2454d";
                }
                $object->backgroundColor = $b_color;
                $object->type = "event";
                if (trim($dtl) == "") {
                    $dtl = trim($dtl . " @" . $row->create_by_name);
                } else {
                    $dtl = trim($dtl);
                }
                $object->title = trim($dtl);

                array_push($new_Array, $object);
            }
//            var_dump($new_Array);
//            exit;
            return $new_Array;
        } else {
            return false;
        }
    }

    function getAttData($user_id, $date)
    {

        if ($date == 0) {
            $query = $this->db->query("select * from employee_attendance_leave where user_id='" . $user_id . "'");
        } else {
            $query = $this->db->query("select * from employee_attendance_leave where date(date)='" . $date . "' AND user_id='" . $user_id . "'");
        }
        $noData=false;
        if ($this->db->affected_rows() > 0) {
            $result = $query->result();
            $new_Array = array();
            foreach ($result as $row) {
                $object = new stdClass();
                if ($row->punch_in != '0000-00-00 00:00:00') {
                    $punch_in = date('H:i', strtotime($row->punch_in));
                } else {
                    $punch_in = "";
                }
                if ($row->punch_out != '0000-00-00 00:00:00') {
                    $punch_out = "-" . date('H:i', strtotime($row->punch_out));
                } else {
                    $punch_out = "";
                }

                if ($row->leave_status == 1) {
                    $leave = "Leave";
                    $object->title = $punch_in . $punch_out . $leave;
                } else if ($row->leave_status == 2) {
                    $leave = "Leave Approved";
                    $object->title = $punch_in . $punch_out . $leave;
                } else if ($row->leave_status == 3) {
                    $leave = "Leave Denied";
                    $object->title = $punch_in . $punch_out . $leave;
                } else {

                    if ($row->punch_regularised_status == 1 && $row->activity_status == 0 && $row->punch_in != '0000-00-00 00:00:00' && $row->punch_out != '0000-00-00 00:00:00') {
                        $object->title = $punch_in . $punch_out;
                        $noData=false;
                    } else if ($row->punch_regularised_status == 1 && $row->activity_status == 0 && ($row->punch_in == '0000-00-00 00:00:00' || $row->punch_out == '0000-00-00 00:00:00')) {
                        $ra = 'RA Requested';
                        $object->title = $punch_in . $punch_out . "-" . $ra;
                        $noData=false;
                    } else if ($row->punch_regularised_status == 1 && $row->activity_status == 3) {
                        $ra = 'RA';
                        $object->title = $punch_in . $punch_out . "-" . $ra;
                        $noData=false;
                    } else if ($row->punch_regularised_status == 1 && $row->activity_status == 4) {
                        $ra = 'RA Denied';
                        $object->title = $ra;
                        $noData=false;
                    } else {

                        if($punch_in == ""){
                            $object->title = "";
                            $noData=true;
                        }else{
                            $noData=false;
                            $object->title = $punch_in . $punch_out;
                        }

                    }

                }

                $object->start = $row->date;
                $object->color = "#f9f9f9";
                $object->textColor = "#6777ef";
                $object->eventDisplay = "list-item";
                $object->type = "attendance";
                // $object->rendering='background';

                if($noData == false){
                    array_push($new_Array, $object);
                }

            }
            return $new_Array;
        } else {
            return false;
        }
    }

    function emp_login_mbl()
    {
        $user_id = $this->session->user_session->user_id;//from session id
        $status = $this->input->post('status');
        $latitude_live = $this->input->post('latitude_live');
        $longitude_live = $this->input->post('longitude_live');
        $shortaddress = $this->input->post('shortaddress');
        $address = $this->input->post('address');
        date_default_timezone_set('Asia/Kolkata');
        $todaydate = date('Y-m-d H:i:s');
        $todaydate1 = date('Y-m-d');
        $day = date('l', strtotime($todaydate1));
        $result = $this->get_firm_id();
        if ($result !== false) {
            $firm_id = $result['firm_id'];
        }
        $check_holiday = $this->Globalmodel->check_Holiday($todaydate1, $user_id, $firm_id);
        $check_holiday_permission = $this->Globalmodel->check_Holiday_permission($user_id);
        if ($check_holiday_permission != FALSE) {
            if ($check_holiday_permission == 1) { //approval not required from senior
                $holiday_approval_status = 1;
            } else if ($check_holiday_permission == 2) { //not having permission to work on holiday
                $holiday_approval_status = 2;
            } else { //approval  required from senior
                $holiday_approval_status = 0;
            }
        } else {
            $holiday_approval_status = 0;
        }
        if ($check_holiday == 1) {
            $holiday = 1; //Holiday
        } else {
            if ($day == 'Sunday') {
                $holiday = 1; //Holiday
            } else {
                $holiday = 0; //NO holiday
            }
        }
        /* $createDate = new DateTime($todaydate);
          $todaydate = $createDate->format('Y-m-d'); */

        $result = $this->get_firm_id();
        if ($result !== false) {
            $firm_id = $result['firm_id'];
        }

        //get branch location

        $qrr = $this->db->query("select * from firm_location where firm_id='$firm_id'");
        if ($this->db->affected_rows() > 0) {
            $result = $qrr->row();
            $firm_lattitude = $result->lattitude;
            $firm_longitude = $result->logitude;
            $radius = $result->radius;
        }

        $distance = $this->twopoints_on_earth($firm_lattitude, $firm_longitude, $latitude_live, $longitude_live);
        $distance_in_meter = $distance * 1609.344;
        if ($distance_in_meter <= $radius) { //Inside Punch
            $punch_regularised_status = 2;
            $regular_status = 0;
        } else { //Out Side Punch
            $punch_regularised_status = 1;
            $query = $this->db->query("select outside_punch_applicable from user_header_all where user_id='$user_id'");
            if ($this->db->affected_rows() > 0) {
                $ress = $query->row();
                $outside_punch_applicable = $ress->outside_punch_applicable;
            }
            if ($outside_punch_applicable == 1) {
                $regular_status = 1;
            } else {
                $regular_status = 0;
            }
        }

        $check_request_leave = $this->db->query("select date from employee_attendance_leave where date ='$todaydate1' AND `user_id`= '$user_id'");
        //echo $this->db->last_query();
        if ($this->db->affected_rows() > 0) {
            if ($status == 'login') {
                //where array
                $data = array(
                    'user_id' => $user_id,
                    'date' => $todaydate1,
                );
                //update array
                $arr = array('punch_in' => $todaydate, 'shortinaddress' => $shortaddress,
                    'longinaddress' => $address, 'punchin_lat' => $latitude_live, 'punchin_long' => $longitude_live, 'is_holiday' => $holiday,
                    'holiday_approval_status' => $holiday_approval_status, 'regular_status' => $regular_status,
                    'leave_status' => 0);
                $this->db->set($arr);
                $this->db->where($data);
                $result = $this->db->update('employee_attendance_leave');
                //echo $this->db->last_query();
                if ($this->db->affected_rows() > 0) {
                    $query = $this->db->query("UPDATE `leave_transaction_all` SET `status`='4' where leave_date='$todaydate1' and user_id='$user_id'");
                    $response['message'] = 'success';
                    $response['body'] = 'Login Successful';
                } else {
                    $response['message'] = 'fail';
                    $response['body'] = 'Something went wrong';
                }
            } else {
                $data = array(
                    'user_id' => $user_id,
                    'punch_out' => 0,
                    'date' => $todaydate1,
                );
                $arr = array('punch_out' => $todaydate, 'punch_regularised_status' => $punch_regularised_status, 'punchout_lat' => $latitude_live,
                    'punchout_long' => $longitude_live, 'shortoutaddress' => $shortaddress,
                    'longoutaddress' => $address);
                $this->db->set($arr);
                $this->db->where($data);
                $result = $this->db->update('employee_attendance_leave');

                if ($this->db->affected_rows() > 0) {
                    $response['message'] = 'success';
                    $response['body'] = 'Logout Successful';
                } else {
                    $response['message'] = 'fail';
                    $response['body'] = 'Something went wrong';
                }
            }
        } else {
            if ($status == 'login') {
                $data = array(
                    'date' => $todaydate1,
                    'punch_in' => $todaydate,
                    'user_id' => $user_id,
                    'firm_id' => $firm_id,
                    'punchin_lat' => $latitude_live,
                    'leave_status' => 0,
                    'is_holiday' => $holiday,
                    'holiday_approval_status' => $holiday_approval_status,
                    'punchin_long' => $longitude_live,
                    'regular_status' => $regular_status,
                    'shortinaddress' => $shortaddress,
                    'longinaddress' => $address

//                'mac_address_intime' => $mac,
                );
                $result = $this->db->insert('employee_attendance_leave', $data);
                if ($result != FALSE) {
                    $query = $this->db->query("UPDATE `leave_transaction_all` SET `status`='4' where leave_date='$todaydate1' and user_id='$user_id'");
                    $response['message'] = 'success';
                    $response['body'] = 'Login Successful';
                } else {

                    $response['message'] = 'fail';
                    $response['body'] = 'Something went wrong';
                }
            } else {

                $data = array(
                    'user_id' => $user_id,
                    'punch_out' => 0,
                    'date' => $todaydate1,
                );
                $arr = array('punch_out' => $todaydate, 'punch_regularised_status' => $punch_regularised_status, 'punchout_lat' => $latitude_live,
                    'punchout_long' => $longitude_live, 'shortoutaddress' => $shortaddress,
                    'longoutaddress' => $address);
                $this->db->set($arr);
                $this->db->where($data);
                $result = $this->db->update('employee_attendance_leave');
                if ($this->db->affected_rows() > 0) {
                    $response['message'] = 'success';
                    $response['body'] = 'Logout Successful';
                } else {

                    $response['message'] = 'fail';
                    $response['body'] = 'Something went wrong';
                }
            }
        }
        echo json_encode($response);
    }

    public function twopoints_on_earth($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
    {
        $long1 = deg2rad($longitudeFrom);
        $long2 = deg2rad($longitudeTo);
        $lat1 = deg2rad($latitudeFrom);
        $lat2 = deg2rad($latitudeTo);

        //Haversine Formula
        $dlong = $long2 - $long1;
        $dlati = $lat2 - $lat1;

        $val = pow(sin($dlati / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($dlong / 2), 2);

        $res = 2 * asin(sqrt($val));

        $radius = 3958.756;

        return ($res * $radius);
    }

    public function GetLoginDetails()
    {
        date_default_timezone_set('Asia/Kolkata');
        $user_id = $this->session->user_session->user_id;//from session id
        $todaydate = date('Y-m-d');
        $query = $this->db->query("SELECT *,(select gps_off_allow from user_header_all where user_id='$user_id') as gps_off_allow  FROM employee_attendance_leave where DATE(date)='$todaydate' AND user_id='$user_id'");
        if ($this->db->affected_rows() > 0) {
            $result = $query->row();
            $intime = $result->punch_in;
            $outtime = $result->punch_out;
            $response['message'] = 'success';
            $response['gps_off_allow'] = $result->gps_off_allow;
            if ($intime != 0 && $outtime != 0) {
                $response['status'] = 'attendace_marked';
                $response['intime'] = $intime;
                $response['outtime'] = $outtime;
            } else if ($intime != 0 && $outtime == 0) {
                $response['status'] = 'intime_marked';
                $response['intime'] = $intime;
            } else {
                $response['message'] = 'success';
                $response['status'] = 'not_marked';
            }
        } else {
            $qr = $this->db->query("select gps_off_allow from user_header_all where user_id='$user_id'");
            if ($this->db->affected_rows() > 0) {
                $result1 = $qr->row();
                $response['gps_off_allow'] = $result1->gps_off_allow;
            }
            if (strtotime($todaydate) == strtotime($todaydate)) {
                $response['message'] = 'success';
                $response['status'] = 'not_marked';
                echo json_encode($response);
                exit;
            }
            $response['message'] = 'fail';
        }
        echo json_encode($response);
    }

    public function AddEventPayroll1()
    {
        $user_id = $this->session->user_session->user_id;//from session id
        $event_name = $this->input->post('Eventname');
        $EventstartDate = $this->input->post('EventstartDate');
        $EventendDate = $this->input->post('EventendDate');


        if (empty($event_name) || is_null($event_name)) {
            $response['status'] = 201;
            $response['body'] = "Enter Event Name";
        } else if (empty($EventstartDate) || is_null($EventstartDate)) {
            $response['status'] = 201;
            $response['body'] = "Select start Date";
        } else if (empty($EventendDate) || is_null($EventendDate)) {
            $response['status'] = 201;
            $response['body'] = "Select End Date";
        } else {
            $data = array(
                "event_details" => $event_name,
                "start_date" => $EventstartDate,
                "end_date" => $EventendDate,
                "user_id" => $user_id,
                "created_on" => date('Y-m-d h:i:s')
            );
            $insert = $this->db->insert('event_master', $data);
            if ($insert == true) {
                $response['status'] = 200;
                $response['body'] = "Added Successfully";
            } else {
                $response['status'] = 201;
                $response['body'] = "Failed to add";
            }
        }
        echo json_encode($response);

    }

    public function AddEventPayroll()
    {
        $user_id = $this->session->user_session->id;//from session id
        $event_details = $this->input->post('data');
        $eventagenda = $this->input->post('addeventAgenda');
        $updateId = $this->input->post('updateID');
        if (!empty($updateId)) {
            if (count($eventagenda) > 0) {
                $del = $this->db->delete("event_agenda", array("event_id" => $updateId));
                if ($del == true) {
                    $cnt = 1;
                    foreach ($eventagenda as $d1) {
                        $data1 = array(
                            "agenda_bullet" => $d1,
                            "event_id" => $updateId,
                            "created_by" => $user_id,
                        );
                        $update = $this->db->insert("event_agenda", $data1);
                        if ($update == true) {
                            $cnt++;
                        }
                    }
                    if ($cnt > 1) {
                        $response['status'] = 200;
                        $response['body'] = "Added Successfully";
                    } else {
                        $response['status'] = 201;
                        $response['body'] = "Failed to add";
                    }
                } else {
                    $response['status'] = 201;
                    $response['body'] = "Something went wrong";
                }
            } else {
                $response['status'] = 201;
                $response['body'] = "Parameter Missing";
            }
        } else {


            date_default_timezone_set('Asia/Kolkata');
            if (empty($event_details) || is_null($event_details)) {
                $response['status'] = 201;
                $response['body'] = "Enter Event Details";
                echo json_encode($response);
                exit();
            } else if ($eventagenda[0] == "") {
                $response['status'] = 201;
                $response['body'] = "Add Agenda";
                echo json_encode($response);
                exit();
            } else {
                $focusTodayChildActArray = $this->input->post('focusTodayChildActArray');
                $hoursTodayChildActArray = $this->input->post('hoursTodayChildActArray');
                $notesArray = $this->input->post('notesArray');

                $explode_hour = explode(",", $hoursTodayChildActArray);
                $Og_date = date('Y-m-d H:i:s', strtotime($this->input->post('Og_date')));
                if (!empty($explode_hour[0])) {
                    $first_hour = str_replace("Hr", "", $explode_hour[0]);
                    $EventendDate = strtotime($Og_date) + ((60 * 60) * $first_hour);
                } else {
                    $EventendDate = strtotime($Og_date) + ((60 * 60));
                }
                $data = array(
                    "event_details" => $event_details,
                    "start_date" => $Og_date,
                    "end_date" => date('Y-m-d H:i:s', $EventendDate),
                    "user_id" => $user_id,
                    "created_on" => date('Y-m-d h:i:s'),
                    "create_by" => $user_id,
                    "note_id" => $notesArray,
                );

                $insert = $this->db->insert('event_master', $data);
                $insert_id = $this->db->insert_id();
                if ($insert == true) {
                    $this->db->where("id", $insert_id);
                    $this->db->update('event_master', array("master_id" => $insert_id));
                }

                $explode_emp = explode(",", $focusTodayChildActArray);
                $cnt = 1;
                if (count($eventagenda) > 0 || $focusTodayChildActArray != "") {
                    foreach ($eventagenda as $d1) {
                        $data1 = array(
                            "agenda_bullet" => $d1,
                            "event_id" => $insert_id,
                            "created_by" => $user_id,
                        );

                        $this->db->insert("event_agenda", $data1);
                    }

                }


                if (count($explode_emp) > 0) {
                    foreach ($explode_emp as $user_id_emp) {
                        $d = array(
                            "event_details" => $event_details,
                            "start_date" => $Og_date,
                            "end_date" => date('Y-m-d H:i:s', $EventendDate),
                            "user_id" => $user_id_emp,
                            "created_on" => date('Y-m-d h:i:s'),
                            "create_by" => $user_id,
                            "master_id" => $insert_id,
                        );

                        $insert_batch = $this->db->insert("event_master", $d);
                        if ($insert_batch == true) {
                            $cnt++;
                        }
                    }


                }

                if ($insert == true && $cnt > 1) {
                    $response['status'] = 200;
                    $response['body'] = "Added Successfully";
                } else {
                    $response['status'] = 201;
                    $response['body'] = "Failed to add";
                }
            }
        }

        echo json_encode($response);

    }

    public function payroll_login()
    {
        $session_data = $this->session->user_session;
        $user_id = $session_data->user_id;
        $qr = $this->db->query("select email from user_header_all where user_id='$user_id'");
        if ($this->db->affected_rows() > 0) {
            $result = $qr->row();
            $email = $result->email;
            $qrr = $this->db->query("select email,password from user_header_all where email='$email' and user_type='4'");
            if ($this->db->affected_rows() > 0) {
                $res = $qrr->row();
                $email = $res->email;
                $password = $res->password;
                $response['email'] = $email;
                $response['password'] = $password;
                $response['code'] = 200;
            } else {
                $response['code'] = 201;
            }
        } else {
            $response['code'] = 201;
        }
        echo json_encode($response);
    }

    public function check_location()
    {
        $result = $this->get_firm_id();
        if ($result !== false) {
            $firm_id = $result['firm_id'];
        }
        $latitude_live = $this->input->post('latitude_live');
        $longitude_live = $this->input->post('longitude_live');
        $startdate = $this->input->post_get('startdate');
        //get branch location

        $qrr = $this->db->query("select * from firm_location where firm_id='$firm_id'");
        if ($this->db->affected_rows() > 0) {
            $result = $qrr->row();
            $firm_lattitude = $result->lattitude;
            $firm_longitude = $result->logitude;
            $radius = $result->radius;

            $distance = $this->twopoints_on_earth($firm_lattitude, $firm_longitude, $latitude_live, $longitude_live);
            $distance_in_meter = $distance * 1609.344;
            if ($distance_in_meter <= $radius) { //Inside Punch
                $response['message'] = 'inside';
            } else { //Out Side Punch
            }
        } else {
            $response['message'] = 'outside';

        }
        $response["start"] = $startdate;
        echo json_encode($response);
    }

    public function getPermissionUser()
    {
        $user_id = $this->session->user_session->user_id;//from session id
        $query = $this->db->query("select focus_area_control from user_header_all where user_id='" . $user_id . "'");
        $permission_array = array();
        if ($this->db->affected_rows() > 0) {
            $focus_area_control = $query->row()->focus_area_control;
            $permission_array['focus_area_permission'] = $focus_area_control;
            $response['status'] = 200;
            $response['permission_array'] = $permission_array;
        } else {
            $response['status'] = 201;
        }
        echo json_encode($response);
    }

    function GetEventByid()
    {
        $session_data = $this->session->user_session;
        $user_id = $session_data->id;
        $event_id = $this->input->post('id');
        $query21 = $this->db->query("select master_id from event_master where id=" . $event_id);
        if ($this->db->affected_rows() > 0) {
            $master_id = $query21->row()->master_id;
        } else {
            $master_id = "";
        }
        //$master_id=$this->input->post('master_id');
        $query = $this->db->query("select e.*,(select group_concat(e.user_id,'||',u.user_name) 
from user_header_all u where u.id in (select e1.user_id from event_master e1 where e1.master_id=e.master_id)) 
as user_ids from event_master e where e.master_id=" . $master_id . " group by e.master_id;");
        if ($this->db->affected_rows() > 0) {
            $result = $query->row()->event_details;
            $note_id = $query->row()->note_id;
            $create_by = $query->row()->create_by;
            $user_ids = $query->row()->user_ids;
            $query2 = $this->db->query("select * from event_agenda where event_id=(select master_id from event_master where id=" . $event_id . ")");
            if ($this->db->affected_rows() > 0) {
                $resultAgenda = $query2->result();
            } else {
                $resultAgenda = "";
            }
            if ($user_id == $create_by) {
                $is_created = 1;
            } else {
                $is_created = 0;
            }
            $dtl = preg_replace('/<[^>]*>/', '', $result);
            $dtl = str_replace("&nbsp;", " ", $dtl);
            $dtl = str_replace("?", " ", $dtl);
            $response['status'] = 200;
            $response['eventName'] = $dtl;
            $response['resultAgenda'] = $resultAgenda;
            $response['note_id'] = $note_id;
            $response['user_id'] = $user_ids;
            $response['is_created'] = $is_created;
        } else {
            $response['status'] = 201;
            $response['eventName'] = "";
        }
        echo json_encode($response);
    }

    function AddEventDetailsNotes()
    {
        $event_id = $this->input->post('event_id');
        $event_note = $this->input->post('event_note');
        $data = array("event_note" => $event_note);
        $this->db->where("id", $event_id);
        $update = $this->db->update("event_master", $data);
        if ($update == true) {
            $response['status'] = 200;
            $response['body'] = "Added Successfully";
        } else {
            $response['status'] = 201;
            $response['body'] = "Something Went Wrong";
        }
        echo json_encode($response);

    }

    function deleteEventFun()
    {
        $event_id = $this->input->post('updateID');
        if (empty($event_id)) {
            $response['status'] = 201;
            $response['body'] = "Parameter Missing";
            echo json_encode($response);
            exit;
        } else {
            $data = array("status" => 0);
            $this->db->where("master_id", $event_id);
            $update = $this->db->update("event_master", $data);
            if ($update == true) {
                $response['status'] = 200;
                $response['body'] = "Deleted Successfully";
            } else {
                $response['status'] = 201;
                $response['body'] = "Something Went Wrong";
            }
        }
        echo json_encode($response);

    }

}