define([
    'Magento_Ui/js/form/element/abstract',
    'mageUtils',
    'jquery',
    'mage/url'
], function (Element, utils, $) {
    'use strict';
    return Element.extend({
        initialize: function () {
            this._super();
            if (this.initialValue === ''){
                this.base_url = this.imports.base_url+'pub/media/mary_optn/image/black-cat.png';
            }
            else{
                //debugger;
                this.base_url = this.imports.base_url+'pub/media/'+this.initialValue;
            }
        },

        getFileName: function () {
            $('#cusimg-'+this.uid).attr('src',this.imports.base_url+'pub/media/'+$('#'+this.uid).val());
        },
    });
});
