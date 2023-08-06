// mark comments

function markComments() {
    $('.comtbox1').each(function () {
        var text = $(this)[0].innerHTML;
        text = text.replace(/&gt;/g, '>').replace(/&lt;/g, '<').replace(/&amp;/g, '&');
        $(this)[0].innerHTML = marked.parse(text);
    });
    $('.comtbox6').each(function () {
        var text = $(this)[0].innerHTML;
        text = text.replace(/&gt;/g, '>').replace(/&lt;/g, '<').replace(/&amp;/g, '&');
        $(this)[0].innerHTML = marked.parse(text);
    });
}

$(function () {
    markComments();
    addCopyButtons();
    highlightAndCopyButtons();
});