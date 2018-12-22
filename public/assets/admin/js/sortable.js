$('.sortable th').on('click', function () {
    const sort_by = $(this).data('sort');
    const dir = $(this).data('dir');
    let url;
    if (sort_by !== undefined) {
        url = location.href;
        var urlBef = '';
        urlSearch = location.search.slice(1, location.search.length);
        urlSearch = urlSearch.split('&');
        for (var i = 0; i < urlSearch.length; i++) {
            col = urlSearch[i].split('=');
            if (col[0].search('column') < 0 && col[0].search('dir')) {
                urlBef += '&' + col[0] + '=' + col[1]
            }
        }
        urls = '?column=' + sort_by + urlBef;
        if (dir === 'asc') {
            $(this).removeAttr('data-dir');
            if (url.indexOf('dir=') > 0) {
                url = url.replace(/dir=\w+/, '&dir=' + dir);
            } else if (url.indexOf('?') > 0) {
                urls = url + '&dir=' + dir;
            } else {
                urls = url + '?dir=' + dir;
            }
        } else {
            $(this).attr('data-dir', 'asc')
        }
        window.history.pushState('', '', urls);
        location.reload();
    }
});
$(function () {
    var index = location.search.indexOf('column=');
    if (index > 0) {
        var column;
        var p = location.search.split('&');
        for (var i = 0; i < p.length; i++) {
            col = p[i].split('=');
            if (col[0].search('column') >= 0) {
                column = col[1];
            }
        }
        $('.sortable th').each(function () {
            if ($(this).data('sort') === column) {
                $(this).attr('data-dir', 'asc');
            }
        });
    }
});