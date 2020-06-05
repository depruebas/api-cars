<?php

class BrandsClass extends CommonClass
{

	public function list_all( $data)
  {

  	$params['query'] = "SELECT * FROM `cars_brand`";
    $params['params'] = array();

    $rows = PDOClass2::ExecuteQuery( $params);

    return ( MessagesClass::Response( array(
	      'success' => true,
	      'type' => 'RESULTS',
	      'code' => RandomString(),
	      'data' => $rows,
	    )
    ));

  }

  public function list_one( $data)
  {

  	if ( $this->CheckParams( $data['DATA'])['status'])
  	{

  		$params['query'] = "SELECT * FROM `cars_brand` Where country = ?";
	    $params['params'] = array( $data['DATA']['country']);

	    $rows = PDOClass2::ExecuteQuery( $params);

	    return ( MessagesClass::Response( array(
		      'success' => true,
		      'type' => 'RESULTS',
		      'code' => RandomString(),
		      'data' => $rows,
		    )
	    ));

  	}
  	else
  	{

  		return ( MessagesClass::Response( array(
          'success' => false,
          'type' => 'ERROR',
          'code' => RandomString(),
          'message' => ConfigClass::get("messages.GEN00003"),
        )
      ));

  	}

  }


}