<?php

class CoreClass
{


  public function Init( $data_input)
  {

    # Si no nos envian información y salimos con mensaje de error
    if ( trim( $data_input) == "")
    {

      return ( MessagesClass::Response( array(
          'success' => false,
          'type' => 'ERROR',
          'code' => RandomString(),
          'message' => ConfigClass::get("messages.GEN00001"),
        )
      ));

    }

    # Si el json no tiene el formato correcto devolvemos un error
    if ( !json_decode( $data_input))
    {

      return ( MessagesClass::Response( array(
          'success' => false,
          'type' => 'ERROR',
          'code' => RandomString(),
          'message' => ConfigClass::get("messages.GEN00002"),
        )
      ));


    }

     # Si todo esta validado seguimos con el proceso  y pasamos el json a un array php
    $data = json_decode( $data_input, true);


    $_login = new LoginClass();
    # Verificamos que el api user y el pass user son correctos y tienen permisos para utilizar
    # esta API
    $login_api = $_login->api_login( $data['LOGIN']);


    if ( !$login_api)
    {
      # Si la llamada a comprobar los datos de la API devuelve falso

       return ( MessagesClass::Response( array(
          'success' => false,
          'type' => 'ERROR',
          'code' => RandomString(),
          'message' => ConfigClass::get("messages.AUTH0001"),
        )
      ));

    }


    $_class = ucwords( trim( $data['ACTIONS']['class'] . "Class"));
    $_method = $data['ACTIONS']['method'];

    # Cargamos la clase (fichero) que vamos a utilizar dinamicamente
    $class_include = dirname( dirname(__FILE__))."/modules/".$_class.".php";

    if ( file_exists( $class_include))
    {
        require $class_include;

        $action = new $_class();
        $return = $action->{$_method} ( $data);

        echo $return;

    }
    else
    {
      echo ( "\nClase '" . $class_include . " no existe\n");
      die;
    }


  }

}