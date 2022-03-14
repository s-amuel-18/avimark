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
		
		if (count($this->servicios_arabe) < 1 or count($this->empleados_arabe) < 1 OR !$this->cliente ) {
			message(
				"Es necesario configurar los empleados, servicios y el cliente que se vincularan a este modulo.",
				"warning",
				"warning",
			);
			
			redirect("admin_cliente_arabe/configuracion");
			return false;
		}
		
		$clientes = $this->cliente_model->get_all();
		$data["clientes"] = $clientes;
		
		$view["body"] = $this->load->view("admin/clientes/modulo_arabe/cli_arabe_index.php", $data, true);
		$view["scripts"] =  archivos_js([
			// base_url() . "assets/plugins/summernote/summernote-bs4.min.js",
			// base_url() . "assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js",
			// base_url("assets/js/admin/clientes/cli_index.js"),
			// base_url("assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"),
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
			// base_url() . "assets/plugins/summernote/summernote-bs4.min.js",
			// base_url() . "assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js",
			base_url("assets/js/admin/clientes/cliente_arabe/cli_arabe_config.js"),
			// base_url("assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"),
		]);
		$this->parser->parse("admin/template/body", $view);

	}

	public function crear_configuracion()
	{
		$request = $this->input->post();

		$servicios_check = $request["servicios"];
		$empleados_check = $request["empleados"];
		$cliente = $request["cliente_id"];

		if (!isset($servicios_check) or !isset($empleados_check) OR !isset( $cliente ) ) {
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
		$servicios = $this->cliente_arabe_model->servicios_con_servicios_arabe();
		$data["servicios"] = $servicios;

		$empleados = $this->cliente_arabe_model->empleados_con_empleados_arabe();
		$data["empleados"] = $empleados;

		$view["body"] = $this->load->view("admin/clientes/modulo_arabe/cli_arabe_reportes.php", $data, true);
		$view["scripts"] =  archivos_js([
			// base_url() . "assets/plugins/summernote/summernote-bs4.min.js",
			// base_url() . "assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js",
			// base_url("assets/js/admin/clientes/cli_index.js"),
			// base_url("assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"),
		]);
		
		$this->parser->parse("admin/template/body", $view);		


	}
}
