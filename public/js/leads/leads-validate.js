// $(document).on('input', '#zip' , function (e) {
//     console.log($( this ).val());
//     console.log($( this ).val().length);
//     if ($( this ).val().length > 5) {
//         $( this ).val() + '-';
//     }
// } );
$(document).on('submit','#leadForm', function (e) {
    e.preventDefault();
    let rules = [
        {
            'el' : $('#first-lead'),
            'rules': [
                $('#first-lead').val() != 0,
                (/^[a-zA-Z]+$/).test($('#first-lead').val()),
                $('#first-lead').val().length >= 2,
                $('#first-lead').val().length <= 20,
            ],
            'messages': [
                'Name cant to be empty',
                'Only English letters',
                'Name is at least 2 characters',
                'Name up to 20 characters',
            ],
        },
        {
            'el' : $('#last-lead'),
            'rules': [
                (/^[a-zA-Z]+$/.test($('#last-lead').val()) || $('#last-lead').val().length == 0),
                ($('#last-lead').val().length >= 2 || $('#last-lead').val().length == 0),
                ($('#last-lead').val().length <= 35 || $('#last-lead').val().length == 0),
            ],
            'messages': [
                'Only English letters',
                'LastName is at least 2 characters',
                'LastName up to 20 characters',
            ],
        },
        {
            'el' : $('#email-lead'),
            'rules': [
                $('#email-lead').val() != 0,
                /\S+@\S+\.\S+/.test($('#email-lead').val()),
            ],
            'messages': [
                'Email cant to be empty',
                'Enter valid email',
            ],
        },
        {
            'el' : $('#phone-lead'),
            'rules': [
                $('#phone-lead').val() != 0,
                $('#phone-lead').val().length == 11,
            ],
            'messages': [
                'Phone cant to be empty',
                'Enter valid phone',
            ],
        },
        {
            'el' : $('#address-lead'),
            'rules': [
                // (/^[a-zA-Z0-9]+$/.test($('#address').val()) || $('#address').val().length == 0),
                ($('#address-lead').val().length >= 5 || $('#address-lead').val().length == 0),
                ($('#address-lead').val().length <= 60 || $('#address-lead').val().length == 0),
            ],
            'messages': [
                'only A-z and 0-9',
                'Address is at least 5 characters',
                'Address up to 60 characters',
            ],
        },
        {
            'el' : $('#street-address-lead'),
            'rules': [
                // (/^[a-zA-Z0-9]+$/.test($('#street-address').val()) || $('#street-address').val().length == 0),
                ($('#street-address-lead').val().length >= 5 || $('#street-address-lead').val().length == 0),
                ($('#street-address-lead').val().length <= 60 || $('#street-address-lead').val().length == 0),
            ],
            'messages': [
                'only A-z and 0-9',
                'Address is at least 5 characters',
                'Address up to 60 characters',
            ],
        },
        {
            'el' : $('#city-lead'),
            'rules': [
                ((/^[a-z A-Z]+$/).test($('#city-lead').val()) || $('#city-lead').val().length == 0),
                ($('#city-lead').val().length >= 5 || $('#city-lead').val().length == 0),
                ($('#city-lead').val().length <= 45 || $('#city-lead').val().length == 0),
            ],
            'messages': [
                'Only letters',
                'Name is at least 5 characters',
                'Name up to 45 characters',
            ],
        },
        {
            'el' : $('#zip-lead'),
            'rules': [
                ($('#zip-lead').val().length == 5 || $('#zip-lead').val().length == 9 || $('#zip-lead').val().length == 0),
            ],
            'messages': [
                'Can be 5 or 9 charsets',
            ],
        },
        {
            'el' : $('#state-lead'),
            'rules': [
                $('#state-lead').val() != 0,
            ],
            'messages': [
                'Choose the state',
            ],
        },
    ];

    for (let i = 0; i < rules.length; i++) {
        for (let it = 0; it < rules[i].rules.length; it++) {
            if (!rules[i].rules[it]) {
                $("#id" + (i + 1)).remove();
                $("#id-err").remove();
                rules[i].el.parent().append("<span class='help-block error' id='id" + (i + 1) + "'>" + rules[i].messages[it] + "</span>");
                break;
            } else {
                $("#id" + (i + 1)).remove();
                $("#id-err").remove();
            }
        }
    }
    const _this=$(this);

    if ($(".error")[0] === undefined) {

        $.ajaxSetup({
            headers: {
                'X-XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:_this.attr('action'),
            type:'post',
            data:_this.serialize(),
            success:function(data){
                if(!data.email){
                    window.location.reload();
                } else {
                    $("#email-lead").parent().append("<span class='help-block error' id='id-err'> email " + data.email +  " already exists </span>");
                }
            }
        });
    }

});



// $().ready(function() {
//     $(document).on('submit','#contactForm',function(e){
//         e.preventDefault();
//         const _this=$(this);
//         $.ajax({
//             url:_this.attr('action'),
//             type:'post',
//             data:_this.serialize(),
//             error:function(event,xhr,options,exc){
//                 const errors=event.responseJSON.errors;
//                 $('#contactForm').find('.help-block').remove();
//                 $('#contactForm').removeClass('error');
//                 $.each(errors, function(index, value){
//                     $("#"+index).addClass('error');
//                     $("#"+index).parent().append("<span class='help-block error'>"+value+"</span>")
//                 });
//             },
//             success:function(data){
//                 window.location.reload();
//             }
//         })
//     });
//
// });