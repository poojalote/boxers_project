<?php
require_once 'HexaController.php';
class EventController extends HexaController
{


    function __construct()
    {
        parent::__construct();
        $this->load->model('Globalmodel');
    }

    function index(){
        $this->load->view('admin/add_events');
    }

    function AddEvent(){
        $event_name=$this->input->post('event_name');
        $event_start_time=$this->input->post('event_starttime');
        $event_end_time=$this->input->post('event_endtime');
        $event_description=$this->input->post('editor');
        $event_date=$this->input->post('Og_date');
        $event_loc=$this->input->post('event_loc');
        $updateID=$this->input->post('updateID');


        if(empty($event_name) || is_null($event_name)){
            $response['status']=201;
            $response['body']="Add Event Name";
        }elseif (empty($event_loc) || is_null($event_loc)){
            $response['status']=201;
            $response['body']="Add Start Time";
        }elseif (empty($event_start_time) || is_null($event_start_time)){
            $response['status']=201;
            $response['body']="Add Start Time";
        }elseif (empty($event_end_time) || is_null($event_end_time)){
            $response['status']=201;
            $response['body']="Add End Time";
        }elseif (empty($event_description) || is_null($event_description)){
            $response['status']=201;
            $response['body']="Add Event Description";
        }else{
            $upload_path = "uploads";
            $combination = 2;
            $name_input='userfile';
            $result = $this->Globalmodel->upload_file($upload_path, $name_input, $combination);
            if ($result['status']==200) {
                if ($result['body'][0] == "uploads/") {
                    $input_data = "";
                } else {
                    $input_data = $result['body'][0];
                }

            } else {
                $input_data = "";
            }
            $data=array(
                "event_name"=>$event_name,
                "event_description"=>$event_description,
                "start_time"=>$event_start_time,
                "end_time"=>$event_end_time,
                "location"=>$event_loc,
                "event_date"=>$event_date,
            );
            //echo $updateID;
            if(!isset($updateID) || empty($updateID)){
                if ($_FILES['userfile']['size'] == 0 && $_FILES['userfile']['error'] == 0){
                    $response['status']=201;
                    $response['body']="Add Event File";
                }else{
                    $data["event_image"]=$input_data;
                    $insert=$this->Globalmodel->insert('event_master_table',$data);
                    if(!empty($insert) && !is_null($insert)){
                        $response['status']=200;
                        $response['body']="Added Successfully.";
                    }else{
                        $response['status']=201;
                        $response['body']="Something went Wrong. Please try again later1.";
                    }
                }

            }else{
                if ($_FILES['userfile']['size'] == 0 && $_FILES['userfile']['error'] == 0){

                }else{
                    $data["event_image"]=$input_data;
                }
                $update=$this->Globalmodel->update('event_master_table',$data,array("id"=>$updateID));
                if($update > 0){
                    $response['status']=200;
                    $response['body']="Update Successfully.";
                }else{
                    $response['status']=201;
                    $response['body']="Something went Wrong. Please try again later.";
                }
            }

        }echo json_encode($response);
    }

    function GetEventData()
    {

            $query = $this->db->query("select * from event_master_table where  status=1");
        $new_Array = array();
        if ($this->db->affected_rows() > 0) {

            $result = $query->result();
            foreach ($result as $row) {
                $object = new stdClass();
                $object->id = $row->id;
                $object->start = $row->event_date;
                $object->color = "#f9f9f9";
                $object->textColor = "#ffff";
                $object->eventDisplay = "list-item";
                $b_color = "#d2454d";
                $object->backgroundColor = $b_color;
                $object->type = "event";
                $object->title =$row->event_name;
                array_push($new_Array, $object);
            }
        }
        $response['status'] = 200;
        $response['data']=$new_Array;
        echo json_encode($response);
    }

    function GetEventByDate(){

        $id=$this->input->post('id');
        $query = $this->db->query("select * from event_master_table where  status=1 AND id='".$id."'");
      //  echo $this->db->last_query();
        if($this->db->affected_rows() > 0){
            $result=$query->row();
            $response['status']=200;
            $response['data']=$result;
        }else{
            $response['status']=201;
            $response['data']="";
        }echo json_encode($response);
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
            $this->db->where("id", $event_id);
            $update = $this->db->update("event_master_table", $data);
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