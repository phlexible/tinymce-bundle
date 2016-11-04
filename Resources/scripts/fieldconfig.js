Ext.require('Phlexible.fields.Registry');
Ext.require('Phlexible.fields.FieldTypes');
Ext.require('Phlexible.fields.FieldHelper');
Ext.require('Phlexible.tinymce.field.HtmlEditor');

Phlexible.fields.Registry.addFactory('editor', function(parentConfig, item, valueStructure, element, repeatableId) {
	var config = Phlexible.fields.FieldHelper.defaults(parentConfig, item, valueStructure, element, repeatableId),
	    tinymceSettings = item.configuration.tinymce_config_override && item.configuration.tinymce_config
		    ? Ext.decode(item.configuration.tinymce_config)
		    : Phlexible.clone(window.tinymceSettings);

	if (item.diff) {
		switch (item.diff.type) {
			case 'change':
				tinymceSettings.content_css = Phlexible.Router.generate('tiymce_contentcss_change');
				break;

			case 'new':
				tinymceSettings.content_css = Phlexible.Router.generate('tiymce_contentcss_new');
				break;
		}
	}

	//tinymceSettings.readonly = (config.isSynchronized && !config.isMaster) || false;
	tinymceSettings.phlx_element = element;

	Ext.apply(config, {
		xtype: 'tinymce-field-editor',
		tinymceSettings: tinymceSettings,
		width: parseInt(item.configuration.width, 10) || 600,
		height: parseInt(item.configuration.height, 10) || 300,

		supportsPrefix: true,
		supportsSuffix: true,
		//supportsDiff: true,
		supportsUnlink: true,
		onUnlink: function(c) {
			c.ed.getBody().setAttribute('contenteditable', true);
		},
		onRelink: function(c) {
			c.ed.getBody().setAttribute('contenteditable', false);
		},
        onApplyUnlink: function(c) {
            if (!c.isMaster && c.hasUnlink && !c.isUnlinked) {
                c.ed.getBody().setAttribute('contenteditable', false);
            }
        }
	});

	return config;
});

Phlexible.fields.FieldTypes.addField('editor', {
    titles: {
        de: 'Editor',
        en: 'Editor'
    },
    iconCls: 'p-tinymce-field_editor-icon',
    allowedIn: [
		'tab',
		'accordion',
		'group',
		'referenceroot'
	],
	allowMap: true,
    defaultValueField: 'default_value_textarea',
    config: {
        labels: {
            field: 1,
            box: 0,
            prefix: 1,
            suffix: 1,
            help: 1
        },
        configuration: {
            required: 1,
            sync: 1,
            width: 1,
            height: 1,
            readonly: 1,
            hide_label: 1,
            sortable: 0
        },
        values: {
            default_text: 0,
            default_number: 0,
            default_textarea: 1,
            default_date: 0,
            default_time: 0,
            default_select: 0,
            default_link: 0,
            default_checkbox: 0,
            default_table: 0,
            source: 0,
            source_values: 0,
            source_function: 0,
            source_datasource: 0,
            text: 0
        },
        validation: {
            text: 1,
            numeric: 0,
            content: 1
        }
    }
});
