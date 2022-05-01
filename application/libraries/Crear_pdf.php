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
		$monto_extra = isset( $_SESSION["servicio_extre"] ) ? count($_SESSION["servicio_extre"]) + 1: 0;

		// dd($monto_extra);
		
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
