$().ready(function() {
    $("#workerForm").validate({
        rules: {
            first: "required",
            last: "required",
            name: "required",
            email: {
                required: true,
                email: true
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
        }
    });
    
});