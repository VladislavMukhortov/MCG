$().ready(function() {
    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
      }, "Letters only please"); 
    $(document).on('submit','#contactForm',function(e){
        e.preventDefault();
        const _this=$(this);
        $.ajax({
            url:_this.attr('action'),
            type:'post',
            data:_this.serialize(),
            error:function(event,xhr,options,exc){
              const errors=event.responseJSON.errors;
              $('#contactForm').find('.help-block').remove();
              $('#contactForm').removeClass('error');
              $.each(errors, function(index, value){
                    $("#"+index).addClass('error');
                    $("#"+index).parent().append("<span class='help-block error'>"+value+"</span>")
              });
            },
            success:function(data){
                window.location.reload();
            }
        })
    });
    
});