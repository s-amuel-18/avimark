<?php 
class Empleado_model extends CI_Model {
  public function __construct() {
    parent::__construct();
    $this->load->database();
    $this->tabla = "empleados";
  }

  public function get_all()
  {
    $sql = "SELECT empl.id,
                   empl.nombre,
                   cat.nombre AS 'cartera',
                   empl.email,
                   IF( usu.nombre_usuario IS NULL, 'Sin Usuario', usu.nombre_usuario ) AS usuario_creacion,
                   IF( empl.updated_at IS NULL, 'Sin Actualizar', DATE_FORMAT(empl.updated_at, '%d/%m/%Y')  ) AS updated_at,
                  DATE_FORMAT(empl.created_at, '%d/%m/%Y') AS created_at
                   FROM {$this->tabla} AS empl
            LEFT JOIN usuarios AS usu ON empl.usuario_id = usu.id 
            LEFT JOIN carteras AS cat ON empl.cartera_id = cat.id 
            ORDER BY empl.created_at";
            // echo $sql;die();
            // var_dump($sql);die();
  return $this->db->query($sql)->result();

  }
}
