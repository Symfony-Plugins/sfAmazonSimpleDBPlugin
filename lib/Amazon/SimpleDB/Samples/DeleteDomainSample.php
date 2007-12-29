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
 * Delete Domain  Sample
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
 * sample for Delete Domain Action
 ***********************************************************************/
 require_once ('Amazon/SimpleDB/Model/DeleteDomain.php'); 
 // @TODO: set action. Action can be passed as Amazon_SimpleDB_Model_DeleteDomain 
 // object or array of parameters
 // invokeDeleteDomain($service, $action);

                                
    /**
     * Delete Domain Action Sample
     * The DeleteDomain operation deletes a domain. Any items (and their attributes) in the domain
     * are deleted as well. The DeleteDomain operation may take 10 or more seconds to complete.
     *   
     * @param Amazon_SimpleDB_Interface $service instance of Amazon_SimpleDB_Interface
     * @param mixed $action Amazon_SimpleDB_Model_DeleteDomain or array of parameters
     */
  function invokeDeleteDomain(Amazon_SimpleDB_Interface $service, $action) 
  {
      try {
            
              $response = $service->deleteDomain($action);

              
                echo ("Service Response\n");
                echo ("=============================================================================\n");

                echo("        DeleteDomainResponse\n");
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
                    