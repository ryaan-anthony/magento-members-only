<?php
/** @var Mage_Customer_Model_Resource_Setup $this */

$this->startSetup();

$attributeCode = 'agreed_to_terms';

$this->addAttribute('customer', $attributeCode, [
    'label' => 'Approved',
    'input' => 'select',
    'type' => 'int',
    'source' => 'eav/entity_attribute_source_boolean',
    'visible' => true,
    'position' => 1,
]);

/** @var Mage_Eav_Model_Config $eavConfig */
$eavConfig = Mage::getSingleton('eav/config');

$eavAttribute = $eavConfig->getAttribute('customer', $attributeCode);

$eavAttribute->setData('used_in_forms', ['adminhtml_customer']);

$eavAttribute->save();

$this->endSetup();
