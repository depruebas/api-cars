<?php

  define ( "EOF", "\n");

  # Punto de entrada de la API
  # Recibimos los datos del POST
  $_data_input = file_get_contents( 'php://input');


  # Mostramos por pantalla lo recibido a la url
  echo EOF."Respuesta JSON".EOF;
  print_r( $_data_input);
  echo EOF;

