<?php

use Dompdf\Dompdf;

class Admin_facturas  extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();


    $this->tabla_principal = "facturas";

    $this->load->helper([
      "url",
      "cargar_archivo_helper",
      "message_helper",
      "upload_imgs_helper",
      "impuestos_helper",
      "manipular_archivos_helper",
    ]);

    $this->load->library([
      "parser",
      "form_validation",
      "session",
      "valid_data_user",
      "pdf",
    ]);

    $this->load->model([
      "cliente_model",
      "categoria_model",
      "informacion_interna_model",
      "factura_model",
      "cartera_model"
    ]);
    // var_dump($this->db->insert_id("facturas"));die();

    $mensaje = "Debes tener como minimo ";
    $clientes = $this->db->get("clientes")->num_rows();
    $carteras = $this->db->get("carteras")->num_rows();
    $categorias = $this->db->get("categorias")->num_rows();
    $info_interna = $this->db->get("informacion_interna")->num_rows();

    if ($clientes == 0) {
      $mensaje .= "un Clienten ";
      $redirect = "admin_clientes";
    } else if ($carteras == 0) {
      $mensaje .= "una Cartere ";
      $redirect = "admin_carteras";
    } else if ($info_interna == 0) {
      $mensaje .= "informacion de la pagina ";
      $redirect = "admin_info_interna";
    } else if ($categorias == 0) {
      $mensaje .= "un Servicio ";
      $redirect = "admin_info_interna";
    }

    $mensaje .= "para poder crear una factura.";
    $type = "warning";
    $color = "warning";

    if ($clientes == 0 or $info_interna == 0 or $carteras == 0 OR $categorias == 0) {
      message(
        $mensaje,
        $type,
        $color
      );

      redirect($redirect);
    }
  }

  public function index()
  {
    $facturas = $this->factura_model->get_all();
    $data["facturas"] = $facturas;

    $view["body"] = $this->load->view("admin/facturas/fac_index", $data, true);
    $view["scripts"] =  archivos_js([
      // base_url() . "assets/plugins/summernote/summernote-bs4.min.js",
      // base_url() . "assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js",
      // base_url("assets/js/admin/facturas/fac_functions.js"),
      // base_url("assets/js/admin/facturas/fac_crear.js"),
      // base_url("assets/js/admin/facturas/fac_categoria.js"),
    ]);
    $this->parser->parse("admin/template/body", $view);
  }

  public function vista_crear()
  {
   
    
    $carteras = $this->cartera_model->get_all();
    $data["carteras"] = $carteras;

    $informacion_interna = $this->db->get("informacion_interna")->row();
    $data["informacion_interna"] = $informacion_interna;


    $categorias = $this->categoria_model->get_all();
    $data["categorias"] = $categorias;

		$servicios_nuevo = $this->db->select(["id", "nombre", "precio_total"])->get("servicios")->result();
		$data["servicios_nuevo"] = $servicios_nuevo;		

    $clientes = $this->db->get("clientes")->result();
    $data["clientes"] = $clientes;

    $view["body"] = $this->load->view("admin/facturas/fac_crear", $data, true);
    $view["scripts"] =  archivos_js([
      base_url() . "assets/plugins/summernote/summernote-bs4.min.js",
      base_url() . "assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js",
      base_url("assets/js/admin/facturas/fac_functions.js"),
      base_url("assets/js/admin/facturas/fac_crear.js"),
      base_url("assets/js/admin/facturas/fac_categoria.js"),
      // base_url("assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"),
    ]);
    $this->parser->parse("admin/template/body", $view);
  }

  public function crear()
  {
  
    $request = $this->input->post();

    $config = [
      [
        "field" => "cliente",
        "label" => "cliente",
        "rules" =>  "trim|required",
      ],
      [
        "field" => "id_informacion_interna",
        "label" => "id_informacion_interna",
        "rules" =>  "trim|required",
      ],
      [
        "field" => "cartera",
        "label" => "cartera",
        "rules" =>  "trim|required",
      ],
      [
        "field" => "job_services",
        "label" => "job_services",
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
      redirect("admin_facturas/crear");

      return false;
    }

    $data_insert["usuario_id"] = $this->session->userdata("id");
    $data_insert["info_interna_id"] = set_value("id_informacion_interna");
    $data_insert["cliente_id"] = set_value("cliente");
    $data_insert["cartera_id"] = set_value("cartera");
    $data_insert["servicio_trabajo"] = set_value("job_services");

    $categorias = $this->db->get("categorias")->result();

    if ($request["id_factura"] > 0) {

      foreach ($data_insert as $key => $item) {
        $this->db->set($key, $item);
      }
      $this->db->where("id", $request["id_factura"]);
      $response = $this->db->update("facturas");

      $this->db->delete("precio_servicios", ["factura_id" => $request["id_factura"]]);

      // var_dump($request["id_factura"]);
      // die();


    } else {

      $response = $this->db->insert($this->tabla_principal, $data_insert);
    }


    $ultimoId = ($request["id_factura"] > 0) ? $request["id_factura"] : $this->db->insert_id();
    if (!$response) {
      message(
        "Ha ocurrido un ERROR, intentalo de nuevo.",
        "error",
        "danger",
      );

      redirect("admin_facturas/crear");
      return false;
    }

    $this->db->insert("historico_facturas", ["numero_factura" => null]);

    $id_historico = $this->db->insert_id();

    $numero_factura = $id_historico + 10000;

    $this->db->set("numero_factura", $numero_factura);
    $this->db->where("id", $ultimoId);
    $this->db->update($this->tabla_principal);
    // if ($request["id_factura"] > 0) {

    // }




    foreach ($categorias as $categoria) {
      if (
        isset($request["cantidad_servicios"][$categoria->id]) &&
        isset($request["cantidad_servicios"][$categoria->id])
      ) {
        $cantidad = $request["cantidad_servicios"][$categoria->id];
        $precio = $request["precio"][$categoria->id];

        $data_precios_servicios["usuario_id"] = $data_insert["usuario_id"];
        $data_precios_servicios["factura_id"] = $ultimoId;
        $data_precios_servicios["categoria_id"] = $categoria->id;
        $data_precios_servicios["cantidad"] = $cantidad;
        $data_precios_servicios["precio"] = $precio;


        $this->db->insert("precio_servicios", $data_precios_servicios);
      }
    }


    $data["factura"] = $this->factura_model->get_all($ultimoId)[0];

    $data["servicio_trabajo"] =     $data_insert["servicio_trabajo"];


    $data["servicios"] = $this->factura_model->servicios_factura($ultimoId);
    $data["servicios_total"] = $this->factura_model->total_servicios_factura($ultimoId);

    $impuesto = null;
    if ($data_insert["cartera_id"] == 2) {
      $impuesto = para_resivir_paypal($data["servicios_total"]->total_pago) - $data["servicios_total"]->total_pago;
      // var_dump($impuesto);die();
    }

    $data["impuesto"] = $impuesto;


    $crear_plantilla = $this->input->post("plantilla_factura");

    if ($request["id_factura"] == 0) {
      if (!$crear_plantilla) {
        $this->db->delete($this->tabla_principal, ["id" => $ultimoId]);
        $this->db->delete("precio_servicios", ["factura_id" => $ultimoId]);
      }
    }

    $_SESSION["factura_data"] = $data;

    redirect("admin_facturas/mostrar_pdf");
  }

  public function ver_factura_plantilla($id_factura = null)
  {
    $fact_exist = $this->db->get_where($this->tabla_principal, ["id" => $id_factura])->num_rows();

    if (!$id_factura and is_nan($id_factura) and $fact_exist > 0) {
      show_404();
      return false;
    }

    $data["factura"] = $this->factura_model->get_all($id_factura)[0];

    $data["servicios"] = $this->factura_model->servicios_factura($id_factura);
    $data["servicios_total"] = $this->factura_model->total_servicios_factura($id_factura);

    if( !$data["factura"]->id_cliente ) {
      message(
        "El cliente de esta plantilla fue eliminado, debes actualizar la plantilla.",
        "warning",
        "warning"
      );

      redirect("admin_facturas/vista_actualizar/".$id_factura);
    }

    if( !$data["factura"]->id_cartera ) {
      message(
        "La plantilla no cuenta con una cartera de pago, registra una cartera para poder utilizar eesta plantilla.",
        "warning",
        "warning"
      );

      redirect("admin_facturas/vista_actualizar/".$id_factura);
    }
    
    if( count($data["servicios"]) < 1) {
      message(
        "No se encontraron servicios vinculados a esta plantilla, incluye los nuevos servicios.",
        "warning",
        "warning"
      );

      redirect("admin_facturas/vista_actualizar/".$id_factura);
    }
    
    $impuesto = null;

    if ($data["factura"]->id_cartera == 2) {
      $impuesto = para_resivir_paypal($data["servicios_total"]->total_pago) - $data["servicios_total"]->total_pago;
    }

    $data["impuesto"] = $impuesto;

    $this->db->insert("historico_facturas", ["numero_factura" => null]);

    $id_historico = $this->db->insert_id();

    $numero_factura = $id_historico + 10000;

    $data["factura"]->numero_factura = $numero_factura;

    $_SESSION["factura_data"] = $data;

    redirect("admin_facturas/mostrar_pdf");
  }

  public function mostrar_pdf()
  {
    $data = $_SESSION["factura_data"];

    $relleno_tablas = 11 - count($data["servicios"]); 

    for ($i=0; $i < $relleno_tablas; $i++) { 
      array_push($data["servicios"], null);
    }
    
    // var_dump($data["servicios"]);die();
    $this->create_pdf($data);
  }

  public function vista_actualizar($id_factura = null)
  {
   
    $fact_exist = $this->db->get_where($this->tabla_principal, ["id" => $id_factura])->num_rows();


    if (!$id_factura or is_nan($id_factura) or $fact_exist == 0) {
      show_404();
      return false;
    }

    $data["factura"] = $this->factura_model->get_all($id_factura)[0];

    $data["servicios"] = $this->factura_model->servicios_factura($id_factura);

    // var_dump(count($data["servicios"]));die();
    
    $id_categorias = [];

    foreach ($data["servicios"] as $servicio) {
      array_push($id_categorias, $servicio->categoria_id);
    }

    $data["id_categorias"] = $id_categorias;

    $data["servicios_total"] = $this->factura_model->total_servicios_factura($id_factura);
    // var_dump($data["servicios_total"]);die();

    $carteras = $this->cartera_model->get_all();
    $data["carteras"] = $carteras;

    $informacion_interna = $this->db->get("informacion_interna")->row();
    $data["informacion_interna"] = $informacion_interna;


    $categorias = $this->categoria_model->get_all();
    $data["categorias"] = $categorias;

		$servicios_nuevo = $this->db->select(["id", "nombre", "precio_total"])->get("servicios")->result();
		$data["servicios_nuevo"] = $servicios_nuevo;

    $clientes = $this->db->get("clientes")->result();
    $data["clientes"] = $clientes;

    $data["titulo"] = "Actualizar Plantilla";

    $view["body"] = $this->load->view("admin/facturas/fac_crear", $data, true);
    $view["scripts"] =  archivos_js([
      base_url() . "assets/plugins/summernote/summernote-bs4.min.js",
      base_url() . "assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js",
      base_url("assets/js/admin/facturas/fac_functions.js"),
      base_url("assets/js/admin/facturas/fac_crear.js"),
      base_url("assets/js/admin/facturas/fac_categoria.js"),
      // base_url("assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"),
    ]);
    $this->parser->parse("admin/template/body", $view);
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
      ],
      [
        "field" =>  "email",
        "label" => "email",
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
      redirect("admin_facturas");
      return false;
    }


    $response_factura_exist = $this->db->get_where(
      $this->tabla_principal,
      [
        "id" => set_value("id_cartera_input")
      ]
    )->row();

    $date = new DateTime();
    $data_update["nombre"] = set_value("nombre");
    $data_update["email"] = set_value("email");
    $data_update["updated_at"] = date_format($date, "Y-m-d H:i:s");



    if (!$response_factura_exist) {
      message(
        "La cartera ´{$data_update["nombre"]}' no esta registrado",
        "error",
        "danger",
      );

      redirect("admin_facturas");
      return false;
    }


    foreach ($data_update as $key => $data_upd) {
      $this->db->set($key, $data_upd);
    }

    $this->db->where("id", $response_factura_exist->id);
    $response = $this->db->update($this->tabla_principal);

    if (!$response) {
      message(
        "Ha ocurrido un ERROR, intentalo de nuevo.",
        "error",
        "danger",
      );

      redirect("admin_facturas");
      return false;
    }

    message(
      "Se Ha actualizado la cartera '{$data_update["nombre"]}' correctamente.",
      "success",
      "success",
    );

    redirect("admin_facturas");
    return false;
  }

  public function get_cartera()
  {
    $id_cartera = $this->input->post("id_cartera");

    $cartera = $this->db->get_where($this->tabla_principal, ["id" => $id_cartera])->row();

    echo json_encode($cartera);
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
      redirect("admin_facturas");
      return false;
    }

    $factura_exist = $this->db->get_where($this->tabla_principal, ["id" => $id])->row();

    if (!$factura_exist) {
      message(
        "El elemento que se quiere eliminar no existe.",
        "error",
        "danger",
      );
      redirect("admin_facturas");
      return false;
    }

    $eliminar = $this->db->delete($this->tabla_principal, ["id" => $id]);
    $servicios = $this->db->delete("precio_servicios", ["factura_id" => $id]);

    if (!$eliminar or !$servicios) {
      message(
        "Ha ocurrido un error.",
        "error",
        "danger",
      );
      redirect("admin_facturas");
      return false;
    }
    // unlink($factura_exist->foto);
    message(
      "La factura se ha eliminado correctamente.",
      "success",
      "success",
    );
    redirect("admin_facturas");
    return false;
  }

  private function create_pdf($data = [])
  {

    $dompdf = new Dompdf();

    $html = $this->load->view("admin/facturas/pdf/fac_pdf", $data, true);
    $opt = $dompdf->getOptions();
    $opt->set(["isRemoteEnabled" => true]);
    $dompdf->setOptions($opt);

    $dompdf->loadHtml($html);
    $dompdf->setPaper("letter");
    $dompdf->render();


    $dompdf->stream("FAC{$data["factura"]->numero_factura}.pdf", ["Attachment" => false]);
  }
}
