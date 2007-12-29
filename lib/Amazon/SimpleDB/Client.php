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
 *  @see Amazon_SimpleDB_Interface
 */
require_once ('Amazon/SimpleDB/Interface.php'); 

/**
 * Amazon SimpleDB is a web service for running queries on structured
 * data in real time. This service works in close conjunction with Amazon
 * Simple Storage Service (Amazon S3) and Amazon Elastic Compute Cloud
 * (Amazon EC2), collectively providing the ability to store, process
 * and query data sets in the cloud. These services are designed to make
 * web-scale computing easier and more cost-effective for developers.
 * 
 * Traditionally, this type of functionality has been accomplished with
 * a clustered relational database that requires a sizable upfront
 * investment, brings more complexity than is typically needed, and often
 * requires a DBA to maintain and administer. In contrast, Amazon SimpleDB
 * is easy to use and provides the core functionality of a database -
 * real-time lookup and simple querying of structured data without the
 * operational complexity.  Amazon SimpleDB requires no schema, automatically
 * indexes your data and provides a simple API for storage and access.
 * This eliminates the administrative burden of data modeling, index
 * maintenance, and performance tuning. Developers gain access to this
 * functionality within Amazon's proven computing environment, are able
 * to scale instantly, and pay only for what they use.
 * 
 * Amazon_SimpleDB_Client is an implementation of Amazon_SimpleDB
 *
 */
class Amazon_SimpleDB_Client implements Amazon_SimpleDB_Interface
{

    const SERVICE_VERSION = '2007-11-07';

    /** @var string */
    private  $_awsAccessKeyId = null;
    
    /** @var string */
    private  $_awsSecretAccessKey = null;
    
    /** @var array */
    private  $_config = array ('ServiceURL' => 'http://sdb.amazonaws.com', 
                               'UserAgent' => 'Amazon SimpleDBPHP5 Library',
                               'SignatureVersion' => 1,
                               'ProxyHost' => null,
                               'ProxyPort' => -1,
                               'MaxErrorRetry' => 3       
                               );
   
    /**
     * Construct new Client
     * 
     * @param string $awsAccessKeyId AWS Access Key ID
     * @param string $awsSecretAccessKey AWS Secret Access Key
     * @param array $config configuration options. 
     * Valid configuration options are:
     * <ul>
     * <li>ServiceURL</li>
     * <li>UserAgent</li>
     * <li>SignatureVersion</li>
     * <li>TimesRetryOnError</li>
     * <li>ProxyHost</li>
     * <li>ProxyPort</li>
     * <li>MaxErrorRetry</li>
     * </ul>
     */
    public function __construct($awsAccessKeyId, $awsSecretAccessKey, $config = null)
    {
        iconv_set_encoding('output_encoding', 'UTF-8');
        iconv_set_encoding('input_encoding', 'UTF-8');
        iconv_set_encoding('internal_encoding', 'UTF-8');

        $this->_awsAccessKeyId = $awsAccessKeyId;
        $this->_awsSecretAccessKey = $awsSecretAccessKey;
        if (!is_null($config)) $this->_config = array_merge($this->_config, $config);
    }

