<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['iniciar_sesion']["post"] = 'auth/loggin';

// usuarios
$route['admin/usuarios/crear']["post"] = 'admin_usuarios/crear';
$route['admin/usuarios/actualizar']["post"] = 'admin_usuarios/actualizar';
$route['admin/usuarios/eliminar']["post"] = 'admin_usuarios/eliminar';
$route['admin/usuarios/activar']["post"] = 'admin_usuarios/actualizar_activacion';
$route['admin/usuarios/actualizar_group']["post"] = 'admin_usuarios/actualizar_group';
$route['admin/usuario/get_usuario']["post"] = 'admin_usuarios/get_usuario';

// clientes
$route['admin/clientes/crear']["post"] = 'admin_clientes/crear';
$route['admin/clientes/get_cliente']["post"] = 'admin_clientes/get_cliente';
$route['admin/clientes/actualizar']["post"] = 'admin_clientes/actualizar';
$route['admin/clientes/eliminar']["post"] = 'admin_clientes/eliminar';

// empleados
$route['admin/empleados/crear']["post"] = 'admin_empleados/crear';
$route['admin/empleados/get_empleado']["post"] = 'admin_empleados/get_empleado';
$route['admin/empleados/actualizar']["post"] = 'admin_empleados/actualizar';
$route['admin/empleados/eliminar']["post"] = 'admin_empleados/eliminar';

// servicios
$route['admin/servicios/crear']["post"] = 'admin_servicios/crear';
$route['admin/servicios/get_servicio']["post"] = 'admin_servicios/get_servicio';
$route['admin/servicios/actualizar']["post"] = 'admin_servicios/actualizar';
$route['admin/servicios/eliminar']["post"] = 'admin_servicios/eliminar';

// carteras
$route['admin/carteras/crear']["post"] = 'admin_carteras/crear';
$route['admin/carteras/get_cartera']["post"] = 'admin_carteras/get_cartera';
$route['admin/carteras/actualizar']["post"] = 'admin_carteras/actualizar';
$route['admin/carteras/eliminar']["post"] = 'admin_carteras/eliminar';

// categorias
$route['admin/categorias/crear']["post"] = 'admin_categorias/crear';
$route['admin/categorias/get_categoria']["post"] = 'admin_categorias/get_categoria';
$route['admin/categorias/actualizar']["post"] = 'admin_categorias/actualizar';
$route['admin/categorias/eliminar']["post"] = 'admin_categorias/eliminar';

// emails contacto
$route['admin/emails_contacto/crear']["post"] = 'admin_emails_contacto/crear';
$route['admin/emails_contacto/actualizar']["post"] = 'admin_emails_contacto/actualizar';
$route['admin/emails_contacto/get_email']["post"] = 'admin_emails_contacto/get_email';
$route['admin/emails_contacto/eliminar']["post"] = 'admin_emails_contacto/eliminar';
$route['admin/emails_contacto/ajax_emails']["get"] = 'admin_emails_contacto/ajax_emails';

// informacion interna
$route['admin/informacion_interna/crear']["post"] = 'admin_info_interna/crear';
$route['admin/informacion_interna/actualizar']["post"] = 'admin_info_interna/actualizar';
$route['admin/informacion_interna/eliminar']["post"] = 'admin_info_interna/eliminar';

// facturas
$route['admin/facturas/crear']["post"] = 'admin_facturas/crear';
$route['admin/facturas/actualizar']["post"] = 'admin_facturas/actualizar';
$route['admin/facturas/eliminar']["post"] = 'admin_facturas/eliminar';

// cliente arabe
$route['admin/cliente_arabe/crear_configuracion']["post"] = 'Admin_cliente_arabe/crear_configuracion';

$route['default_controller'] = 'admin_dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
