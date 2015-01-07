Ext.provide('Phlexible.tinymce.field.HtmlEditor');
Ext.require('Ext.ux.TinyMCE');

Phlexible.tinymce.field.HtmlEditor = Ext.extend(Ext.ux.TinyMCE, {
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
        Phlexible.tinymce.field.HtmlEditor.superclass.onRender.call(this, ct, position);

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
Ext.reg('tinymce-field-editor', Phlexible.tinymce.field.HtmlEditor);
