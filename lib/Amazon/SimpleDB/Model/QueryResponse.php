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
 *  @see Amazon_SimpleDB_Model
 */
require_once ('Amazon/SimpleDB/Model.php');  

    

/**
 * Amazon_SimpleDB_Model_QueryResponse
 * 
 * Properties:
 * <ul>
 * 
 * <li>QueryResult: Amazon_SimpleDB_Model_QueryResult</li>
 * <li>ResponseMetadata: Amazon_SimpleDB_Model_ResponseMetadata</li>
 *
 * </ul>
 */ 
class Amazon_SimpleDB_Model_QueryResponse extends Amazon_SimpleDB_Model
{


    /**
     * Construct new Amazon_SimpleDB_Model_QueryResponse
     * 
     * @param mixed $data DOMElement or Associative Array to construct from. 
     * 
     * Valid properties:
     * <ul>
     * 
     * <li>QueryResult: Amazon_SimpleDB_Model_QueryResult</li>
     * <li>ResponseMetadata: Amazon_SimpleDB_Model_ResponseMetadata</li>
     *
     * </ul>
     */
    public function __construct($data = null)
    {
        $this->_fields = array (
        'QueryResult' => array('FieldValue' => null, 'FieldType' => 'Amazon_SimpleDB_Model_QueryResult'),
        'ResponseMetadata' => array('FieldValue' => null, 'FieldType' => 'Amazon_SimpleDB_Model_ResponseMetadata'),
        );
        parent::__construct($data);
    }

       
    /**
     * Construct Amazon_SimpleDB_Model_QueryResponse from XML string
     * 
     * @param string $xml XML string to construct from
     * @return Amazon_SimpleDB_Model_QueryResponse 
     */
    public static function fromXML($xml)
    {
        $dom = new DOMDocument();
        $dom->loadXML($xml);
        $xpath = new DOMXPath($dom);
    	$xpath->registerNamespace('a', 'http://sdb.amazonaws.com/doc/2007-11-07/');
        $response = $xpath->query('//a:QueryResponse');
        if ($response->length == 1) {
            return new Amazon_SimpleDB_Model_QueryResponse(($response->item(0))); 
        } else {
            throw new Exception ("Unable to construct Amazon_SimpleDB_Model_QueryResponse from provided XML. 
                                  Make sure that QueryResponse is a root element");
        }
          
    }
    
    /**
     * Gets the value of the QueryResult.
     * 
     * @return QueryResult QueryResult
     */
    public function getQueryResult() 
    {
        return $this->_fields['QueryResult']['FieldValue'];
    }

    /**
     * Sets the value of the QueryResult.
     * 
     * @param QueryResult QueryResult
     * @return void
     */
    public function setQueryResult($value) 
    {
        $this->_fields['QueryResult']['FieldValue'] = $value;
        return;
    }

    /**
     * Sets the value of the QueryResult  and returns this instance
     * 
     * @param QueryResult $value QueryResult
     * @return Amazon_SimpleDB_Model_QueryResponse instance
     */
    public function withQueryResult($value)
    {
        $this->setQueryResult($value);
        return $this;
    }


    /**
     * Checks if QueryResult  is set
     * 
     * @return bool true if QueryResult property is set
     */
    public function isSetQueryResult()
    {
        return !is_null($this->_fields['QueryResult']['FieldValue']);

    }

    /**
     * Gets the value of the ResponseMetadata.
     * 
     * @return ResponseMetadata ResponseMetadata
     */
    public function getResponseMetadata() 
    {
        return $this->_fields['ResponseMetadata']['FieldValue'];
    }

    /**
     * Sets the value of the ResponseMetadata.
     * 
     * @param ResponseMetadata ResponseMetadata
     * @return void
     */
    public function setResponseMetadata($value) 
    {
        $this->_fields['ResponseMetadata']['FieldValue'] = $value;
        return;
    }

    /**
     * Sets the value of the ResponseMetadata  and returns this instance
     * 
     * @param ResponseMetadata $value ResponseMetadata
     * @return Amazon_SimpleDB_Model_QueryResponse instance
     */
    public function withResponseMetadata($value)
    {
        $this->setResponseMetadata($value);
        return $this;
    }


    /**
     * Checks if ResponseMetadata  is set
     * 
     * @return bool true if ResponseMetadata property is set
     */
    public function isSetResponseMetadata()
    {
        return !is_null($this->_fields['ResponseMetadata']['FieldValue']);

    }



    /**
     * XML Representation for this object
     * 
     * @return string XML for this object
     */
    public function toXML() 
    {
        $xml = "";
        $xml .= "<QueryResponse xmlns=\"http://sdb.amazonaws.com/doc/2007-11-07/\">";
        $xml .= $this->_toXMLFragment();
        $xml .= "</QueryResponse>";
        return $xml;
    }


}