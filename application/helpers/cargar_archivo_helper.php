<?php 

function archivos_js($arr) {
  if( !is_array($arr) AND !is_string($arr) ) {
    die("Los datos ingresados no son Validos");
  }
  
  if( is_string($arr) ) {
    return "<script src='{$arr}'></script>";
  }
  
  $str = "";
  foreach ($arr as $el) {
    $str .=  "<script src='{$el}'></script>";
  }

  return $str; 
}