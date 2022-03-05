<?php 
class Cliente_model extends CI_Model {
  public function __construct() {
    parent::__construct();
    $this->load->database();
    $this->tabla = "clientes";
  }

  public function get_all()
  {
    $sql = "SELECT cl.id,
                   cl.nombre,
                   cl.nombre_empresa,
                   cl.email,
                   cl.telefono,
                   IF( usu.nombre_usuario IS NULL, 'Sin Usuario', usu.nombre_usuario ) AS usuario_creacion,
                   IF( updated_at IS NULL, 'Sin Actualizar', DATE_FORMAT(updated_at, '%d/%m/%Y')  ) AS updated_at,
                  DATE_FORMAT(cl.created_at, '%d/%m/%Y') AS created_at
                   FROM {$this->tabla} AS cl
            LEFT JOIN usuarios AS usu ON cl.usuario_id = usu.id 
            ORDER BY cl.created_at";
            // echo $sql;die();
            // var_dump($sql);die();
  return $this->db->query($sql)->result();

  }
}
