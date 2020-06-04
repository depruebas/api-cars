<?php

class LoginClass
{

  function __construct()
  {
  }


  public function api_login( $data)
  {

    # Validamos los datos de user y pass de la API con la tabla auth_sockets
    $params['query'] = "SELECT id, token
                      from auth_env where api_user = ? And api_pass = ? And enabled = 1 And api_name = ?";
    $params['params'] = array( $data['username'], $data['password'], $data['api']);

    $rows = PDOClass2::ExecuteQuery( $params);

    if ( empty( $rows['data']))
    {

      return (false);

    }

    return ( true);

  }


  # Aqui podemos poner otras validaciones que necesite nuestra API

}