<?php
/**
 * ITYetti Rotate View
 *
 * @author Borovik Alexey
 * @category ITYetti
 * @package ITYetti_Rotate
 * @copyright Copyright (c) 2018 ITYetti (https://github.com/ityetti)
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

$installer = $this;

$installer->startSetup();

$installer->getConnection()
    ->addColumn($installer->getTable('catalog_product_entity_media_gallery_value'), 'rotate', array(
        'type' => Varien_Db_Ddl_Table::TYPE_SMALLINT,
        'nullable' => false,
        'length' => 5,
        'after' => 'disabled',
        'comment' => 'Rotate'
    ));

$installer->endSetup();