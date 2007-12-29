<?php
require_once ('Amazon/SimpleDB/Client.php'); 

/**
 * Amazon SimpleDB client for Symfony
 * 
 * @package plugins
 * @author  Nicolas Perriault <nperriault@gmail.com>
 */
class sfAmazonSimpleDBClient
{
  
  protected static 
    $client     = null,
    $domain     = null,
    $instance   = null;
  
  /**
   * Retrieves Amazon SimpleDB client instance
   *
   * @return Amazon_SimpleDB_Client
   */
  public static function getClient()
  {
    if (is_null(self::$client))
    {
      $awsAccessId  = sfConfig::get('app_sfAmazonSimpleDBPlugin_aws_access_key'); 
      $awsSecretKey = sfConfig::get('app_sfAmazonSimpleDBPlugin_aws_secret_key');
      sfLogger::getInstance()->info(sprintf('Amazon_SimpleDB_Client loaded with id "%s"',
                                            $awsAccessId));
      self::$client = new Amazon_SimpleDB_Client($awsAccessId, $awsSecretKey);
    }
    return self::$client;
  }
  
  /**
   * Retrieve actual singleton instance
   *
   * @return sfAmazonSimpleDBClient
   */
  public function getInstance()
  {
    if (is_null(self::$client))
    {
      self::$instance = new self;
    }
    return self::$instance;
  }
  
  /**
   * Deletes an attribute matching a given value, for a given entry
   *
   * @param  string  $name        Entry name
   * @param  string  $attr_name   Attribute name
   * @param  mixed   $attr_value  Matching value
   * @param  mixed   $domain      Domain name (optional)
   * @return boolean
   * @throws sfAmazonSimpleDBException
   */
  public function deleteAttributes($name, $attr_name = null, $attr_value = null, $domain = null)
  {
    if (is_null($domain))
    {
      $domain = self::$domain;
    }
    if (is_null($domain))
    {
      throw new sfAmazonSimpleDBException('deleteAttributes(): No domain has been selected nor specified');
    }
    try
    {
      $attribute = new Amazon_SimpleDB_Model_Attribute();
      if (!is_null($attr_name))
      {
        $attribute->withName($attr_name);
      }
      if (!is_null($attr_value))
      {
        $attribute->withValue($attr_value);
      }
      $action = new Amazon_SimpleDB_Model_DeleteAttributes();
      $action->withDomainName($domain)->withItemName($name)->withAttribute($attribute);
      sfLogger::getInstance()->info(sprintf('Deleting attributes for entry "%s" in domain "%s"', $name, $domain));
      $response = self::getClient()->deleteAttributes($action);
      return $response->isSetResponseMetadata() && !is_null($response->getResponseMetadata()->isSetRequestId());
    }
    catch (Amazon_SimpleDB_Exception $e)
    {
      throw new sfAmazonSimpleDBException($e->getMessage(), 0, $e);
    }
  }
  
  /**
   * Deletes a domain
   *
   * @param  string $name
   * @return boolean
   * @throws sfAmazonSimpleDBException
   */
  public function deleteDomain($name)
  {
    try
    {
      require_once ('Amazon/SimpleDB/Model/DeleteDomain.php'); 
      $action = new Amazon_SimpleDB_Model_DeleteDomain();
      $action->setDomainName($name);
      sfLogger::getInstance()->info(sprintf('Deleting domain "%s"', $name));
      $response = self::getClient()->deleteDomain($action);
      $status = $response->isSetResponseMetadata() && !is_null($response->getResponseMetadata()->isSetRequestId());
      if ($status && $this->getSelectedDomain() === $name)
      {
        $this->selectDomain(null);
      }
      return $status;
    }
    catch (Amazon_SimpleDB_Exception $e)
    {
      throw new sfAmazonSimpleDBException($e->getMessage(), 0, $e);
    }
  }
  
