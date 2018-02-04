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

class ITYetti_Rotate_Helper_Config extends Mage_Core_Helper_Abstract
{
    const XML_PATH_GENERAL_ENABLE = 'ityetti/ityetti_group/ityetti_enable';
    const XML_PATH_GENERAL_WIDTH = 'ityetti/ityetti_group/ityetti_width';
    const XML_PATH_GENERAL_HEIGHT = 'ityetti/ityetti_group/ityetti_height';
    const XML_PATH_GENERAL_FRAME_TIME = 'ityetti/ityetti_group/ityetti_frame_time';
    const XML_PATH_GENERAL_FRAMES = 'ityetti/ityetti_group/ityetti_frames';

    /**
     * Module enable or disable
     *
     * @return int|mixed
     */
    public function isEnabled()
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_GENERAL_ENABLE);
    }

    /**
     * Get image width
     *
     * @param $storeId
     * @return mixed
     */
    public function getImageWidth($storeId)
    {
        return Mage::getStoreConfig(self::XML_PATH_GENERAL_WIDTH, $storeId);
    }

    /**
     * Get image height
     *
     * @param $storeId
     * @return mixed
     */
    public function getImageHeight($storeId)
    {
        return Mage::getStoreConfig(self::XML_PATH_GENERAL_HEIGHT, $storeId);
    }

    /**
     * Time in ms between update
     *
     * @param $storeId
     * @return mixed
     */
    public function getFrameRates($storeId)
    {
        return Mage::getStoreConfig(self::XML_PATH_GENERAL_FRAME_TIME, $storeId);
    }

    /**
     * Total number of frames
     *
     * @param $storeId
     * @return mixed
     */
    public function getFrames($storeId)
    {
        return Mage::getStoreConfig(self::XML_PATH_GENERAL_FRAMES, $storeId);
    }

    /**
     * Get correct url path for rotate image
     *
     * @return string
     */
    public function urlPathForRotateImage()
    {
        return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'catalog/product';
    }
}