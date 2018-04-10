$(document).ready(function() {
    var form = $("#signUpForm");
    form.validate({
        rules:{
            txtFirstNameSU:{
                required: true
            },
            txtLastNameSU:{
                required: true
            },
            txtEmailSU:{
                required: true
            },
            txtPasswordSU:{
                required: true
            },
            txtPasswordConfirmSU:{
                required: true
            }
        },
        messages:{
            txtFirstNameSU:{
                required: "You must enter your first name",
            },
            txtLastNameSU:{
                required: "You must enter your last name",
            },
            txtEmailSU:{
                required: "You must enter an email address"
            },
            txtPasswordSU:{
                required: "You must enter a password"
            },
            txtPasswordConfirmSU:{
                required: "You must confirm your password"
            }
        }
    });
});