<?php

	# Iniciamos el timer para ver el tiempo que tarda la api en procesar una peticíon
  $start_time = microtime(true);


  # Guardamos la fecha con la que se inicia la API en cada petición, despues la utilizaremos en los
  # logs para saber cuando fue la petición
  global $init_time;
  $init_time = date( "Y-m-d H:i:s");


  # Incluimos los headers para que
  # el content-type y el cache ( no queremos que se cacheen los resultados )
  header('Content-Type: text/html; charset=utf-8');
  header('Cache-Control: no-cache');
  header('Cache-Control: no-store');
  header('Pragma: no-cache');


  # Añadimos las librerias .php que vamos a necesitar en la API
  require_once dirname( dirname(__FILE__))."/libs/ConfigClass.php";
  require_once dirname( dirname(__FILE__))."/libs/Utils.php";
  require_once dirname( dirname(__FILE__))."/libs/CustomErrorLog.php";
  require_once dirname( dirname(__FILE__))."/libs/PDOClass2.php";


  # Inicializamos CustomErrorLog, para procesar automaticamente los errores
  $e = new CustomErrorLog();


  # Defimos las costantes del programa
  define( 'DEBUG', ConfigClass::get("config.debug"));
  define( 'ENVIRONMENT', ConfigClass::get("config.environment"));
  define( "EOF", "\n");


  # Guardamos en un array de entrada los datos generales de la llamada:
  #   el metodo de llamada POST, GET, PUT ... etc ...
  #   la url que la llama
  #   la IP que la llama
  $_data_server = array(
    'method' => $_SERVER['REQUEST_METHOD'],
    'uri' => explode( "/", $_SERVER['REQUEST_URI']),
    'remote_ip' => $_SERVER['REMOTE_ADDR'],
  );

  # Punto de entrada de la API donde se reciben los datos del POST
  $_data_input = file_get_contents( 'php://input');

  # Guardamos los datos tal como vienen en una variable en la clase de errores por si se
  # produce un error saber que datos de entrada lo ha provcado
  $e->set_data( $_data_input);


  /*$_core = new CoreClass();
  $_core->Init ( $_data_input, $_data_server);*/


  # Si tenemos la depuración activada se registra el tiempo que tarda en procesar las peticiones
  if ( DEBUG)
  {
    $time = microtime(true) - $start_time;

    if ( $time > 1)
    {
      # formatPeriod es una función que esta en el fichero Utils.php
      $time = formatPeriod( $time);
    }

    echo EOF.( $time ) . EOF;
  }
