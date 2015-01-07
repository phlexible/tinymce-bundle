Ext.require('Phlexible.fields.Registry');
Ext.require('Phlexible.fields.FieldTypes');
Ext.provide('Phlexible.tinymce.field.HtmlEditor');

Phlexible.fields.Registry.addFactory('editor', function(parentConfig, item, valueStructure, element, repeatableId) {
	var isMaster = element.master;
	var isSynchronized = (item.configuration['synchronized'] === 'synchronized' || item.configuration['synchronized'] === 'synchronized_unlink');

	var tinymceReadonly = (isSynchronized && !isMaster) || false;

	//plugins: "safari,style,layer,table,advimage,advlink,iespell,insertdatetime,preview,media,searchreplace,contextmenu,paste,directionality,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
	var tinymceSettings = item.configuration.tinymce_config_override && item.configuration.tinymce_config
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

	/*
	 {
	 theme: "advanced",
	 plugins: "safari,advlink,searchreplace,contextmenu,paste,noneditable,visualchars,xhtmlxtras",
	 theme_advanced_buttons1: "code,|,cut,copy,paste,pastetext,pasteword,|,removeformat,cleanup,|,search,replace,|,undo,redo",
	 theme_advanced_buttons2: "bold,italic,|,sub,sup,|,blockquote,cite,abbr,acronym,|,visualchars,|,charmap,|,bullist,numlist,|,link,unlink",
	 theme_advanced_buttons3: "",
	 theme_advanced_buttons4: "",
	 theme_advanced_toolbar_location: "top",
	 theme_advanced_toolbar_align: "left",
	 theme_advanced_statusbar_location: "bottom",
	 theme_advanced_resizing: false,
	 extended_valid_elements: "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
	 template_external_list_url: "example_template_list.js"
	 };
	 */
	tinymceSettings.readonly = tinymceReadonly;
	tinymceSettings.phlx_element = element;

    var config = Phlexible.fields.FieldHelper.defaults(parentConfig, item, valueStructure, element, repeatableId);

	Ext.apply(config, {
		xtype: 'tinymce-field-editor',
		tinymceSettings: tinymceSettings,
		width: parseInt(item.configuration.width, 10) || 600,
		height: parseInt(item.configuration.height, 10) || 300,

		supportsPrefix: true,
		supportsSuffix: true,
		//supportsDiff: true,
		supportsUnlink: true
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
