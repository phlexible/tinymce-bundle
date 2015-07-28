Ext.provide('Phlexible.tinymce.configuration.FieldConfigurationTinymce');

Phlexible.tinymce.configuration.FieldConfigurationTinymce = Ext.extend(Ext.form.FieldSet, {
    title: 'TinyMCE',
	strings: Phlexible.tinymce.Strings,
    iconCls: 'p-tinymce-field_editor-icon',
	autoHeight: true,
	labelWidth: 139,
	hideMode: 'offsets',

    initComponent: function() {
        this.items = [{
			xtype: 'checkbox',
			name: 'tinymce_config_override',
			fieldLabel: Phlexible.elementtypes.Strings.configuration,
			boxLabel: this.strings.override_default_config,
			listeners: {
				check: function(cb, checked) {
					this.getComponent(1).setDisabled(!checked);
				},
				scope: this
			}
		},{
            xtype: 'textarea',
            name: 'tinymce_config',
            fieldLabel: '',
			labelSeparator: '',
			width: 600,
            height: 220,
			style: 'white-space: pre; font-family: monospace; word-wrap: normal; overflow: scroll;'
        }];

		Phlexible.tinymce.configuration.FieldConfigurationTinymce.superclass.initComponent.call(this);
    },

	updateVisibility: function(type) {
		var isTinymce = type === 'editor';
		this.getComponent(0).setDisabled(!isTinymce);
		this.getComponent(1).setDisabled(!isTinymce);
		this.setVisible(isTinymce);
	},

	loadData: function(fieldData, fieldType) {
		var defaultConfig = window.tinymceSettings,
			fieldConfig = fieldData.tinymce_config_override && fieldData.tinymce_config
				? JSON.parse(fieldData.tinymce_config)
				: null;

		var stringifiedConfig = JSON.stringify(fieldConfig || defaultConfig, null, '    ');

        this.getComponent(0).setValue(fieldData.tinymce_config_override);
        this.getComponent(1).setValue(stringifiedConfig);

		if (fieldData.tinymce_config_override) {
			this.getComponent(1).enable();
		} else {
			this.getComponent(1).disable();
		}

        this.isValid();
    },

    getSaveValues: function() {
		var override = this.getComponent(0).getValue(),
			config = this.getComponent(1).getValue();

		if (override && config) {
			config = JSON.stringify(JSON.parse(config));
		} else {
			override = false;
			config = null;
		}

        return {
			tinymce_config_override: override,
			tinymce_config: config
		};
    },

    isValid: function() {
		var override = this.getComponent(0).getValue(),
			config = this.getComponent(1).getValue();

		if (override && config) {
			try {
				config = JSON.stringify(JSON.parse(config));
			} catch (e) {
				config = null;
			}

			if (!config) {
				return false;
			}
		}

		return true;
	}
});

Ext.reg('tinymce-configuration-field-configuration-tinymce', Phlexible.tinymce.configuration.FieldConfigurationTinymce);
