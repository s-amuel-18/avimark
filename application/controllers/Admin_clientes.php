<?php

class Admin_clientes  extends CI_Controller
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
      "cliente_model"
    ]);
  }

  public function index()
  {
    $clientes = $this->cliente_model->get_all();
    $data["clientes"] = $clientes;

    $view["body"] = $this->load->view("admin/clientes/cli_index", $data, true);
    $view["scripts"] =  archivos_js([
      base_url() . "assets/plugins/summernote/summernote-bs4.min.js",
      base_url() . "assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js",
      base_url("assets/js/admin/clientes/cli_index.js"),
      // base_url("assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"),
    ]);
    $this->parser->parse("admin/template/body", $view);
  }

  public function get_cliente()
  {
    $id_cliente = $this->input->post("id_cliente");

    $cliente = $this->db->get_where($this->tabla_principal, ["id" => $id_cliente])->row();

    echo json_encode($cliente);
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
        "field" =>  "nombre_empresa",
        "label" => "nombre_empresa",
        "rules" =>  "required",
      ],
      [
        "field" =>  "email",
        "label" => "email",
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
      redirect("admin_clientes");
      return false;
    }

    $data_insert["usuario_id"] = $this->session->userdata("id");
    $data_insert["nombre"] = set_value("nombre");
    $data_insert["nombre_empresa"] = set_value("nombre_empresa");
    $data_insert["telefono"] = set_value("telefono");
    $data_insert["email"] = set_value("email");


    $response = $this->db->insert($this->tabla_principal, $data_insert);

    if (!$response) {
      message(
        "Ha ocurrido un ERROR, intentalo de nuevo.",
        "error",
        "danger",
      );

      redirect("admin_clientes");
      return false;
    }

    message(
      "El Cliente '{$data_insert["nombre"]}' se ha registrado correctamente.",
      "success",
      "success",
    );

    redirect("admin_clientes");
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
      redirect("admin_clientes");
      return;
    }


    $config = [
      [
        "field" =>  "nombre",
        "label" => "Nombre",
        "rules" =>  "required",
      ],
      [
        "field" =>  "nombre_empresa",
        "label" => "nombre_empresa",
        "rules" =>  "required",
      ],
      [
        "field" =>  "email",
        "label" => "email",
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
      redirect("admin_clientes");
      return false;
    }


    $response_client_exist = $this->db->get_where(
      $this->tabla_principal,
      [
        "id" => set_value("id_cliente_input")
      ]
    )->row();

    $date = new DateTime();
    $data_update["updated_at"] = date_format($date, "Y-m-d H:i:s");
    $data_update["nombre"] = set_value("nombre");
    $data_update["nombre_empresa"] = set_value("nombre");
    $data_update["email"] = set_value("email");
    $data_update["telefono"] = set_value("telefono") ? set_value("telefono") : $response_client_exist->telefono;

    // var_dump($data_update);die();

    if (!$response_client_exist) {
      message(
        "El cliente ´{$data_update["nombre"]}' no esta registrado",
        "error",
        "danger",
      );

      redirect("admin_clientes");
      return false;
    }



    foreach ($data_update as $key => $data_upd) {
      $this->db->set($key, $data_upd);
    }

    $this->db->where("id", $response_client_exist->id);
    $response = $this->db->update($this->tabla_principal);

    if (!$response) {
      message(
        "Ha ocurrido un ERROR, intentalo de nuevo.",
        "error",
        "danger",
      );

      redirect("admin_clientes");
      return false;
    }

    message(
      "Se ha actualizado el cliente '{$data_update["nombre"]}' correctamente.",
      "success",
      "success",
    );

    redirect("admin_clientes");
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
      redirect("admin_clientes");
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
      redirect("admin_clientes");
      return false;
    }


    $cliente_exist = $this->db->get_where($this->tabla_principal, ["id" => $id])->row();

    if (!$cliente_exist) {
      message(
        "El elemento que se quiere eliminar no existe.",
        "error",
        "danger",
      );
      redirect("admin_clientes");
      return false;
    }


    $eliminar = $this->db->delete($this->tabla_principal, ["id" => $id]);

    if (!$eliminar) {
      message(
        "Ha ocurrido un error.",
        "error",
        "danger",
      );
      redirect("admin_clientes");
      return false;
    }

    message(
      "EL Cliente " . $cliente_exist->nombre . " se ha eliminado correctamente.",
      "success",
      "success",
    );
    redirect("admin_clientes");
    return false;
  }
}
