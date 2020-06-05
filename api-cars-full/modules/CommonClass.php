<?php

#
# clase comun al resto de clases de la aplicación
# metodos comunes que se tengan que utilizar en todas o algunas de las clase
# lo podemos poner aqui para no tener que repetir codigo
#

class CommonClass
{

  # Metodo comun para verificar si la API tiene parametros
  # para un método especifico
	public function CheckParams( $data)
  {

  	if ( empty( $data))
  	{
  		return ( array( 'status' => false));
  	}
  	else
  	{
  		return ( array( 'status' => true));
  	}

  }

}