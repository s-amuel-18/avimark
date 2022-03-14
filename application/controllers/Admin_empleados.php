<?php

class Admin_empleados  extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->tabla_principal = "empleados";

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
			"empleado_model"
		]);
	}

	public function index()
	{
		$empleados = $this->empleado_model->get_all();
		$data["empleados"] = $empleados;

		$carteras = $this->db->select(["id", "nombre"])->get("carteras")->result();
		$data["carteras"] = $carteras;
		// var_dump($carteras);die();

		$view["body"] = $this->load->view("admin/empleados/empl_index", $data, true);
		$view["scripts"] =  archivos_js([
			//   base_url() . "assets/plugins/summernote/summernote-bs4.min.js",
			//   base_url() . "assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js",
			base_url("assets/js/admin/empleados/empl_index.js"),
			//   base_url("assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"),
		]);
		$this->parser->parse("admin/template/body", $view);
	}

	public function get_empleado()
	{
		$id_empleado = $this->input->post("id_empleado");

		$empleado = $this->db->get_where($this->tabla_principal, ["id" => $id_empleado])->row();

		echo json_encode($empleado);
	}

	public function crear()
	{
		$request = $this->input->post();

		$config = [
			[
				"field" =>  "nombre",
				"label" => "Nombre",
				"rules" =>  "required",
			],
			[
				"field" =>  "cartera_id",
				"label" => "cartera",
				"rules" =>  "required",
			],
			[
				"field" =>  "email",
				"label" => "email",
			]
		];

		$this->form_validation->set_rules($config);

		if (!$this->form_validation->run()) {

			message(
				"Error de validacion, Intentalo de nuevo",
				"error",
				"danger",
			);
			redirect("admin_empleados");
			return false;
		}

		$emails_exist = $this->db->get_where("empleados", ["email" => set_value("email")])->result();
		
				if (count( $emails_exist ) > 0) {
					message(
						"El email ya a sido registrado al empleado '{$emails_exist[0]->nombre}'",
						"error",
						"danger",
					);
		
					redirect("admin_empleados");
					return false;
				}



		$data_insert["usuario_id"] = $this->session->userdata("id");
		$data_insert["nombre"] = set_value("nombre");
		$data_insert["cartera_id"] = set_value("cartera_id");
		$data_insert["email"] = set_value("email");
		
		
		$response = $this->db->insert($this->tabla_principal, $data_insert);
		
				if (!$response) {
					message(
						"Ha ocurrido un ERROR, intentalo de nuevo.",
						"error",
						"danger",
					);
		
					redirect("admin_empleados");
					return false;
				}

		message(
			"El empleado '{$data_insert["nombre"]}' se ha registrado correctamente.",
			"success",
			"success",
		);

		redirect("admin_empleados");
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
			redirect("admin_empleados");
			return;
		}

		$config = [
			[
				"field" =>  "nombre",
				"label" => "Nombre",
				"rules" =>  "required",
			],
			[
				"field" =>  "cartera_id",
				"label" => "cartera",
				"rules" =>  "required",
			],
			[
				"field" =>  "email",
				"label" => "email",
			]
		];

		$this->form_validation->set_rules($config);

		if (!$this->form_validation->run()) {

			message(
				"Error de validacion, Intentalo de nuevo",
				"error",
				"danger",
			);
			redirect("admin_empleados");
			return false;
		}


		$response_empleado_exist = $this->db->get_where(
			$this->tabla_principal,
			[
				"id" => set_value("id_empleado_input")
			]
		)->row();

		$date = new DateTime();
		$data_update["updated_at"] = date_format($date, "Y-m-d H:i:s");
		$data_update["usuario_id"] = $this->session->userdata("id");
		$data_update["nombre"] = set_value("nombre");
		$data_update["cartera_id"] = set_value("cartera_id");
		$data_update["email"] = set_value("email");
		// var_dump($data_update);die();

		if (!$response_empleado_exist) {
			message(
				"El empleado ´{$data_update["nombre"]}' no esta registrado",
				"error",
				"danger",
			);

			redirect("admin_empleados");
			return false;
		}



		foreach ($data_update as $key => $data_upd) {
			$this->db->set($key, $data_upd);
		}

		$this->db->where("id", $response_empleado_exist->id);
		$response = $this->db->update($this->tabla_principal);

		if (!$response) {
			message(
				"Ha ocurrido un ERROR, intentalo de nuevo.",
				"error",
				"danger",
			);

			redirect("admin_empleados");
			return false;
		}

		message(
			"Se ha actualizado el empleado '{$data_update["nombre"]}' correctamente.",
			"success",
			"success",
		);

		redirect("admin_empleados");
		return false;
	}


	public function eliminar()
	{
		if ($this->session->userdata("perfil") != "administrador" and $this->session->userdata("perfil") != "editor") {
			message(
				"No tienes los permisos para eliminar este contenido",
				"error",
				"danger",
			);
			redirect("admin_empleados");
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
			redirect("admin_empleados");
			return false;
		}


		$empleado_exist = $this->db->get_where($this->tabla_principal, ["id" => $id])->row();

		if (!$empleado_exist) {
			message(
				"El elemento que se quiere eliminar no existe.",
				"error",
				"danger",
			);
			redirect("admin_empleados");
			return false;
		}


		$this->db->delete("empleados_arabe", ["empleado_id" => $id]);

		$eliminar = $this->db->delete($this->tabla_principal, ["id" => $id]);

		if (!$eliminar) {
			message(
				"Ha ocurrido un error.",
				"error",
				"danger",
			);
			redirect("admin_empleados");
			return false;
		}

		message(
			"EL empleado " . $empleado_exist->nombre . " se ha eliminado correctamente.",
			"success",
			"success",
		);
		redirect("admin_empleados");
		return false;
	}



}
