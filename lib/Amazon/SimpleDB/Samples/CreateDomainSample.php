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
 * Create Domain  Sample
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
 * sample for Create Domain Action
 ***********************************************************************/
 require_once ('Amazon/SimpleDB/Model/CreateDomain.php'); 
 // @TODO: set action. Action can be passed as Amazon_SimpleDB_Model_CreateDomain 
 // object or array of parameters
 // invokeCreateDomain($service, $action);

                        
    /**
     * Create Domain Action Sample
     * The CreateDomain operation creates a new domain. The domain name must be unique
     * among the domains associated with the Access Key ID provided in the request. The CreateDomain
     * operation may take 10 or more seconds to complete.
     *   
     * @param Amazon_SimpleDB_Interface $service instance of Amazon_SimpleDB_Interface
     * @param mixed $action Amazon_SimpleDB_Model_CreateDomain or array of parameters
     */
  function invokeCreateDomain(Amazon_SimpleDB_Interface $service, $action) 
  {
      try {
            
              $response = $service->createDomain($action);

              
                echo ("Service Response\n");
                echo ("=============================================================================\n");

                echo("        CreateDomainResponse\n");
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
                            