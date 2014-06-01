/* Functions for the advlink plugin popup */

tinyMCEPopup.requireLangPack();

var templates = {
	"window.open" : "window.open('${url}','${target}','${options}')"
};

function showPhlexibleLinkWindow() {
    var w = new parent.Phlexible.tinymce.LinkWindow({
        submitParams: {
            siteroot_id: '48ef589f-2ddc-4cb6-9a54-7e0dc0a8005b'
        },
        listeners: {
            submit: function(values){
                console.log(values);
                toPhlexibleLink(values.tid);
            }
        }
    });
    w.show();
}
function toPhlexibleLink(tid) {
    document.getElementById('href').value = '[tid=' + tid + ']';
}

// While loading
preinit();
tinyMCEPopup.onInit.add(init);
