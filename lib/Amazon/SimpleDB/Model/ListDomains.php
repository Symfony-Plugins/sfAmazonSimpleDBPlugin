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
 * Amazon_SimpleDB_Model_ListDomains
 * 
 * Properties:
 * <ul>
 * 
 * <li>MaxNumberOfDomains: int</li>
 * <li>NextToken: string</li>
 *
 * </ul>
 */ 
class Amazon_SimpleDB_Model_ListDomains extends Amazon_SimpleDB_Model
{


    /**
     * Construct new Amazon_SimpleDB_Model_ListDomains
     * 
     * @param mixed $data DOMElement or Associative Array to construct from. 
     * 
     * Valid properties:
     * <ul>
     * 
     * <li>MaxNumberOfDomains: int</li>
     * <li>NextToken: string</li>
     *
     * </ul>
     */
    public function __construct($data = null)
    {
        $this->_fields = array (
        'MaxNumberOfDomains' => array('FieldValue' => null, 'FieldType' => 'int'),
        'NextToken' => array('FieldValue' => null, 'FieldType' => 'string'),
        );
        parent::__construct($data);
    }

        /**
     * Gets the value of the MaxNumberOfDomains property.
     * 
     * @return int MaxNumberOfDomains
     */
    public function getMaxNumberOfDomains() 
    {
        return $this->_fields['MaxNumberOfDomains']['FieldValue'];
    }

    /**
     * Sets the value of the MaxNumberOfDomains property.
     * 
     * @param int MaxNumberOfDomains
     * @return this instance
     */
    public function setMaxNumberOfDomains($value) 
    {
        $this->_fields['MaxNumberOfDomains']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Sets the value of the MaxNumberOfDomains and returns this instance
     * 
     * @param int $value MaxNumberOfDomains
     * @return Amazon_SimpleDB_Model_ListDomains instance
     */
    public function withMaxNumberOfDomains($value)
    {
        $this->setMaxNumberOfDomains($value);
        return $this;
    }


    /**
     * Checks if MaxNumberOfDomains is set
     * 
     * @return bool true if MaxNumberOfDomains  is set
     */
    public function isSetMaxNumberOfDomains()
    {
        return !is_null($this->_fields['MaxNumberOfDomains']['FieldValue']);
    }

    /**
     * Gets the value of the NextToken property.
     * 
     * @return string NextToken
     */
    public function getNextToken() 
    {
        return $this->_fields['NextToken']['FieldValue'];
    }

    /**
     * Sets the value of the NextToken property.
     * 
     * @param string NextToken
     * @return this instance
     */
    public function setNextToken($value) 
    {
        $this->_fields['NextToken']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Sets the value of the NextToken and returns this instance
     * 
     * @param string $value NextToken
     * @return Amazon_SimpleDB_Model_ListDomains instance
     */
    public function withNextToken($value)
    {
        $this->setNextToken($value);
        return $this;
    }


    /**
     * Checks if NextToken is set
     * 
     * @return bool true if NextToken  is set
     */
    public function isSetNextToken()
    {
        return !is_null($this->_fields['NextToken']['FieldValue']);
    }




    /**
     * Representation of action that returns associative array of AWS Query Parameters
     * 
     * @return array AWS Query parameters - name and value pairs
     */
    public function toMap()
                                        {
        $parameters = array();
        $parameters["Action"] = 'ListDomains';
        if ($this->isSetMaxNumberOfDomains()) {
            $parameters["MaxNumberOfDomains"] =  $this->getMaxNumberOfDomains();
        }
        if ($this->isSetNextToken()) {
            $parameters["NextToken"] =  $this->getNextToken();
        }
        return $parameters;
    }

}