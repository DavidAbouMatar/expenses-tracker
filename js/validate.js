

$(function() {
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $("form[name='registration']").validate({
      // Specify validation rules
      rules: {
        // The key name on the left side is the name attribute
        // of an input field. Validation rules are defined
        // on the right side
        
        name: "required",
        last_name: "required",
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
          minlength: 5
        },
        conpassword : {
          minlength : 5,
          equalTo : "#password"
      },
      // Specify validation error messages
      messages: {
        name: "Please enter your firstname *",
        last_name: "Please enter your lastname *",
        password: {
          required: "Please provide a password *",
          minlength: "Your password must be at least 5 characters long *"
        },
        conpassword: {
          required: "Please provide a password *",
          minlength: "Your password must be at least 5 characters long *",
          equalTo: "passwwords doesnt match"
        },

        email: "Please enter a valid email address *"
      },
      // Make sure the form is submitted to the destination defined
      // in the "action" attribute of the form when valid
      submitHandler: function(form) {
        form.submit();
      }
    }
  }); });

  $.validator.addMethod("customemail", 
    function(value, element) {
        return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
    }, 
    "Wrong email format"
);