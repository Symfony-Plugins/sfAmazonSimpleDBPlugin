<?php
// initializes testing framework
$app = 'main';
$sf_root = dirname(__FILE__).'/../../../..';
include($sf_root.'/test/bootstrap/functional.php');
require_once($sf_root.'/lib/symfony/vendor/lime/lime.php');

$t = new lime_test(54, new lime_output_color());

$service = sfAmazonSimpleDBClient::getInstance();
$t->isa_ok($service, 'sfAmazonSimpleDBClient', 'getClient() retrieve an Amazon_SimpleDB_Client instance');

$t->diag('Test domain creation');
try
{
  $domainCreation1 = $service->createDomain('sfAmazonSimpleDBPluginTestDomain');
  $domainCreation2 = $service->createDomain('sfAmazonSimpleDBPluginTestDomain2');
  $domainCreation3 = $service->createDomain('sfAmazonSimpleDBPluginTestDomain3');
  $t->ok($domainCreation1 && $domainCreation2 && $domainCreation3, 'createDomain() confirms domain has been created');
  $t->pass('createDomain() does not throw an exception');
}
catch (Exception $e)
{
  $t->fail('createDomain() throwed an exception: '.$e->getMessage());
}

$t->diag('Test domain list');
try
{
  $domainsResults = $service->listDomains();
  $domainsList = $domainsResults['results'];
  $t->isa_ok($domainsList, 'array', 'listDomains() returns an array');
  $t->ok(in_array('sfAmazonSimpleDBPluginTestDomain', $domainsList), 'listDomains() lists new created domain');
  $t->ok(in_array('sfAmazonSimpleDBPluginTestDomain2', $domainsList), 'listDomains() lists new created domain');
  $t->ok(in_array('sfAmazonSimpleDBPluginTestDomain3', $domainsList), 'listDomains() lists new created domain');
  
  $t->diag('Testing limit and offseting for domains list');
  $domainsResults = $service->listDomains(2);
  $domainsList = $domainsResults['results'];
  $t->is(count($domainsList), 2, 'listDomains() retrieves the correct limited number of results');
  $t->ok(isset($domainsResults['next_token']), 'listDomains() returns a next token');
  
  $domainsResultsNext = $service->listDomains(2, $domainsResults['next_token']);
  $domainsResultsListNext = $domainsResultsNext['results'];
  $t->is(count($domainsResultsListNext), 1, 'listDomains() retrieves the correct limited number of results with an offset');
  
  $t->pass('listDomains() does not throw an exception');
}
catch (Exception $e)
{
  $t->fail('listDomains() throwed an exception: '.$e->getMessage());
}

$t->diag('Test domain selection');
$t->is($service->getSelectedDomain(), null, 'getSelectedDomain() is not prefilled');
$service->selectDomain('sfAmazonSimpleDBPluginTestDomain');
$t->is($service->getSelectedDomain(), 'sfAmazonSimpleDBPluginTestDomain', 'selectDomain() and getSelectedDomain() works');

$t->diag('Test data attributes creation');
try
{
  $service->putAttributes('Entry #1', array('Color' => 'Blue', 'Size' => 'Big'));
  $service->putAttributes('Entry #2', array('Color' => 'Red', 'Size' => 'Medium'));
  $service->putAttributes('Entry #3', array('Color' => array('Yellow', 'Green', 'Purple'), 'Size' => 'Small'));
  $t->pass('putAttributes() does not throw an exception');
}
catch (Exception $e)
{
  $t->fail('putAttributes() throwed an exception: '.$e->getMessage());
}

$t->diag('Test data attributes retrieval');
try
{
  $entry1 = $service->getAttributes('Entry #1');
  $t->is($entry1['Color'], 'Blue', 'getAttributes() retrieve attribute correctly');
  $t->is($entry1['Size'],  'Big',  'getAttributes() retrieve attribute correctly');
  
  $entry2 = $service->getAttributes('Entry #2');
  $t->is($entry2['Color'], 'Red',    'getAttributes() retrieve attribute correctly');
  $t->is($entry2['Size'],  'Medium', 'getAttributes() retrieve attribute correctly');
  
  $t->diag('Test multi-attributes data retrieval');
  $entry3 = $service->getAttributes('Entry #3');
  $t->ok(in_array('Yellow', $entry3['Color']), 'getAttributes() retrieve one of multiple attribute correctly');
  $t->ok(in_array('Green',  $entry3['Color']), 'getAttributes() retrieve one of multiple attribute correctly');
  $t->ok(in_array('Purple', $entry3['Color']), 'getAttributes() retrieve one of multiple attribute correctly');
  $t->is($entry3['Size'],  'Small',  'getAttributes() retrieve attribute correctly');
  
  $t->pass('getAttributes() does not throw an exception');
}
catch (Exception $e)
{
  $t->fail('getAttributes() throwed an exception: '.$e->getMessage());
}

