<?php

class Admin_tasa_bolivares  extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->tabla_principal = "clientes";

		$this->load->helper([
			"url",
			"message_helper",
		]);

		$this->load->library([
			"parser",
			"form_validation",
			"session",
			"valid_data_user",
		]);

		$this->load->model([
			"tasa_bolivares_model"
		]);
	}

	public function actualizar()
	{
		if ($this->session->userdata("perfil") != "administrador" and $this->session->userdata("perfil") != "editor") {
			message(
				"No tienes los permisos para eliminar este contenido",
				"error",
				"danger",
			);
			redirect("admin_dashboard");
			return;
		}


		$config = [
			[
				"field" =>  "tasa",
				"label" => "Tasa Bolivares",
				"rules" =>  "trim|required|numeric",
			],
		];
		$this->form_validation->set_rules($config);

		if (!$this->form_validation->run()) {

			message(
				"Error de validacion, Intentalo de nuevo",
				"error",
				"danger",
			);
			redirect("admin_dashboard");
			return false;
		}

		$this->db->insert(
			"tasa_bolivar",
			[
				"user_id" => $this->session->userdata("id"),
				"precio" => set_value("tasa")
			]
		);

		message(
			"Registrado Correctamente",
			"success",
			"success",
		);

		redirect($_SERVER['HTTP_REFERER']);
	}
}
