$(function() {
    $("#signInForm").validate({
        rules:{
            email:{
                required: true
            },
            password:{
                required: true
            }
        },
        messages:{
            email:{
                required: "You must enter an email address"
            },
            password:{
                required: "You must enter a password"
            }
        }
    });
});
$(function() {
    $("#signUpForm").validate({
        rules:{
            firstname:{
                required: true
            },
            lastname:{
                required: true
            },
            email:{
                required: true
            },
            password:{
                required: true
            },
            confirmPassword:{
                required: true
            },
            phone:{
                required: true
            }
        },
        messages:{
            firstname:{
                required: "You must enter your first name",
            },
            lastname:{
                required: "You must enter your last name",
            },
            email:{
                required: "You must enter an email address"
            },
            password:{
                required: "You must enter a password"
            },
            confirmPassword:{
                required: "You must confirm your password"
            },
            phone:{
                required: "You must enter a phone number"
            }
        }
    });
});