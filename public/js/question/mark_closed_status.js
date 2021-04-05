
$(document)
    .on("click", ".mark__closed", function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        // $('#loading').css('visibility', 'visible');

        var questionId  = $(this).data('question_id');
        var url         = $(this).data('url');
        makeClosed(questionId, url);
    })
    .on("click", ".question__closed", function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        // $('#loading').css('visibility', 'visible');

        var questionId  = $(this).data('question_id');
        var url         = $(this).data('url');
        reopenClosed(questionId, url);
    })

function makeClosed(questionId, url) {
    $('#loading').css('visibility', 'visible');
    $.ajax({
        type: 'PUT',
        url: url,
        data: {
            "_token": window.csrfToken
        },
    }).done(function (data) {
        // $('#loading').css('visibility', 'hidden');
        window.location.reload();
    }).fail(function () {
        // $('#loading').css('visibility', 'hidden');
        // $('#').html("Status can not be changed.");
    });
}
function reopenClosed(questionId, url) {
    $('#loading').css('visibility', 'visible');
    $.ajax({
        type: 'PUT',
        url: url,
        data: {
            "_token": window.csrfToken
        },
    }).done(function (data) {
        // $('#loading').css('visibility', 'hidden');
        window.location.reload();
    }).fail(function () {
        // $('#loading').css('visibility', 'hidden');
        // $('#').html("Status can not be changed.");
    });
}