  /**
   * Creates a new domain
   *
   * @param  string $name
   * @return boolean
   * @throws sfAmazonSimpleDBException
   */
  public function createDomain($name)
  {
    try
    {
      require_once ('Amazon/SimpleDB/Model/CreateDomain.php'); 
      $action = new Amazon_SimpleDB_Model_CreateDomain();
      $action->setDomainName($name);
      sfLogger::getInstance()->info(sprintf('Creating domain "%s"', $name));
      $response = self::getClient()->createDomain($action);
      return $response->isSetResponseMetadata() && !is_null($response->getResponseMetadata()->isSetRequestId());
    }
    catch (Amazon_SimpleDB_Exception $e)
    {
      throw new sfAmazonSimpleDBException($e->getMessage(), 0, $e);
    }
  }
  
  /**
   * Lists available domains
   *
   * @param int  $max     Max entries to retrieve (optional)
   * @param int  $offset  Offset to start with (optional)
   * @return array of strings
   * @throws sfAmazonSimpleDBException
   */
  public function listDomains($max = null, $offset = null)
  {
    try
    {
      $results = array();
      $action = new Amazon_SimpleDB_Model_ListDomains();
      if (!is_null($max) && $max > 0)
      {
        $action->setMaxNumberOfDomains($max);
      }
      if (!is_null($offset))
      {
        $action->setNextToken($offset);
      }
      $results = array('results' => array());
      sfLogger::getInstance()->info('Listing existing domains');
      $response = self::getClient()->listDomains($action);
      if ($response->isSetListDomainsResult()) 
      { 
        $listDomainsResult = $response->getListDomainsResult();
        $domainNameList    = $listDomainsResult->getDomainName();
        foreach ($domainNameList as $domainName) 
        { 
          $results['results'][] = $domainName;  
        }
        if ($listDomainsResult->isSetNextToken()) 
        {
          $results['next_token'] = $listDomainsResult->getNextToken();
        }
      }
      if ($response->isSetResponseMetadata()) 
      { 
        $responseMetadata = $response->getResponseMetadata();
        if ($responseMetadata->isSetRequestId()) 
        {
          $results['request_id'] = $responseMetadata->getRequestId();
        }
        if ($responseMetadata->isSetBoxUsage()) 
        {
          $results['box_usage'] = $responseMetadata->getBoxUsage();
        }
      }
      return $results;
    }
    catch (Amazon_SimpleDB_Exception $e)
    {
      throw new sfAmazonSimpleDBException($e->getMessage(), 0, $e);
    } 
  }
  
  /**
   * Retrieves attributes for an entry
   *
   * @param string  $name    Entry name
   * @param string  $domain  Domain (optional)
   * @return array of key => values
   */
  public function getAttributes($name, $domain = null)
  {
    if (is_null($domain))
    {
      $domain = self::$domain;
    }
    if (is_null($domain))
    {
      throw new sfAmazonSimpleDBException('getAttributes(): No domain has been selected nor specified');
    }
    $action = new Amazon_SimpleDB_Model_GetAttributes();
    $action->setDomainName($domain);
    $action->setItemName($name);
    sfLogger::getInstance()->info(sprintf('Getting attributes for entry "%s" in domain "%s"', 
                                          $name, $domain));
    $response = self::getClient()->getAttributes($action);
    $results = array();
    if ($response->isSetGetAttributesResult()) 
    {
      $getAttributesResult = $response->getGetAttributesResult();
      $attributes = $getAttributesResult->getAttribute();
      foreach ($attributes as $attribute)
      {
        if ($attribute->isSetName())
        {
          $attr_name = $attribute->getName();
          if (isset($results[$attr_name]))
          {
            if (is_array($results[$attr_name]))
            {
              $results[$attr_name][] = $attribute->getValue();
            }
            else
            {
              $results[$attr_name] = array($results[$attr_name],
                                           $attribute->getValue());
            }
          }
          else
          {
            $results[$attr_name] = $attribute->getValue();
          }
        }
      }
    }
    return $results;
  }
  
  /**
   * Creates an attribute
   *
   * @param string $name
   * @param string $value
   * @param boolean $replaceable
   * @return Amazon_SimpleDB_Model
   */
  protected static function createAttribute($name, $value = null, $replaceable = true)
  {
    $attribute = new Amazon_SimpleDB_Model_ReplaceableAttribute();
    $attribute->withName($name)->withValue($value);
    if ($replaceable)
    {
      $attribute->withReplace(true);
    }
    return $attribute;
  }
  
