Phlexible.elementtypes.configuration.FieldConfigurationTinymce = Ext.extend(Ext.form.FieldSet, {
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
			xtype: 'propertygrid',
			hideMode: 'offsets',
			width: 400,
			height: 200,
			fieldLabel: '',
			labelSeparator: '',
			source: {},
			isFormField: true,
			disabled: true,
			tbar: [{
				text: this.strings.add,
				disabled: true,
				handler: function() {
					this.getComponent(1).getSource()[Ext.id()] = 'new';
				},
				scope: this
			},{
				text: this.strings.rename,
				disabled: true,
				handler: function() {

				},
				scope: this
			},{
				text: this.strings.remove,
				disabled: true,
				handler: function() {

				},
				scope: this
			}],
			listeners: {
				propertychange: function(config) {
					this.getComponent(2).setValue(JSON.stringify(config, null, "  "));
				},
				scope: this
			},
			validate: function() {
				return true;
			}
		},{
            xtype: 'textarea',
            name: 'tinymce_config',
            fieldLabel: this.strings.preview,
			width: 400,
            height: 200,
			readOnly: true,
			style: 'overflow: auto; white-space: nowrap; font-family: monospace;'
        }];

		this.on({
			show: function() {
				this.getComponent(1).getView().fitColumns(false, false);
			},
			scope: this
		});

        Phlexible.elementtypes.configuration.FieldConfigurationTinymce.superclass.initComponent.call(this);
    },

	updateVisibility: function(type) {
		var isTinymce = type === 'editor';
		this.getComponent(0).setDisabled(!isTinymce);
		this.getComponent(1).setDisabled(!isTinymce);
		this.getComponent(2).setDisabled(!isTinymce);
		this.setVisible(isTinymce);
	},

	loadData: function(fieldData, fieldType) {
		var defaultConfig = {
			"theme":"advanced",
			"plugins":"safari,advlink,searchreplace,contextmenu,paste,noneditable,visualchars,xhtmlxtras",
			"theme_advanced_buttons1":"code,|,cut,copy,paste,pastetext,pasteword,|,removeformat,cleanup,|,search,replace,|,undo,redo",
			"theme_advanced_buttons2":"bold,italic,|,sub,sup,|,blockquote,cite,abbr,acronym,|,visualchars,|,charmap,|,bullist,numlist,|,link,unlink",
			"theme_advanced_buttons3":"",
			"theme_advanced_buttons4":"",
			"theme_advanced_toolbar_location":"top",
			"theme_advanced_toolbar_align":"left",
			"theme_advanced_statusbar_location":"bottom",
			"theme_advanced_resizing":false,
			"extended_valid_elements":"a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
			"template_external_list_url":"example_template_list.js"
		};

		var tinymceConfigSerialized = fieldData.tinymce_config ? JSON.stringify(JSON.parse(fieldData.tinymce_config), null, "  ") : JSON.stringify(defaultConfig, null, "  ");
		var tinymceConfig = fieldData.tinymce_config ? Ext.decode(fieldData.tinymce_config) : defaultConfig;

        this.getComponent(0).setValue(fieldData.tinymce_config_override);
        this.getComponent(1).setSource(tinymceConfig);
        this.getComponent(2).setValue(tinymceConfigSerialized);

		if (this.getComponent(0).getValue()) {
			this.getComponent(1).enable();
		} else {
			this.getComponent(1).disable();
		}
		this.getComponent(1).getView().fitColumns(false, false);

        this.isValid();
    },

    getSaveValues: function() {
        return {
			tinymce_config_override: this.getComponent(0).getValue(),
			tinymce_config: this.getComponent(0).getValue() ? Ext.encode(this.getComponent(1).getSource()) : null
		};
    },

    isValid: function() {
        return true;
	}
});

Ext.reg('tinymce-configuration-field-configuration-tinymce', Phlexible.elementtypes.configuration.FieldConfigurationTinymce);