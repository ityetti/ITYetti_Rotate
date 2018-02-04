/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE_AFL.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @copyright   Copyright (c) 2006-2017 X.commerce, Inc. and affiliates (http://www.magento.com)
 * @license     http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

var Product = {};

Product.Gallery = Class.create();
Product.Gallery.prototype = {
    updateImage : function(file) {
        var index = this.getIndexByFile(file);
        this.images[index].label = this
            .getFileElement(file, 'cell-label input').value;
        this.images[index].position = this.getFileElement(file,
            'cell-position input').value;
        this.images[index].removed = (this.getFileElement(file,
            'cell-remove input').checked ? 1 : 0);
        this.images[index].disabled = (this.getFileElement(file,
            'cell-disable input').checked ? 1 : 0);
        this.images[index].rotate = (this.getFileElement(file,
            'cell-rotate input').checked ? 1 : 0);
        this.getElement('save').value = Object.toJSON(this.images);
        this.updateState(file);
        this.container.setHasChanges();
    },
    updateVisualisation : function(file) {
        var image = this.getImageByFile(file);
        this.getFileElement(file, 'cell-label input').value = image.label;
        this.getFileElement(file, 'cell-position input').value = image.position;
        this.getFileElement(file, 'cell-remove input').checked = (image.removed == 1);
        this.getFileElement(file, 'cell-disable input').checked = (image.disabled == 1);
        this.getFileElement(file, 'cell-rotate input').checked = (image.rotate == 1);
        $H(this.imageTypes)
            .each(
                function(pair) {
                    if (this.imagesValues[pair.key] == file) {
                        this.getFileElement(file,
                            'cell-' + pair.key + ' input').checked = true;
                    }
                }.bind(this));
        this.updateState(file);
    }
};