  /**
   * Insert a new record for the domain
   *
   * @param  string  $name         name of item to insert
   * @param  array   $attributes   attributes hash. values can be arrays of possible values
   * @param  boolean $replaceable  are attributes replaceable? (default true)
   * @param  mixed   $domain       specific domain for current operation
   * @return boolean
   * @throws sfAmazonSimpleDBException
   */
  public function putAttributes($name, $attributes, $replaceable = true, $domain = null)
  {
    if (is_null($domain))
    {
      $domain = self::$domain;
    }
    if (is_null($domain))
    {
      throw new sfAmazonSimpleDBException('putAttributes(): No domain has been selected nor specified');
    }
    $aws_attributes = array();
    foreach ($attributes as $attr_name => $attr_value)
    {
      if (is_array($attr_value))
      {
        $attr_value = array_unique($attr_value);
        foreach ($attr_value as $attr_enum_value)
        {
          $aws_attributes[] = self::createAttribute($attr_name, $attr_enum_value, $replaceable);
        }
      }
      else
      {
        $aws_attributes[] = self::createAttribute($attr_name, $attr_value, $replaceable);
      }
    }
    try
    {
      $action = new Amazon_SimpleDB_Model_PutAttributes();
      $action->withDomainName($domain)->withItemName($name)->setAttribute($aws_attributes);
      sfLogger::getInstance()->info(sprintf('Adding %d attributes for entry "%s" in domain "%s"', 
                                            count($aws_attributes), $name, $domain));
      $response = self::getClient()->putAttributes($action);
      return $response->isSetResponseMetadata() && !is_null($response->getResponseMetadata()->isSetRequestId());
    }
    catch (Exception $e)
    {
      throw new sfAmazonSimpleDBException($e->getMessage(), 0, $e);
    }
  }
  
  /**
   * Query database with given expression
   *
   * @param  string  $expression  Query expression (optional)
   * @param  int     $max         Max entries to retrieve (optional)
   * @param  int     $offset      Offset to start with (optional)
   * @param  string  $domain      Domain to query (optional)
   * @return array
   * @link   http://docs.amazonwebservices.com/AmazonSimpleDB/2007-11-07/DeveloperGuide/SDB_API_Query.html#SDB_API_Query_QueryExpressionSyntax
   */
  public function query($expression = null, $max = null, $offset = null, $domain = null)
  {
    if (is_null($domain))
    {
      $domain = self::$domain;
    }
    if (is_null($domain))
    {
      throw new sfAmazonSimpleDBException('query(): No domain has been selected nor specified');
    }
    $results = array('results' => array());
    $action = new Amazon_SimpleDB_Model_Query();
    $action->setDomainName($domain);
    if (!is_null($expression))
    {
      $action->setQueryExpression($expression);
    }
    if (!is_null($max) && $max > 0)
    {
      $action->setMaxNumberOfItems($max);
    }
    if (!is_null($offset))
    {
      $action->setNextToken($offset);
    }
    sfLogger::getInstance()->info(sprintf('Querying "%s" in domain "%s"', $expression, $domain));
    $response = self::getClient()->query($action); 
    if ($response->isSetQueryResult()) 
    {
      $queryResult = $response->getQueryResult();
      $itemNameList = $queryResult->getItemName();
      foreach ($itemNameList as $itemName)
      {
        $results['results'][] = $itemName;
      }
      if ($queryResult->isSetNextToken()) 
      {
        $results['next_token'] = $queryResult->getNextToken();
      }
    }
    if ($response->isSetResponseMetadata()) 
    { 
      $responseMetadata = $response->getResponseMetadata();
      if ($responseMetadata->isSetRequestId()) 
      {
        $results['request_id'] = $responseMetadata->getRequestId();
      }
      if ($responseMetadata->isSetBoxUsage()) 
      {
        $results['box_usage'] = $responseMetadata->getBoxUsage();
      }
    }
    return $results;
  }
  
  /**
   * Get current selected domain
   * 
   * @return mixed
   */
  public function getSelectedDomain()
  {
    return self::$domain;
  }
  
  /**
   * Select a domain
   * 
   * @param  string  $name
   * @return 
   */
  public function selectDomain($name)
  {
    sfLogger::getInstance()->info(sprintf('Selecting domain "%s"', $name));
    self::$domain = $name;
    return $this;
  }
  
}
