$(document).ready(function(){

    $("form[name='registration']").validate({
        rules: {
            email: {
                required:  {
                        depends:function(){
                            $(this).val($.trim($(this).val()));
                            return true;
                        }   
                    },
                customemail: true
            },
            password: {
                required: true,
                minlength : 5
            },
        
        messages: {
            email: {
                required: "specify email"
            },
            password: {
                required: "specify password",
                minlength: "Your password must be at least 5 characters long *",
            }
        }
    }

});
});
$.validator.addMethod("customemail", 
function(value, element) {
    return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
}, 
"Wrong email format"
);