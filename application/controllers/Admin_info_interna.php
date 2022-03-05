<?php

class Admin_info_interna  extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->tabla_principal = "informacion_interna";

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
      "categoria_model",
      "informacion_interna_model",
      "cartera_model"
    ]);


    if ($this->session->userdata("perfil") != "administrador" and $this->session->userdata("perfil") != "editor") {
      show_404();
      return false;

      return;
    }
  }

  public function index()
  {
    $carteras = $this->cartera_model->get_all();
    $data["carteras"] = $carteras;

    $informacion_interna = $this->db->get($this->tabla_principal)->row();
    $data["informacion_interna"] = $informacion_interna;

    $categorias = $this->categoria_model->get_all();
    $data["categorias"] = $categorias;

    $url_form_info_interna = !$informacion_interna ? site_url("admin/informacion_interna/crear") : site_url("admin/informacion_interna/actualizar");
    $data["url_form_info_interna"] = $url_form_info_interna;

    $informacion_internat_exist = $this->db->get("informacion_interna")->num_rows();

    if ($informacion_internat_exist == 0) {
      message(
        "Es necesario registrar una informacion base en el modulo 'Informacion De La Empresa' para poder realizar las distintas operaciones relacionas con la empresa.",
        "warning",
        "warning",
      );
    }


    $view["body"] = $this->load->view("admin/info_interna/if_in_index", $data, true);
    $view["scripts"] =  archivos_js([
      base_url() . "assets/plugins/summernote/summernote-bs4.min.js",
      base_url() . "assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js",
      base_url("assets/js/admin/info_interna/if_in_index.js"),
      // base_url("assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"),
    ]);
    $this->parser->parse("admin/template/body", $view);
  }

  public function crear()
  {
    $request = $this->input->post();

    $config = [
      [
        "field" =>  "nombre_empresa",
        "label" => "nombre empresa",
        "rules" =>  "required",
      ],
      [
        "field" =>  "email_empresa",
        "label" => "email empresa",
        "rules" =>  "required",
      ],
      [
        "field" =>  "direccion_empresa",
        "label" => "direccion empresa",
        "rules" =>  "required",
      ],
      [
        "field" =>  "telefono_empresa",
        "label" => "telefono empresa",
        "rules" =>  "required",
      ]
    ];

    $this->form_validation->set_rules($config);

    if (!$this->form_validation->run()) {

      message(
        "Error de validacion, Intentalo de nuevo",
        "error",
        "danger",
      );
      redirect("admin_info_interna");
      return false;
    }

    // $data_insert["usuario_id"] = $this->session->userdata("id");
    $data_insert["nombre_empresa"] = set_value("nombre_empresa");
    $data_insert["direccion_empresa"] = set_value("direccion_empresa");
    $data_insert["telefono_empresa"] = set_value("telefono_empresa");
    $data_insert["email_empresa"] = set_value("email_empresa");

    // var_dump($data_insert);die();


    $response = $this->db->insert($this->tabla_principal, $data_insert);

    if (!$response) {
      message(
        "Ha ocurrido un ERROR, intentalo de nuevo.",
        "error",
        "danger",
      );

      redirect("admin_info_interna");
      return false;
    }

    message(
      "La informacion de la empresa se ha registrado correctamente.",
      "success",
      "success",
    );

    redirect("admin_info_interna");
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
      redirect("admin_info_interna");
      return;
    }


    $config = [
      [
        "field" =>  "nombre_empresa",
        "label" => "nombre empresa",
        "rules" =>  "required",
      ],
      [
        "field" =>  "email_empresa",
        "label" => "email empresa",
        "rules" =>  "required",
      ],
      [
        "field" =>  "direccion_empresa",
        "label" => "direccion empresa",
        "rules" =>  "required",
      ],
      [
        "field" =>  "telefono_empresa",
        "label" => "telefono empresa",
        "rules" =>  "required",
      ]
    ];

    $this->form_validation->set_rules($config);

    if (!$this->form_validation->run()) {

      message(
        "Error de validacion, Intentalo de nuevo",
        "error",
        "danger",
      );
      redirect("admin_info_interna");
      return false;
    }


    $response_info_exist = $this->db->get(
      $this->tabla_principal,
    )->row();


    $date = new DateTime();
    $data_update["updated_at"] = date_format($date, "Y-m-d H:i:s");
    $data_update["nombre_empresa"] = set_value("nombre_empresa");
    $data_update["direccion_empresa"] = set_value("direccion_empresa");
    $data_update["telefono_empresa"] = set_value("telefono_empresa");
    $data_update["email_empresa"] = set_value("email_empresa");


    // var_dump($data_update);die();

    if (!$response_info_exist) {
      message(
        "El cliente ´{$data_update["nombre"]}' no esta registrado",
        "error",
        "danger",
      );

      redirect("admin_info_interna");
      return false;
    }



    foreach ($data_update as $key => $data_upd) {
      $this->db->set($key, $data_upd);
    }

    $this->db->where("id", $response_info_exist->id);
    $response = $this->db->update($this->tabla_principal);

    if (!$response) {
      message(
        "Ha ocurrido un ERROR, intentalo de nuevo.",
        "error",
        "danger",
      );

      redirect("admin_info_interna");
      return false;
    }

    message(
      "Se ha actualizado la informacion correctamente.",
      "success",
      "success",
    );

    redirect("admin_info_interna");
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
      redirect("admin_info_interna");
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
      redirect("admin_info_interna");
      return false;
    }


    $cliente_exist = $this->db->get_where($this->tabla_principal, ["id" => $id])->row();

    if (!$cliente_exist) {
      message(
        "El elemento que se quiere eliminar no existe.",
        "error",
        "danger",
      );
      redirect("admin_info_interna");
      return false;
    }


    $eliminar = $this->db->delete($this->tabla_principal, ["id" => $id]);

    if (!$eliminar) {
      message(
        "Ha ocurrido un error.",
        "error",
        "danger",
      );
      redirect("admin_info_interna");
      return false;
    }

    message(
      "EL Cliente " . $cliente_exist->nombre . " se ha eliminado correctamente.",
      "success",
      "success",
    );
    redirect("admin_info_interna");
    return false;
  }
}
