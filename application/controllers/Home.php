<?php

class Home  extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->model([
      "Auth_model"
    ]);

    $this->load->helper([
      "url",
      "message_helper"
    ]);

    $this->load->library([
      "parser",
      "form_validation",
      "session"
    ]);
  }

  public function index()
  {
	$ip_address_user = $_SERVER["REMOTE_ADDR"];

	$ip_valid = $this->db->get_where("visitas", ["ip_address" => $ip_address_user])->num_rows();

	if( $ip_valid < 0 ){
		
		$this->db->insert("visitas", ["ip_address" => $ip_address_user]);

	}

	  
    $view["body"] = $this->load->view("front/index", [], true);
    $this->parser->parse("front/template/body", $view);
  }


}
