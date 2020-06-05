<?php

class CarsClass extends CommonClass
{

	public function list_all( $data)
  {

  	$params['query'] = "SELECT * FROM `cars_models`";
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

  public function Add( $data)
  {

  	if ( $this->CheckParams( $data['DATA'])['status'])
  	{


  		$data['table'] = "cars_models";
			$data['fields'] = array (
			  'brand_id' => $data['DATA']['brand_id'],
			  'model_name' => $data['DATA']['model_name'],
			  'price' => $data['DATA']['price'],
			  'enabled' => $data['DATA']['enabled'],
			);

			# Call to Insert method
			$ret = PDOClass2::Insert( $data);


			return ( MessagesClass::Response( array(
		      'success' => true,
		      'type' => 'RESULTS',
		      'code' => RandomString(),
		      'data' => $ret,
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