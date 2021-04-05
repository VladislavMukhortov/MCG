$('#lvl_4_lvls3').on('change', function () {

    $.ajaxSetup({
        headers: {
            'X-XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: 'level-4',
        method: 'get',
        data: {
            level_3: $('#lvl_4_lvls3').val(),
        },
        success: function (data) {
            console.log(data)
            $('#lvl_4_lvls1').val(data.level_1.level_name + " " + data.level_1.level_description);
            $('#lvl_4_lvls2').val(data.level_2.level_name + " " + data.level_2.level_description);
        }
    });
});