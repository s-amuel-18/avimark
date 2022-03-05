<?php

class Admin_categorias  extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->tabla_principal = "categorias";

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
      "categoria_model"
    ]);
  }

  public function crear()
  {
    // var_dump("sads");die();
    $request = $this->input->post();

    $config = [
      [
        "field" =>  "nombre",
        "label" => "Nombre",
        "rules" =>  "trim|required",
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

    $data_insert["nombre"] = set_value("nombre");
    $data_insert["usuario_id"] = $this->session->userdata("id");

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
      "La categori '{$data_insert["nombre"]}' se ha registrado correctamente.",
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
      redirect("admin_clientes");
      return;
    }


    $config = [
      [
        "field" =>  "nombre",
        "label" => "Nombre",
        "rules" =>  "trim|required",
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


    $response_categoria_exist = $this->db->get_where(
      $this->tabla_principal,
      [
        "id" => set_value("id_categoria_input")
      ]
    )->row();

    $date = new DateTime();
    $data_update["nombre"] = set_value("nombre");
    $data_update["updated_at"] = date_format($date, "Y-m-d H:i:s");



    if (!$response_categoria_exist) {
      message(
        "La categoria ´{$data_update["nombre"]}' no esta registrado",
        "error",
        "danger",
      );

      redirect("admin_info_interna");
      return false;
    }


    foreach ($data_update as $key => $data_upd) {
      $this->db->set($key, $data_upd);
    }

    $this->db->where("id", $response_categoria_exist->id);
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
      "Se Ha actualizado la categoria '{$data_update["nombre"]}' correctamente.",
      "success",
      "success",
    );

    redirect("admin_info_interna");
    return false;
  }

  public function get_categoria()
  {
    $id_categoria = $this->input->post("id_categoria");

    $categoria = $this->db->get_where($this->tabla_principal, ["id" => $id_categoria])->row();

    echo json_encode($categoria);
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
      redirect("admin_info_interna");
      return false;
    }

    $categoria_exist = $this->db->get_where($this->tabla_principal, ["id" => $id])->row();

    if (!$categoria_exist) {
      message(
        "El elemento que se quiere eliminar no existe.",
        "error",
        "danger",
      );
      redirect("admin_info_interna");
      return false;
    }

    $this->db->delete("precio_servicios", ["categoria_id" => $id]);
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
    // unlink($categoria_exist->foto);
    message(
      "EL usuario " . $categoria_exist->nombre . " se ha eliminado correctamente.",
      "success",
      "success",
    );
    redirect("admin_info_interna");
    return false;
  }
}
