<?php 

class Admin_dashboard  extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

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
      "valid_data_user"
    ]);

    $this->load->model([
      "email_contacto_model",
      "vistas_model"
    ]);

  }

  public function index()
  {

		$ip_address_user = $_SERVER["REMOTE_ADDR"];
		$visitas = $this->vistas_model->vistas_semana();
		$data["visitas"] = $visitas ;

		$users = $this->db->get("usuarios")->num_rows();
		$data["users"] = $users;
		
    $view["body"] = $this->load->view("admin/dashboard/dash_index", $data, true);
    $this->parser->parse("admin/template/body", $view);
  }
}
