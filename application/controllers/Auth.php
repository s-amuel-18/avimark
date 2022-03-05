<?php

class Auth  extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->model([
      "Auth_model"
    ]);

    $this->load->helper([
      "url",
      "message_helper"
    ]);

    $this->load->library([
      "parser",
      "form_validation",
      "session"
    ]);
  }

  public function index()
  {
    $view["body"] = $this->load->view("admin/login/log_index", [], true);
    $this->parser->parse("admin/login/log_template", $view);
  }

  public function loggin()
  {
    $request = $this->input->post();

    $config = [
      [
        "field" =>  "nombre_usuario",
        "label" => "Nombre De Usuario",
        "rules" =>  "required|alpha_numeric",
        "errors" => [
          "required" => "El campo %s es requerido",
        ]
      ],
      [
        "field" =>  "contraseña",
        "label" => "Contraseña",
        "rules" =>  "required",
        "errors" => [
          "required" => "El campo %s es requerida",
        ]
      ],
    ];

    $this->form_validation->set_rules($config);

    if (!$this->form_validation->run()) {

      $view["body"] = $this->load->view("admin/login/log_index", [], true);
      $this->parser->parse("admin/login/log_template", $view);
      return false;
    }

    // *nombre de usuario
    $nombre_usuario = set_value("nombre_usuario");

    // *Contraseña
    $password = set_value("contraseña");

    $response_usuario = $this->db->get_where("usuarios", ["password" => $password, "nombre_usuario" => $nombre_usuario])->row();

    $respuesta =
      empty($response_usuario)
      ? "El nombre de usuario o la contraseña son INCORRECTOS."
      : (
        (!empty($response_usuario) and $response_usuario->activado == 0)
        ? "El usuario aun no esta activado."
        : ""
      );
    // var_dump( !empty($response_usuario) AND $response_usuario->activado == 0 );die();
    if (empty($response_usuario) or (!empty($response_usuario) and $response_usuario->activado == 0)) {
      message(
        $respuesta,
        "error",
        "danger"
      );

      redirect("auth");
      return false;
    }
    $date = new DateTime();
    $this->db->set("ultimo_login", date_format($date, "Y-m-d H:i:s"));
    $this->db->where("id", $response_usuario->id);
    $this->db->update("usuarios");

    $data_user = [
      "id" => $response_usuario->id,
      "nombre" => $response_usuario->nombre,
      "username" => $response_usuario->nombre_usuario,
      "is_logged" => true,
      "perfil" => $response_usuario->perfil,
      "activado" => $response_usuario->activado,
      "foto" => $response_usuario->foto ? base_url($response_usuario->foto) : base_url("assets/admin-lte/img/avatar.png")
    ];

		$informacion_interna = $this->db->get("informacion_interna")->row();

		$_SESSION["info_empresa"] = $informacion_interna; 

    $this->session->set_userdata($data_user);


    if( $this->session->userdata("perfil") === "administrador" OR $this->session->userdata("perfil") === "editor" ) {
      $informacion_internat_exist = $this->db->get("informacion_interna")->num_rows();
  
      if( $informacion_internat_exist == 0 ) {
        message(
          "Es necesario registrar una informacion base en el modulo 'Informacion De La Empresa' para poder realizar las distintas operaciones relacionas con la empresa.",
          "warning",
          "warning",
        );
        
        redirect("admin_info_interna");
        return false;
      }
      
    } else {
      redirect("admin_dashboard");
      return false;
    }
    
    redirect("admin_dashboard");
    
    // var_dump($response_usuario);die();
  }


  public function logout()
  {
    $sesion_data = [
      "id",
      "nombre",
      "username",
      "is_logged",
      "perfil",
      "activado",
      "foto"
    ];

		unset($_SESSION["info_empresa"]);
		
    $this->session->unset_userdata($sesion_data);
    $this->session->sess_destroy();
    redirect("/auth");
  }
}
