<?php 
class Email_contacto_model extends CI_Model {
  public function __construct() {
    parent::__construct();
    $this->load->database();
    $this->tabla = "emails_contacto";
  }

  public function get_all()
  {
    $sql = "SELECT em.id,
                   em.nombre,
                   em.email,
                   em.descripcion,
                   em.url,
                   IF( em.enviado = 0, 'Sin Enviar', 'Enviado' ) AS text_enviado,
                   IF( em.enviado = 0, 'danger', 'success' ) AS color_enviado,
                   IF( cat.nombre IS NULL, 'Sin Categoria', cat.nombre ) AS categoria,
                   IF( usu.nombre_usuario IS NULL, 'Sin Usuario', usu.nombre_usuario ) AS usuario_creacion,
                   IF( usu.foto IS NULL,  'assets/admin-lte/img/avatar.png', usu.foto) AS foto_usuario,
                   IF( em.updated_at IS NULL, 'Sin Actualizar', DATE_FORMAT(em.updated_at, '%d/%m/%Y')  ) AS updated_at,
                  DATE_FORMAT(em.created_at, '%d/%m/%Y') AS created_at
                   FROM {$this->tabla} AS em
            LEFT JOIN usuarios AS usu ON em.usuario_id = usu.id 
            LEFT JOIN categorias AS cat ON cat.id = em.categoria_id 
            ORDER BY em.created_at";
            // echo $sql;die();
            // var_dump($sql);die();
  return $this->db->query($sql)->result();

  }


  public function emails_dia_actual($limit = null, $count = null)
  {    
    $limit = ($limit AND is_numeric($limit)) ? "LIMIT $limit" : ""; 
    $select = !$count 
                ? "*,
                IF( enviado = 0, 'Sin Enviar', 'Enviado' ) AS val_enviado,
                DATE_FORMAT(created_at, '%d/%m/%Y') AS for_fecha" 
                : "COUNT(*) AS cantidad_emails";
    
    $sql = "SELECT {$select}
              
          FROM {$this->tabla} 
          WHERE YEAR(cast(created_at as date)) = YEAR(NOW()) AND MONTH(cast(created_at as date))=MONTH(NOW()) AND DAY(cast(created_at as date)) = DAY(now())  
          ORDER BY created_at DESC
          {$limit}";
      // var_dump($sql);die();
    return $this->db->query($sql)->result();
  }
}
