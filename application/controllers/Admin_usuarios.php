<?php

class Admin_usuarios  extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->tabla_principal = "usuarios";
		$this->load->helper([
			"url",
			"cargar_archivo_helper",
			"message_helper",
			"upload_imgs_helper",
			"manipular_archivos_helper",
		]);

		$this->load->library([
			"parser",
			"valid_data_user",
			"form_validation",
			"session",
		]);

		$this->load->model([
			"usuarios_model"
		]);


		// validar loggin
		if ($this->session->userdata("perfil") != "administrador") {
			show_404();
			return false;

			return;
		}
	}

	public function index()
	{
		// var_dump($this->session->userdata());die();

		// $date = new DateTime();
		$data["usuarios"] = $this->usuarios_model->consulta_usuarios();


		$view["body"] = $this->load->view("admin/usuarios/usu_index", $data, true);
		$view["scripts"] =  archivos_js([
			base_url("assets/js/admin/usuarios/index.js"),
			base_url("assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"),
		]);
		$this->parser->parse("admin/template/body", $view);
	}

	public function crear()
	{
		$request = $this->input->post();

		$config = [
			[
				"field" =>  "nombre",
				"label" => "Nombre",
				"rules" =>  "trim|required",
			],
			[
				"field" =>  "nombre_usuario",
				"label" => "Nombre De Usuario",
				"rules" =>  "trim|required|alpha_numeric",
			],
			[
				"field" =>  "password",
				"label" => "Contraseña",
				"rules" =>  "trim|required",
			],
			[
				"field" =>  "perfil",
				"label" => "Perfil",
				"rules" =>  "trim|required",
			],
		];

		$this->form_validation->set_rules($config);

		if (!$this->form_validation->run()) {

			message(
				"Error de validacion, Intentalo de nuevo",
				"error",
				"danger",
			);
			redirect("admin_usuarios");
			return false;
		}

		$data_insert["nombre"] = set_value("nombre");
		$data_insert["nombre_usuario"] = set_value("nombre_usuario");
		$data_insert["password"] = set_value("password");
		$data_insert["perfil"] = set_value("perfil");

		$response_user_exist = $this->db->get_where(
			$this->tabla_principal,
			[
				"nombre_usuario" => $data_insert["nombre_usuario"]
			]
		)->row();

		if ($response_user_exist) {
			message(
				"Ya existe un usuario con el nombre de usuario: ´{$data_insert["nombre_usuario"]}'",
				"error",
				"danger",
			);

			redirect("admin_usuarios");
			return false;
		}

		// var_dump($response_user_exist);die();

		$ruta_uploads = "uploads/usuarios/" . $data_insert["nombre_usuario"];
		// var_dump($ruta_uploads);die();

		if( !is_dir($ruta_uploads)) {
			/* esta funcion mkdir se usar para la creacion de carpetas */
			mkdir($ruta_uploads, 0755 /* este numero se coloca para dar permisos a la carpeta de lectura escritura, eliminacion, etc.. */);
			
		}
		
		$nombre_foto = subir_img_cuadrada("foto", getcwd() . "/" . $ruta_uploads);
		$data_insert["foto"] = $nombre_foto == "" ? NULL : $ruta_uploads . "/" . $nombre_foto;

		$response = $this->db->insert($this->tabla_principal, $data_insert);

		if (!$response) {
			message(
				"Ha ocurrido un ERROR, intentalo de nuevo.",
				"error",
				"danger",
			);

			redirect("admin_usuarios");
			return false;
		}

		message(
			"El usuario '{$data_insert["nombre_usuario"]}' se ha registrado correctamente.",
			"success",
			"success",
		);

		redirect("admin_usuarios");
		return false;
	}



	public function actualizar()
	{
		$config = [
			[
				"field" =>  "nombre",
				"label" => "Nombre",
				"rules" =>  "trim|required",
			],
			[
				"field" =>  "nombre_usuario",
				"label" => "Nombre De Usuario",
				"rules" =>  "trim|required|alpha_numeric",
			],
			[
				"field" =>  "id_usuario_input",
				"label" => "id",
				"rules" =>  "trim|required",
			],
			[
				"field" =>  "perfil",
				"label" => "Perfil",
				"rules" =>  "trim|required",
			],
		];

		$this->form_validation->set_rules($config);

		if (!$this->form_validation->run()) {

			message(
				"Error de validacion, Intentalo de nuevo",
				"error",
				"danger",
			);
			redirect("admin_usuarios");
			return false;
		}


		$response_user_exist = $this->db->get_where(
			$this->tabla_principal,
			[
				"id" => set_value("id_usuario_input")
			]
		)->row();

		$data_update["nombre"] = set_value("nombre");
		$data_update["nombre_usuario"] = $response_user_exist->nombre_usuario;
		$data_update["password"] = set_value("password") == "" ? $response_user_exist->password : set_value("password");
		$data_update["perfil"] = set_value("perfil");


		if (!$response_user_exist) {
			message(
				"El usuario ´{$data_update["nombre_usuario"]}' no esta registrado",
				"error",
				"danger",
			);

			redirect("admin_usuarios");
			return false;
		}


		$ruta_uploads = "uploads/usuarios/" . $data_update["nombre_usuario"];
		$nombre_foto = subir_img_cuadrada("foto", getcwd() . "/" . $ruta_uploads);
		$data_update["foto"] = $nombre_foto == "" ? $response_user_exist->foto : $ruta_uploads . "/" . $nombre_foto;
		// var_dump($response_user_exist->foto);die();

		if (!empty($nombre_foto) && $response_user_exist->foto) {
			unlink($response_user_exist->foto);
		}

		foreach ($data_update as $key => $data_upd) {
			$this->db->set($key, $data_upd);
		}

		$this->db->where("id", $response_user_exist->id);
		$response = $this->db->update("usuarios");

		if (!$response) {
			message(
				"Ha ocurrido un ERROR, intentalo de nuevo.",
				"error",
				"danger",
			);

			redirect("admin_usuarios");
			return false;
		}

		message(
			"El actualizado el usuario '{$data_update["nombre_usuario"]}' correctamente.",
			"success",
			"success",
		);

		redirect("admin_usuarios");
		return false;
	}

	public function get_usuario()
	{
		$id_usuario = $this->input->post("id_usuario");

		$usuario = $this->db->get_where("usuarios", ["id" => $id_usuario])->row();

		echo json_encode($usuario);
	}

	public function eliminar()
	{
		// var_dump("dsad");die();
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
			redirect("admin_usuarios");
			return false;
		}

		$usuario_exist = $this->db->get_where("usuarios", ["id" => $id])->row();

		if (!$usuario_exist) {
			message(
				"El elemento que se quiere eliminar no existe.",
				"error",
				"danger",
			);
			redirect("admin_usuarios");
			return false;
		}

		// eliminar la carpeta del usuario
		rmDir_rf(getcwd() . "/uploads/usuarios/{$usuario_exist->nombre_usuario}");

		$eliminar = $this->db->delete("usuarios", ["id" => $id]);

		if (!$eliminar) {
			message(
				"Ha ocurrido un error.",
				"error",
				"danger",
			);
			redirect("admin_usuarios");
			return false;
		}
		// unlink($usuario_exist->foto);
		message(
			"EL usuario " . $usuario_exist->nombre_usuario . " se ha eliminado correctamente.",
			"success",
			"success",
		);
		redirect("admin_usuarios");
		return false;
	}


	public function actualizar_activacion()
	{
		// var_dump("dsad");die();
		$config = [
			[
				"field" =>  "id",
				"label" => "id",
				"rules" =>  "trim|required|numeric",
			],
			[
				"field" =>  "estado",
				"label" => "estado",
				"rules" =>  "trim|required|numeric",
			],
		];

		$id = set_value("id");
		$estado_final = set_value("estado") == 0 ? 1 : 0;

		$this->form_validation->set_rules($config);

		if (!$this->form_validation->run() or !$id) {

			message(
				"Error de validacion, Intentalo de nuevo",
				"error",
				"danger",
			);
			redirect("admin_usuarios");
			return false;
		}


		$usuario_exist = $this->db->get_where("usuarios", ["id" => $id])->row();

		if (!$usuario_exist) {
			message(
				"El elemento que se quiere eliminar no existe.",
				"error",
				"danger",
			);
			redirect("admin_usuarios");
			return false;
		}

		$this->db->set("activado", $estado_final);
		$this->db->where("id", $id);
		$editar = $this->db->update("usuarios");
		// var_dump($estado_final);die();



		if (!$editar) {
			message(
				"Ha ocurrido un error.",
				"error",
				"danger",
			);
			redirect("admin_usuarios");
			return false;
		}
		// unlink($usuario_exist->foto);
		message(
			"EL usuario " . $usuario_exist->nombre_usuario . " se ha " . ($estado_final == 0 ? "Desactivado" : "Activado") . " correctamente.",
			"success",
			"success",
		);
		redirect("admin_usuarios");
		return false;
	}
}
