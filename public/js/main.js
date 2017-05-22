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
    var html = html_editor.getValue(),
            css = css_editor.getValue(),
            js = js_editor.getValue(),
            src = '';

    // HTML
    src = base_tpl.replace('</body>', html + '</body>');

    // CSS
    css = '<style>' + css + '</style>';
    src = src.replace('</head>', css + '</head>');

    // Javascript
    js = '<script>' + js + '<\/script>';
    src = src.replace('</body>', js + '</body>');

    return src;
};

var render = function() {
    var source = prepareSource();

    var iframe = document.querySelector('#output iframe'),
    iframe_doc = iframe.contentDocument;

    iframe_doc.open();
    iframe_doc.write(source);
    iframe_doc.close();
};

// HTML EDITOR
var html_editor = codemirror_grammar_demo(document.querySelector("#html textarea"), [
    {language : "htmlmixed", grammar : htmlmixed_grammar}
]);
html_editor.on('change', function (inst, changes) {
    render();
});

// CSS EDITOR
var css_editor = codemirror_grammar_demo(document.querySelector("#css textarea"), [
    {language : "css", grammar : css_grammar}
]);
css_editor.on('change', function (inst, changes) {
    render();
});

// JAVASCRIPT EDITOR
var js_editor = codemirror_grammar_demo(document.querySelector("#js textarea"), [
    {language : "javascript", grammar : js_grammar}
]);
js_editor.on('change', function (inst, changes) {
    render();
});

window.onload = function() {
    render();
    $('.collapsible').collapsible('open', 0);
};
}());
