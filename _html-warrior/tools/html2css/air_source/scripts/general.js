function applicationExit(){
    var exitingEvent = new air.Event(air.Event.EXITING, false, true);
    air.NativeApplication.nativeApplication.dispatchEvent(exitingEvent);
    if (!exitingEvent.isDefaultPrevented()) {
        air.NativeApplication.nativeApplication.exit();
    }
}

$(document).ready(function() {
    var outbutton = $('#outbutton');
    var in_div = $('#in');
    var out_div = $('#out');

    if(air.Clipboard.generalClipboard.hasFormat(air.ClipboardFormats.TEXT_FORMAT)) {
        var clipboard = air.Clipboard.generalClipboard.getData(air.ClipboardFormats.TEXT_FORMAT);
        in_div.val(clipboard);
    }

    out_div.click(function() {
        this.select();
    })

    var html2css = function() {
        
        var tree = $(in_div.val());
        
        var line = '';
        var out = '';
        var a_out = new Array();

        var children = tree.find('*');
        var root = tree.get(0);
        var root_id = root.id ? '#' + root.id : '.' + root.className;
        a_out[root_id] = '';
        children.each(function() {
            var tag = this.tagName.toLowerCase();
            var tag_id = this.id ? '#' + this.id : '';
            tag_id += this.className ? '.' + this.className : '';
            var final_tag = tag_id == '' ? tag : tag_id;
            line = root_id + ' ' + final_tag;
            a_out[line] = '';
        })

        for(key in a_out) {
            out += key + ' {}' + "\n";
        }

        out_div.html(out);
    }

    html2css();

    if(air.Clipboard.generalClipboard.hasFormat(air.ClipboardFormats.TEXT_FORMAT)) {
        air.Clipboard.generalClipboard.setData(air.ClipboardFormats.TEXT_FORMAT, out_div.val());
    }

    applicationExit();

    outbutton.click(function () {
        html2css();
    })
});