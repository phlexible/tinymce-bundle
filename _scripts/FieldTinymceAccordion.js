Phlexible.elementtypes.FieldTinymceAccordion = Ext.extend(Ext.FormPanel, {
    title: 'TinyMCE',
    iconCls: 'p-tinymce-field_editor-icon',
    border: false,
    bodyStyle: 'padding:3px',
    defaultType: 'textfield',
    labelWidth: 150,

    initComponent: function() {
        this.items = [{
            xtype: 'textarea',
            name: 'tynymce_config',
            fieldLabel: Phlexible.elementtypes.Strings.configuration,
            anchor: '-10',
            height: 300,
            validator: function(value) {
                if (!value) {
                    return true;
                }
                try {
                    if (Ext.decode(value)) {
                        return true;
                    }
                } catch (e) {

                }
                return false;
            }
        }];

        Phlexible.elementtypes.FieldTinymceAccordion.superclass.initComponent.call(this);
    },

    loadData: function(fieldData, fieldType) {
        var defaults = Phlexible.clone(Phlexible.elementtypes.FieldMap.configuration);

        for (var i in fieldData) {
            if (fieldData[i] === undefined) delete fieldData[i];
        }

        Ext.applyIf(fieldData, defaults);

        this.getForm().setValues([
            {id: 'tynymce_config', value: fieldData.tynymce_config},
        ]);

        this.isValid();
    },

    getSaveValues: function() {
        var data = this.getForm().getValues();
        return data;
    },

    isValid: function() {
        if(this.getForm().isValid()) {
            //this.header.child('span').removeClass('error');
            this.setIconClass('p-elementtypes-field_table-icon');

            return true;
        } else {
            //this.header.child('span').addClass('error');
            this.setIconClass('p-elementtypes-tab_error-icon');

            return false;
        }
    },

    loadField: function(properties, node, fieldType) {
        if (node.attributes.type === 'editor') {
            this.ownerCt.getTabEl(this).hidden = false;
            this.enable();
            this.loadData(properties.configuration, fieldType);
        }
        else {
            this.ownerCt.getTabEl(this).hidden = true;
            this.hide();
            this.disable();
        }
    }
});

Ext.reg('tinymce-field-tinymce', Phlexible.elementtypes.FieldTinymceAccordion);