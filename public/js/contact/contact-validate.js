// $(document).on('input', '#zip' , function (e) {
//     console.log($( this ).val());
//     console.log($( this ).val().length);
//     if ($( this ).val().length > 5) {
//         $( this ).val() + '-';
//     }
// } );
$(document).on('submit','#contactForm', function (e) {
    e.preventDefault();
    let rules = [
        {
            'el' : $('#first'),
            'rules': [
                $('#first').val() != 0,
                (/^[a-zA-Z]+$/).test($('#first').val()),
                $('#first').val().length >= 2,
                $('#first').val().length <= 20,
            ],
            'messages': [
                'Name cant to be empty',
                'Only English letters',
                'Name is at least 2 characters',
                'Name up to 20 characters',
            ],
        },
        {
            'el' : $('#last'),
            'rules': [
                (/^[a-zA-Z]+$/.test($('#last').val()) || $('#last').val().length == 0),
                ($('#last').val().length >= 2 || $('#last').val().length == 0),
                ($('#last').val().length <= 35 || $('#last').val().length == 0),
            ],
            'messages': [
                'Only English letters',
                'LastName is at least 2 characters',
                'LastName up to 20 characters',
            ],
        },
        {
            'el' : $('#email'),
            'rules': [
                $('#email').val() != 0,
                /\S+@\S+\.\S+/.test($('#email').val()),
            ],
            'messages': [
                'Email cant to be empty',
                'Enter valid email',
            ],
        },
        {
            'el' : $('#phone'),
            'rules': [
                $('#phone').val() != 0,
                $('#phone').val().length == 11,
            ],
            'messages': [
                'Phone cant to be empty',
                'Enter valid phone',
            ],
        },
        {
            'el' : $('#address'),
            'rules': [
                // (/^[a-zA-Z0-9]+$/.test($('#address').val()) || $('#address').val().length == 0),
                ($('#address').val().length >= 5 || $('#address').val().length == 0),
                ($('#address').val().length <= 60 || $('#address').val().length == 0),
            ],
            'messages': [
                'only A-z and 0-9',
                'Address is at least 5 characters',
                'Address up to 60 characters',
            ],
        },
        {
            'el' : $('#street-address'),
            'rules': [
                // (/^[a-zA-Z0-9]+$/.test($('#street-address').val()) || $('#street-address').val().length == 0),
                ($('#street-address').val().length >= 5 || $('#street-address').val().length == 0),
                ($('#street-address').val().length <= 60 || $('#street-address').val().length == 0),
            ],
            'messages': [
                'only A-z and 0-9',
                'Address is at least 5 characters',
                'Address up to 60 characters',
            ],
        },
        {
            'el' : $('#city'),
            'rules': [
                ((/^[a-z A-Z]+$/).test($('#city').val()) || $('#city').val().length == 0),
                ($('#city').val().length >= 5 || $('#city').val().length == 0),
                ($('#city').val().length <= 45 || $('#city').val().length == 0),
            ],
            'messages': [
                'Only letters',
                'Name is at least 5 characters',
                'Name up to 45 characters',
            ],
        },
        {
            'el' : $('#zip'),
            'rules': [
                ($('#zip').val().length == 5 || $('#zip').val().length == 9 || $('#zip').val().length == 0),
            ],
            'messages': [
                'Can be 5 or 9 charsets',
            ],
        },
        {
            'el' : $('#state'),
            'rules': [
                $('#state').val() != 0,
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
        console.log
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
                window.location.reload();
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