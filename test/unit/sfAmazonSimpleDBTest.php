<?php
// initializes testing framework
$app = 'main';
$sf_root = dirname(__FILE__).'/../../../..';
include($sf_root.'/test/bootstrap/functional.php');
require_once($sf_root.'/lib/symfony/vendor/lime/lime.php');

$t = new lime_test(44, new lime_output_color());

$service = sfAmazonSimpleDBClient::getInstance();
$t->isa_ok($service, 'sfAmazonSimpleDBClient', 'getClient() retrieve an Amazon_SimpleDB_Client instance');

$t->diag('Test domain creation');
try
{
  $domainCreation = $service->createDomain('sfAmazonSimpleDBPluginTestDomain');
  $t->ok($domainCreation, 'createDomain() confirms domain has been created');
  $t->pass('createDomain() does not throw an exception');
}
catch (Exception $e)
{
  $t->fail('createDomain() throwed an exception: '.$e->getMessage());
}

$t->diag('Test domain list');
try
{
  $domainsList = $service->listDomains();
  $t->isa_ok($domainsList, 'array', 'listDomains() returns an array');
  $t->ok(in_array('sfAmazonSimpleDBPluginTestDomain', $domainsList), 'listDomains() lists new created domain');
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
  $query = $service->query();
  $t->isa_ok($query, 'array', 'query() retrieves results as an array');
  $t->is(count($query), 3, 'query() retrieves the correct number of results');
  
  $t->diag(' 2. Filtering one attribute');
  $query = $service->query("['Color' = 'Red']");
  $t->isa_ok($query, 'array', 'query() retrieves results as an array');
  $t->is(count($query), 1, 'query() retrieves the correct number of results');
  $t->is($query[0], 'Entry #2', 'query() retrieves the correct result');
  
  $t->diag(' 3. Filtering multiple attributes');
  $query = $service->query("['Color' = 'Green'] intersection ['Size' = 'Small']");
  $t->is(count($query), 1, 'query() retrieves the correct number of results');
  $t->is($query[0], 'Entry #3', 'query() retrieves the correct result');
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
  $domainDeletion = $service->deleteDomain('sfAmazonSimpleDBPluginTestDomain');
  $t->ok($domainDeletion, 'deleteDomain() confirms domain has been deleted');
  $t->pass('deleteDomain() does not throw an exception');
}
catch (Exception $e)
{
  $t->fail('deleteDomain() throwed an exception: '.$e->getMessage());
}

$domainsList = $service->listDomains();
$t->ok(!in_array('sfAmazonSimpleDBPluginTestDomain', $domainsList), 'listDomains() no more lists deleted domain');
$t->is($service->getSelectedDomain(), null, 'getSelectedDomain() no more returns a deleted domain as selected');