<?php 
class Servicio_model extends CI_Model {
  public function __construct() {
    parent::__construct();
    $this->load->database();
    $this->tabla = "servicios";
  }

  public function get_all()
  {
    $sql = "SELECT ser.id,
                   ser.nombre,
                   ser.precio_total,
                   ser.precio_empleado,
                   ser.precio_empleado_mayor,
									 IF( usu.nombre_usuario IS NULL, 'Sin Usuario', usu.nombre_usuario ) AS usuario_creacion,
									 IF( usu.foto IS NULL,  'assets/admin-lte/img/avatar.png', usu.foto) AS foto_usuario,
                  	DATE_FORMAT(ser.created_at, '%d/%m/%Y') AS created_at,
                   IF( ser.updated_at IS NULL, 'Sin Actualizar', DATE_FORMAT(ser.updated_at, '%d/%m/%Y')  ) AS updated_at
                   FROM {$this->tabla} AS ser
									 LEFT JOIN usuarios AS usu ON usu.id = ser.usuario_id";
  return $this->db->query($sql)->result();

	// "SELECT 
	// 	id,
	// 	nombre,
	// 	precio_total,
	// 	precio_empleado,
	// 	precio_empleado_mayor,
	// 	IF( usu.nombre_usuario IS NULL, 'Sin Usuario', usu.nombre_usuario ) AS usuario_creacion,
	// 	DATE_FORMAT(created_at,
	// 	'%d/%m/%Y') AS created_at,
	// 	IF( updated_at IS NULL, 'Sin Actualizar', DATE_FORMAT(updated_at, '%d/%m/%Y') ) AS updated_at 
	// FROM servicios AS ser 
	// LEFT JOIN usuarios AS usu 
	// 	ON usu.id = ser.usuario_id"

  }
}
