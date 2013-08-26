/**
 * editor_plugin_src.js
 *
 * Copyright 2009, Moxiecode Systems AB
 * Released under LGPL License.
 *
 * License: http://tinymce.moxiecode.com/license
 * Contributing: http://tinymce.moxiecode.com/contributing
 */

(function() {
	tinymce.create('tinymce.plugins.PhlexibleLinkPlugin', {
		init : function(ed, url) {
			this.editor = ed;

			// Register commands
			ed.addCommand('mcePhlxLink', function() {
				var se = ed.selection;

				// No selection and not in link
				if (se.isCollapsed() && !ed.dom.getParent(se.getNode(), 'A'))
					return;

                var elm = this.selection.getNode();
                elm = this.dom.getParent(elm, "A");
                var target = this.dom.getAttrib(elm, 'target') || '';
                var href = this.dom.getAttrib(elm, 'href') || '';
                var cls = this.dom.getAttrib(elm, 'class') || '';

                var tid = false;
                if (href) {
                    var m = href.match(/\[tid.([0-9]*)\]/);
                    if (m) {
                        href = m[1];
                        tid = true;
                    }
                }

                var classes = getClasses(ed);

				ed.windowManager.open({
					items: {
                        xtype: 'form',
                        bodyStyle: 'padding: 5px;',
                        border: false,
                        items: [{
                            html: 'Start typing to search for a link target or click the icon to open the link editor.',
                            border: false,
                            bodyStyle: 'padding-bottom: 10px;'
                        },{
                            xtype: 'linkfield',
                            fieldLabel: 'Source element',
                            allSiteroots: true,
                            labelSeparator: '',
                            siteroot_id: ed.settings.phlx_element.siteroot_id,
                            language: ed.settings.phlx_element.language,
                            allowed: {
                                tid: true,
                                intrasiteroot: true,
                                url: true,
                                mailto: true
                            },
                            hideNewWindow: true,
                            hideLanguage: true,
                            anchor: '-70',
                            listWidth: 233,
                            treeWidth: 233,
                            menuConfig: {
                                width: 250
                            },
                            value: href,
                            hiddenValue: tid ? 'id:' + href : href,
                            listeners: {
                                render: function(c) {
                                    if (!tid) return;

                                    Ext.Ajax.request({
                                        url: MWF.baseUrl + '/tinymce/data/link/tid/' + href,
                                        success: function(response) {
                                            var result = Ext.decode(response.responseText);

                                            if (result.success) {
                                                c.setValue(result.data.title);
                                            }
                                        },
                                        scope: c
                                    });
                                }
                            }
                        },{
                            xtype: 'twincombobox',
                            fieldLabel: 'Target',
                            emptyText: 'No target',
                            store: new Ext.data.SimpleStore({
                                fields: ['value'],
                                data: [['_blank'],['_self']],
                                id: 0
                            }),
                            anchor: '-70',
                            listWidth: 233,
                            displayField: 'value',
                            mode: 'local',
                            forceSelection: true,
                            typeAhead: false,
                            editable: false,
                            triggerAction: 'all',
                            selectOnFocus: true,
                            value: target
                        },{
                            xtype: 'twincombobox',
                            hiddenName: 'cls',
                            fieldLabel: 'Class',
                            emptyText: 'No class',
                            store: new Ext.data.SimpleStore({
                                fields: ['key', 'value'],
                                data: classes,
                                id: 0
                            }),
                            anchor: '-70',
                            listWidth: 233,
                            displayField: 'value',
                            valueField: 'key',
                            mode: 'local',
                            forceSelection: true,
                            typeAhead: false,
                            editable: false,
                            triggerAction: 'all',
                            selectOnFocus: true,
                            value: cls
                        }],
                        buttons: [{
                            text: 'Cancel',
                            handler: function(btn) {
                                var window = btn.ownerCt.ownerCt;
                                window.close();
                            },
                            scope: this
                        },{
                            text: 'Set',
                            handler: function(btn) {
                                var inst = this;
                                var elm, elementArray, i;

                                elm = inst.selection.getNode();
                                //checkPrefix(document.forms[0].href);

                                elm = inst.dom.getParent(elm, "A");

                                var form = btn.ownerCt;
                                var href = form.getComponent(1).hiddenValue;
                                var target = form.getComponent(2).getValue();
                                var cls = form.getComponent(3).getValue();
                                var window = form.ownerCt;

                                if (href.substr(0, 3) == 'id:') {
                                    href = '[tid:' + href.substr(3) + ']';
                                }
                                else if (href.substr(0, 3) == 'sr:') {
                                    href = '[tid:' + href.substr(3) + ']';
                                }

                                // Remove element if there is no href
                                if (!href) {
                                    i = inst.selection.getBookmark();
                                    inst.dom.remove(elm, 1);
                                    inst.selection.moveToBookmark(i);
                                    tinymce.execCommand("mceEndUndoLevel");
                                    window.close();
                                    return;
                                }

                                // Create new anchor elements
                                if (elm == null) {
                                    inst.getDoc().execCommand("unlink", false, null);
                                    tinymce.execCommand("mceInsertLink", false, "#mce_temp_url#", {skip_undo : 1});

                                    elementArray = tinymce.grep(inst.dom.select("a"), function(n) {return inst.dom.getAttrib(n, 'href') == '#mce_temp_url#';});
                                    for (i=0; i<elementArray.length; i++)
                                        setAllAttribs(elm = elementArray[i], href, target, cls, inst);
                                } else
                                    setAllAttribs(elm, href, target, cls, inst);

                                // Don't move caret if selection was image
                                if (elm.childNodes.length != 1 || elm.firstChild.nodeName != 'IMG') {
                                    inst.focus();
                                    inst.selection.select(elm);
                                    inst.selection.collapse(0);
                                    // tinymce.storeSelection();
                                }

                                tinymce.execCommand("mceEndUndoLevel");

                                window.close();
                            },
                            scope: this
                        }]
                    },
                    name: 'Link',
					width : 480,
					height : 200,
					inline : 1
				}, {
					plugin_url : url
				});
			});

			// Register buttons
			ed.addButton('link', {
				title : 'advlink.link_desc',
				cmd : 'mcePhlxLink'
			});

			ed.addShortcut('ctrl+k', 'advlink.advlink_desc', 'mcePhlxLink');

			ed.onNodeChange.add(function(ed, cm, n, co) {
				cm.setDisabled('link', co && n.nodeName != 'A');
				cm.setActive('link', n.nodeName == 'A' && !n.name);
			});
		},

		getInfo : function() {
			return {
				longname : 'Phlexible link',
				author : 'Stephan Wentz',
				authorurl : 'http://phlexible.net',
				infourl : 'http://phlexible.net',
				version : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('phlx_link', tinymce.plugins.PhlexibleLinkPlugin);
})();


function setAllAttribs(elm, href, target, cls, ed) {
    var dummy1 = tinymce.settings.url_converter;
    var dummy2 = tinymce.settings.convert_urls;
    tinymce.settings.url_converter = null;
    tinymce.settings.convert_urls = 0;

    setAttrib(elm, 'href', href, ed);
    setAttrib(elm, 'target', target == '_self' ? '' : target, ed);
    setAttrib(elm, 'class', cls, ed);

    tinymce.settings.url_converter = dummy1;
    tinymce.settings.convert_urls = dummy2;

    // Refresh in old MSIE
    if (tinyMCE.isMSIE5)
        elm.outerHTML = elm.outerHTML;
}


function setAttrib(elm, attrib, value, ed) {
    var dom = ed.dom;

    if (typeof(value) == "undefined" || value == null) {
        value = "";
    }

    dom.setAttrib(elm, attrib, value);
}

function getClasses(ed) {
    // Setup class droplist
    var styles = ed.settings.advlink_styles;

    var data = [];
    if (styles) {
        var stylesAr = styles.split(';');

        for (var i=0; i<stylesAr.length; i++) {
            if (stylesAr != "") {
                var keyValue = stylesAr[i].split('=');

                data.push([keyValue[1], keyValue[0]]);
            }
        }
    }
    return data;
}