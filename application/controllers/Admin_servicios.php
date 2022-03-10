<?php

class Admin_servicios  extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->tabla_principal = "servicios";

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
			"servicio_model"
		]);
	}

	public function index()
	{
		$servicios = $this->servicio_model->get_all();
		$data["servicios"] = $servicios;

		$view["body"] = $this->load->view("admin/servicios/ser_index", $data, true);
		$view["scripts"] =  archivos_js([
			//   base_url() . "assets/plugins/summernote/summernote-bs4.min.js",
			//   base_url() . "assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js",
			base_url("assets/js/admin/servicios/ser_index.js"),
			// base_url("assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"),
		]);
		$this->parser->parse("admin/template/body", $view);
	}

	public function crear()
	{
		// var_dump("sads");die();
		$request = $this->input->post();
		// var_dump($request);die();
		$config = [
			[
				"field" =>  "nombre",
				"label" => "Nombre",
				"rules" =>  "trim|required",
			],
			[
				"field" =>  "precio_total",
				"label" => "precio_total",
				"rules" =>  "trim|required|numeric",
			],
			[
				"field" =>  "precio_empleado",
				"label" => "precio_empleado",
				"rules" =>  "trim|required|numeric",
			],
			[
				"field" =>  "precio_empleado_mayor",
				"label" => "precio_empleado_mayor",
				"rules" =>  "trim|numeric",
			]
		];

		$this->form_validation->set_rules($config);

		if (!$this->form_validation->run()) {

			message(
				"Error de validacion, Intentalo de nuevo",
				"error",
				"danger",
			);
			redirect("admin_servicios");

			return false;
		}

		$data_insert["nombre"] = set_value("nombre");
		$data_insert["precio_total"] = set_value("precio_total");
		$data_insert["precio_empleado"] = set_value("precio_empleado");
		$data_insert["precio_empleado_mayor"] = (set_value("precio_empleado_mayor") == 0) ? null : set_value("precio_empleado_mayor");
		$data_insert["usuario_id"] = $this->session->userdata("id");

		$response = $this->db->insert($this->tabla_principal, $data_insert);

		if (!$response) {
			message(
				"Ha ocurrido un ERROR, intentalo de nuevo.",
				"error",
				"danger",
			);

			redirect("admin_servicios");
			return false;
		}

		message(
			"El servicio '{$data_insert["nombre"]}' se ha registrado correctamente.",
			"success",
			"success",
		);

		redirect("admin_servicios");
		return false;
	}



	public function actualizar()
	{
		if ($this->session->userdata("perfil") != "administrador" and $this->session->userdata("perfil") != "editor") {
			message(
				"No tienes los permisos para eliminar este contenido",
				"error",
				"danger",
			);
			redirect("admin_servicios");
			return;
		}


		$config = [
			[
				"field" =>  "nombre",
				"label" => "Nombre",
				"rules" =>  "trim|required",
			],
			[
				"field" =>  "precio_total",
				"label" => "precio_total",
				"rules" =>  "trim|required|numeric",
			],
			[
				"field" =>  "precio_empleado",
				"label" => "precio_empleado",
				"rules" =>  "trim|required|numeric",
			],
			[
				"field" =>  "precio_empleado_mayor",
				"label" => "precio_empleado_mayor",
				"rules" =>  "trim|numeric",
			]
		];
		$this->form_validation->set_rules($config);

		if (!$this->form_validation->run()) {

			message(
				"Error de validacion, Intentalo de nuevo",
				"error",
				"danger",
			);
			redirect("admin_servicios");
			return false;
		}


		$response_servicio_exist = $this->db->get_where(
			$this->tabla_principal,
			[
				"id" => set_value("id_servicio_input")
			]
		)->row();

		$date = new DateTime();
		$data_update["nombre"] = set_value("nombre");
		$data_update["precio_total"] = set_value("precio_total");
		$data_update["precio_empleado"] = set_value("precio_empleado");
		$data_update["precio_empleado_mayor"] = (set_value("precio_empleado_mayor") == 0) ? null : set_value("precio_empleado_mayor");;
		$data_update["updated_at"] = date_format($date, "Y-m-d H:i:s");



		if (!$response_servicio_exist) {
			message(
				"El servicio ´{$data_update["nombre"]}' no esta registrado",
				"error",
				"danger",
			);

			redirect("admin_servicios");
			return false;
		}


		foreach ($data_update as $key => $data_upd) {
			$this->db->set($key, $data_upd);
		}

		$this->db->where("id", $response_servicio_exist->id);
		$response = $this->db->update($this->tabla_principal);

		if (!$response) {
			message(
				"Ha ocurrido un ERROR, intentalo de nuevo.",
				"error",
				"danger",
			);

			redirect("admin_servicios");
			return false;
		}

		message(
			"Se Ha actualizado el servicio '{$data_update["nombre"]}' correctamente.",
			"success",
			"success",
		);

		redirect("admin_servicios");
		return false;
	}

	public function get_servicio()
	{
		$id_servicio = $this->input->post("id_servicio");

		$servicio = $this->db->get_where($this->tabla_principal, ["id" => $id_servicio])->row();

		echo json_encode($servicio);
	}

	public function eliminar()
	{
		if ($this->session->userdata("perfil") != "administrador" and $this->session->userdata("perfil") != "editor") {
			message(
				"No tienes los permisos para eliminar este contenido",
				"error",
				"danger",
			);
			redirect("admin_servicios");
			return;
		}

		$config = [
			[
				"field" =>  "id",
				"label" => "id",
				"rules" =>  "trim|required|numeric",
			],
		];

		$id = set_value("id");

		$this->form_validation->set_rules($config);

		if (!$this->form_validation->run() or !$id) {

			message(
				"Error de validacion, Intentalo de nuevo",
				"error",
				"danger",
			);
			redirect("admin_servicios");
			return false;
		}

		$servicio_exist = $this->db->get_where($this->tabla_principal, ["id" => $id])->row();

		if (!$servicio_exist) {
			message(
				"El elemento que se quiere eliminar no existe.",
				"error",
				"danger",
			);
			redirect("admin_servicios");
			return false;
		}


		$eliminar = $this->db->delete($this->tabla_principal, ["id" => $id]);

		if (!$eliminar) {
			message(
				"Ha ocurrido un error.",
				"error",
				"danger",
			);
			redirect("admin_servicios");
			return false;
		}

		message(
			"EL usuario " . $servicio_exist->nombre . " se ha eliminado correctamente.",
			"success",
			"success",
		);
		redirect("admin_servicios");
		return false;
	}
}
