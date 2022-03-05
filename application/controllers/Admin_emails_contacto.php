<?php

class Admin_emails_contacto  extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->tabla_principal = "emails_contacto";

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
      "email_contacto_model"
    ]);
  }

  public function index()
  {
    $this->valid_data_user->usuario_valido();
    $emails_contacto =  $this->email_contacto_model->get_all();
    $data["emails_contacto"] = $emails_contacto;

    $emails_al_dia = $this->email_contacto_model->emails_dia_actual(null, true)[0]->cantidad_emails;
    // var_dump($emails_al_dia);die();

    $emails_registrados_epoca = [
      [
        "color" => "danger",
        "titulo" => "Registros Totales",
        "cantidad" => $this->db->get($this->tabla_principal)->num_rows(),
        "url_reporte" => site_url("admin_trabajos/reporte_trabajos_anio")
      ],
      [
        "color" => "warning",
        "titulo" => "Reporte Del Dia",
        "cantidad" => $emails_al_dia,
        "url_reporte" => site_url("admin_trabajos/reporte_trabajos_mes")
      ],
      [
        "color" => "info",
        "titulo" => "Correos sin Envio",
        "cantidad" => $this->db->get_where($this->tabla_principal, ["enviado" => 0])->num_rows(),
        "url_reporte" => site_url("admin_trabajos/reporte_trabajos_sin_enviar")
      ],

    ];

    $data["emails_registrados_epoca"] = $emails_registrados_epoca;

    // var_dump($emails_contacto);die();

    $categorias = $this->db->get("categorias")->result();/* $this->email_contacto_model->get_all(); */
    $data["categorias"] = $categorias;

    $view["body"] = $this->load->view("admin/emails_contacto/em_con_index", $data, true);
    $view["scripts"] =  archivos_js([
      base_url() . "assets/plugins/summernote/summernote-bs4.min.js",
      base_url() . "assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js",
      base_url("assets/js/admin/emails_contacto/em_co__index.js"),
      // base_url("assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"),
    ]);
    $this->parser->parse("admin/template/body", $view);
  }

  public function get_email()
  {

    $id_email_contacto = $this->input->post("id_email");

    $email_contacto = $this->db->get_where($this->tabla_principal, ["id" => $id_email_contacto])->row();

    echo json_encode($email_contacto);
  }

  public function ajax_emails()
  {
    $trabajos = $this->email_contacto_model->get_all();
    echo $this->json_table($trabajos);
  }

  private function json_table($trabajos = [])
  {
    $response =  '{"data": [';

    foreach ($trabajos as $i => $trabajo) {




      $foto_usuario = base_url($trabajo->foto_usuario);
      $usuario = "<img src='{$foto_usuario}' alt='Product 1' class='img-circle img-size-32 mr-2'>{$trabajo->usuario_creacion}";

      $badge = "<span class='badge bg-{$trabajo->color_enviado}'>$trabajo->text_enviado</span>";

      $url_delete = site_url('admin/emails_contacto/eliminar');
      $buttons = "<form action='{$url_delete}' method='POST' onsubmit='return confirm(`Realmente deseas eliminar el email_contacto {$trabajo->nombre}`)'><input type='hidden' value='{$trabajo->id}' name='id'><button class='btn btn-warning btn-sm' type='button' data-titulo='Editar email '{$trabajo->nombre}'' data-toggle='modal' data-target='#nuevo_email_contacto' data-id='{$trabajo->id}'><i class='fas fa-edit'></i></button><button class='btn btn-danger btn-sm' type='submit'><i class='fas fa-trash'></i></button></form>";

      $response .= '
              [
               
                "' . ($i + 1) . '",
                "' . $trabajo->id . '",
                "' . $usuario . '",
                "' . $trabajo->categoria . '",
                "' . $trabajo->nombre . '",
                "' . $trabajo->email . '",
                "' . $badge . '",
                "' . $trabajo->updated_at . '",
                "' . $trabajo->created_at . '",
                "' . $buttons . '"
              ]
            ';

      if ($i != (COUNT($trabajos) - 1)) {
        $response .= ",";
      }
    }

    $response .= ']}';
    return $response;
    // echo json_encode($trabajos);
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
        "field" =>  "url",
        "label" => "url",
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
      redirect("admin_emails_contacto");
      return false;
    }

    $data_insert["usuario_id"] = $this->session->userdata("id");
    $data_insert["nombre"] = set_value("nombre");
    $data_insert["url"] = set_value("url");
    $data_insert["descripcion"] = set_value("descripcion");
    $data_insert["categoria_id"] = (!set_value("categoria_id")  or set_value("categoria_id") == "") ? NULL : set_value("categoria_id");
    $data_insert["email"] = set_value("email");

    // var_dump($data_insert);die();

    $response = $this->db->insert($this->tabla_principal, $data_insert);

    if (!$response) {
      message(
        "Ha ocurrido un ERROR, intentalo de nuevo.",
        "error",
        "danger",
      );

      redirect("admin_emails_contacto");
      return false;
    }

    message(
      "El email_contacto '{$data_insert["nombre"]}' se ha registrado correctamente.",
      "success",
      "success",
    );

    redirect("admin_emails_contacto");
    return false;
  }

  public function actualizar()
  {
    $config = [
      [
        "field" =>  "nombre",
        "label" => "Nombre",
        "rules" =>  "required",
      ],
      [
        "field" =>  "url",
        "label" => "url",
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
      redirect("admin_emails_contacto");
      return false;
    }


    $response_email_exist = $this->db->get_where(
      $this->tabla_principal,
      [
        "id" => set_value("id_email_input")
      ]
    )->row();

    $date = new DateTime();
    $data_update["updated_at"] = date_format($date, "Y-m-d H:i:s");
    $data_update["nombre"] = set_value("nombre");
    $data_update["url"] = set_value("url");
    $data_update["descripcion"] = set_value("descripcion");
    $data_update["categoria_id"] = (!set_value("categoria_id")  or set_value("categoria_id") == "") ? NULL : set_value("categoria_id");
    $data_update["email"] = set_value("email");



    if (!$response_email_exist) {
      message(
        "El email ´{$data_update["nombre"]}' no esta registrado",
        "error",
        "danger",
      );

      redirect("admin_emails_contacto");
      return false;
    }



    foreach ($data_update as $key => $data_upd) {
      $this->db->set($key, $data_upd);
    }

    $this->db->where("id", $response_email_exist->id);
    $response = $this->db->update($this->tabla_principal);

    if (!$response) {
      message(
        "Ha ocurrido un ERROR, intentalo de nuevo.",
        "error",
        "danger",
      );

      redirect("admin_emails_contacto");
      return false;
    }

    message(
      "Se ha actualizado el email '{$data_update["email"]}' correctamente.",
      "success",
      "success",
    );

    redirect("admin_emails_contacto");
    return false;
  }


  public function eliminar()
  {
    if ($this->session->userdata("perfil") != "administrador") {
      message(
        "No tienes los permisos para eliminar este contenido",
        "error",
        "danger",
      );
      redirect("admin_emails_contacto");
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
      redirect("admin_emails_contacto");
      return false;
    }


    $email_contacto_exist = $this->db->get_where($this->tabla_principal, ["id" => $id])->row();

    if (!$email_contacto_exist) {
      message(
        "El elemento que se quiere eliminar no existe.",
        "error",
        "danger",
      );
      redirect("admin_emails_contacto");
      return false;
    }


    $eliminar = $this->db->delete($this->tabla_principal, ["id" => $id]);

    if (!$eliminar) {
      message(
        "Ha ocurrido un error.",
        "error",
        "danger",
      );
      redirect("admin_emails_contacto");
      return false;
    }

    message(
      "EL email " . $email_contacto_exist->email . " se ha eliminado correctamente.",
      "success",
      "success",
    );
    redirect("admin_emails_contacto");
    return false;
  }
}
