$().ready(function() {
    $("#paymentForm").validate({
        rules: {
            amount: "required",
            status_id: "required",
            subcontractor_id: "required",
            date: {
                required: true,
            },
        },
        messages: {
            amount: "Please enter Amount",
            status_id: "Please select Status",
            due_date:{
                required: "Please select Due Date"
            },
            subcontractor_id: "Please select Subcontractor",
        }
    });

});