    // Public API ------------------------------------------------------------//


            
    /**
     * Create Domain 
     * The CreateDomain operation creates a new domain. The domain name must be unique
     * among the domains associated with the Access Key ID provided in the request. The CreateDomain
     * operation may take 10 or more seconds to complete.
     *   
     * @see http://docs.amazonwebservices.com/SimpleDB/2007-11-07/DG/CreateDomain.html      
     * @param mixed $action array of parameters for Amazon_SimpleDB_Model_CreateDomain action or Amazon_SimpleDB_Model_CreateDomain object itself
     * @see Amazon_SimpleDB_Model_CreateDomain
     * @return Amazon_SimpleDB_Model_CreateDomainResponse Amazon_SimpleDB_Model_CreateDomainResponse
     *
     * @throws Amazon_SimpleDB_Exception
     */
    public function createDomain($action) 
    {
        if (!$action instanceof Amazon_SimpleDB_Model_CreateDomain) {
            require_once ('Amazon/SimpleDB/Model/CreateDomain.php');
            $action = new Amazon_SimpleDB_Model_CreateDomain($action);
        }
        require_once ('Amazon/SimpleDB/Model/CreateDomainResponse.php');
        return Amazon_SimpleDB_Model_CreateDomainResponse::fromXML($this->_invoke($action->toMap()));
    }


            
    /**
     * List Domains 
     * The ListDomains operaton lists all domains associated with the Access Key ID. It returns
     * domain names up to the limit set by MaxNumberOfDomains. A NextToken is returned if there are more
     * than MaxNumberOfDomains domains. Calling ListDomains successive times with the
     * NextToken returns up to MaxNumberOfDomains more domain names each time.
     *   
     * @see http://docs.amazonwebservices.com/SimpleDB/2007-11-07/DG/ListDomains.html      
     * @param mixed $action array of parameters for Amazon_SimpleDB_Model_ListDomains action or Amazon_SimpleDB_Model_ListDomains object itself
     * @see Amazon_SimpleDB_Model_ListDomains
     * @return Amazon_SimpleDB_Model_ListDomainsResponse Amazon_SimpleDB_Model_ListDomainsResponse
     *
     * @throws Amazon_SimpleDB_Exception
     */
    public function listDomains($action) 
    {
        if (!$action instanceof Amazon_SimpleDB_Model_ListDomains) {
            require_once ('Amazon/SimpleDB/Model/ListDomains.php');
            $action = new Amazon_SimpleDB_Model_ListDomains($action);
        }
        require_once ('Amazon/SimpleDB/Model/ListDomainsResponse.php');
        return Amazon_SimpleDB_Model_ListDomainsResponse::fromXML($this->_invoke($action->toMap()));
    }


            
    /**
     * Delete Domain 
     * The DeleteDomain operation deletes a domain. Any items (and their attributes) in the domain
     * are deleted as well. The DeleteDomain operation may take 10 or more seconds to complete.
     *   
     * @see http://docs.amazonwebservices.com/SimpleDB/2007-11-07/DG/DeleteDomain.html      
     * @param mixed $action array of parameters for Amazon_SimpleDB_Model_DeleteDomain action or Amazon_SimpleDB_Model_DeleteDomain object itself
     * @see Amazon_SimpleDB_Model_DeleteDomain
     * @return Amazon_SimpleDB_Model_DeleteDomainResponse Amazon_SimpleDB_Model_DeleteDomainResponse
     *
     * @throws Amazon_SimpleDB_Exception
     */
    public function deleteDomain($action) 
    {
        if (!$action instanceof Amazon_SimpleDB_Model_DeleteDomain) {
            require_once ('Amazon/SimpleDB/Model/DeleteDomain.php');
            $action = new Amazon_SimpleDB_Model_DeleteDomain($action);
        }
        require_once ('Amazon/SimpleDB/Model/DeleteDomainResponse.php');
        return Amazon_SimpleDB_Model_DeleteDomainResponse::fromXML($this->_invoke($action->toMap()));
    }


            
    /**
     * Put Attributes 
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
     * @see http://docs.amazonwebservices.com/SimpleDB/2007-11-07/DG/PutAttributes.html      
     * @param mixed $action array of parameters for Amazon_SimpleDB_Model_PutAttributes action or Amazon_SimpleDB_Model_PutAttributes object itself
     * @see Amazon_SimpleDB_Model_PutAttributes
     * @return Amazon_SimpleDB_Model_PutAttributesResponse Amazon_SimpleDB_Model_PutAttributesResponse
     *
     * @throws Amazon_SimpleDB_Exception
     */
    public function putAttributes($action) 
    {
        if (!$action instanceof Amazon_SimpleDB_Model_PutAttributes) {
            require_once ('Amazon/SimpleDB/Model/PutAttributes.php');
            $action = new Amazon_SimpleDB_Model_PutAttributes($action);
        }
        require_once ('Amazon/SimpleDB/Model/PutAttributesResponse.php');
        return Amazon_SimpleDB_Model_PutAttributesResponse::fromXML($this->_invoke($action->toMap()));
    }


            
    /**
     * Get Attributes 
     * Returns all of the attributes associated with the item. Optionally, the attributes returned can be limited to
     * the specified AttributeName parameter.
     * If the item does not exist on the replica that was accessed for this operation, an empty attribute is
     * returned. The system does not return an error as it cannot guarantee the item does not exist on other
     * replicas.
     *   
     * @see http://docs.amazonwebservices.com/SimpleDB/2007-11-07/DG/GetAttributes.html      
     * @param mixed $action array of parameters for Amazon_SimpleDB_Model_GetAttributes action or Amazon_SimpleDB_Model_GetAttributes object itself
     * @see Amazon_SimpleDB_Model_GetAttributes
     * @return Amazon_SimpleDB_Model_GetAttributesResponse Amazon_SimpleDB_Model_GetAttributesResponse
     *
     * @throws Amazon_SimpleDB_Exception
     */
    public function getAttributes($action) 
    {
        if (!$action instanceof Amazon_SimpleDB_Model_GetAttributes) {
            require_once ('Amazon/SimpleDB/Model/GetAttributes.php');
            $action = new Amazon_SimpleDB_Model_GetAttributes($action);
        }
        require_once ('Amazon/SimpleDB/Model/GetAttributesResponse.php');
        return Amazon_SimpleDB_Model_GetAttributesResponse::fromXML($this->_invoke($action->toMap()));
    }


            
    /**
     * Delete Attributes 
     * Deletes one or more attributes associated with the item. If all attributes of an item are deleted, the item is
     * deleted.
     *   
     * @see http://docs.amazonwebservices.com/SimpleDB/2007-11-07/DG/DeleteAttributes.html      
     * @param mixed $action array of parameters for Amazon_SimpleDB_Model_DeleteAttributes action or Amazon_SimpleDB_Model_DeleteAttributes object itself
     * @see Amazon_SimpleDB_Model_DeleteAttributes
     * @return Amazon_SimpleDB_Model_DeleteAttributesResponse Amazon_SimpleDB_Model_DeleteAttributesResponse
     *
     * @throws Amazon_SimpleDB_Exception
     */
    public function deleteAttributes($action) 
    {
        if (!$action instanceof Amazon_SimpleDB_Model_DeleteAttributes) {
            require_once ('Amazon/SimpleDB/Model/DeleteAttributes.php');
            $action = new Amazon_SimpleDB_Model_DeleteAttributes($action);
        }
        require_once ('Amazon/SimpleDB/Model/DeleteAttributesResponse.php');
        return Amazon_SimpleDB_Model_DeleteAttributesResponse::fromXML($this->_invoke($action->toMap()));
    }


            
    /**
     * Query 
     * The Query operation returns a set of ItemNames that match the query expression. Query operations that
     * run longer than 5 seconds will likely time-out and return a time-out error response.
     * A Query with no QueryExpression matches all items in the domain.
     *   
     * @see http://docs.amazonwebservices.com/SimpleDB/2007-11-07/DG/Query.html      
     * @param mixed $action array of parameters for Amazon_SimpleDB_Model_Query action or Amazon_SimpleDB_Model_Query object itself
     * @see Amazon_SimpleDB_Model_Query
     * @return Amazon_SimpleDB_Model_QueryResponse Amazon_SimpleDB_Model_QueryResponse
     *
     * @throws Amazon_SimpleDB_Exception
     */
    public function query($action) 
    {
        if (!$action instanceof Amazon_SimpleDB_Model_Query) {
            require_once ('Amazon/SimpleDB/Model/Query.php');
            $action = new Amazon_SimpleDB_Model_Query($action);
        }
        require_once ('Amazon/SimpleDB/Model/QueryResponse.php');
        return Amazon_SimpleDB_Model_QueryResponse::fromXML($this->_invoke($action->toMap()));
    }

