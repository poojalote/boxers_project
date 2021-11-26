<?php

require_once 'HexaController.php';

/**
 * @property  User User
 * @property  loginModel loginModel
 */
class BoxingController extends HexaController
{

	function __construct()
	{
		parent::__construct();
		
	}

	/*
	 * login api
	 */
	public function index()
	{
		$this->load->view('boxing/boxing_index',array("title"=>"Boxing"));
	}
	public function gallery()
	{
		$this->load->view('boxing/boxing_gallery');
	}
	public function contactus()
	{
		$this->load->view('boxing/boxing_contact');
	}
	public function about()
	{
		$this->load->view('boxing/boxing_about');
	}
	public function event()
	{
		$this->load->view('boxing/boxing_event');
	}
	public function eventdetails()
	{
		$this->load->view('boxing/boxer_details');
	}

}
