$().ready(function() {
    $("#paymentForm").validate({
        rules: {
            amount: "required",
            status_id: "required",
            due_date: {
                required: true,

            },
        },
        messages: {
            amount: "Please enter Amount",
            status_id: "Please select Status",
            due_date:{
                required: "Please select Due Date"
            },
        }
    });

});
