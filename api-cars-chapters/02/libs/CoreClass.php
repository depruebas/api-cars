<?php

class CoreClass
{

  function __construct()
  {
  }

  public function Init( $data_input, $data_server)
  {

    # Si no nos envian información y salimos con mensaje de error
    if ( trim( $data_input) == "")
    {
      echo ("Error: no hay datos para procesar");
      die;
    }

    # Si el json no tiene el formato correcto devolvemos un error
    if ( !json_decode( $data_input))
    {
      echo ("Error: el JSON no tiene el formato correcto");
      die;
    }

     # Si todo esta validado seguimos con el proceso  y pasamos el json a un array php
    $data = json_decode( $data_input, true);


    $_config = ConfigClass::get("database.cars");
    PDOClass2::Connection( $_config);


    $_login = new LoginClass();
    # Verificamos que el api user y el pass user son correctos y tienen permisos para utilizar
    # esta API
    $login_api = $_login->api_login( $data);


    if ( !$login_api)
    {
      # Si la llamada a comprobar los datos de la API devuelve falso
      echo "La api no tiene permisos";
      die;
    }


    # Verificamos que el user y pass son correctos para el acceso de la api
    $login_user = $_login->user_login( $data);


    # Si el login es correcto vemos que nos pide la llamada de la API
    if ( $login_user)
    {

      $_class = ucwords( trim( $data['DATA']['class'] . "Class"));
      $_action = $data['DATA']['method'];

      # Cargamos la clase (fichero) que vamos a utilizar dinamicamente
      $class_include = dirname( dirname(__FILE__))."/Modules/".$_class.".php";

      if ( file_exists( $class_include))
      {
          require $class_include;

          $action = new $_class();
          $return = $action->{$_action} ( $data);

          echo $return;
      }
      else
      {
        echo ( "Clase '" . $class_include . " no existe");
        die;
      }

    }
    else
    {
      echo "Error en el login";
      die;
    }

    PDOClass2::Close();

  }

}