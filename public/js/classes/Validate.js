class Validate {
    validate (elemsArr, rulesArr, errorElementClass, ajaxType, ajaxElems)
    {

        for (let i = 0; i < elemsArr.length; i++) {
            for (let it = 0; it < rulesArr[i].rules.length; it++) {
                console.log(rulesArr[i].rules[it]);
                if (!rulesArr[i].rules[it]) {
                    $("#id" + (i + 1)).remove();
                    $("#id-err").remove();
                    elemsArr[i].parent().append("<span class='help-block" + " " + errorElementClass + "' id='id" + (i + 1) + "'>" + rulesArr[i].messages[it] + "</span>");
                    break;
                } else {
                    $("#id" + (i + 1)).remove();
                    $("#id-err").remove();
                }
            }
        }
        const _this=$(this);

        if ($('.' + errorElementClass)[0] === undefined) {
            $.ajaxSetup({
                headers: {
                    'X-XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:_this.attr('action'),
                type:ajaxType,
                data:_this.serialize(),
                success:function(data){
                    if(!data.email){
                        window.location.reload();
                    } else {
                        ajaxElems.elems[0].parent().append("<span class='help-block" + " " + errorElementClass + "' id='id-err'>" + data.email + ajaxElems.messages[0] + "</span>");
                    }
                }
            });
        }
    }
}