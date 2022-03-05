<?php 
class Cartera_model extends CI_Model {
  public function __construct() {
    parent::__construct();
    $this->load->database();
    $this->tabla = "carteras";
  }

  public function get_all()
  {
    $sql = "SELECT id,
                   nombre,
                   email,
                  DATE_FORMAT(created_at, '%d/%m/%Y') AS created_at,
                   IF( updated_at IS NULL, 'Sin Actualizar', DATE_FORMAT(updated_at, '%d/%m/%Y')  ) AS updated_at
                   FROM {$this->tabla}";
  return $this->db->query($sql)->result();

  }
}