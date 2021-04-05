$().ready(function() {
    $("#accountForm").validate({
        rules: {
            first: "required",
            last: "required",
            name: "required",
            // user_role_id: {
            //     required: true
            // },
            email: {
                required: true,
                email: true
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
            // user_role_id: {
            //    required: "Please provide a role." ,
            // },

            email:{
               required: "Please provide a email." ,
               email: "Please enter a valid email address."
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