<?php
require_once 'HexaController.php';

class StickyController extends HexaController
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('designation_model');
        $this->load->model('Globalmodel');
        $this->db2=$this->load->database('db2', TRUE);
    }

    function CreateNewSticky1()
    {
        $id = $this->session->user_session->id;//from session id
        $data = $this->input->post('data');
        $dataArr = json_decode($data);

        $d = array(
            "user_id" => $id,
            "title" => $dataArr->Title,
            "note_text" => $dataArr->NoteText,
            "pos_left" => $dataArr->PositionTop,
            "pos_top" => $dataArr->PositionLeft,
            "d_width" => $dataArr->DimensionWidth,
            "d_height" => $dataArr->DimensionHeight,
            "z_index" => $dataArr->ZIndex,
            "outer_css_class" => $dataArr->OuterCssClass,
            "sticky_id" => $dataArr->Id,
            "index" => $dataArr->Index,
            "created_on" => date('Y-m-d H:i:s'),
        );
        $insert = $this->db->insert('StickyNotes_master', $d);
        if ($insert == true) {
            $response['status'] = 200;
            $response['body'] = "Created Successfully";
        } else {
            $response['status'] = 201;
            $response['body'] = "Something Went Wrong";
        }
        echo json_encode($response);
    }

    function CreateNewSticky()
    {
        $id = $this->session->user_session->id;//from session id
        $data = $this->input->post('stickynote');
        $stickyID = $this->input->post('stickyID');

        if (!isset($stickyID) || empty(trim($stickyID))) {
            $d = array(
                "user_id" => $id,
                "title" => $data,
                "created_on" => date('Y-m-d H:i:s'),
            );
            $insert = $this->db->insert('StickyNotes_master', $d);
            $response['body'] = "Created Successfully";
        } else {
            $d = array(
                "title" => $data,
            );
            $this->db->where(array("id" => $stickyID));
            $insert = $this->db->update('StickyNotes_master', $d);
            $response['body'] = "Updated Successfully";
        }

        if ($insert == true) {
            $response['status'] = 200;

        } else {
            $response['status'] = 201;
            $response['body'] = "Something Went Wrong";
        }
        echo json_encode($response);
    }

    function UpdateSticky1()
    {
        $id = $this->session->user_session->id;//from session id
        $data = $this->input->post('data');
        $id_sts = $this->input->post('id');
        $dataArr = json_decode($data);

        $d = array(
            "title" => $dataArr->Title,
            "note_text" => $dataArr->NoteText,
            "pos_left" => $dataArr->PositionTop,
            "pos_top" => $dataArr->PositionLeft,
            "d_width" => $dataArr->DimensionWidth,
            "d_height" => $dataArr->DimensionHeight,
            "z_index" => $dataArr->ZIndex,
            "outer_css_class" => $dataArr->OuterCssClass,
        );
        if ($id_sts == 1) {
            $d['status'] = 0;
        }
        $this->db->where(array("id" => $dataArr->Id, "user_id" => $id));
        $insert = $this->db->update('StickyNotes_master', $d);

        if ($insert == true) {
            $response['status'] = 200;
            $response['body'] = "Updated Successfully";
        } else {
            $response['status'] = 201;
            $response['body'] = "Something Went Wrong";
        }
        echo json_encode($response);
    }

    function UpdateSticky()
    {
        $id = $this->session->user_session->id;//from session id
        $id_sts = $this->input->post('id');

        $d = array(
            "status" => 0
        );
        $this->db->where(array("id" => $id_sts, "user_id" => $id));
        $insert = $this->db->update('StickyNotes_master', $d);
        if ($insert == true) {
            $response['status'] = 200;
            $response['body'] = "Deleted Successfully";
        } else {
            $response['status'] = 201;
            $response['body'] = "Something Went Wrong";
        }
        echo json_encode($response);
    }

    function getAllSticky1()
    {
        $id = $this->session->user_session->id;//from session id
        $query = $this->db->query("select * from StickyNotes_master where status=1 AND user_id=" . $id);

        if ($this->db->affected_rows() > 0) {
            $result = $query->result();
            $final_array = array();

            foreach ($result as $row) {
                $object = new stdClass();
                $object->Title = $row->title;
                $object->NoteText = $row->note_text;
                $object->PositionTop = $row->pos_top;
                $object->PositionLeft = $row->pos_left;
                $object->DimensionWidth = $row->d_width;
                $object->DimensionHeight = $row->d_height;
                $object->ZIndex = $row->z_index;
                $object->OuterCssClass = $row->outer_css_class;
                $object->Id = $row->id;
                $object->index = $row->index;
                array_push($final_array, $object);
            }
            $response['status'] = 200;
            $response['data'] = $final_array;
        } else {
            $response['status'] = 201;
        }
        echo json_encode($response);
    }

    function getAllSticky()
    {
        $id = $this->session->user_session->id;//from session id
        $query = $this->db->query("select * from StickyNotes_master where status=1 AND user_id=" . $id . " order by id desc");

        if ($this->db->affected_rows() > 0) {
            $result = $query->result();
            $data = "";
            $data .= "<ul>";

            foreach ($result as $row) {
                $k = base64_encode($row->title);
                $data .= "<li style='line-height: normal;'>" . $row->title . "<button type='button' onclick='deleteSticky(" . $row->id . ")'
 class='btn btn-link btn-sm'><i class='fa fa-trash' style='color: orangered'></i></button>
<button type='button' onclick='updateStickyFetch(" . $row->id . ",\"" . $k . "\")' class='btn btn-link btn-sm'><i class='fa fa-pencil'></i></button>
</li>";
            }
            $data .= "</ul>";
            $response['status'] = 200;
            $response['data'] = $data;
        } else {
            $response['status'] = 201;
            $response['data'] = "";
        }
        echo json_encode($response);
    }

    //----------------------------------------------folder Notes Work By pooja-----------------------------------------------
    function getRmtUserId($email){
        $query=$this->db2->query("select user_id from user_header_all where email='".$email."'");
        if($this->db2->affected_rows() > 0){
            return $query->row()->user_id;
        }else{
            return false;
        }
    }
    function getFolderName($email){

        //master_user_folder
        $query=$this->db2->query("select root_folder from master_user_folder where user_name='".$email."'");

        if($this->db2->affected_rows() > 0){
            return $query->row()->root_folder;
        }else{
            return false;
        }
    }
    function get_file_by_file_id($file_id)
    {
        try {
            return $this->db2->where(array('file_id' => $file_id, 'status' => 1))
                ->get('file_master_data')->row();
        } catch (Exception $ex) {
            return null;
        }
    }
    function createNotes()
    {

        //need to get user id from db2 using session mail id
        $email = $this->session->user_session->email;
        $getRMTuser_id=$this->getRmtUserId($email);
      $folder_name=$this->getFolderName($email);
      if($folder_name=="" || $folder_name == false){
          $response['body'] = 'Folder Not Found';
          $response['status'] = 202;
          echo json_encode($response);
          exit;
      }
        if($getRMTuser_id !== false){
            $uploaded_by=$getRMTuser_id;
        }
    //    $uploaded_by = $this->session->user_session->user_id;
        if (!is_null($this->input->post('noteName'))) {
            $file_id = $this->input->post('file_id');
            $fileObject = $this->get_file_by_file_id($file_id);
            $fileBody = $this->input->post('noteBody');
            if (empty($fileBody)) {
                $fileBody = "<p> </p>";
            }
            if (is_null($fileObject)) {
                $filePath = 'Main_folder/'.$folder_name ."/". $this->input->post('noteName') . '.txt';
            } else {
                $filePath = $fileObject->upload_file;
            }

            $file = fopen($filePath, 'w');
            fwrite($file, $fileBody);
            fclose($file);

            $type = 0;
            if (is_null($file_id)) {
                $file_id = $this->get_file_id();
            } else {
                $type = 1;
            }
            $fileData = array(
                'file_id' => $file_id,
                    'upload_file' => $filePath,
                'created_on' => date('Y-m-d H:i:s'),
                'status' => 1,
                'uploaded_by' => $uploaded_by
            );
            $noteData = array(
                'modify_at' => date('Y-m-d H:i:s'),
                'modify_by' => $uploaded_by
            );
            $this->notes($noteData, $fileData, $type, $file_id);
            $response['body'] = 'Save File';
            $response['status'] = 200;
        } else {
            $response['body'] = 'Missing Parameter';
            $response['status'] = 202;
        }
        echo json_encode($response);
    }
    function get_file_id()
    {
        $file_id = rand(10, 1000);
        $this->db2->select('*');
        $this->db2->from('file_master_data');
        $this->db2->where('file_id', $file_id);
        $this->db2->get();
        if ($this->db2->affected_rows() > 0) {
            return $this->get_file_id();
        } else {
            return $file_id;
        }
    }
    function notes($noteData, $fileData, $type, $file_id)
    {
        try {
            $this->db2->trans_start();
            if ($type == 0) {
                $this->db2->insert('file_master_data', $fileData);
                $id = $this->db2->insert_id();
                $noteData['note_file'] = $file_id;

                $this->db2->insert('file_notes_master_data', $noteData);
            } else {
                $this->db2->set($noteData)->where('note_file', $file_id)
                    ->update('file_notes_master_data');
            }
            if ($this->db2->trans_status() === FALSE) {
                $this->db2->trans_rollback();
                log_message('info', "insert user Transaction Rollback");
                $result = FALSE;
            } else {
                $this->db2->trans_commit();
                log_message('info', "insert user Transaction Commited");
                $result = TRUE;
            }
        } catch (Exception $e) {
            $result = FALSE;
        }
        return $result;
    }
    function readNotes() {
        if (!is_null($this->input->post('file_id'))) {
            $file_id = $this->input->post('file_id');
            $fileObject = $this->get_file_by_file_id($file_id);

            if (!is_null($fileObject)) {
                if (file_exists($fileObject->upload_file)) {
                    $file = fopen($fileObject->upload_file, 'r') or die('Unable To Open File');
                    $size = filesize($fileObject->upload_file);
                    if ($size <= 0) {
                        $size = 1;
                    }
                    $fileBody = fread($file, $size);
                    fclose($file);
                    $response['status'] = 200;
                    $response['body'] = $fileBody;
                } else {
                    $response['status'] = 202;
                    $response['body'] = 'File Not Found';
                }
            } else {
                $response['status'] = 201;
                $response['body'] = 'File not Found';
            }
        } else {
            $response['status'] = 201;
            $response['body'] = 'Missing Parameter';
        }
        echo json_encode($response);
    }
}