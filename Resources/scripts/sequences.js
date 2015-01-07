Ext.require('Phlexible.elementtypes.configuration.FieldConfiguration');

Phlexible.elementtypes.configuration.FieldConfiguration.prototype.initMyItems =
	Phlexible.elementtypes.configuration.FieldConfiguration.prototype.initMyItems.createSequence(function() {
        this.items.push({
            xtype: 'tinymce-configuration-field-configuration-tinymce',
			additional: true
        });
    });