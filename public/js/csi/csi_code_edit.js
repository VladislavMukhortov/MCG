$.ajaxSetup({
    headers: {
        'X-XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#csi_lvls1-edit').on('change', function () {
    $.ajax({
        url: 'csi-code-tree',
        method: 'get',
        data: {
            level_1: $('#csi_lvls1-edit').val(),
        },
        success: function (data) {
            $('#csi_lvls2-label-edit').css('display', 'block');
            $('#csi_lvls2-edit').css('display', 'block');

            $('#csi_lvls3-label-edit').css('display', 'none');
            $('#csi_lvls3-edit').css('display', 'none');

            $('#csi_lvls4-label-edit').css('display', 'none');
            $('#csi_lvls4-edit').css('display', 'none');

            $('.added-option-2').remove();
            if (!data.length) {
                $('#csi_lvls2-label-edit').css('display', 'none');
                $('#csi_lvls2-edit').css('display', 'none');
                return;
            }
            addLevel_2(data);
        }
    });
});

$('#csi_lvls2-edit').on('change', function () {
    $.ajax({
        url: 'csi-code-tree',
        method: 'get',
        data: {
            level_2: $('#csi_lvls2-edit').val(),
        },
        success: function (data) {
            $('#csi_lvls3-label-edit').css('display', 'block');
            $('#csi_lvls3-edit').css('display', 'block');

            $('#csi_lvls4-label-edit').css('display', 'none');
            $('#csi_lvls4-edit').css('display', 'none');
            $('.added-option-3').remove();
            if (!data.length) {
                $('#csi_lvls3-label-edit').css('display', 'none');
                $('#csi_lvls3-edit').css('display', 'none');
                return;
            }
            addLevel_3(data);
        }
    });
});

$('#csi_lvls3-edit').on('change', function () {
    $.ajax({
        url: 'csi-code-tree',
        method: 'get',
        data: {
            level_3: $('#csi_lvls3-edit').val(),
        },
        success: function (data) {
            $('#csi_lvls4-label-edit').css('display', 'block');
            $('#csi_lvls4-edit').css('display', 'block');
            $('.added-option-4').remove();
            if (!data.length) {
                $('#csi_lvls4-label-edit').css('display', 'none');
                $('#csi_lvls4-edit').css('display', 'none');
                return;
            }
            addLevel_4(data);
        }
    });
});

function addLevel_2(data){
    for(let option of data) {
        $('#csi_lvls2-edit').append(
            '<option value="' + option.id + '" class="added-option-2">' + option.level_name + " " + option.level_description + '</option>'
        );
    }
}

function addLevel_3(data){
    for(let option of data) {
        $('#csi_lvls3-edit').append(
            '<option value="' + option.id + '" class="added-option-3">' + option.level_name + " " + option.level_description + '</option>'
        );
    }
}

function addLevel_4(data){
    for(let option of data) {
        $('#csi_lvls4-edit').append(
            '<option value="' + option.id + '" class="added-option-4">' + option.level_name + " " + option.level_description + '</option>'
        );
    }
}