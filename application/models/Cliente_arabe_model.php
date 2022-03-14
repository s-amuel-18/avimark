<?php
class Cliente_arabe_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->tabla = "clientes";
	}



	public function servicios_con_servicios_arabe()
	{
		$sql = "SELECT 
					IF( serv_ar.id IS NULL, 0, 1 ) AS 'check',
					serv.id,
					serv.nombre,
					serv.precio_total,
					serv.precio_empleado,
					serv.precio_empleado_mayor
				FROM servicios AS serv
				LEFT JOIN servicios_arabe AS serv_ar ON serv_ar.servicio_id = serv.id
				ORDER BY serv.nombre";

		return $this->db->query($sql)->result();
	}

	public function cliente_con_cliente_arabe()
	{
		$sql = "SELECT 
					IF( modu.id IS NULL, 0, 1 ) AS 'check',
					cli.id,
					cli.nombre
				FROM clientes AS cli
				LEFT JOIN modulo_arabe AS modu ON modu.cliente_id = cli.id
				ORDER BY cli.nombre";

		return $this->db->query($sql)->result();
	}

	public function empleados_con_empleados_arabe()
	{
		$sql = "SELECT 
					IF( empl_ar.id IS NULL, 0, 1 ) AS 'check',
					empl.id,
					empl.nombre
				FROM empleados AS empl
				LEFT JOIN empleados_arabe AS empl_ar ON empl_ar.empleado_id = empl.id
				ORDER BY empl.nombre";

		return $this->db->query($sql)->result();
	}

	public function cliente_vinculado()
	{
		$sql = "SELECT 
					cli.*
				FROM modulo_arabe AS modu
				INNER JOIN clientes AS cli ON modu.cliente_id = cli.id";

		return $this->db->query($sql)->row();
	}

	public function servicios()
	{
		$sql = "SELECT 
					serv_ar.servicio_id,
					serv_ar.id,
					serv.nombre,
					serv.precio_total,
					serv.precio_empleado,
					serv.precio_empleado_mayor
				FROM servicios_arabe AS serv_ar
				INNER JOIN servicios AS serv ON serv.id = serv_ar.servicio_id
				ORDER BY serv.nombre ";
		return $this->db->query($sql)->result();
	}

	public function empleados()
	{
		$sql = "SELECT 
					empl_ar.empleado_id,
					empl_ar.id,
					empl.nombre,
					empl.email,
					empl.cartera_id
					
				FROM empleados_arabe AS empl_ar
				INNER JOIN empleados AS empl ON empl.id = empl_ar.empleado_id
				INNER JOIN carteras AS car ON car.id = empl.cartera_id
				ORDER BY empl.nombre";
		return $this->db->query($sql)->result();
	}

	public function eliminar_servicios_y_empleados()
	{
		$sql_empleado = "DELETE FROM empleados_arabe";
		$sql_servicios = "DELETE FROM servicios_arabe";
		$sql_modulo = "DELETE FROM modulo_arabe";

		$this->db->query($sql_empleado);
		$this->db->query($sql_servicios);
		$this->db->query($sql_modulo);
	}
}
