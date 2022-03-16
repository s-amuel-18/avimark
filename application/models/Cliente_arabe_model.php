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

	public function reportes($limit = null)
	{
		$limit_sql = $limit ? "LIMIT {$limit}" : "";

		$sql = "SELECT 
					id,
                   IF( reporte_facturado = 0, 'Sin Facturar', 'Facturado'  ) AS reporte_facturado,
                   IF( reporte_facturado = 0, 'danger', 'success'  ) AS reporte_facturado_color,
                   IF( updated_at IS NULL, 'Sin Actualizar', DATE_FORMAT(updated_at, '%d/%m/%Y')  ) AS updated_at,
				   DATE_FORMAT(created_at, '%d/%m/%Y') AS created_at
				FROM arabe_registros AS ar_reg
				ORDER BY created_at, id DESC
				$limit_sql";

		return $this->db->query($sql)->result();
	}

	public function reporte_completo($ids)
	{
		$sql = "SELECT
					-- sum(empl.id) NO VA 
					empl.id,
					-- ar_reg.id AS reporte_id
					empl.nombre,
					-- empl.cartera_id
					car.nombre AS 'cartera',
					-- ar_bon.empleado_id,
					SUM(ar_bon.bono) AS 'bono',
					SUM(ar_bon.tabajo_extra) AS 'tabajo_extra',
					SUM((
						-- este subselect nos permite buscar totos los servicios vinculados con el empleado y extraemos su cantidad
						SELECT
							SUM( ar_ser.cantidad )
						FROM arabe_servicios_cantidad AS ar_ser
						WHERE ar_ser.empleado_id = empl.id AND ar_ser.arabe_registro_id = ar_reg.id  
					)) AS suma_cantidades,
					NULL AS 'servicios'
				FROM arabe_registros AS ar_reg
				INNER JOIN arabe_bonos AS ar_bon ON ar_bon.arabe_registro_id = ar_reg.id 
				INNER JOIN empleados AS empl ON ar_bon.empleado_id = empl.id
				INNER JOIN carteras AS car ON empl.cartera_id = car.id
				WHERE ar_reg.id IN ($ids)
				GROUP BY empl.id 
				-- ORDER BY sum(ar_reg.id)
				ORDER BY SUM((SELECT
							SUM( ar_ser.cantidad )
						FROM arabe_servicios_cantidad AS ar_ser
						WHERE ar_ser.empleado_id = empl.id AND ar_ser.arabe_registro_id = ar_reg.id  )) DESC";


		$empleados_reporte =  $this->db->query($sql)->result();
		// return $empleados_reporte;
		
		
		
		foreach ($empleados_reporte as $empleado) {
			$sql = "SELECT
 						serv.nombre,
						serv.precio_total,
						serv.precio_empleado,
						serv.precio_empleado_mayor,
						SUM(ar_ser.cantidad) AS 'cantidad_realizada',
						-- aqui estamos validando en caso de que el empleado alla la mayor cantidad de ordenes maxima se le pagara en comparacion con precio_empleado_mayor en caso de que el servicio cuente con esta
						IF( 
							SUM( serv.precio_empleado_mayor ) > 0 AND  
							SUM((
								-- este sub select nos permite ver cual fue la cantidad mayor realizada
								SELECT 
									max( ar_ser_sub.cantidad )
								FROM arabe_servicios_cantidad AS ar_ser_sub 
								WHERE ar_ser_sub.arabe_registro_id IN ($ids) AND ar_ser_sub.servicio_id = serv.id
								
							)) = SUM(ar_ser.cantidad)
								, ( SUM(serv.precio_empleado_mayor * ar_ser.cantidad) )
								, ( SUM(serv.precio_empleado * ar_ser.cantidad) ) 
						) AS 'pago_por_servicio'

					FROM arabe_servicios_cantidad AS ar_ser
					INNER JOIN arabe_registros AS ar_reg ON ar_ser.arabe_registro_id = ar_reg.id
					INNER JOIN empleados AS empl ON ar_ser.empleado_id = {$empleado->id}
					INNER JOIN servicios AS serv ON ar_ser.servicio_id = serv.id
					WHERE empl.id = {$empleado->id}  AND ar_reg.id IN ($ids)
					GROUP BY serv.id
					ORDER BY serv.nombre 
					";

			$empleado_servicios =  $this->db->query($sql)->result();
			$empleado->servicios = $empleado_servicios;
		}

		return $empleados_reporte;
	}
}
