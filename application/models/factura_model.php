<?php
class Factura_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->tabla = "facturas";
  }

  public function get_all($id = null)
  {
    $where = $id ? "WHERE fac.id = " . $id : "";

    $sql = "SELECT
              fac.id,
              fac.numero_factura,
              fac.servicio_trabajo,
              IF( us.foto IS NULL,  'assets/admin-lte/img/avatar.png', us.foto) AS foto_usuario,
              IF( us.nombre_usuario IS NULL, 'Sin Usuario', us.nombre_usuario ) AS nombre_usuario,
              DATE_FORMAT(fac.created_at, '%d/%m/%Y') AS fac_created_at,              
              IF( fac.updated_at IS NULL, 'Sin Actualizar', DATE_FORMAT(fac.updated_at, '%d/%m/%Y')  ) AS updated_at,
              inf.nombre_empresa,
              inf.direccion_empresa,
              inf.telefono_empresa,
              inf.email_empresa,
              cli.id AS id_cliente,
              cli.nombre AS nombre_cliente,
              cli.nombre_empresa AS nombre_empresa_cliente,
              cli.telefono AS telefono_cliente,
              cli.email AS email_cliente,
              car.id AS id_cartera,
              car.email AS email_cartera,
              car.id AS id_cartera,
              IF( car.nombre IS NULL, 'Sin Cartera', car.nombre ) AS nombre_cartera,
              (
                SELECT COUNT( preci.id ) 
                FROM precio_servicios AS preci 
                INNER JOIN categorias AS cate ON cate.id = preci.categoria_id
                WHERE preci.factura_id = fac.id ) AS cantidad_categorias
            FROM {$this->tabla} fac
            LEFT JOIN usuarios AS us ON fac.usuario_id = us.id
            LEFT JOIN informacion_interna AS inf ON fac.info_interna_id = inf.id
            LEFT JOIN clientes AS cli ON fac.cliente_id = cli.id
            LEFT JOIN carteras AS car ON fac.cartera_id = car.id
            {$where}
            ORDER BY cli.id 
    ";

    return $this->db->query($sql)->result();
  }

  public function servicios_factura($factura_id)
  {
    $sql = "SELECT 
              cat.nombre AS nombre_categoria,
              cat.id AS categoria_id,
              pre.cantidad,
              pre.precio,
              ( pre.cantidad * pre.precio ) AS total
            FROM precio_servicios pre
            INNER JOIN categorias AS cat ON cat.id = pre.categoria_id
            WHERE pre.factura_id = {$factura_id}
            ";

    return $this->db->query($sql)->result();
  }
  public function total_servicios_factura($factura_id)
  {
    $sql = "SELECT 
              SUM( pre.cantidad ) AS total_cantidad,
              SUM( pre.cantidad *   pre.precio ) AS total_pago
            FROM precio_servicios pre 
            WHERE pre.factura_id = {$factura_id}

            ";
// var_dump($sql);die();
    return $this->db->query($sql)->row();
  }
}
