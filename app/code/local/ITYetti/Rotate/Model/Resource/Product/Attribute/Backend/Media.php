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

class ITYetti_Rotate_Model_Resource_Product_Attribute_Backend_Media extends Mage_Catalog_Model_Resource_Product_Attribute_Backend_Media
{
    /**
     * @param array $productIds
     * @param $storeId
     * @param int $attributeId
     * @return Varien_Db_Select
     */
    protected function _getLoadGallerySelect(array $productIds, $storeId, $attributeId)
    {
        $adapter = $this->_getReadAdapter();

        $positionCheckSql = $adapter->getCheckSql('value.position IS NULL', 'default_value.position', 'value.position');

        // Select gallery images for product
        $select = $adapter->select()
            ->from(
                array('main' => $this->getMainTable()),
                array('value_id', 'value AS file', 'product_id' => 'entity_id')
            )
            ->joinLeft(
                array('value' => $this->getTable(self::GALLERY_VALUE_TABLE)),
                $adapter->quoteInto('main.value_id = value.value_id AND value.store_id = ?', (int)$storeId),
                array('label', 'position', 'disabled', 'rotate')
            )
            ->joinLeft( // Joining default values
                array('default_value' => $this->getTable(self::GALLERY_VALUE_TABLE)),
                'main.value_id = default_value.value_id AND default_value.store_id = 0',
                array(
                    'label_default' => 'label',
                    'position_default' => 'position',
                    'disabled_default' => 'disabled',
                    'rotate_default' => 'rotate'
                )
            )
            ->where('main.attribute_id = ?', $attributeId)
            ->where('main.entity_id in (?)', $productIds)
            ->order($positionCheckSql . ' ' . Varien_Db_Select::SQL_ASC);

        return $select;
    }

}