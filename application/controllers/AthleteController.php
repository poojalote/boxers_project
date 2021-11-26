<?php
require_once 'HexaController.php';
class AthleteController extends HexaController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Globalmodel');
    }

    function index(){
        $this->load->view('admin/add_athlete');
    }

    function AddAthlete(){
        $ath_name=$this->input->post('ath_name');
        $ath_contact=$this->input->post('ath_contact');
        $email_id=$this->input->post('email_id');
        $location=$this->input->post('location');
        $details=$this->input->post('editor');
        $updateID=$this->input->post('updateID');


        if(empty($ath_name) || is_null($ath_name)){
            $response['status']=201;
            $response['body']="Add Athlete Name";
        }elseif (empty($ath_contact) || is_null($ath_contact)){
            $response['status']=201;
            $response['body']="Add Contact Number";
        }elseif (empty($email_id) || is_null($email_id)){
            $response['status']=201;
            $response['body']="Add Email Id";
        }elseif (empty($location) || is_null($location)){
            $response['status']=201;
            $response['body']="Add Location";
        }elseif (empty($details) || is_null($details)){
            $response['status']=201;
            $response['body']="Add Athlete Details";
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
                "name"=>$ath_name,
                "contact_number"=>$ath_contact,
                "email_id"=>$email_id,
                "loaction"=>$location,
                "other_info"=>$details,
            );
            //echo $updateID;
            if(!isset($updateID) || empty($updateID)){
                if ($_FILES['userfile']['size'] == 0 && $_FILES['userfile']['error'] == 0){
                    $response['status']=201;
                    $response['body']="Add Event File";
                }else{
                    $data["file"]=$input_data;
                    $insert=$this->Globalmodel->insert('athlete_master_table',$data);
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
                    $data["file"]=$input_data;
                }
                $update=$this->Globalmodel->update('athlete_master_table',$data,array("id"=>$updateID));
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

    function ViewAthelet(){
        $query=$this->db->query("select * from athlete_master_table where activity_status=1");
       $data="";
        if($this->db->affected_rows() > 0){
            $result=$query->result();
            foreach ($result as $item) {
                $btn1='<button class="btn btn-link" type="button"onclick="viewDetails(\''.$item->file.'\',\''.$item->other_info.'\');"><i class="fa fa-eye"></i></button>';
                $btn2='<button class="btn btn-link" onclick="deleteAthlete('.$item->id.');"><i class="fa fa-trash"></i></button>';
                $data.="<tr>
<td>".$item->name."</td>
<td>".$item->email_id."</td>
<td>".$item->contact_number."</td>
<td>".$item->loaction."</td>
<td>".$item->file."</td>
<td>".$btn1.$btn2."</td>
</tr>";

            }
            $response['data']=$data;
            $response['status']=200;
        }else{
            $response['data']=$data;
            $response['status']=201;
        }echo json_encode($response);
    }
    function DeleteAthelet()
    {
        $id = $this->input->post('id');
        if (empty($id)) {
            $response['status'] = 201;
            $response['body'] = "Parameter Missing";
            echo json_encode($response);
            exit;
        } else {
            $data = array("activity_status" => 0);
            $this->db->where("id", $id);
            $update = $this->db->update("athlete_master_table", $data);
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