        // Private API ------------------------------------------------------------//

    /**
     * Invoke request and return response
     */
    private function _invoke(array $parameters)
    {
        $actionName = $parameters["Action"];
        $response = array();
        $responseBody = null;
        $statusCode = 200;

        /* Submit the request and read response body */
        try {
        
            /* Add required request parameters */
            $parameters = $this->_addRequiredParameters($parameters);

            $shouldRetry = true;
            $retries = 0;
            do {
                try {
                        $response = $this->_httpPost($parameters);
                        if ($response['Status'] === 200) {
                            $shouldRetry = false;
                        } else {
                            if ($response['Status'] === 500 || $response['Status'] === 503) {
                                $shouldRetry = true;
                                $this->_pauseOnRetry(++$retries, $response['Status']);
                            } else {    
                                throw $this->_reportAnyErrors($response['ResponseBody'], $response['Status']);
                            }
                       }     
                /* Rethrow on deserializer error */
                } catch (Exception $e) {
                    require_once ('Amazon/SimpleDB/Exception.php');
                    if ($e instanceof Amazon_SimpleDB_Exception) {
                        throw $e;
                    } else {
                        require_once ('Amazon/SimpleDB/Exception.php');
                        throw new Amazon_SimpleDB_Exception(array('Exception' => $e, 'Message' => $e->getMessage()));   
                    }
                }

            } while ($shouldRetry);

        } catch (Amazon_SimpleDB_Exception $se) {
            throw $se;
        } catch (Exception $t) {
            throw new Amazon_SimpleDB_Exception(array('Exception' => $t, 'Message' => $t->getMessage()));
        }

        return $response['ResponseBody'];
    }