$t->diag('Test querying');
try
{
  $t->diag(' 1. Getting all data');
  $queryResults = $service->query();
  $queryResultsList = $queryResults['results'];
  $t->isa_ok($queryResultsList, 'array', 'query() retrieves results as an array');
  $t->is(count($queryResultsList), 3, 'query() retrieves the correct number of results');
  
  $t->diag(' 2. Filtering one attribute');
  $queryResults = $service->query("['Color' = 'Red']");
  $queryResultsList = $queryResults['results'];
  $t->isa_ok($queryResultsList, 'array', 'query() retrieves results as an array');
  $t->is(count($queryResultsList), 1, 'query() retrieves the correct number of results');
  $t->is($queryResultsList[0], 'Entry #2', 'query() retrieves the correct result');
  
  $t->diag(' 3. Filtering multiple attributes');
  $queryResults = $service->query("['Color' = 'Green'] intersection ['Size' = 'Small']");
  $queryResultsList = $queryResults['results'];
  $t->is(count($queryResultsList), 1, 'query() retrieves the correct number of results');
  $t->is($queryResultsList[0], 'Entry #3', 'query() retrieves the correct result');
  
  $t->diag(' 4. Testing limit and offseting for results list');
  $queryResults = $service->query(null, 2);
  $queryResultsList = $queryResults['results'];
  $t->is(count($queryResultsList), 2, 'query() retrieves the correct limited number of results');
  $t->ok(isset($queryResults['next_token']), 'query() retrieves a next token attribute');
    
  $queryResultsNext = $service->query(null, 2, $queryResults['next_token']);
  $queryResultsListNext = $queryResultsNext['results'];
  $t->is(count($queryResultsListNext), 1, 'query() retrieves the correct limited number of results with an offset');
  
  $t->pass('query() does not throw an exception');
}
catch (Exception $e)
{
  $t->fail('query() throwed an exception: '.$e->getMessage());
}

$t->diag('Test attribute replacement');
try
{
  $replacement = $service->putAttributes('Entry #2', array('Color' => 'Black',
                                                           'Size'  => 'Tiny'), true);
  $t->ok($replacement, 'putAttributes() declares replacement done');
  $entry2 = $service->getAttributes('Entry #2');
  $t->is($entry2['Color'], 'Black', 'getAttributes() retrieve attribute correctly');
  $t->is($entry2['Size'],  'Tiny',  'getAttributes() retrieve attribute correctly');
  $t->pass('putAttributes() does not throw an exception');
}
catch (Exception $e)
{
  $t->fail('putAttributes() throwed an exception: '.$e->getMessage());
}

$t->diag('Test attribute deletion');
try
{
  $t->diag(' 1. by attribute name and value');
  $attributesDeletion = $service->deleteAttributes('Entry #3', 'Color', 'Green');
  $t->ok($attributesDeletion, 'deleteAttributes() declares deletion by name and value has been done');
  $entry3 = $service->getAttributes('Entry #3');
  $t->ok(!in_array('Green', $entry3['Color']), 'getAttributes() does not retrieve a deleted attribute');
  $t->ok(in_array('Yellow', $entry3['Color']), 'getAttributes() still retrieve other attribute correctly');
  $t->ok(in_array('Purple', $entry3['Color']), 'getAttributes() still retrieve other attribute correctly');
  
  $t->diag(' 2. by attribute name');
  $attributesDeletion = $service->deleteAttributes('Entry #3', 'Color');
  $t->ok($attributesDeletion, 'deleteAttributes() declares deletion by name has been done');
  $entry3 = $service->getAttributes('Entry #3');
  $t->ok(!array_key_exists('Color', $entry3), 'getAttributes() retrieves no values for deleted attribute name');
  
  $t->pass('deleteAttributes() does not throw an exception');
}
catch (Exception $e)
{
  $t->fail('deleteAttributes() throwed an exception: '.$e->getMessage());
}

$t->diag('Test item deletion');
try
{
  $entryDeletion = $service->deleteAttributes('Entry #2');
  $t->ok($entryDeletion, 'deleteAttributes() confirms entry has been deleted');
  $entry2 = $service->getAttributes('Entry #2');
  $t->is(count($entry2), 0, 'deleteAttributes() Entry no more exists');
  $t->pass('deleteAttributes() does not throw an exception');
}
catch (Exception $e)
{
  $t->fail('deleteAttributes() throwed an exception: '.$e->getMessage());
}

$t->diag('Test domain deletion');
try
{
  $domainDeletion1 = $service->deleteDomain('sfAmazonSimpleDBPluginTestDomain');
  $domainDeletion2 = $service->deleteDomain('sfAmazonSimpleDBPluginTestDomain2');
  $domainDeletion3 = $service->deleteDomain('sfAmazonSimpleDBPluginTestDomain3');
  $t->ok($domainDeletion1 && $domainDeletion2 && $domainDeletion3, 'deleteDomain() confirms domain has been deleted');
  $t->pass('deleteDomain() does not throw an exception');
}
catch (Exception $e)
{
  $t->fail('deleteDomain() throwed an exception: '.$e->getMessage());
}

$domainsResults = $service->listDomains();
$domainsList = $domainsResults['results'];
$t->ok(!in_array('sfAmazonSimpleDBPluginTestDomain', $domainsList), 'listDomains() no more lists deleted domain');
$t->ok(!in_array('sfAmazonSimpleDBPluginTestDomain2', $domainsList), 'listDomains() no more lists deleted domain');
$t->ok(!in_array('sfAmazonSimpleDBPluginTestDomain3', $domainsList), 'listDomains() no more lists deleted domain');
$t->is($service->getSelectedDomain(), null, 'getSelectedDomain() no more returns a deleted domain as selected');