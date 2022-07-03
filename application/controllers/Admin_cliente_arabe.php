<?php

class Admin_cliente_arabe  extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->tabla_principal = "clientes";

		$this->load->helper([
			"url",
			"cargar_archivo_helper",
			"message_helper",
			"upload_imgs_helper",
			"text",
			"impuestos_helper",
			"manipular_archivos_helper",
		]);

		$this->load->library([
			"parser",
			"form_validation",
			"session",
			"valid_data_user",
		]);


		// var_dump();die();

		$this->load->model([
			"cliente_model",
			"cartera_model",
			"cliente_arabe_model",
		]);




		$mensaje = "Debes tener como minimo ";
		$clientes = $this->db->get("clientes")->num_rows();
		$empleados = $this->db->get("empleados")->num_rows();
		$servicios = $this->db->get("servicios")->num_rows();
		$info_interna = $this->db->get("informacion_interna")->num_rows();

		if ($clientes == 0) {
			$mensaje .= "un Clienten ";
			$redirect = "admin_clientes";
		} else if ($empleados == 0) {
			$mensaje .= "una Cartere ";
			$redirect = "admin_empleados";
		} else if ($info_interna == 0) {
			$mensaje .= "informacion de la pagina ";
			$redirect = "admin_info_interna";
		} else if ($servicios == 0) {
			$mensaje .= "un Servicio ";
			$redirect = "admin_servicios";
		}

		$mensaje .= "para poder crear una factura.";
		$type = "warning";
		$color = "warning";

		// var_dump($clientes == 0 or $info_interna == 0 or $carteras == 0 or $servicios == 0);die();

		if ($clientes == 0 or $info_interna == 0 or $empleados == 0 or $servicios == 0) {
			message(
				$mensaje,
				$type,
				$color
			);
			// var_dump($redirect);die();
			redirect($redirect);
		}


		$this->servicios_arabe = $this->cliente_arabe_model->servicios();
		$this->empleados_arabe = $this->cliente_arabe_model->empleados();
		$this->cliente = $this->cliente_arabe_model->cliente_vinculado();
		// var_dump($this->cliente);die();

	}

	public function index()
	{
		// var_dump($this->servicios_arabe);die();

		if (count($this->servicios_arabe) < 1 or count($this->empleados_arabe) < 1 or !$this->cliente) {
			message(
				"Es necesario configurar los empleados, servicios y el cliente que se vincularan a este modulo.",
				"warning",
				"warning",
			);

			redirect("admin_cliente_arabe/configuracion");
			return false;
		}

		$reportes = $this->cliente_arabe_model->reportes(5);
		$data["reportes"] = $reportes;

		$view["body"] = $this->load->view("admin/clientes/modulo_arabe/cli_arabe_index.php", $data, true);
		$view["scripts"] =  archivos_js([


			base_url("assets/js/admin/clientes/cliente_arabe/cli_arabe_index.js"),

		]);

		$this->parser->parse("admin/template/body", $view);
	}

	public function historial_reportes()
	{
		// var_dump($this->servicios_arabe);die();

		if (count($this->servicios_arabe) < 1 or count($this->empleados_arabe) < 1 or !$this->cliente) {
			message(
				"Es necesario configurar los empleados, servicios y el cliente que se vincularan a este modulo.",
				"warning",
				"warning",
			);

			redirect("admin_cliente_arabe/configuracion");
			return false;
		}

		$reportes = $this->cliente_arabe_model->reportes();
		$data["reportes"] = $reportes;

		$view["body"] = $this->load->view("admin/clientes/modulo_arabe/cli_arabe_historial_reportes.php", $data, true);
		$view["scripts"] =  archivos_js([


			base_url("assets/js/admin/clientes/cliente_arabe/cli_arabe_index.js"),

		]);

		$this->parser->parse("admin/template/body", $view);
	}

	public function configuracion()
	{
		// empleados
		$empleados = $this->cliente_arabe_model->empleados_con_empleados_arabe();
		$data["empleados"] = $empleados;



		// clientes
		$clientes = $this->cliente_arabe_model->cliente_con_cliente_arabe();
		$data["clientes"] = $clientes;

		// servicios
		$servicios = $this->cliente_arabe_model->servicios_con_servicios_arabe();
		$data["servicios"] = $servicios;

		$view["body"] = $this->load->view("admin/clientes/modulo_arabe/cli_arabe_config.php", $data, true);
		$view["scripts"] =  archivos_js([


			base_url("assets/js/admin/clientes/cliente_arabe/cli_arabe_config.js"),

		]);

		$this->parser->parse("admin/template/body", $view);
	}

	public function crear_configuracion()
	{
		$request = $this->input->post();

		$servicios_check = $request["servicios"];
		$empleados_check = $request["empleados"];
		$cliente = $request["cliente_id"];

		if (!isset($servicios_check) or !isset($empleados_check) or !isset($cliente)) {
			message(
				"Error de validacion, Es obligatirio seleccionar como minimo un servicio y un empleado intentalo nuevamente",
				"error",
				"error"
			);
			redirect("admin_cliente_arabe/configuracion");
			return false;
		}

		// var_dump($cliente);die();

		// funcion que elimina los servicios y los empleados relacionados con este modulo
		$this->cliente_arabe_model->eliminar_servicios_y_empleados();

		foreach ($empleados_check as $empleado_id => $item) {
			$this->db->insert("empleados_arabe", ["empleado_id" => $empleado_id]);
		}

		foreach ($servicios_check as $servicio_id => $item) {
			$this->db->insert("servicios_arabe", ["servicio_id" => $servicio_id]);
		}

		$this->db->insert("modulo_arabe", ["cliente_id" => $cliente]);


		message(
			"La configuracion se ha realizado con exito",
			"success",
			"success"
		);

		redirect("admin_cliente_arabe");
	}

	public function vista_creacion_registro()
	{
		$servicios = $this->servicios_arabe;
		$data["servicios"] = $servicios;

		$empleados = $this->empleados_arabe;
		$data["empleados"] = $empleados;



		$view["body"] = $this->load->view("admin/clientes/modulo_arabe/cli_arabe_crear_reporte.php", $data, true);
		$view["scripts"] =  archivos_js([

			base_url() . "assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js",


			// base_url("assets/js/admin/clientes/cliente_arabe/cli_arabe_reporte.js"),
			base_url("assets/js/admin/clientes/cliente_arabe/cli_arabe_crear_reporte.js"),

		]);

		$this->parser->parse("admin/template/body", $view);
	}

	public function crear_reporte()
	{

		$request = $this->input->post();


		$bonos = $request["bono"];

		$trabajo_extra = $request["trabajo_extra"];

		// insertamos un valos nulo en la base de datos que nos servira para poder extraer el id del reporte y de esta forma relacionarlo con las demas tablas.
		$insert_reporte = $this->db->insert("arabe_registros", ["reporte_facturado" => 0]);

		// extraemos el id del ultimo reporte
		$id_insert_reporte = $this->db->insert_id();

		try {
			// se realizo un siclo para poder extraer los ids de cada servicio
			foreach ($request as $key => $value) {

				// se añade un condicional que nos permita saber si efectivamente la llave del array enviado por el formulario contiene el string "servicios_"
				if (strpos($key, "servicios_") !== false) {

					// en caso de tenerlo separamos el valos servicios_ del id y de esta forma extraemos el id. 
					$servicio_id = explode("servicios_", $key)[1];

					// se realiza un siclo para poder extraer los ids de los empleados junto con la camtodad de servicios realozados.
					foreach ($value as $id_empleado => $cantidad_servicios) {

						// creamos el array de los datos que se insertaran en la base da datos
						$data_servicios_insert =  [
							"arabe_registro_id" => $id_insert_reporte,
							"servicio_id" => $servicio_id,
							"empleado_id" => $id_empleado,
							"cantidad" => $cantidad_servicios
						];

						// 	insertamos en la base de datos
						$this->db->insert("arabe_servicios_cantidad", $data_servicios_insert);
					}
				}
			}

			// se recorre el array bono que nos envia el formulario, de esta forma extraemos el id del empleado, el monto del bono y con el id que nos entrega el empleado buscamos el valor en el array de trabajos extras.
			foreach ($bonos as $id_empleado => $bono) {

				// array que se insertara en la base de datos
				$data_bonos_insert = [
					"arabe_registro_id" => $id_insert_reporte,
					"empleado_id" => $id_empleado,
					"bono" => $bono,
					"tabajo_extra" => $trabajo_extra[$id_empleado]
				];

				// insertamos en la base de datos.
				$this->db->insert("arabe_bonos", $data_bonos_insert);
			}
		} catch (\Throwable $th) {
			message(
				"Ha ocurrido un error",
				"success",
				"success"
			);
		}


		message(
			"Se ha registrado correctamente el Reporte",
			"success",
			"success"
		);

		redirect("admin_cliente_arabe/vista_reporte?ids_reportes[$id_insert_reporte]=" . $id_insert_reporte);
	}

	public function vista_reporte()
	{
		// extraemos el array de ids de los reportes
		$ids_reportes = $this->input->get("ids_reportes");

		// validamos que efectivamente los ids se estan enviando correctamente y que se estan enviando como array
		if (!$ids_reportes and !is_array($ids_reportes)) {
			show_404();
			return false;
		}



		$arr_ids_reportes = $ids_reportes;

		// convertimos el array en un string separando los ids con comas
		$ids_reportes = implode(",", $ids_reportes);

		// recorremos el array de forma que validemos que el array que se esta enviando como parametro cumple con las reglas de SOLO NUmeros
		foreach ($arr_ids_reportes as $id) {
			if (!is_numeric($id)) {
				show_404();
				return false;
			}
		}

		// realizamos la consulta
		$reporte = $this->cliente_arabe_model->reporte_completo($ids_reportes);

		// validamos que la consulta no llegue vacia
		if (count($reporte) < 1) {
			show_404();
			return false;
		}

		// enviamos el reporte como parametro
		$data["reporte"] = $reporte;

		$tasa_bolivar = $this->db->order_by('created_at', "DESC")->get('tasa_bolivar')->row();
		$data["tasa_bolivar"] = $tasa_bolivar;

		// creamos una variable auxiliar que nos va a permitir sumar los valores totales de los servicios.
		$precio_total_servicios = 0;

		// recorremos los datos que nos traiga la consulta de forma que podamos sumar todos los valores totales de esta
		foreach ($reporte as $empleado) {
			$precio_total_servicios += $empleado->total_pago;
		}


		$url_parametros = "";

		// recorremos el array de ids de forma que podamos crear un nuevo string que representan los parametros de los ids en la url
		foreach ($this->input->get("ids_reportes") as $i => $item) {
			$url_parametros .= $item = "ids_reportes[$item]=$item&";
		}
		// eliminamos el ultimo "&" de el string
		$url_parametros = rtrim($url_parametros, "&");

		$data["url_parametros"] = $url_parametros;

		$data["precio_total_servicios"] = $precio_total_servicios;

		$servicios = $this->servicios_arabe;
		$data["servicios"] = $servicios;

		$empleados = $this->empleados_arabe;
		$data["empleados"] = $empleados;

		$view["body"] = $this->load->view("admin/clientes/modulo_arabe/cli_arabe_reporte.php", $data, true);
		$view["scripts"] =  archivos_js([
			base_url("assets/js/admin/clientes/cliente_arabe/cli_arabe_reporte.js"),
		]);

		$this->parser->parse("admin/template/body", $view);
	}

	public function facturar_reportes()
	{
		// extraemos el array de ids de los reportes
		$ids_reportes = $this->input->get("ids_reportes");

		// validamos que efectivamente los ids se estan enviando correctamente y que se estan enviando como array
		if (!$ids_reportes and !is_array($ids_reportes)) {
			show_404();
			return false;
		}



		$arr_ids_reportes = $ids_reportes;

		// convertimos el array en un string separando los ids con comas
		$ids_reportes = implode(",", $ids_reportes);

		// recorremos el array de forma que validemos que el array que se esta enviando como parametro cumple con las reglas de SOLO NUmeros
		foreach ($arr_ids_reportes as $id) {
			if (!is_numeric($id)) {
				show_404();
				return false;
			}
		}

		$this->cliente_arabe_model->facturar_reportes($ids_reportes);

		$informacion_interna = $this->db->get("informacion_interna")->row();
		$data["informacion_interna"] = $informacion_interna;

		$carteras = $this->cartera_model->get_all();
		$data["carteras"] = $carteras;

		$factura = $this->cliente_arabe_model->clinte_asociado();
		$data["factura"] = $factura;

		$servicios = $this->cliente_arabe_model->servicios_factura($ids_reportes);
		$data["servicios"] = $servicios;

		$bonos_totales = $this->cliente_arabe_model->reporte_total_bonos($ids_reportes);
		// dd($bonos_totales);
		$_SESSION["servicio_extre"] = [
			"servicios" => [
				["servicio" => "bonos", "precio" => $bonos_totales->total_bonos],
				["servicio" => "salary", "precio" => $bonos_totales->total_trb_extra],
			],
			"suma_total" => $bonos_totales->suma_total
		];

		// echo json_encode($_SESSION["servicio_extre"]["servicios"]);die();
		// var_dump($_SESSION["servicio_extre"]);die();

		// dd($_SESSION["servicio_extre"]["suma_total"]);




		$servicios_total = $this->cliente_arabe_model->servicios_total_factura($ids_reportes);
		$data["servicios_total"] = $servicios_total;


		$id_categorias = [];

		foreach ($data["servicios"] as $servicio) {
			array_push($id_categorias, $servicio->categoria_id);
		}

		$data["id_categorias"] = $id_categorias;

		$servicios_nuevos = $this->db->select(["id", "nombre", "precio_total"])->get("servicios")->result();
		$data["servicios_nuevos"] = $servicios_nuevos;

		$clientes = $this->db->get("clientes")->result();
		$data["clientes"] = $clientes;

		$data["titulo"] = "Generar Factura";

		$view["body"] = $this->load->view("admin/facturas/fac_crear", $data, true);
		$view["scripts"] =  archivos_js([
			base_url() . "assets/plugins/summernote/summernote-bs4.min.js",
			base_url() . "assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js",
			base_url("assets/js/admin/facturas/fac_functions.js"),
			base_url("assets/js/admin/facturas/fac_crear.js"),
			base_url("assets/js/admin/facturas/fac_categoria.js"),
			base_url("assets/js/admin/facturas/fac_index.js"),
		]);

		$this->parser->parse("admin/template/body", $view);
	}

	public function actualizar_facturacion_reporte($id_reporte = null)
	{
		if (!$id_reporte) {
			show_404();
			return false;
		}

		$exist_reporte = $this->db->get_where("arabe_registros", ["id" => $id_reporte])->row();

		$facturado = $exist_reporte->reporte_facturado == 1 ?  0 : 1;

		if (!$exist_reporte) {
			show_404();
			return false;
		}

		$this->db->where("id",  $exist_reporte->id);
		$this->db->update("arabe_registros", ["reporte_facturado" => $facturado]);

		message(
			"El reporte se ha actualizado correctamente.",
			"success",
			"success",
		);

		redirect("admin_cliente_arabe");
	}

	public function vista_reporte_actualizar($id = null)
	{
		if (!$id) {
			show_404();
			return false;
		}


		$reporte = $this->cliente_arabe_model->reporte_completo($id);

		if (count($reporte) < 1) {
			show_404();
			return false;
		}

		$data["reporte"] = $reporte;

		// echo json_encode($reporte);die();

		$servicios = $this->servicios_arabe;
		$data["servicios"] = $servicios;

		$data["id_reporte"] = $id;



		$view["body"] = $this->load->view("admin/clientes/modulo_arabe/cli_arabe_actualizar_reporte.php", $data, true);
		$view["scripts"] =  archivos_js([
			base_url() . "assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js",
			base_url("assets/js/admin/clientes/cliente_arabe/cli_arabe_crear_reporte.js"),
		]);



		$this->parser->parse("admin/template/body", $view);
	}

	public function actualizar_reporte($id)
	{

		$request = $this->input->post();

		// $id$request["id_reporte"];ç

		$reporte_exist = $this->db->get_where("arabe_registros", ["id" => $id])->row();

		if (!$reporte_exist) {
			show_404();
			return false;
		}

		// var_dump($reporte_exist);
		// die();

		$arabe_servicios_cantidad = $this->db->delete("arabe_servicios_cantidad", ["arabe_registro_id" => $id]);
		$arabe_bonos = $this->db->delete("arabe_bonos", ["arabe_registro_id" => $id]);

		$bonos = $request["bono"];

		$trabajo_extra = $request["trabajo_extra"];


		// extraemos el id del ultimo reporte
		$id_insert_reporte = $id;
		try {
			// se realizo un siclo para poder extraer los ids de cada servicio
			foreach ($request as $key => $value) {

				// se añade un condicional que nos permita saber si efectivamente la llave del array enviado por el formulario contiene el string "servicios_"
				if (strpos($key, "servicios_") !== false) {

					// en caso de tenerlo separamos el valos servicios_ del id y de esta forma extraemos el id. 
					$servicio_id = explode("servicios_", $key)[1];

					// se realiza un siclo para poder extraer los ids de los empleados junto con la camtodad de servicios realozados.
					foreach ($value as $id_empleado => $cantidad_servicios) {

						// creamos el array de los datos que se insertaran en la base da datos
						$data_servicios_insert =  [
							"arabe_registro_id" => $id_insert_reporte,
							"servicio_id" => $servicio_id,
							"empleado_id" => $id_empleado,
							"cantidad" => $cantidad_servicios
						];

						// 	insertamos en la base de datos
						$this->db->insert("arabe_servicios_cantidad", $data_servicios_insert);
					}
				}
			}

			// se recorre el array bono que nos envia el formulario, de esta forma extraemos el id del empleado, el monto del bono y con el id que nos entrega el empleado buscamos el valor en el array de trabajos extras.
			foreach ($bonos as $id_empleado => $bono) {

				// array que se insertara en la base de datos
				$data_bonos_insert = [
					"arabe_registro_id" => $id_insert_reporte,
					"empleado_id" => $id_empleado,
					"bono" => $bono,
					"tabajo_extra" => $trabajo_extra[$id_empleado]
				];

				// insertamos en la base de datos.
				$this->db->insert("arabe_bonos", $data_bonos_insert);
			}
		} catch (\Throwable $th) {
			message(
				"Ha ocurrido un error",
				"success",
				"success"
			);
		}

		message(
			"Se ha actualizado correctamente el Reporte",
			"success",
			"success"
		);


		// redirect("admin_cliente_arabe");
		redirect("admin_cliente_arabe/vista_reporte?ids_reportes[$id_insert_reporte]=" . $id_insert_reporte);
	}

	public function eliminar_reporte($id)
	{

		$request = $this->input->post();

		// $id$request["id_reporte"];ç

		$reporte_exist = $this->db->get_where("arabe_registros", ["id" => $id])->row();

		if (!$reporte_exist) {
			show_404();
			return false;
		}

		// var_dump($reporte_exist);
		// die();

		$arabe_servicios_cantidad = $this->db->delete("arabe_servicios_cantidad", ["arabe_registro_id" => $id]);
		$arabe_bonos = $this->db->delete("arabe_bonos", ["arabe_registro_id" => $id]);
		$arabe_registros = $this->db->delete("arabe_registros", ["id" => $id]);

		message(
			"Se ha eliminado correctamente el Reporte",
			"success",
			"success"
		);


		redirect("admin_cliente_arabe");
	}
}
