Phlexible.tinymce.HtmlEditor = Ext.extend(Ext.ux.TinyMCE, {
    hideMode: 'offsets',

    removeControl: function() {
        tinyMCE.execCommand('mceRemoveControl', false, this.textareaEl.id);
    },

    restoreControl: function() {
        this.ed.destroy();
        delete this.ed;

        this.createEditor(this.textareaEl.id);
    },

    // private
    onRender : function(ct, position){
        Phlexible.tinymce.HtmlEditor.superclass.onRender.call(this, ct, position);

        if (this.element && this.diff) {
            var targetEl = this.el;
            this.ed.onClick.add(function(ed, e) {
                Phlexible.console.log(arguments);
                if (this.element.activeDiffEl && this.element.activeDiffEl.isVisible()) { // && !e.within(targetEl.dom, false, true) && !e.within(this.element.activeDiffEl.dom, false, true)){
                    this.element.activeDiffEl.hide();
                    this.element.activeDiffEl = null;
                }

                if (!this.diffEl) {
                    var height = (targetEl.getHeight && targetEl.getHeight() > 32) ? targetEl.getHeight() : 32;
                    var html = '';
                    if (this.diff['type'] == 'change') {
                        html = this.diff.content_diff;
                    }
                    else {
                        html = Phlexible.fields.Strings.diff_new_field;
                        height = 14;
                    }

                    this.diffEl = targetEl.insertSibling({
                        tag: 'div',
                        html: html,
                        cls: 'm-fields-diff-inline',
                        style: 'height: ' + height + 'px;'
                    }, 'after');
                    this.diffEl.setVisibilityMode(Ext.Element.DISPLAY);
                    this.element.activeDiffEl = this.diffEl;
                }
                else {
                    if (!this.diffEl.isVisible()) {
                        this.diffEl.show();
                        this.element.activeDiffEl = this.diffEl;
                    }
                }
            }.createDelegate(this));
        }
    }
});
Ext.reg('tinymce-field-editor', Phlexible.tinymce.HtmlEditor);

Phlexible.fields.Registry.addFactory('editor', function(parentConfig, item, valueStructure, pos, element, repeatablePostfix, forceAdd) {
	if (element.master) {
		element.prototypes.addFieldPrototype(item);
	}

	element.prototypes.incCount(item.dsId);

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

	var config = Phlexible.fields.FieldHelper.defaults(parentConfig, item, element, repeatablePostfix, forceAdd);

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
    allowedIn: ['tab','accordion','group','referenceroot'],
    iconCls: 'p-tinymce-field_editor-icon',
    accordions: ['fieldproperties','fieldlabels','fieldconfiguration','fieldvalues','fieldvalidation'],
    defaultValueField: 'default_value_textarea',
    config: {
        properties: {
        },
        labels: {
            field: 1,
            box: 0,
            prefix: 1,
            suffix: 1,
            context: 1
        },
        configuration: {
            sync: 1,
            width: 1,
            height: 1,
            readonly: 1,
            hide_label: 1,
            sortable: 0,
            repeat: 0,
            group: 0,
            link: 0,
            table: 0,
            accordion: 0
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
            required: 1,
            text: 1,
            numeric: 0,
            content: 1
        }
    }
});
