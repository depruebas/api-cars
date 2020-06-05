<?php

  return array(

    # ruta de logs  de la aplicacion
    'ruta_logs' => array(
      'general' =>   dirname( dirname(__FILE__)) . '/logs/',
      'error_log' =>  dirname( dirname(__FILE__)). '/logs/',
    ),

    # 0 - no depuración
    # 1 - depuración
    'debug' => 1,

    # development or production
    'environment' => 'development',

    # API configuración
    'app_version' => '1.0',
    'app_enabled' => 1,
    'app_salt' => 'WQ5+VEy&*m&6qw12Ra!',

  );