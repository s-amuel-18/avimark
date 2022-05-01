<?php 
function message($message, $type, $color, $sesion = true) {
  $message = [
    "type" => $type,
    "message" => $message,
    "color" => $color
  ];

  if( $sesion ) {
    $_SESSION["message"] = $message;
  } 
  
  return $message;
}

function dd($data)
{
	echo json_encode($data);die();
}
