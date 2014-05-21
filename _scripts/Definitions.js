Ext.ns('Phlexible.tinymce');

Phlexible.elementtypes.ElementtypeField.prototype.initMyItems =
    Phlexible.elementtypes.ElementtypeField.prototype.initMyItems.createSequence(function() {
        this.items.push({
            xtype: 'tinymce-field-tinymce',
            hidden: true,
            isFieldAccordion: true,
            key: 'configuration'
        });
    });