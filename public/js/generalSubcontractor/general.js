$().ready(function() {
    $("#generalForm").validate({
        rules: {
            first: "required",
            last: "required",
            name: "required",
            email: {
                required: true,
                email: true
            },
            phone: {
                maxlength: 15
            },
            zip: {
                number: true,
                maxlength: 8
            },
            password: {
                required: true,
                minlength: 5
            },
            password_confirmation: {
                required: true,
                minlength: 5,
                equalTo: "#password"
            },
        },
        messages: {
            first: "Please enter your name",
            last: "Please enter your name",
            name: "Please enter your name",
            email:{
               required: "Please provide a email" ,
               email: "Please enter a valid email address"
            },
            phone: {
                maxlength: "Please enter a value less than or equal to 15."
            },

            zip: {
                number: "Please enter a valid number.",
                maxlength: "Please enter a value less than or equal to 8."
            },
            password: {
                required: "Please provide a password.",
                minlength: "Your password must be at least 5 characters long."
            },
            password_confirmation: {
                required: "Please provide a password.",
                minlength: "Your password must be at least 5 characters long.",
                equalTo: "Please enter the same password as above."
            },
        }
    });
    
});