<?php
class sfAmazonSimpleDBException extends sfException
{

  protected $awsDBException;
  
  public function __construct($message = null, $code = 0, $awsDBException = null)
  {
    $this->setName('sfAmazonSimpleDBException');
    $this->setAwsDBException($awsDBException);
    parent::__construct($message, $code);
  }
  
  public function getAwsDBException()
  {
    return $this->awsException;
  }
  
  public function setAwsDBException($e)
  {
    $this->awsException = $e;
  }
  
  public function getDetails()
  {
    $ex = $this->getAwsDBException();
    if ($ex && $ex instanceof Amazon_SimpleDB_Exception)
    {
      $output  = "Caught Exception: " . $ex->getMessage() . "\n";
      $output .= "Response Status Code: " . $ex->getStatusCode() . "\n";
      $output .= "Error Code: " . $ex->getErrorCode() . "\n";
      $output .= "Error Type: " . $ex->getErrorType() . "\n";
      $output .= "Box Usage: " . $ex->getBoxUsage() . "\n";
      $output .= "Request ID: " . $ex->getRequestId() . "\n";
      $output .= "XML: " . $ex->getXML() . "\n";
      return $output;
    }
  }
  
}
