<?php 


class CustomErrorLog
{

  protected $data = null;
	protected $pathLogs = null;

  function __construct()
  {

    $this->pathLogs = ConfigClass::get("config.ruta_logs")['error_log']; 

    set_error_handler( array( &$this, 'customError'), E_ALL | E_STRICT);
    register_shutdown_function( array( &$this, 'CatchFatalError'));

  }

  public function set_data( $input_data)
  {
    $this->data = $input_data;
  }

  private function FriendlyErrorType($type)
  {
    switch($type)
    {
      case E_ERROR: //code error 1
          return 'E_ERROR';
      case E_WARNING: // code error 2 
          return 'E_WARNING';
      case E_PARSE: // code error 4
          return 'E_PARSE';
      case E_NOTICE: // code error 8 
          return 'E_NOTICE';
      case E_CORE_ERROR: // code error 16 
          return 'E_CORE_ERROR';
      case E_CORE_WARNING: // code error 32
          return 'E_CORE_WARNING';
      case E_CORE_ERROR: // code error 64
          return 'E_COMPILE_ERROR';
      case E_CORE_WARNING: // code error 128
          return 'E_COMPILE_WARNING';
      case E_USER_ERROR: // code error 256
          return 'E_USER_ERROR';
      case E_USER_WARNING: // code error 512
          return 'E_USER_WARNING';
      case E_USER_NOTICE: // code error 1024
          return 'E_USER_NOTICE';
      case E_STRICT: // code error 2048
          return 'E_STRICT';
      case E_RECOVERABLE_ERROR: // code error 4096
          return 'E_RECOVERABLE_ERROR';
      case E_DEPRECATED: // code error 8192
          return 'E_DEPRECATED';
      case E_USER_DEPRECATED: // code error 16384
          return 'E_USER_DEPRECATED';
    }
    return "";
  } 

  public function customError($errno, $errstr, $errfile, $errline)
  {

    $error = error_get_last();
    $debug = debug_backtrace();

    $txterror = "[" . date('Y-m-d H:i:s') . "] - " . $errno ." -  ".$errstr." - ".$errfile." - Linea: ".$errline."\n";

    error_log( $txterror, 3, $this->pathLogs."error.log");

    if ( isset( $debug[2]))
    {
      if ( isset( $debug[2]['file']))
      {
        $referer = "referer: ".$debug[2]['file']." - Linea: ".$debug[2]['line']."\n";
        error_log( $referer, 3, $this->pathLogs."error.log");
      }
    }

    # I Add the JSON that caused this error
    error_log( $this->data . "\n", 3, $this->pathLogs."error.log");
  }

  public function CatchFatalError() 
  {

    $error = error_get_last();

    if ( !empty($error))
    {
      $error['typeMs'] = $this->FriendlyErrorType( $error['type']);

      $txt = "[".date('Y-m-d H:i:s')."] ".$error['type']." - ".$error['typeMs']." - ".$error['message']." - ".$error['file']." - Linea: ".$error['line']."\n";

      error_log( $txt, 3, $this->pathLogs."error.log");
      # I Add the JSON that caused this error
      error_log( $this->data . "\n", 3, $this->pathLogs."error.log");
    }

  }
	
}

//$e = new CustomErrorLog();