    /**
     * Look for additional error strings in the response and return formatted exception
     */
    private function _reportAnyErrors($responseBody, $status, Exception $e =  null)
    {
        $ex = null;
        if (!is_null($responseBody) && strpos($responseBody, '<') === 0) {
            if (preg_match('@<RequestId>(.*)</RequestId>.*<Error><Code>(.*)</Code><Message>(.*)</Message></Error>.*(<Error>)?@mi',
                $responseBody, $errorMatcherOne)) {
                                
                $requestId = $errorMatcherOne[1];
                $code = $errorMatcherOne[2];
                $message = $errorMatcherOne[3];

                require_once ('Amazon/SimpleDB/Exception.php');
                $ex = new Amazon_SimpleDB_Exception(array ('Message' => $message, 'StatusCode' => $status, 'ErrorCode' => $code, 
                                                           'ErrorType' => 'Unknown', 'RequestId' => $requestId, 'XML' => $responseBody));

            } elseif (preg_match('@<Error><Code>(.*)</Code><Message>(.*)</Message></Error>.*(<Error>)?.*<RequestID>(.*)</RequestID>@mi',
                $responseBody, $errorMatcherTwo)) {
                                
                $code = $errorMatcherTwo[1];  
                $message = $errorMatcherTwo[2];  
                $requestId = $errorMatcherTwo[4];   
                require_once ('Amazon/SimpleDB/Exception.php');
                $ex = new Amazon_SimpleDB_Exception(array ('Message' => $message, 'StatusCode' => $status, 'ErrorCode' => $code, 
                                                              'ErrorType' => 'Unknown', 'RequestId' => $requestId, 'XML' => $responseBody));
            } elseif (preg_match('@<Error><Code>(.*)</Code><Message>(.*)</Message><BoxUsage>(.*)</BoxUsage></Error>.*(<Error>)?.*<RequestID>(.*)</RequestID>@mi',
                $responseBody, $errorMatcherThree)) {
                                
                $code = $errorMatcherThree[1];  
                $message = $errorMatcherThree[2]; 
                $boxUsage = $errorMatcherThree[3];   
                $requestId = $errorMatcherThree[5];   
                require_once ('Amazon/SimpleDB/Exception.php');
                $ex = new Amazon_SimpleDB_Exception(array ('Message' => $message, 'StatusCode' => $status, 'ErrorCode' => $code, 
                                                              'ErrorType' => 'Unknown', 'BoxUsage' => $boxUsage, 'RequestId' => $requestId, 'XML' => $responseBody));
 
            } else {
                require_once ('Amazon/SimpleDB/Exception.php');
                $ex = new Amazon_SimpleDB_Exception(array('Message' => 'Internal Error', 'StatusCode' => $status));
            }
        } else {
            require_once ('Amazon/SimpleDB/Exception.php');
            $ex = new Amazon_SimpleDB_Exception(array('Message' => 'Internal Error', 'StatusCode' => $status));
        }
        return $ex;
    }



