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
 */

interface  Amazon_SimpleDB_Interface 
{
    

            
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
    public function createDomain($action);


            
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
    public function listDomains($action);


            
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
    public function deleteDomain($action);


            
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
    public function putAttributes($action);


            
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
    public function getAttributes($action);


            
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
    public function deleteAttributes($action);


            
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
    public function query($action);

}