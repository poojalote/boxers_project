<?php

require_once 'MasterModel.php';

class loginModel extends MasterModel
{


	/**
	 * @param $username String username
	 * @param $password String password
	 * @return stdClass Object of result with totalCount and data
	 */
    public function login($username, $password)
    {

        return parent::_select2('user_header_all', array("email" => $username, "password" => $password),
            array("email", "id", "user_name", "password","user_id","linked_with_boss_id","user_type","is_employee","firm_id"));


    }
    public function getPayrollSession($username)
    {
        return parent::_select('user_header_all', array("email" => $username),
            array("email", "id", "user_name", "password","user_id","linked_with_boss_id","user_type","is_employee","firm_id"));
    }



}
