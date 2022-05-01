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
					reporte_facturado AS reporte_facturado_bool,
                   IF( reporte_facturado = 0, 'Sin Facturar', 'Facturado'  ) AS reporte_facturado,
                   IF( reporte_facturado = 0, 'danger', 'success'  ) AS reporte_facturado_color,
                   IF( updated_at IS NULL, 'Sin Actualizar', DATE_FORMAT(updated_at, '%d/%m/%Y')  ) AS updated_at,
				   created_at AS timestamp_created_at,
				   DATE_FORMAT(created_at, '%d/%m/%Y') AS created_at
				FROM arabe_registros AS ar_reg
				ORDER BY reporte_facturado DESC, timestamp_created_at DESC 
				$limit_sql";

		return $this->db->query($sql)->result();
	}

	public function reporte_completo($ids)
	{
		$sql = "SELECT
					empl.id,
					empl.nombre,
					car.nombre AS 'cartera',
					car.id AS 'cartera_id',
					SUM(ar_bon.bono) AS 'bono',
					SUM(ar_bon.tabajo_extra) AS 'tabajo_extra',
					NULL AS 'impuesto',
					(SUM((
						-- este subselect nos permite multiplicar la cantidad de servicios por el valor de este y sumarlo para encontrar el valor total de pago
						SELECT
							SUM( 
								ar_ser.cantidad * 
								IF( serv_total.precio_empleado_mayor > 0 AND 
									(
										SELECT 
											MAX(ar_ser_sub.cantidad)
										FROM arabe_servicios_cantidad AS ar_ser_sub 
										WHERE ar_ser_sub.arabe_registro_id IN ($ids) AND ar_ser_sub.servicio_id = serv_total.id
									) = ar_ser.cantidad
										, serv_total.precio_empleado_mayor
										, serv_total.precio_empleado )
								 
							)
						FROM arabe_servicios_cantidad AS ar_ser
						INNER JOIN servicios AS serv_total ON serv_total.id = ar_ser.servicio_id 
						WHERE ar_ser.empleado_id = empl.id AND ar_ser.arabe_registro_id = ar_reg.id  
					)) + SUM(ar_bon.bono) + SUM(ar_bon.tabajo_extra) ) AS total_pago,
					
					-- seleccionamos un elemento nulo para posteriormente agregarle valores con una consulta 
					NULL AS 'total_pago_con_impuesto',
					NULL AS 'servicios'
				FROM arabe_registros AS ar_reg
				INNER JOIN arabe_bonos AS ar_bon ON ar_bon.arabe_registro_id = ar_reg.id 
				INNER JOIN empleados AS empl ON ar_bon.empleado_id = empl.id
				INNER JOIN carteras AS car ON empl.cartera_id = car.id
				WHERE ar_reg.id IN ($ids)
				GROUP BY empl.id 
				-- realizamos una subconsulta de manera que podamos sumar todas las cantidades por empleado y posteriormente ordenarlo
				ORDER BY SUM((SELECT
							SUM( ar_ser.cantidad )
						FROM arabe_servicios_cantidad AS ar_ser
						WHERE ar_ser.empleado_id = empl.id AND ar_ser.arabe_registro_id = ar_reg.id  )) DESC";


		$empleados_reporte =  $this->db->query($sql)->result();

		// realizamos un siclo que nos permita leer el id del empleado y posteriormente realizar una consulta de los servicios que ha realizado el usuario en su respoectivo reporte.
		foreach ($empleados_reporte as $empleado) {
			$sql = "SELECT
 						serv.id,
 						serv.nombre,
						serv.precio_total,
						serv.precio_empleado,
						serv.precio_empleado_mayor,
						SUM(ar_ser.cantidad) AS 'cantidad_realizada',
						-- saber cual si el empleado realizo la mayor cantidad de servicios para colocar el precio del empleado mayor
						IF( 
							SUM( serv.precio_empleado_mayor ) > 0 AND  
							SUM((
								-- este sub select nos permite ver cual fue la cantidad mayor realizada
								SELECT 
									max( ar_ser_sub.cantidad )
								FROM arabe_servicios_cantidad AS ar_ser_sub 
								WHERE ar_ser_sub.arabe_registro_id IN ($ids) AND ar_ser_sub.servicio_id = serv.id
								
							)) = SUM(ar_ser.cantidad)
								, serv.precio_empleado_mayor
								, serv.precio_empleado 
						)AS 'precio_servicio', 
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

			$impuesto = 0;

			if ($empleado->cartera_id == 30) {
				$impuesto_paypal = $empleado->total_pago - si_envio_paypal($empleado->total_pago);
				$total_menos_paypal = $empleado->total_pago - $impuesto_paypal;

				$impuesto = ($total_menos_paypal * 0.1) + $impuesto_paypal;
			}

			$empleado->impuesto = $impuesto;
			$empleado->total_pago_con_impuesto = $empleado->total_pago - $impuesto;
		}
		// echo json_encode($empleados_reporte);die();
		return $empleados_reporte;
	}

	public function clinte_asociado()
	{
		$sql = "SELECT 
					cliente_id AS id_cliente
				FROM modulo_arabe";
		return $this->db->query($sql)->row();
	}

	public function servicios_factura($ids)
	{
		$sql = "SELECT 
					serv.nombre AS nombre_categoria,
					serv.id AS categoria_id,
					serv.precio_total AS precio,
					SUM(ar_ser.cantidad) AS cantidad,
					( SUM(ar_ser.cantidad) * serv.precio_total ) AS total
				FROM servicios AS serv
				INNER JOIN arabe_servicios_cantidad AS ar_ser ON ar_ser.servicio_id = serv.id
				WHERE ar_ser.arabe_registro_id IN ( $ids )
				GROUP BY serv.id";
  
	  return $this->db->query($sql)->result();
	}

	public function servicios_total_factura($ids)
	{
		$sql = "SELECT 
					SUM(ar_ser.cantidad) AS total_cantidad,
					SUM(serv.precio_total * ar_ser.cantidad) AS total_pago
				FROM servicios AS serv
				INNER JOIN arabe_servicios_cantidad AS ar_ser ON ar_ser.servicio_id = serv.id
				WHERE ar_ser.arabe_registro_id IN ( $ids )
				";
  
	  return $this->db->query($sql)->row();
	}
	
	
	public function facturar_reportes($ids)
	{
		$sql = "UPDATE arabe_registros 
				SET reporte_facturado = 1
				WHERE id IN ($ids)";
		return $this->db->query($sql);
	}
	
	public function reporte_total_bonos($ids)
	{
		$sql = "SELECT
					SUM(ar_bo.bono) AS total_bonos,
					SUM(ar_bo.tabajo_extra) AS total_trb_extra,
					SUM(ar_bo.tabajo_extra) + SUM(ar_bo.bono) AS suma_total
				FROM arabe_registros AS ar_r
				INNER JOIN arabe_bonos AS ar_bo ON ar_r.id = ar_bo.arabe_registro_id
				WHERE  ar_r.id IN ({$ids})";

		return $this->db->query($sql)->row();
	}
}
