$('#lvl_3_lvls2').on('change', function () {

    $.ajaxSetup({
        headers: {
            'X-XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: 'level-3',
        method: 'get',
        data: {
            level_2: $('#lvl_3_lvls2').val(),
        },
        success: function (data) {
            $('#lvl_3_lvls1').val(data.level_name + " " + data.level_description);
        }
    });
});
