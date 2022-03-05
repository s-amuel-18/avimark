<?php 
class Usuarios_model extends CI_Model {
  public function __construct() {
    parent::__construct();
    $this->load->database();
    $this->tabla = "usuarios";
  }

  public function consulta_usuarios()
  {
    $sql = "SELECT id,
                   nombre,
                   nombre_usuario,
                   perfil,
                  --  password,
                   activado AS estado,
                   IF( foto IS NULL,  'assets/admin-lte/img/avatar.png', foto) AS foto,
                   IF( ultimo_login IS NULL, 'Sin Iniciar sesion', DATE_FORMAT(ultimo_login, '%d/%m/%Y')  ) AS ultimo_login,
                   IF( created_at IS NULL, 'Sin Iniciar sesion', DATE_FORMAT(created_at, '%d/%m/%Y')  ) AS created_at,
                   IF( activado = 1, 'Activado', 'Desactivado' ) AS activado,
                   IF( activado = 1, 'success', 'danger' ) AS activado_color
                   FROM {$this->tabla}";
  return $this->db->query($sql)->result();

  }
}