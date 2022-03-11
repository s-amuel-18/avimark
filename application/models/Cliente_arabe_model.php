<?php
class Cliente_arabe_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->tabla = "clientes";
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
				INNER JOIN servicios AS serv ON serv.id = serv_ar.servicio_id";
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
				";
		return $this->db->query($sql)->result();
	}
}
