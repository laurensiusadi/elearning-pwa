(function() {

// Base template
var base_tpl =
        "<!doctype html>\n" +
        "<html>\n\t" +
  "<head>\n\t\t" +
  "<meta charset=\"utf-8\">\n\t\t" +
  "<title>Render</title>\n\n\t\t\n\t" +
  "</head>\n\t" +
  "<body>\n\t\n\t" +
  "</body>\n" +
  "</html>";

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
// html_editor.on('change', function (inst, changes) {
//     render();
// });

// CSS EDITOR
var css_editor = codemirror_grammar(document.querySelector("#css textarea"), [
    {language : "css", grammar : css_grammar}
]);
// css_editor.on('change', function (inst, changes) {
//     render();
// });

// JAVASCRIPT EDITOR
var js_editor = codemirror_grammar(document.querySelector("#js textarea"), [
    {language : "javascript", grammar : js_grammar}
]);
// js_editor.on('change', function (inst, changes) {
//     render();
// });

$("#run").click(function(){
    render();
});

window.onload = function() {
    render();
    $('.collapsible').collapsible('open', 0);
};
}());
