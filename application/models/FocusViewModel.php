<?php

require_once 'MasterModel.php';

class FocusViewModel extends MasterModel
{
    function addFocusView($data_master, $final_assignment_array,$parent_focus_id)
    {
        try {
            $this->db->trans_start();
                $insert=$this->db->insert('focus_master', $data_master);
                $insert_id=$this->db->insert_id();
                if(is_null($parent_focus_id))
                {
                    $this->db->update('focus_master',array('parent_focus_id'=>$insert_id),array('id'=>$insert_id));
                }
                $final_assignment_array2=array();
                if(count($final_assignment_array) > 0 && $insert==true){
                    foreach ($final_assignment_array as $inside_array){
                        $inside_array['focus_id']=$insert_id;
                        array_push($final_assignment_array2,$inside_array);
                    }
                    $insert_batch=$this->db->insert_batch('focus_assignment',$final_assignment_array2);
                }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                log_message('info', "insert user Transaction Rollback");
                $result = FALSE;
            } else {
                $this->db->trans_commit();
                log_message('info', "insert user Transaction Commited");
                $result = TRUE;
            }
            $this->db->trans_complete();
        } catch (Exception $exc) {
            log_message('error', $exc->getMessage());
            $result = FALSE;
        }
        return $result;
    }
    function  addTaskassignment($data_master, $final_assignment_array){

        try {
            $this->db->trans_start();
            $insert=$this->db->insert('task_master', $data_master);
            $insert_id=$this->db->insert_id();

            $final_assignment_array2=array();
            if(count($final_assignment_array) > 0 && $insert==true){
                foreach ($final_assignment_array as $inside_array){
                    $inside_array['task_id']=$insert_id;
                    array_push($final_assignment_array2,$inside_array);
                }
                $insert_batch=$this->db->insert_batch('task_assignment',$final_assignment_array2);
            }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                log_message('info', "insert user Transaction Rollback");
                $result = FALSE;
            } else {
                $this->db->trans_commit();
                log_message('info', "insert user Transaction Commited");
                $result = TRUE;
            }
            $this->db->trans_complete();
        } catch (Exception $exc) {
            log_message('error', $exc->getMessage());
            $result = FALSE;
        }
        return $result;
    }
    function AddComment($data_array,$tableName){
        try {
            $this->db->trans_start();
            $this->db->insert($tableName, $data_array);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                log_message('info', "insert user Transaction Rollback");
                $result = FALSE;
            } else {
                $this->db->trans_commit();
                log_message('info', "insert user Transaction Commited");
                $result = TRUE;
            }
            $this->db->trans_complete();
        } catch (Exception $exc) {
            log_message('error', $exc->getMessage());
            $result = FALSE;
        }
        return $result;
    }
    function AddTodaysActivity($data){
        try {
            $this->db->trans_start();
            $this->db->insert('activity_master', $data);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                log_message('info', "insert user Transaction Rollback");
                $result = FALSE;
            } else {
                $this->db->trans_commit();
                log_message('info', "insert user Transaction Commited");
                $result = TRUE;
            }
            $this->db->trans_complete();
        } catch (Exception $exc) {
            log_message('error', $exc->getMessage());
            $result = FALSE;
        }
        return $result;
    }

    function  updateTaskassignment($data_master, $final_assignment_array,$task_id){

        try {
            $this->db->trans_start();
            $where=array('id'=>$task_id);
            $update=$this->db->update('task_master', $data_master,$where);
            $this->db->where('task_id',$task_id);
            $delete=$this->db->delete('task_assignment');
            if($delete==true)
            {
                $final_assignment_array2=array();
                if(count($final_assignment_array) > 0){
                    foreach ($final_assignment_array as $inside_array){
                        array_push($final_assignment_array2,$inside_array);
                    }
                    $insert_batch=$this->db->insert_batch('task_assignment',$final_assignment_array2);
                }
            }
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                log_message('info', "insert user Transaction Rollback");
                $result = FALSE;
            } else {
                $this->db->trans_commit();
                log_message('info', "insert user Transaction Commited");
                $result = TRUE;
            }
            $this->db->trans_complete();
        } catch (Exception $exc) {
            log_message('error', $exc->getMessage());
            $result = FALSE;
        }
        return $result;
    }
    function  updateFocusView($data_master, $final_assignment_array,$focus_id){

        try {
            $this->db->trans_start();
            $where=array('id'=>$focus_id);
            $update=$this->db->update('focus_master', $data_master,$where);
            $this->db->where('focus_id',$focus_id);
            $delete=$this->db->delete('focus_assignment');
            if($delete==true)
            {
                $final_assignment_array2=array();
                if(count($final_assignment_array) > 0){
                    foreach ($final_assignment_array as $inside_array){
                        array_push($final_assignment_array2,$inside_array);
                    }
                    $insert_batch=$this->db->insert_batch('focus_assignment',$final_assignment_array2);
                }
            }
            
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                log_message('info', "insert user Transaction Rollback");
                $result = FALSE;
            } else {
                $this->db->trans_commit();
                log_message('info', "insert user Transaction Commited");
                $result = TRUE;
            }
            $this->db->trans_complete();
        } catch (Exception $exc) {
            log_message('error', $exc->getMessage());
            $result = FALSE;
        }
        return $result;
    }

}