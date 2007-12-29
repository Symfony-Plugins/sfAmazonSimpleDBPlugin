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
 * Amazon_SimpleDB_Model_GetAttributes
 * 
 * Properties:
 * <ul>
 * 
 * <li>DomainName: string</li>
 * <li>ItemName: string</li>
 * <li>AttributeName: string</li>
 *
 * </ul>
 */ 
class Amazon_SimpleDB_Model_GetAttributes extends Amazon_SimpleDB_Model
{


    /**
     * Construct new Amazon_SimpleDB_Model_GetAttributes
     * 
     * @param mixed $data DOMElement or Associative Array to construct from. 
     * 
     * Valid properties:
     * <ul>
     * 
     * <li>DomainName: string</li>
     * <li>ItemName: string</li>
     * <li>AttributeName: string</li>
     *
     * </ul>
     */
    public function __construct($data = null)
    {
        $this->_fields = array (
        'DomainName' => array('FieldValue' => null, 'FieldType' => 'string'),
        'ItemName' => array('FieldValue' => null, 'FieldType' => 'string'),
        'AttributeName' => array('FieldValue' => array(), 'FieldType' => array('string')),
        );
        parent::__construct($data);
    }

        /**
     * Gets the value of the DomainName property.
     * 
     * @return string DomainName
     */
    public function getDomainName() 
    {
        return $this->_fields['DomainName']['FieldValue'];
    }

    /**
     * Sets the value of the DomainName property.
     * 
     * @param string DomainName
     * @return this instance
     */
    public function setDomainName($value) 
    {
        $this->_fields['DomainName']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Sets the value of the DomainName and returns this instance
     * 
     * @param string $value DomainName
     * @return Amazon_SimpleDB_Model_GetAttributes instance
     */
    public function withDomainName($value)
    {
        $this->setDomainName($value);
        return $this;
    }


    /**
     * Checks if DomainName is set
     * 
     * @return bool true if DomainName  is set
     */
    public function isSetDomainName()
    {
        return !is_null($this->_fields['DomainName']['FieldValue']);
    }

    /**
     * Gets the value of the ItemName property.
     * 
     * @return string ItemName
     */
    public function getItemName() 
    {
        return $this->_fields['ItemName']['FieldValue'];
    }

    /**
     * Sets the value of the ItemName property.
     * 
     * @param string ItemName
     * @return this instance
     */
    public function setItemName($value) 
    {
        $this->_fields['ItemName']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Sets the value of the ItemName and returns this instance
     * 
     * @param string $value ItemName
     * @return Amazon_SimpleDB_Model_GetAttributes instance
     */
    public function withItemName($value)
    {
        $this->setItemName($value);
        return $this;
    }


    /**
     * Checks if ItemName is set
     * 
     * @return bool true if ItemName  is set
     */
    public function isSetItemName()
    {
        return !is_null($this->_fields['ItemName']['FieldValue']);
    }

    /**
     * Gets the value of the AttributeName .
     * 
     * @return array of string AttributeName
     */
    public function getAttributeName() 
    {
        return $this->_fields['AttributeName']['FieldValue'];
    }

    /**
     * Sets the value of the AttributeName.
     * 
     * @param mixed array, or variable number of  string AttributeName
     * @return this instance
     */
    public function setAttributeName($value) 
    {
        foreach (func_get_args() as $attributeName) {
            if (!$this->_isNumericArray($attributeName)) {
                $attributeName =  array ($attributeName);    
            }
        }
        $this->_fields['AttributeName']['FieldValue'] = $attributeName;
        return $this;
    }
  

    /**
     * Sets single or multiple values of AttributeName list via variable number of arguments. 
     * For example, to set the list with two elements, simply pass two values as arguments to this function
     * <code>withAttributeName($attributeName1, $attributeName2)</code>
     * 
     * @param string  $stringArgs one or more AttributeName
     * @return Amazon_SimpleDB_Model_GetAttributes  instance
     */
    public function withAttributeName($stringArgs)
    {
        foreach (func_get_args() as $attributeName) {
            $this->_fields['AttributeName']['FieldValue'][] = $attributeName;
        }
        return $this;
    }  
      

    /**
     * Checks if AttributeName list is non-empty
     * 
     * @return bool true if AttributeName list is non-empty
     */
    public function isSetAttributeName()
    {
        return count ($this->_fields['AttributeName']['FieldValue']) > 0;
    }




    /**
     * Representation of action that returns associative array of AWS Query Parameters
     * 
     * @return array AWS Query parameters - name and value pairs
     */
    public function toMap()
                                        {
        $parameters = array();
        $parameters["Action"] = 'GetAttributes';
        if ($this->isSetDomainName()) {
            $parameters["DomainName"] =  $this->getDomainName();
        }
        if ($this->isSetItemName()) {
            $parameters["ItemName"] =  $this->getItemName();
        }
        foreach  ($this->getAttributeName() as $attributeNameIndex => $attributeName) {
            $parameters["AttributeName" . "."  . ($attributeNameIndex + 1)] =  $attributeName;
        }	
        return $parameters;
    }

}