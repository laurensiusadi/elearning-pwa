(function() {

var prepareSource = function() {
    var code = '<!DOCTYPE html><html><head>';
    code += '<style>'  + css_editor.getValue() + '</style>';
    code += '<body>' + html_editor.getValue();
    code += '<script>' + js_editor.getValue() + '</script>';
    code += '</body></html>';
    return code;
};

var render = function() {
    var source = prepareSource();

    var iframe = document.querySelector('#output iframe'),
    iframe_doc = iframe.contentDocument;

    iframe_doc.open();
    iframe_doc.write(source);
    iframe_doc.close();

    Materialize.toast('Rendered', 1000, 'grey');
};

// HTML EDITOR
var html_editor = codemirror_grammar(document.querySelector("#html textarea"), [
    {language : "htmlmixed", grammar : htmlmixed_grammar}
]);

// CSS EDITOR
var css_editor = codemirror_grammar(document.querySelector("#css textarea"), [
    {language : "css", grammar : css_grammar}
]);

// JAVASCRIPT EDITOR
var js_editor = codemirror_grammar(document.querySelector("#js textarea"), [
    {language : "javascript", grammar : js_grammar}
]);

$("#run").click(function(){
    render();
});

window.onload = function() {
    render();
};
}());
