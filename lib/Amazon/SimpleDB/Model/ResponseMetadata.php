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
 * Amazon_SimpleDB_Model_ResponseMetadata
 * 
 * Properties:
 * <ul>
 * 
 * <li>RequestId: string</li>
 * <li>BoxUsage: string</li>
 *
 * </ul>
 */ 
class Amazon_SimpleDB_Model_ResponseMetadata extends Amazon_SimpleDB_Model
{


    /**
     * Construct new Amazon_SimpleDB_Model_ResponseMetadata
     * 
     * @param mixed $data DOMElement or Associative Array to construct from. 
     * 
     * Valid properties:
     * <ul>
     * 
     * <li>RequestId: string</li>
     * <li>BoxUsage: string</li>
     *
     * </ul>
     */
    public function __construct($data = null)
    {
        $this->_fields = array (
        'RequestId' => array('FieldValue' => null, 'FieldType' => 'string'),
        'BoxUsage' => array('FieldValue' => null, 'FieldType' => 'string'),
        );
        parent::__construct($data);
    }

        /**
     * Gets the value of the RequestId property.
     * 
     * @return string RequestId
     */
    public function getRequestId() 
    {
        return $this->_fields['RequestId']['FieldValue'];
    }

    /**
     * Sets the value of the RequestId property.
     * 
     * @param string RequestId
     * @return this instance
     */
    public function setRequestId($value) 
    {
        $this->_fields['RequestId']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Sets the value of the RequestId and returns this instance
     * 
     * @param string $value RequestId
     * @return Amazon_SimpleDB_Model_ResponseMetadata instance
     */
    public function withRequestId($value)
    {
        $this->setRequestId($value);
        return $this;
    }


    /**
     * Checks if RequestId is set
     * 
     * @return bool true if RequestId  is set
     */
    public function isSetRequestId()
    {
        return !is_null($this->_fields['RequestId']['FieldValue']);
    }

    /**
     * Gets the value of the BoxUsage property.
     * 
     * @return string BoxUsage
     */
    public function getBoxUsage() 
    {
        return $this->_fields['BoxUsage']['FieldValue'];
    }

    /**
     * Sets the value of the BoxUsage property.
     * 
     * @param string BoxUsage
     * @return this instance
     */
    public function setBoxUsage($value) 
    {
        $this->_fields['BoxUsage']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Sets the value of the BoxUsage and returns this instance
     * 
     * @param string $value BoxUsage
     * @return Amazon_SimpleDB_Model_ResponseMetadata instance
     */
    public function withBoxUsage($value)
    {
        $this->setBoxUsage($value);
        return $this;
    }


    /**
     * Checks if BoxUsage is set
     * 
     * @return bool true if BoxUsage  is set
     */
    public function isSetBoxUsage()
    {
        return !is_null($this->_fields['BoxUsage']['FieldValue']);
    }





}