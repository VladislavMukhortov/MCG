

$(document).ready(function () {
    const $doc = $(document);

    $doc.on('click', '.add-estimate-template', function (e) {
        $("#estimateTemplateModel").modal('show');
    })
        .on('click', '.save-estimate-template', function () {
            var form_action = $(".estimate-template-form").attr('action');
            var form_data = $(".estimate-template-form").serialize();

            $.ajax({
                url: form_action,
                method: 'post',
                data: form_data,
                success: function (data) {
                    window.location.reload();
                }
            });
        })
        .on('click', '.edit-line-items', function (e) {
            e.preventDefault();
            $("#modalEstimateTemplate").modal('show');

            return;
            const href = $(this).attr('href');
            $.ajax({
                url: href,
                method: 'get',
                success: function (data) {

                }
            })
        })
        .on('click', '.all_codes li', function (e) {
            e.preventDefault();
            $(this).addClass('selected');
        })
        .on('click', '.level1 li, .level2 li, .level3 li, .level4 li', function () {
            $(this).parent('ul').find('li').removeClass('active');
            $(this).addClass('active');
        })

});
