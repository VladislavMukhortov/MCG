$().ready(function() {
    $("#subcontractorForm").validate({
        rules: {
            first: "required",
            last: "required",
            name: "required",
            company_name: "required",
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
        },
        messages: {
            first: "Please enter your name",
            last: "Please enter your name",
            name: "Please enter your name",
            company_name: "Please enter your company name",


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
        }
    });
    
});