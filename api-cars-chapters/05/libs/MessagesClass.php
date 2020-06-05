<?php

class MessagesClass
{

  # Metodo para grabar logs en disco
	public static function WrieLog( $data)
  {

    # Obtenemos la ruta de los logs del fichero de configuración
    $file = ConfigClass::get("config.ruta_logs")['general'] . "trace.log";

    # Obtenemos la fecha actual
    $date = date( "Y-m-d H:i:s");

    # Grabamos log a disco
  	error_log ( "[".$date."] ". $data['code'] . " - " . print_r( $data['message'], true). "\n", 3, $file);

  }

  public static function WriteBBDD( $data)
  {

    # Grabamos el log en la base de datos en la tabla logs
  	$params['query'] = "insert into logs( type, message, code) values( ?, ?, ?)";
    $params['params'] = array( $data['type'], $data['message'], $data['code']);

    PDOClass2::Execute( $params);

  }


  public static function Response( $data)
  {

    if ( $data['TYPE'] == 'ERROR')
    {

      # Graba log bbdd
      self::WriteBBDD( $data);

      # Graba log
      self::WrieLog( $data);

    }

  	# Devuelve datos a quien ha hecho la petición porque la salida siempre la hacemos
    # por la entrada, no paramos nunca el programa a menos que sea requerimiento
  	return ( json_encode( $data));

  }


 }