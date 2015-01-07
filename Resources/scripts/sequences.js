Ext.require('Phlexible.elementtypes.configuration.FieldConfiguration');
Ext.require('Phlexible.tinymce.configuration.FieldConfigurationTinymce');

Phlexible.elementtypes.configuration.FieldConfiguration.prototype.initMyItems =
	Phlexible.elementtypes.configuration.FieldConfiguration.prototype.initMyItems.createSequence(function() {
        this.items.push({
            xtype: 'tinymce-configuration-field-configuration-tinymce',
			additional: true
        });
    });