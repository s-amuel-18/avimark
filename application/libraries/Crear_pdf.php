<?php

use Dompdf\Dompdf;

class Crear_pdf
{
	protected $ci;


	public function __construct()
	{
		// parent::__construct(); 
		$this->ci = &get_instance();

		$this->ci->load->helper([
			"url",
			"message_helper",
		]);

		$this->ci->load->library([
			"pdf",
		]);
		
	}

	public function factura($data = [])
	{
		// en caso de que exista la variable de sesion servicio_extre 
		// $monto_extra = isset( $_SESSION["servicio_extre"] ) ? count($_SESSION["servicio_extre"]) + 1: 0;
		$monto_extra = 0;
		
		// esto se hace para pasar el array de objetos que nos devuelve la variable "Servicios" a un array normal
		$de_obj_a_arr_servicios = [];

		foreach ($data["servicios"] as $key => $serv) {
			$newArray = [
				"nombre_categoria" => $serv->nombre_categoria,
				"categoria_id" => $serv->categoria_id,
				"cantidad" => $serv->cantidad,
				"precio" => $serv->precio,
				"total" => $serv->total,
			];

			array_push($de_obj_a_arr_servicios, $newArray);
		}

		$data["servicios"] = $de_obj_a_arr_servicios;
		
		
		if(isset( $_SESSION["servicio_extre"] )) {
			foreach ($_SESSION["servicio_extre"]["servicios"] as $key => $serv_extr) {
				# code...
				$newArray = [
					"nombre_categoria" => $serv_extr["servicio"],
					"categoria_id" => 0,
					"cantidad" => 1,
					"precio" => $serv_extr["precio"],
					"total" => $serv_extr["precio"],
				];
				
				array_push($data["servicios"], $newArray);
			}
		}
		

		// echo json_encode($data["servicios"]);die();

		$relleno_tablas = 11 - count($data["servicios"]) - $monto_extra;

		for ($i = 0; $i < $relleno_tablas; $i++) {
			array_push($data["servicios"], null);
		}

		$dompdf = new Dompdf();

		$html = $this->ci->load->view("admin/facturas/pdf/fac_pdf", $data, true);
		$opt = $dompdf->getOptions();
		$opt->set(["isRemoteEnabled" => true]);
		$dompdf->setOptions($opt);

		$dompdf->loadHtml($html);
		$dompdf->setPaper("letter");
		$dompdf->render();


		$dompdf->stream("FAC{$data["factura"]->numero_factura}.pdf", ["Attachment" => false]);
	}

}
