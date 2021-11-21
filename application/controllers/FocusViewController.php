<?php

require_once 'HexaController.php';
class FocusViewController extends HexaController
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('FocusViewModel');
        $this->db2=$this->load->database('db2', TRUE);

    }

    function AddFocusView(){
        $user_array=$this->input->post('userdata');
        $focus_details=$this->input->post('focus_details');

        $parent_focus_id=$this->input->post('parent_focus_id');
        $note_ids=$this->input->post('note_ids');
        // $parent_focus_id=1;
        $created_by= $this->session->user_session->id;//through session
        // $user_array=array(1,2,3);
        // print_r($user_array);exit();
        $type=1;
//echo str_replace("<br>", "",$focus_details);
//exit;
        $regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
        $clean_text = preg_replace($regexEmoticons, '', $focus_details);

        // echo  preg_replace('/\xEE[\x80-\xBF][\x80-\xBF]|\xEF[\x81-\x83][\x80-\xBF]/', '', $focus_details);

        if(empty($focus_details) || $focus_details=="<br><br>" || is_null($focus_details)){
            $response['status']=201;
            $response['body']="Please write something...";
            echo json_encode($response);
            exit;

        }

//        if(strlen(trim($focus_details)) > 40){
//            $response['status']=201;
//            $response['body']="Maximum 40 characters allow.";
//            echo json_encode($response);
//            exit;
//        }

        if(!is_null($parent_focus_id))
        {
            $type=2;
        }
        $data_master=array(
            "focus_details"=>str_replace("<br>", "",$focus_details),
            "created_on"=>date('Y-m-d H:i:s'),
            "created_by"=>$created_by,
            "status"=>1,
            "activity_status"=>1,
            "type"=>$type,
            "note_id"=>$note_ids
        );
        if(!is_null($parent_focus_id))
        {
            $data_master['parent_focus_id']=$parent_focus_id;
        }
        $final_assignment_array=array();
        if(!empty($parent_focus_id)){
            //sub focus
            if(!empty($user_array)){
                $user_array=explode(',', $user_array);
                foreach ($user_array as $assign_to){
                    $data_assignment=array(
                        "assign_to"=>$assign_to,
                        "created_on"=>date('Y-m-d H:i:s'),
                        "status"=>1,
                        "activity_status"=>1
                    );
                    array_push($final_assignment_array,$data_assignment);
                }
            }
        }
        //insert function
        $insert=$this->FocusViewModel->addFocusView($data_master,$final_assignment_array,$parent_focus_id);
        if($insert == true){
            $response['status']=200;
            $response['body']="Added Successfully";
        }else{
            $response['status']=200;
            $response['body']="Failed To add";
        }echo json_encode($response);

    }

    function AddFocusComment(){
        // print_r($this->input->post());exit();
        $comment=$this->input->post('comment');
        $file=$this->input->post('file');
        // print_r($_FILES);exit();
        $created_by=$this->session->user_session->id;//from session id
        $focus_id=$this->input->post('focus_id');
        $upload_path = "uploads";
        $combination = 2;
        $name_input='file';
        $result = $this->upload_file($upload_path, $name_input, $combination);
        // print_r($result['status']);exit();
        if ($result['status']==200) {
            if ($result['body'][0] == "uploads/") {
                $input_data = "";
            } else {
                $input_data = $result['body'][0];
            }

        } else {
            $input_data = "";
        }
        $data_array=array(
            "focus_id"=>$focus_id,
            "comment"=>$comment,
            "file"=>$input_data,
            "created_on"=>date('Y-m-d H:i:s'),
            "created_by"=>$created_by,
        );
        $tablename='focus_comments';
        $insert=$this->FocusViewModel->AddComment($data_array,$tablename);
        if($insert == true){
            $response['status']=200;
            $response['body']="Added Successfully";
        }else{
            $response['status']=200;
            $response['body']="Failed To add";
        }echo json_encode($response);
    }
    public function getFocusComment()
    {
        $focus_id=$this->input->post('focus_id');
        $query=$this->db->query("select * from focus_comments WHERE focus_id=".$focus_id);
        if($this->db->affected_rows() > 0){
            $result=$query->result();
            $response['status']=200;
            $response['data']=$result;
        }else{
            $response['status']=200;
            $response['data']=array();
            $response['body']='no comment data';
        }echo json_encode($response);
    }
    function DeleteFocusView(){
       $focus_id=$this->input->post('focus_id');
        if(isset($focus_id) && !empty($focus_id)){
            $query=$this->db->query("update focus_master SET activity_status=0 WHERE id=".$focus_id);
            if($this->db->affected_rows() > 0){
                $response['status']=200;
                $response['body']="Deleted SuccessFully";
            }else{
                $response['status']=200;
                $response['body']="Failed To Delete";
            }
        }else{
            $response['status']=200;
            $response['body']="Failed To Delete";
        }echo json_encode($response);

    }

    function UpdateFocusView()
    {
        // print_r($this->input->post());exit();
        $focus_id=$this->input->post('focus_id');
        $focus_detail=$this->input->post('focus_detail');
        $employee_ids=$this->input->post('employee_ids');
        $note_ids=$this->input->post('note_ids');
        $update_data=array('focus_details'=>$focus_detail,"note_id"=>$note_ids);
        $final_assignment_array=array();
//        if(strlen(trim($focus_detail)) > 40){
//            $response['status']=201;
//            $response['body']="Maximum 40 characters allow.";
//            echo json_encode($response);
//            exit;
//        }

        if(!empty($focus_id)){
            //sub focus
            if(!empty($employee_ids)){
                $user_array=explode(',', $employee_ids);
                foreach ($user_array as $assign_to){
                    $data_assignment=array(
                        "assign_to"=>$assign_to,
                        "created_on"=>date('Y-m-d H:i:s'),
                        "status"=>1,
                        "activity_status"=>1,
                        "focus_id"=>$focus_id
                    );
                    array_push($final_assignment_array,$data_assignment);
                }
            }
        }
        //insert function
        $update=$this->FocusViewModel->updateFocusView($update_data,$final_assignment_array,$focus_id);
        // $query=$this->db->query("update focus_master SET focus_details='".$focus_detail."' WHERE id=".$focus_id);
        if($update==true){
            $response['status']=200;
            $response['body']="Updated SuccessFully";
        }else{
            $response['status']=200;
            $response['body']="Failed To Update";
        }echo json_encode($response);
    }
    function GetFocusData(){
        $date=$this->input->post('date');
        $user_id=$this->input->post('user_id');
        if($user_id==null){
            $user_id=$this->session->user_session->id;//from session
        }


        $GetFocusAssigntoemp=$this->GetFocusAssigntoemp($date,$user_id); // focus Assign To you
        $query=$this->db->query("select *, 0 as is_assign,
            (select group_concat(fa.assign_to,'||',(select um.user_name from user_header_all um where um.id=fa.assign_to)) from focus_assignment fa where fa.focus_id=fm.id) as assign_to,
            (select group_concat(uha.id,'||',uha.user_name) from user_header_all uha where uha.id=fm.created_by) as created_to from 
            focus_master fm where fm.created_by=$user_id AND fm.activity_status=1 AND fm.type=1  order by modify_on desc");
        $note_array=array();
        $noteID_array=array();
        if($this->db->affected_rows() > 0){
            $result=$query->result();

            foreach ($result as $row){
                $note_id=$row->note_id;

                $id=$row->id;
                $id1="a_".$id;
                if($note_id !== null || !empty($note_id)){
                    $data=$this->getDatafromRMTtable($note_id,$id);
                    if($data!=false){
                        $exp=explode(",",$data);
                        $data1="";
                        foreach ($exp as $e){
                            $exp2=explode("/",$e);
                            $data1 .=$exp2[3].",";
                        }

                        $note_array[$id1]=rtrim($data1,",");
                        $noteID_array[$id1]=$note_id;
                    }else{
                        $note_array[$id1]='';
                        $noteID_array[$id1]='';
                    }

                }else{
                    $note_array[$id1]='';
                    $noteID_array[$id1]='';
                }

            }
        }else{
            $result=array();
        }
        if($GetFocusAssigntoemp != false){
            $last_array= array_merge($result,$GetFocusAssigntoemp);
            foreach ($last_array as $row1){
                $note_id=$row1->note_id;

                $id=$row1->id;
                $id1="a_".$id;
                if($note_id !== null || !empty($note_id)){
                    $data=$this->getDatafromRMTtable($note_id,$id);
                    if($data!=false){
                        $exp=explode(",",$data);
                        $data1="";
                        foreach ($exp as $e){
                            $exp2=explode("/",$e);
                            $data1 .=$exp2[3].",";
                        }

                        $note_array[$id1]=rtrim($data1,",");
                        $noteID_array[$id1]=$note_id;
                    }else{
                        $note_array[$id1]='';
                        $noteID_array[$id1]='';
                    }

                }else{
                    $note_array[$id1]='';
                    $noteID_array[$id1]='';
                }

            }
        }else{
            $last_array=$result;
        }
        // $sortArray=array();
        // foreach ($last_array as $key => $value) {
        //     if($value->modify_on!=null)
        //     {
        //         $sortArray[$key]=$value;
        //     }
        //    else
        //    {
        //         $sortArray[$value->created_on]=$value;
        //    }
        // }
        // print_r($last_array);exit();
        usort($last_array, function($a, $b) {
            // print_r($a->modify_on);exit();
            if($a->modify_on!=null && $b->modify_on!=null)
            {
                $return = new DateTime($a->modify_on) <=> new DateTime($b->modify_on);
            }
            else if($a->modify_on!=null && $b->modify_on==null)
            {
                $return = new DateTime($a->modify_on) <=> new DateTime($b->created_on);
            }
            else if($a->modify_on==null && $b->modify_on!=null)
            {
                $return = new DateTime($a->created_on) <=> new DateTime($b->modify_on);
            }
            else if($a->modify_on==null && $b->modify_on==null)
            {
                $return = new DateTime($a->created_on) <=> new DateTime($b->created_on);
            }
            else
            {
                $return = new DateTime($a->modify_on) <=> new DateTime($b->modify_on);
            }
            return $return;
        });
        rsort($last_array);
        // echo '<pre>';
        //  var_dump($last_array);
        $response['status']=200;
        $response['data']=$last_array;
        $response['note_data']=$note_array;
        $response['noteID_data']=$noteID_array;
        ob_clean();
        echo json_encode($response,JSON_UNESCAPED_UNICODE);

    }

    function GetFocusAssigntoemp($date,$id){
        // $id=$this->session->user_session->id;//from session
        $query=$this->db->query("select fm.*,1 as is_assign,(select group_concat(uha.id,'||',uha.user_name) from user_header_all uha where uha.id=fm.created_by) as created_to,
        (select group_concat(uha.id,'||',uha.user_name) from user_header_all uha where uha.id=".$id.") as assign_to from focus_master fm where fm.activity_status=1 AND fm.id in (select fa.focus_id from focus_assignment fa where fa.assign_to=".$id.") order by id desc");
        if($this->db->affected_rows() > 0){
            $result=$query->result();

            return $result;
        }else{
            return  false;
        }

    }
    public function GetFocusChildData()
    {
        $date=$this->input->post('date');
        $parentId=$this->input->post('parentId');
        $user_id=$this->session->user_session->id;//from session
        // $query=$this->db->query("select *,
        //     (select group_concat(fa.assign_to,'||',(select um.user_name from user_header_all um where um.id=fa.assign_to)) from focus_assignment fa where fa.focus_id=fm.id) as assign_to,
        //      from
        //     focus_master fm where fm.created_by=$user_id AND fm.activity_status=1 AND date(fm.created_on)='".$date."' AND fm.type=2 AND fm.parent_focus_id=".$parentId." AND fm.id!=".$parentId."");
        $query=$this->db->query("select *,(select group_concat(fa.assign_to,'||',(select um.user_name from user_header_all um where um.id=fa.assign_to)) from focus_assignment fa where fa.focus_id=fm.id) as assign_to 
from focus_master fm where fm.created_by=".$user_id." AND fm.activity_status=1 AND fm.type=2 AND fm.parent_focus_id=".$parentId." AND fm.id!=".$parentId." order by id desc");


        if($this->db->affected_rows() > 0){
            $result=$query->result();

            $note_array=array();
            $noteID_array=array();
            foreach ($result as $row){
                $note_id=$row->note_id;

                $id=$row->id;
                $id1="a_".$id;
                if($note_id !== null || !empty($note_id)){
                    $data=$this->getDatafromRMTtable($note_id,$id);
                    if($data!=false){
                        $exp=explode(",",$data);
                        $data1="";
                        foreach ($exp as $e){
                            $exp2=explode("/",$e);
                            $data1 .=$exp2[3].",";
                        }

                        $note_array[$id1]=rtrim($data1,",");
                        $noteID_array[$id1]=$note_id;
                    }else{
                        $note_array[$id1]='';
                        $noteID_array[$id1]='';
                    }

                }else{
                    $note_array[$id1]='';
                    $noteID_array[$id1]='';
                }

            }

            $response['status']=200;
            $response['data']=$result;
            $response['note_data']=$note_array;
            $response['noteID_data']=$noteID_array;
        }else{
            $response['status']=201;
            $response['data']=array();
        }echo json_encode($response);
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

    function addTodaysActivity(){
        $activity_details=$this->input->post('act_det');
        $focus_id=$this->input->post('focus_id');
        $user_id=$this->session->user_session->id;//from session
        // $focus_id=implode(",",$focus_id_array);

        $data=array(
            "activity_details"=>$activity_details,
            "user_id"=>$user_id,
            "focus_id"=>$focus_id,
            "created_on"=>date('Y-m-d H:i:s'),
            "status"=>1
        );
        $insert=$this->FocusViewModel->AddTodaysActivity($data);
        if($insert == true){
            $response['status']=200;
            $response['body']="Added Successfully";
        }else{
            $response['status']=200;
            $response['body']="Failed To add";
        }echo json_encode($response);
    }
    function GetActivityData(){

        $user_id=$this->input->post('user_id');
        $key=$this->input->post('key');
        if($user_id==null)
        {
            $user_id=$this->session->user_session->id;//from session
        }
        $date=$this->input->post('date');
        if($key == 0){
            $date=$this->input->post('date');
        }else if($key == 1){
            $date=date('Y-m-d', strtotime($date. ' - 1 day'));
        }else if($key==2){
            $date=date('Y-m-d', strtotime($date. ' + 1 day'));
        }
        $query=$this->db->query("select am.*,(select group_concat(fm.id,'||',fm.focus_details) from focus_master fm where fm.id=am.focus_id) as focus_to from activity_master am where am.user_id=".$user_id." AND am.status=1 AND am.activity_status=1 AND date(am.created_on)='".$date."' order by id desc");
        $response['date_format']=$date;
        if($this->db->affected_rows() > 0){
            $result=$query->result();
            $note_array=array();
            $noteID_array=array();
            foreach ($result as $row){
                $note_id=$row->note_id;

                $id=$row->id;
                $id1="a_".$id;
                if($note_id !== null || !empty($note_id)){
                    $data=$this->getDatafromRMTtable($note_id,$id);
                    if($data!=false){
                        $exp=explode(",",$data);
                        $data1="";

                        foreach ($exp as $e){
                            $exp2=explode("/",$e);
                            if(count($exp2)>3)
                            {
                                $data1 .=$exp2[3].",";
                            }

                        }

                        $note_array[$id1]=rtrim($data1,",");
                        $noteID_array[$id1]=$note_id;
                    }else{
                        $note_array[$id1]='';
                        $noteID_array[$id1]='';
                    }

                }else{
                    $note_array[$id1]='';
                    $noteID_array[$id1]='';
                }

            }

            $response['status']=200;
            $response['data']=$result;
            $response['note_data']=$note_array;
            $response['noteID_data']=$noteID_array;

        }else{
            $response['status']=201;
            $response['data']=array();
        }echo json_encode($response);

    }
    public function updateTodayActivityView()
    {
        // print_r($this->input->post());exit();
        $acitivity_id=$this->input->post('acitivity_id');
        $activity_detail=$this->input->post('activity_detail');
        $focus_ids=$this->input->post('focus_ids');
        $activity_hr=$this->input->post('activity_hr');
        $note_ids=$this->input->post('note_ids');
        // print_r($note_ids);exit();
        if(empty(trim($activity_detail))){
            $activity_detail="Sample Activity";
        }
        $data=array(
            "activity_details"=>$activity_detail,
            "focus_id"=>$focus_ids,
            "activity_hours"=>$activity_hr,
            "note_id"=>$note_ids
        );
        $where=array("id"=>$acitivity_id);
        // $query=$this->db->query("update activity_master SET activity_details='".$activity_detail."' WHERE id=".$acitivity_id);
        $this->db->update('activity_master',$data,$where);
        if($this->db->affected_rows() > 0){
            $response['status']=200;
            $response['body']="Updated SuccessFully";
        }else{
            $response['status']=200;
            $response['body']="Failed To Update";
        }echo json_encode($response);
    }
    function DeleteTodaysActivity(){
        $activity_id=$this->input->post('activity_id');
        $query=$this->db->query("update activity_master SET activity_status=0 WHERE id=".$activity_id);
        if($this->db->affected_rows() > 0){
            $response['status']=200;
            $response['body']="Deleted SuccessFully";
        }else{
            $response['status']=200;
            $response['body']="Failed To Delete";
        }echo json_encode($response);
    }
    public function getEmployeeUnderSenior(){
        $user_id=$this->session->user_session->user_id;
        $query=$this->db->query("select `all_emp_access` from user_header_all where user_id='".$user_id."'");
        $all_emp_access=0;
        if($this->db->affected_rows() > 0){
            $all_emp_access=$query->row()->all_emp_access;
        }
        if($all_emp_access == 1){
            $result=array();
            $get_employee=$this->getEMpNormal($user_id,1);
            if($get_employee != false){
                $result=$get_employee;
            }
        }else{
            $get_other_employeeD=array();
            $get_other_employee=$this->getOtheremployeeUnderSenior($user_id);
            if($get_other_employee != false){
                $get_other_employeeD=$get_other_employee;
            }
            $get_employeeD=array();
            $get_employee=$this->getEMpNormal($user_id,0);
            if($get_employee != false){
                $get_employeeD=$get_employee;
            }
            $result=array_merge($get_other_employeeD,$get_employeeD);
        }

        $response['status']=200;
        $response['data']=$result;
        echo json_encode($response);

    }
    function getEMpNormal($user_id,$all_access){
        $result = $this->get_firm_id();
        if ($result !== false) {
            $firm_id = $result['firm_id'];
        }
        $get_group_id=$this->db->query("select group_id from partner_header_all where firm_id='".$firm_id."'");
        if($this->db->affected_rows() > 0){
            $group_id=$get_group_id->row()->group_id;
        }else{
            $group_id=0;
        }

        if($all_access == 1){
            $query=$this->db->query("select user_id,id,user_name,focus_area_control from user_header_all where activity_status=1 AND user_type=4 AND firm_id in(select firm_id from partner_header_all where group_id=".$group_id.")");
        }else{
            $query=$this->db->query("select id,user_name,user_id,focus_area_control from user_header_all where senior_user_id='".$user_id."' AND activity_status=1");
        }

        if($this->db->affected_rows() > 0){
            $result=$query->result();
            return $result;
        }else{
            return false;
        }
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
    function getOtheremployeeUnderSenior($user_id){
        $user_id=$this->session->user_session->user_id;
        $query=$this->db->query("select user_id,(select u.user_name from user_header_all u where u.user_id=e.user_id) as user_name,
(select u.id from user_header_all u where u.user_id=e.user_id) as id,
(select u.focus_area_control from user_header_all u where u.user_id=e.user_id) as focus_area_control
 from employee_senior_combination e where find_in_set('".$user_id."',senior_id)");
        if($this->db->affected_rows() > 0){
            $result=$query->result();
            return $result;
        }else{
            return false;
        }
    }

    public function GetFocusassigntoemployee(){
        $id=$this->session->user_session->id;
        $query=$this->db->query("select focus_details,id from focus_master where id in (select focus_id from focus_assignment where assign_to=".$id.")");
        if($this->db->affected_rows() > 0){
            $result=$query->result();
            $response['status']=200;
            $response['data']=$result;
        }else{
            $response['status']=201;
            $response['data']="";
        }echo json_encode($response);
    }


    public function addTask(){
        $user_array=$this->input->post('userdata1');
        $task_details=$this->input->post('task_details');
        $user_id=$this->session->user_session->id;//from session
        $data_master=array(
            "task_details"=>$task_details,
            "created_by"=>$user_id,
            "created_on"=>date('Y-m-d h:i:s'),
            "status"=>1,
            "activity_status"=>1
        );
        $final_assignment_array=array();
        if(!empty($user_array)){

            $user_array=explode(',', $user_array);
            foreach ($user_array as $assign_to){
                $data_assignment=array(
                    "user_id"=>$assign_to,
                    "created_on"=>date('Y-m-d H:i:s'),
                    "status"=>1,
                    "activity_status"=>1
                );
                array_push($final_assignment_array,$data_assignment);
            }
        }
        //insert function
        $insert=$this->FocusViewModel->addTaskassignment($data_master,$final_assignment_array);
        if($insert == true){
            $response['status']=200;
            $response['body']="Added Successfully";
        }else{
            $response['status']=200;
            $response['body']="Failed To add";
        }echo json_encode($response);
    }

    function getTaskAssignToEmployee(){
        $user_id=$this->input->post('user_id');
        if($user_id==null)
        {
            $user_id=$this->session->user_session->id;//from session
        }
        $query=$this->db->query("select tm.*,(select group_concat(tm.created_by,'||',um.user_name) from user_header_all um where um.id=tm.created_by) as assign_by from task_master tm where tm.activity_status=1 AND 
                tm.id in (select ta.task_id from task_assignment ta where tm.completion_status != 2 AND ta.user_id= ".$user_id.")");
        if($this->db->affected_rows() > 0){
            $result=$query->result();
            $response['status']=200;
            $response['data']=$result;
        }else{
            $response['status']=201;
            $response['data']="";
        }echo json_encode($response);
    }
    function getTaskAssignBYEmployee(){
        $user_id=$this->input->post('user_id');
        if($user_id==null)
        {
            $user_id=$this->session->user_session->id;//from session
        }

        $query=$this->db->query("select tm.*,(select group_concat(fa.user_id,'||',(select um.user_name from user_header_all um where um.id=fa.user_id)) from task_assignment fa where fa.task_id=tm.id) as assign_to
            from task_master tm where tm.activity_status=1 AND tm.created_by=".$user_id." order by id desc");
        if($this->db->affected_rows() > 0){
            $result=$query->result();
            $note_array=array();
            $noteID_array=array();
            foreach ($result as $row){
                $note_id=$row->note_id;

                $id=$row->id;
                $id1="a_".$id;
                if($note_id !== null || !empty($note_id)){
                    $data=$this->getDatafromRMTtable($note_id,$id);
                    if($data!=false){
                        $exp=explode(",",$data);
                        $data1="";
                        foreach ($exp as $e){
                            $exp2=explode("/",$e);
                            $data1 .=$exp2[3].",";
                        }

                        $note_array[$id1]=rtrim($data1,",");
                        $noteID_array[$id1]=$note_id;
                    }else{
                        $note_array[$id1]='';
                        $noteID_array[$id1]='';
                    }

                }else{
                    $note_array[$id1]='';
                    $noteID_array[$id1]='';
                }

            }
            $response['status']=200;
            $response['data']=$result;
            $response['note_data']=$note_array;
            $response['noteID_data']=$noteID_array;
        }else{
            $response['status']=201;
            $response['data']="";
        }echo json_encode($response);
    }
    function getDatafromRMTtable($note_id,$id){
        if($note_id !="") {

            $query = $this->db2->query("SELECT group_concat(upload_file) as allfiles FROM file_master_data where file_id in (" . $note_id . ")");
            //echo $this->db2->last_query();
            if ($this->db2->affected_rows() > 0) {
                return $query->row()->allfiles;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
    function deletetask(){
        $task_id=$this->input->post('task_id');
        $where=array("id"=>$task_id);
        $set=array("activity_status"=>0);
        $this->db->where($where);
        $update=$this->db->update('task_master',$set);
        if($update == true){
            $response['status']=200;
            $response['body']="Deleted Successfully";
        }else{
            $response['status']=200;
            $response['body']="Something Went wrong";
        }echo json_encode($response);
    }
    public function updateTaskAssignByUView()
    {
        // print_r($this->input->post());exit();
        $task_id=$this->input->post('task_id');
        $task_detail=$this->input->post('task_detail');
        $employee_ids=$this->input->post('employee_ids');
        $note_ids=$this->input->post('note_ids');
        $update_array=array('task_details'=>$task_detail,"note_id"=>$note_ids);
        $final_assignment_array=array();
        if(!empty($employee_ids)){

            $user_array=explode(',', $employee_ids);
            foreach ($user_array as $assign_to){
                $data_assignment=array(
                    "user_id"=>$assign_to,
                    "created_on"=>date('Y-m-d H:i:s'),
                    "status"=>1,
                    "activity_status"=>1,
                    "task_id"=>$task_id
                );
                array_push($final_assignment_array,$data_assignment);
            }
        }
        // $query=$this->db->query("update task_master SET task_details='".$task_detail."' WHERE id=".$task_id);
        $insert=$this->FocusViewModel->updateTaskassignment($update_array,$final_assignment_array,$task_id);
        if($insert==true){
            $response['status']=200;
            $response['body']="Updated SuccessFully";
        }else{
            $response['status']=200;
            $response['body']="Failed To Update";
        }echo json_encode($response);
    }

    function AddActivityComment(){
        // print_r($this->input->post());exit();
        $comment=$this->input->post('comment');
        $file=$this->input->post('file');
        // print_r($_FILES);exit();
        $created_by=$this->session->user_session->id;//from session id
        $activity_id=$this->input->post('activity_id');
        $upload_path = "uploads";
        $combination = 2;
        $name_input='file';
        $result = $this->upload_file($upload_path, $name_input, $combination);
        // print_r($result['status']);exit();
        if ($result['status']==200) {
            if ($result['body'][0] == "uploads/") {
                $input_data = "";
            } else {
                $input_data = $result['body'][0];
            }

        } else {
            $input_data = "";
        }
        $data_array=array(
            "activity_id"=>$activity_id,
            "comment"=>$comment,
            "file"=>$input_data,
            "created_on"=>date('Y-m-d H:i:s'),
            "created_by"=>$created_by,
        );
        $tablename='activity_comments';

        $insert=$this->FocusViewModel->AddComment($data_array,$tablename);
        if($insert == true){
            $response['status']=200;
            $response['body']="Added Successfully";
        }else{
            $response['status']=200;
            $response['body']="Failed To add";
        }echo json_encode($response);
    }
    public function getActivityComment()
    {
        $activity_id=$this->input->post('activity_id');
        $query=$this->db->query("select * from activity_comments WHERE activity_id=".$activity_id);
        if($this->db->affected_rows() > 0){
            $result=$query->result();
            $response['status']=200;
            $response['data']=$result;
        }else{
            $response['status']=200;
            $response['data']=array();
            $response['body']='no comment data';
        }echo json_encode($response);
    }
    public function getTaskToComment()
    {
        $task_id=$this->input->post('task_id');
        $query=$this->db->query("select * from task_comments WHERE task_id=".$task_id);
        if($this->db->affected_rows() > 0){
            $result=$query->result();
            $response['status']=200;
            $response['data']=$result;
        }else{
            $response['status']=200;
            $response['data']=array();
            $response['body']='no comment data';
        }echo json_encode($response);
    }
    function AddTaskToComment(){
        // print_r($this->input->post());exit();
        $comment=$this->input->post('comment');
        $file=$this->input->post('file');
        // print_r($_FILES);exit();
        $created_by=$this->session->user_session->id;//from session id
        $task_id=$this->input->post('task_id');
        $upload_path = "uploads";
        $combination = 2;
        $name_input='file';
        $result = $this->upload_file($upload_path, $name_input, $combination);
        // print_r($result['status']);exit();
        if ($result['status']==200) {
            if ($result['body'][0] == "uploads/") {
                $input_data = "";
            } else {
                $input_data = $result['body'][0];
            }

        } else {
            $input_data = "";
        }
        $data_array=array(
            "task_id"=>$task_id,
            "comment"=>$comment,
            "file"=>$input_data,
            "created_on"=>date('Y-m-d H:i:s'),
            "created_by"=>$created_by,
        );
        $tablename='task_comments';

        $insert=$this->FocusViewModel->AddComment($data_array,$tablename);
        if($insert == true){
            $response['status']=200;
            $response['body']="Added Successfully";
        }else{
            $response['status']=200;
            $response['body']="Failed To add";
        }echo json_encode($response);
    }
    function CompleteFocusView(){
        $focus_id=$this->input->post('focus_id');
        $query=$this->db->query("update focus_master SET completion_status=2 WHERE id=".$focus_id);
        if($this->db->affected_rows() > 0){
            $response['status']=200;
            $response['body']="Status Changed SuccessFully";
        }else{
            $response['status']=200;
            $response['body']="Failed To Change Status";
        }echo json_encode($response);
    }
    function CompleteTaskView(){
        $task_id=$this->input->post('task_id');
        $query=$this->db->query("update task_master SET completion_status=2 WHERE id=".$task_id);
        if($this->db->affected_rows() > 0){
            $response['status']=200;
            $response['body']="Status Changed SuccessFully";
        }else{
            $response['status']=200;
            $response['body']="Failed To Change Status";
        }echo json_encode($response);
    }

}

