$('.lang span').on('click', function () {
    if ($(this).hasClass('active')) return;
    $('.lang span.active').removeClass('active');
    $(this).addClass('active');
    var lang = $(this).data('v');
    $('.localize label .lang-label').remove();
    $('.localize *[data-lang]').hide();
    $('.localize *[data-lang]').removeClass('active');
    if (lang !== 'ru') {
        $('.localize label')
            .append($('<span>').addClass('lang-label').css('color', 'red').css('margin-left', '1rem').html(lang));
    }
    $('.localize *[data-lang="' + lang + '"]').show();
    $('.localize *[data-lang="' + lang + '"]').addClass('active');
});