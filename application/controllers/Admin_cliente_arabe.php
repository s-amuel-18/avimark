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
			"manipular_archivos_helper",
		]);

		$this->load->library([
			"parser",
			"form_validation",
			"session",
			"valid_data_user",
		]);

		$this->load->model([
			"cliente_model",
			"cliente_arabe_model",
		]);

		$this->servicios_arabe = $this->cliente_arabe_model->servicios();
		$this->servicios_arabe = $this->cliente_arabe_model->empleados();

	}

	public function index()
	{

		if( count($this->servicios_arabe) < 1 OR count($this->empleados_arabe) < 1 ) {
			message(
        "Es necesario configurar los empleados y los servicios que se vincularan a este modulo.",
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
		$empleados = $this->db->get("empleados")->result();
		$data["empleados"] = $empleados;

		// servicios
		$servicios = $this->db->get("servicios")->result();
		$data["servicios"] = $servicios;

		$view["body"] = $this->load->view("admin/clientes/modulo_arabe/cli_arabe_config.php", $data, true);
		$view["scripts"] =  archivos_js([
			// base_url() . "assets/plugins/summernote/summernote-bs4.min.js",
			// base_url() . "assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js",
			// base_url("assets/js/admin/clientes/cli_index.js"),
			// base_url("assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"),
		]);
		$this->parser->parse("admin/template/body", $view);
	}

	public function crear_configuracion()
	{
		
	}
}
