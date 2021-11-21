<?php

require_once 'HexaController.php';

/**
 * @property  User User
 * @property  loginModel loginModel
 */
class LoginController extends HexaController
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('loginModel');
		$this->load->model('MasterModel');
	}

	/*
	 * login api
	 */
	public function index()
	{
		$this->load->view('login',array("title"=>"Login"));
	}
    public function inlineTableTest()
    {
        $this->load->view('PayrollComponent/inlineTableEdit',array("title"=>"Login"));
    }
    public function loginUser()
    {
        // print_r($this->input->post());exit();
        $validationObject = parent::is_parameter(array("email", "password"));

        if ($validationObject->status) {
            $param = $validationObject->param;

            $resultData = $this->loginModel->login($param->email, $param->password);
            // print_r($resultData);exit();
            if ($resultData->totalCount > 0) {
                $userdata=$resultData->data;
                // print_r($userdata->id);exit();
                $email=$param->email;
                $resultData2 = $this->loginModel->getPayrollSession($param->email);
                if($resultData2->totalCount>0)
                {
                    $userdata1=$resultData2->data;
                    $userData = $resultData2->data;
                    $userData->id=$userdata1->id;
                    $userData->email=$email;
                    $this->session->user_session = $userData;
                    $response['status'] = 200;
                    $response['data'] = $userdata;
                    $response['body'] = 'login successfully';
                }
                else
                {
                    $response['status'] = 201;
                    $response['body'] = 'login failed';
                }


            }
            else{
                $response['status'] = 201;
                $response['body'] = 'login failed';
            }

        } else {
            $response['status'] = 201;
            $response['body'] = 'login failed';
        }
        echo json_encode($response);
    }
	public function LoginFromRMT($data =""){

	    $userArray=$this->input->post_get('data');
        $userArray=json_decode($userArray);
        $this->session->user_session = $userArray[0];

        header("Location:".base_url()."dashboard");
    }
	public function logout()
	{

		$this->session->sess_destroy();
        header("Location:https://rmt.docango.com");
		//redirect();
	}

	public function getDepartmentTableData()
	{
		$type = $this->input->post('type');

		$where = '';
		if (!is_null($this->input->post('companyId'))) {
			$companyId = $this->input->post('companyId');
			$where = 'where company_id="' . $companyId . '"';
		}
		$tableName = 'departments_master';
		$resultObject = $this->loginModel->getTableData($tableName, $where);
		//print_r($resultObject);exit();
		if ($resultObject->totalCount > 0) {
			$tableRows = array();
			foreach ($resultObject->data as $row) {
				$tableRows[] = array(
					$row->id,
					$row->name,
					$row->company_id,
					$row->status,
					$row->create_on,
					$row->create_by,
					$row->company_name
				);
			}
			$results = array(
				"data" => $tableRows
			);
		} else {
			$results = array(
				"draw" => (int)$_POST['draw'],
				"recordsTotal" => $resultObject->totalCount,
				"recordsFiltered" => $resultObject->totalRecored,
				"data" => $resultObject->data
			);
		}
		echo json_encode($results);

	}

	function login_validation(){
	    $username=$this->input->post('username');
	    $password=$this->input->post('paasword');
	    $where=array(
	        "email"=>$username,
	        "password"=>$password,
        );
	    $query=$this->MasterModel->_select("login_table",$where,"*");
	    if($query->totalCount == 0){
	        $response['status']=200;
        }else{
            $response['status']=201;
        }echo json_encode($results);
    }



}
