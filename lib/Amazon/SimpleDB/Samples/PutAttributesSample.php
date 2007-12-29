<?php
/** 
 *  PHP Version 5
 *
 *  @category    Amazon
 *  @package     Amazon_SimpleDB
 *  @copyright   Copyright 2007 Amazon Technologies, Inc.
 *  @link        http://aws.amazon.com
 *  @license     http://aws.amazon.com/apache2.0  Apache License, Version 2.0
 *  @version     2007-11-07
 */
/******************************************************************************* 
 *    __  _    _  ___ 
 *   (  )( \/\/ )/ __)
 *   /__\ \    / \__ \
 *  (_)(_) \/\/  (___/
 * 
 *  Amazon Simple DB PHP5 Library
 *  Generated: Thu Dec 27 02:50:26 PST 2007
 * 
 */

/**
 * Put Attributes  Sample
 */

set_include_path(get_include_path() . PATH_SEPARATOR . '../../../.');  


/************************************************************************
 * Access Key ID and Secret Acess Key ID, obtained from:
 * http://aws.amazon.com
 ***********************************************************************/
 $AWS_ACCESS_KEY_ID        = '<Your Access Key ID>';
 $AWS_SECRET_ACCESS_KEY    = '<Your Secret Access Key>';

/************************************************************************
 * Instantiate an Implementation of Simple DB 
 ***********************************************************************/
 require_once ('Amazon/SimpleDB/Client.php'); 
 $service = new Amazon_SimpleDB_Client($AWS_ACCESS_KEY_ID, $AWS_SECRET_ACCESS_KEY);
 
/************************************************************************
 * Uncomment to try out Mock Service that simulates Amazon_SimpleDB
 * responses without calling Amazon_SimpleDB service.
 *
 * Responses are loaded from local XML files. You can tweak XML files to
 * experiment with various outputs during development
 *
 * XML files available under Amazon/SimpleDB/Mock tree
 *
 ***********************************************************************/
 // require_once ('Amazon/SimpleDB/Mock.php'); 
 // $service = new Amazon_SimpleDB_Mock();

/************************************************************************
 * Setup action parameters and uncomment invoke to try out 
 * sample for Put Attributes Action
 ***********************************************************************/
 require_once ('Amazon/SimpleDB/Model/PutAttributes.php'); 
 // @TODO: set action. Action can be passed as Amazon_SimpleDB_Model_PutAttributes 
 // object or array of parameters
 // invokePutAttributes($service, $action);

                                    
    /**
     * Put Attributes Action Sample
     * The PutAttributes operation creates or replaces attributes within an item. You specify new attributes
     * using a combination of the Attribute.X.Name and Attribute.X.Value parameters. You specify
     * the first attribute by the parameters Attribute.0.Name and Attribute.0.Value, the second
     * attribute by the parameters Attribute.1.Name and Attribute.1.Value, and so on.
     * 
     * Attributes are uniquely identified within an item by their name/value combination. For example, a single
     * item can have the attributes { "first_name", "first_value" } and { "first_name",
     * second_value" }. However, it cannot have two attribute instances where both the Attribute.X.Name and
     * Attribute.X.Value are the same.
     * Optionally, the requestor can supply the Replace parameter for each individual value. Setting this value
     * to true will cause the new attribute value to replace the existing attribute value(s). For example, if an
     * item has the attributes { 'a', '1' }, { 'b', '2'} and { 'b', '3' } and the requestor does a
     * PutAttributes of { 'b', '4' } with the Replace parameter set to true, the final attributes of the
     * item will be { 'a', '1' } and { 'b', '4' }, replacing the previous values of the 'b' attribute
     * with the new value.
     *   
     * @param Amazon_SimpleDB_Interface $service instance of Amazon_SimpleDB_Interface
     * @param mixed $action Amazon_SimpleDB_Model_PutAttributes or array of parameters
     */
  function invokePutAttributes(Amazon_SimpleDB_Interface $service, $action) 
  {
      try {
            
              $response = $service->putAttributes($action);

              
                echo ("Service Response\n");
                echo ("=============================================================================\n");

                echo("        PutAttributesResponse\n");
                if ($response->isSetResponseMetadata()) { 
                    echo("            ResponseMetadata\n");
                    $responseMetadata = $response->getResponseMetadata();
                    if ($responseMetadata->isSetRequestId()) 
                    {
                        echo("                RequestId\n");
                        echo("                    " . $responseMetadata->getRequestId() . "\n");
                    }
                    if ($responseMetadata->isSetBoxUsage()) 
                    {
                        echo("                BoxUsage\n");
                        echo("                    " . $responseMetadata->getBoxUsage() . "\n");
                    }
                } 

           
     } catch (Amazon_SimpleDB_Exception $ex) {
            
         echo("Caught Exception: " . $ex->getMessage() . "\n");
         echo("Response Status Code: " . $ex->getStatusCode() . "\n");
         echo("Error Code: " . $ex->getErrorCode() . "\n");
         echo("Error Type: " . $ex->getErrorType() . "\n");
         echo("Box Usage: " . $ex->getBoxUsage() . "\n");
         echo("Request ID: " . $ex->getRequestId() . "\n");
         echo("XML: " . $ex->getXML() . "\n");
     }
 }
                