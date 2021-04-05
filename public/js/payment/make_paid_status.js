
$(document)
    .on("click", ".make-paid", function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        // $('#loading').css('visibility', 'visible');

        var paymentId   = $(this).data('payment_id');
        var url         = $(this).data('url');
        makePaid(paymentId, url);
    })

function makePaid(paymentId, url) {
    $('#loading').css('visibility', 'visible');
    $.ajax({
        type: 'PUT',
        url: url,
        data: {
            "_token": window.csrfToken,
            'status_id': 2
        },
    }).done(function (data) {
        // $('#loading').css('visibility', 'hidden');
        let newStatus   = data.data.status
        let statusEl    = $('.payment-status[data-payment_id=' + paymentId + ']');
        let makePaidEl  = $('.make-paid[data-payment_id=' + paymentId + ']');
        if(newStatus) {
            statusEl.text(newStatus)
            makePaidEl.text('')
        }
    }).fail(function () {
        // $('#loading').css('visibility', 'hidden');
        // $('#').html("Status can not be changed.");
    });
}
