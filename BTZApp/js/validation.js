function doValidate_signUpForm() {
    var form = $("#signUpForm");
    form.validate({
        rules:{
            firstname:{
                required: true,
                lettersonly: true
            },
            lastname:{
                required: true,
                lettersonly: true
            },
            email:{
                required: true,
                email: true
            },
            password:{
                required: true
            },
            confirmPassword:{
                required: true,
                equalTo: "#password"
            },
            phone:{
                required: true
            }
        },
        messages:{
            firstname:{
                required: "You must enter your first name",
                lettersonly: "First name can only contain letters"
            },
            lastname:{
                required: "You must enter your last name",
                lettersonly: "Last name can only contain letters"
            },
            email:{
                required: "You must enter an email address",
                email: "You must enter a valid email address"
            },
            password:{
                required: "You must enter a password"
            },
            confirmPassword:{
                required: "You must confirm your password",
                equalTo: "Passwords do not match"
            },
            phone:{
                required: "You must enter a phone number"
            }
        }
    });
    return form.valid();
}
function doValidate_signInForm() {
    var form = $("#signInForm");
    form.validate({
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
    return form.valid();
}