    /**
     * Perform HTTP post with exponential retries on error 500 and 503
     * 
     */
    private function _httpPost(array $parameters) 
    {
        $query = $this->_getParametersAsString($parameters);
        $url = parse_url ($this->_config['ServiceURL']);
        $post  = "POST / HTTP/1.0\r\n";
        $post .= "Host: " . $url['host'] . "\r\n";
        $post .= "Content-Type: application/x-www-form-urlencoded; charset=utf-8\r\n";
        $post .= "Content-Length: " . strlen($query) . "\r\n";
        $post .= "User-Agent: " . $this->_config['UserAgent'] . "\r\n";
        $post .= "\r\n";
        $post .= $query;

        $response = '';
        if ($socket = @fsockopen($url['host'], $url['port'] === null? 80 : $url['port'], $errno, $errstr, 10)) {
  
            fwrite($socket, $post);

            while (!feof($socket)) {
                $response .= fgets($socket, 1160);
            }
            fclose($socket);
        
            list($other, $responseBody) = explode("\r\n\r\n", $response, 2);
            $other = preg_split("/\r\n|\n|\r/", $other);
            list($protocol, $code, $text) = explode(' ', trim(array_shift($other)), 3);
        } else {
            throw new Exception ("Unable to establish connection to host " . $url['host'] . " $errstr");
        }
        return array ('Status' => (int)$code, 'ResponseBody' => $responseBody);
    }

    /**
     * Exponential sleep on failed request
     * @param retries current retry
     * @throws Amazon_SimpleDB_Exception if maximum number of retries has been reached
     */
    private function _pauseOnRetry($retries, $status)
    {
        if ($retries <= $this->_config['MaxErrorRetry']) {
            $delay = (int) (pow(4, $retries) * 100000) ;
            usleep($delay);
        } else {
            require_once ('Amazon/SimpleDB/Exception.php');
            throw new Amazon_SimpleDB_Exception (array ('Message' => "Maximum number of retry attempts reached :  $retries", 'StatusCode' => $status));
        }
    }

    /**
     * Add authentication related and version parameters
     */
    private function _addRequiredParameters(array $parameters)
    {
        $parameters['AWSAccessKeyId'] = $this->_awsAccessKeyId;
        $parameters['Timestamp'] = $this->_getFormattedTimestamp();
        $parameters['Version'] = self::SERVICE_VERSION;      
        $parameters['SignatureVersion'] = $this->_config['SignatureVersion']; 
        $parameters['Signature'] = $this->_signParameters($parameters, $this->_awsSecretAccessKey); 
        
        return $parameters;
    }

    /**
     * Convert paremeters to Url encoded query string
     */
    private function _getParametersAsString(array $parameters)
    {
        return http_build_query($parameters, '', '&');
    }  


    /**
      * Computes RFC 2104-compliant HMAC signature for request parameters
      * Implements AWS Signature, as per following spec:
      *
      * If Signature Version is 0, it signs concatenated Action and Timestamp
      *
      * If Signature Version is 1, it performs the following:
      *
      * Sorts all  parameters (including SignatureVersion and excluding Signature,
      * the value of which is being created), ignoring case.
      *
      * Iterate over the sorted list and append the parameter name (in original case)
      * and then its value. It will not URL-encode the parameter values before
      * constructing this string. There are no separators.
      */
    private function _signParameters(array $parameters, $key)
    {
        $signatureVersion = $parameters['SignatureVersion'];
        $data = '';

        if (0 === $signatureVersion) {
            $data .=  $parameters['Action'] .  $parameters['Timestamp'];
        } elseif (1 === $signatureVersion) {
            uksort($parameters, 'strnatcasecmp');
            unset ($parameters['Signature']);
                
            foreach ($parameters as $parameterName => $parameterValue) {
                $data .= $parameterName . $parameterValue;
            }
        } else {
            throw new Exception("Invalid Signature Version specified");
        }
        return $this->_sign($data, $key);
    }


    /**
     * Computes RFC 2104-compliant HMAC signature.
     */
    private function _sign($data, $key)
    {
        return base64_encode (
            pack("H*", sha1((str_pad($key, 64, chr(0x00))
            ^(str_repeat(chr(0x5c), 64))) .
            pack("H*", sha1((str_pad($key, 64, chr(0x00))
            ^(str_repeat(chr(0x36), 64))) . $data))))
        );
    }


    /**
     * Formats date as ISO 8601 timestamp
     */
    private function _getFormattedTimestamp()
    {
        return gmdate("Y-m-d\TH:i:s.\\0\\0\\0\\Z", time());
    }
}