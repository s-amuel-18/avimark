<?php

class Valid_data_user
{
  protected $ci;
  protected $datauser;

  public function __construct()
  {
    // parent::__construct(); 
    $this->ci = &get_instance();
    $this->ci->load->helper([
      "url",
      "message_helper",
    ]);

    $this->ci->load->library([
      "session"
    ]);

    $this->ci->load->model([
      "email_contacto_model"
    ]);

    $this->usuario_valido();
  }

  public function usuario_valido()
  {
    $userdata = $this->ci->session->userdata();
// var_dump($variable);
    if (!isset($userdata["id"]) OR !$userdata["id"]) {
      redirect("auth");
      return false;
    }
		
    $valid_user = $this->ci->db->get_where("usuarios", ["id" => $userdata["id"]])->row();
		
    if (!$valid_user) {
      redirect("auth");
      return false;
    }

    $data_user = [
      "id" => $valid_user->id,
      "nombre" => $valid_user->nombre,
      "username" => $valid_user->nombre_usuario,
      "is_logged" => true,
      "perfil" => $valid_user->perfil,
      "activado" => $valid_user->activado,
      "foto" => $valid_user->foto ? base_url($valid_user->foto) : base_url("assets/admin-lte/img/avatar.png")
    ];


    $this->ci->session->set_userdata($data_user);


    if (empty($valid_user)) {
      redirect("auth");
    } else if ($valid_user->activado == 0) {
      message(
        "Su usuario a sido desactivado",
        "danger",
        "danger"
      );
      redirect("auth");
    }

    if (!$this->ci->session->userdata("is_logged")) {
      redirect("auth");
    }
  }
}
