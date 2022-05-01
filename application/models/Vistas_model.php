<?php
class Vistas_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->tabla = "vistas";
  }

  public function vistas_semana()
  {
	  $sql = "SELECT 
			*
		FROM visitas
		WHERE WEEKOFYEAR(created_at )=WEEKOFYEAR(NOW())  AND YEAR(cast(created_at as date)) = YEAR(NOW()) 
		ORDER BY created_at DESC";

	  return $this->db->query($sql);
  }
	
}





