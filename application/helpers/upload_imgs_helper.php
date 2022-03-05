<?php 

function subir_img_cuadrada($nombre_campo, $ruta_foto) {
  $ruta_img = "";
  // var_dump($ruta_foto);die();
  if (isset($_FILES[$nombre_campo])) {
    $file = $_FILES[$nombre_campo];

    if (!empty($file["tmp_name"])) {

      // la funcion list se usa para extraer indices de un array como una variable.
      list($ancho, $alto) = getimagesize($file["tmp_name"]);

      $nuevo_ancho = 500;
      $nuevo_alto = 500;
      
      $directorio = $ruta_foto;
      if( !is_dir($directorio)) {
        /* esta funcion mkdir se usar para la creacion de carpetas */
        mkdir($directorio, 0755 /* este numero se coloca para dar permisos a la carpeta de lectura escritura, eliminacion, etc.. */);
        
      }
      

      $tipo_img = $_FILES[$nombre_campo]["type"];

      if( $tipo_img == "image/jpeg"  ) {
        $nombre_archivo = "foto-perfil-".uniqid().".jpeg";
        $ruta = $directorio . "/" . $nombre_archivo;
        $ruta_img = $nombre_archivo;
        // funcion que nos genera el origen de la imagen AUN NO LA ENTIENDO
        $origen = imagecreatefromjpeg($file["tmp_name"]); 

        // funcion que nos permite recortar la imagen conservando el color.
        $destino = imagecreatetruecolor($nuevo_ancho,$nuevo_alto); 

        imagecopyresized(
          $destino, /* img de destino */
          $origen, /* ruta del origen de la img */
          0, /* corte al nivel del eje X INICIO */
          0, /* corte al nivel del eje Y INICIO */
          0, /* corte al nivel del eje X INICIO */
          0, /* corte al nivel del eje  INICIO */
          $nuevo_ancho, /* Ancho de la nueva imagen*/
          $nuevo_alto, /* alto de la nueva imagen*/
          $ancho, /* ancho de la foto de origen*/
          $alto, /* alto de la foto de origen*/
        );
          imagejpeg($destino, $ruta);

      }

      if( $tipo_img == "image/png"  ) {
        $nombre_archivo = "foto-perfil-".uniqid().".png";
        $ruta = $directorio . "/" . $nombre_archivo;
        $ruta_img = $nombre_archivo;
        // funcion que nos genera el origen de la imagen AUN NO LA ENTIENDO
        $origen = imagecreatefrompng($file["tmp_name"]); 

        // funcion que nos permite recortar la imagen conservando el color.
        $destino = imagecreatetruecolor($nuevo_ancho,$nuevo_alto); 

        imagecopyresized(
          $destino, /* img de destino */
          $origen, /* ruta del origen de la img */
          0, /* corte al nivel del eje X INICIO */
          0, /* corte al nivel del eje Y INICIO */
          0, /* corte al nivel del eje X INICIO */
          0, /* corte al nivel del eje  INICIO */
          $nuevo_ancho, /* Ancho de la nueva imagen*/
          $nuevo_alto, /* alto de la nueva imagen*/
          $ancho, /* ancho de la foto de origen*/
          $alto, /* alto de la foto de origen*/
        );
          imagepng($destino, $ruta);

      }
    }
  }

  return $ruta_img;
}