<?php

/*
**
**
  Connection class to bbdd with PDO drivers.
  Driver List: https://www.php.net/manual/es/pdo.drivers.php

  The way to use it in a PHP program is to add the PDOClass.php file to the beginning of the file and call the methods directly. As it is a static class it is not necessary to declare the variables a direct call can be made.

  Example:

  # Array de configuración
  $config = array(
    'dsn' => 'mysql:host=localhost;dbname=sakila;charset=utf8',
    'username' => 'devuser',
    'password' => 'mysql',
  );

  # To make the connection to the bbdd
  $connection = PDOClass::Connection ( $config);

  # Prepare the parameters for a SELECT statement
  # We have to send in the connection array the values for query and parameters

  PDOClass2::Connection( $config);


  $data['query'] = "Select staff_id, first_name, last_name, email, username,
                      password From staff where staff_id = ?";
  $data['params'] = array( '11');

  # Execute the query and return results in rows variable
  $rows = PDOClass::ExecuteQuery( $data);

  # Delete connection
  PDOClass2::Close();


  The results are expressed in an array.
  $rows will have the following outputs:

  (
    [success] => 1
    [data] => Array
      (
        [0] => Array
          (
            [staff_id] => 11
            [first_name] => Juan
            [last_name] => Sin Miedo33
            [email] =>
            [username] => juan
            [password] =>
          )

      )

    [count] => 1
  )

  A array with three positions:
  - success:  true (if OK) or false (if error)
  - data: a array with the query results
  - count: it's the number total of records of the query

**
**
*/

class PDOClass2
{

  protected static $conn = null;
  protected static $pathLogs = null;

  function __construct() {

    $pathLogs = dirname( dirname( __FILE__)) . '/logs/';

  }

  public static function Connection( $config = array())
  {

    if ( empty( $config))
    {
      error_log( date("Y-m-d H:i:s") . " - Config file empty \n", 3, static::$pathLogs."db_error.log");
      $return = array(
        'success' => false,
        'data' => 'Config file empty',
      );
      return ( array( 'success' => false, 'data' => $return));
    }

    try
    {
      self::$conn = new PDO( $config['dsn'], $config['username'], $config['password']);
      self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      return ( array( 'success' => true, 'data' => self::$conn));

    }
    catch (PDOException $e)
    {

      $_error = print_r( $e->getTrace(), true) . "\n" . $e->getMessage();

      error_log( date("Y-m-d H:i:s") . " - " . $_error . "\n", 3, static::$pathLogs."db_error.log");
      $return = array(
        'success' => false,
        'data' => $_error,
      );
      return ( array( 'success' => false, 'data' => $return));
    }

  }

  public static function Close()
  {

    self::$conn = null;

  }

  public static function ExecuteQuery( $params = array())
  {

   try
    {
      $stmt = self::$conn->prepare( $params['query']);
      $stmt->execute( $params['params'] );
      $data = $stmt->fetchAll( PDO::FETCH_ASSOC);
      $count = $stmt->rowCount();
      $stmt->closeCursor();

      $return = array( 'success' => true, 'data' => $data, 'count' => $count);
    }
    catch (PDOException $e)
    {
      $_error = print_r( $e->getTrace(), true) . "\n" . $e->getMessage();

      error_log( date("Y-m-d H:i:s") . " - " . $_error . "\n", 3, static::$pathLogs."db_error.log");
      $return = array(
        'success' => false,
        'data' => $_error,
      );
    }

    unset ( $stmt);

    return ( $return);
  }

  public static function Execute( $params = array())
  {

    try
    {
      $stmt = self::$conn->prepare( $params['query']);
      $stmt->execute( $params['params'] );
      $count = $stmt->rowCount();

      $return = array( 'success' => true, 'count' => $count);
    }
    catch (PDOException $e)
    {
      $_error = print_r( $e->getTrace(), true) . "\n" . $e->getMessage();

      error_log( date("Y-m-d H:i:s") . " - " . $_error . "\n", 3, static::$pathLogs."db_error.log");
      $return = array(
        'success' => false,
        'data' => $_error,
      );
    }

    unset ( $stmt);

    return ( $return);

  }

  public static function Insert( $params = array())
  {

    if ( empty( self::$conn))
    {
      $config_db = ConfigClass::get("database.twitter");
      self::Connection( $config_db);
    }

    $data = array();
    $fields = $fields_values = $a_values = "";

    foreach ( $params['fields'] as $key => $value)
    {
      $fields .= $key . ",";
      $fields_values .= " ?,";
      $a_values .= $value . ".:.";
    }

    $fields  = substr( $fields, 0, strlen( $fields) - 1);
    $fields_values  = substr( $fields_values, 0, strlen( $fields_values) - 1);
    $a_values  = substr( $a_values, 0, strlen( $a_values) - 3);


    try
    {

      $sql = "insert into " . $params['table'] . "( {$fields} ) values( ".$fields_values." )";

      $stmt = self::$conn->prepare( $sql);
      $r = $stmt->execute( explode( ".:.", $a_values));
      $count = $stmt->rowCount();
      $id = self::$conn->lastInsertId();

      $return = array( 'success' => true, 'data' => $data, 'last_id' =>  $id, 'count' => $count);

    }
    catch (PDOException $e)
    {

      $_error = print_r( $e->getTrace(), true) . "\n" . $e->getMessage();

      error_log( date("Y-m-d H:i:s") . " - " . $_error . "\n", 3, static::$pathLogs."db_error.log");
      $return = array(
        'success' => false,
        'data' => $_error,
      );

    }

    unset( $stmt);

    return ( $return );

  }


}