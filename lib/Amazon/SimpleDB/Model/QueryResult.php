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
 * Amazon_SimpleDB_Model_QueryResult
 * 
 * Properties:
 * <ul>
 * 
 * <li>ItemName: string</li>
 * <li>NextToken: string</li>
 *
 * </ul>
 */ 
class Amazon_SimpleDB_Model_QueryResult extends Amazon_SimpleDB_Model
{


    /**
     * Construct new Amazon_SimpleDB_Model_QueryResult
     * 
     * @param mixed $data DOMElement or Associative Array to construct from. 
     * 
     * Valid properties:
     * <ul>
     * 
     * <li>ItemName: string</li>
     * <li>NextToken: string</li>
     *
     * </ul>
     */
    public function __construct($data = null)
    {
        $this->_fields = array (
        'ItemName' => array('FieldValue' => array(), 'FieldType' => array('string')),
        'NextToken' => array('FieldValue' => null, 'FieldType' => 'string'),
        );
        parent::__construct($data);
    }

        /**
     * Gets the value of the ItemName .
     * 
     * @return array of string ItemName
     */
    public function getItemName() 
    {
        return $this->_fields['ItemName']['FieldValue'];
    }

    /**
     * Sets the value of the ItemName.
     * 
     * @param mixed array, or variable number of  string ItemName
     * @return this instance
     */
    public function setItemName($value) 
    {
        foreach (func_get_args() as $itemName) {
            if (!$this->_isNumericArray($itemName)) {
                $itemName =  array ($itemName);    
            }
        }
        $this->_fields['ItemName']['FieldValue'] = $itemName;
        return $this;
    }
  

    /**
     * Sets single or multiple values of ItemName list via variable number of arguments. 
     * For example, to set the list with two elements, simply pass two values as arguments to this function
     * <code>withItemName($itemName1, $itemName2)</code>
     * 
     * @param string  $stringArgs one or more ItemName
     * @return Amazon_SimpleDB_Model_QueryResult  instance
     */
    public function withItemName($stringArgs)
    {
        foreach (func_get_args() as $itemName) {
            $this->_fields['ItemName']['FieldValue'][] = $itemName;
        }
        return $this;
    }  
      

    /**
     * Checks if ItemName list is non-empty
     * 
     * @return bool true if ItemName list is non-empty
     */
    public function isSetItemName()
    {
        return count ($this->_fields['ItemName']['FieldValue']) > 0;
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
     * @return Amazon_SimpleDB_Model_QueryResult instance
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





}