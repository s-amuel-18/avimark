<?php
class Tasa_bolivares_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->tabla = "tasa_bolivar";
	}
}
