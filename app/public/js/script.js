/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    
    $("#register").validate({
        rules: {
            name: { 
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            },
            c_password: {
                required: true,
                minlength: 6,
                equalTo: "#password"
            },
            gender: {
                required: true,
            }
        },
        messages: {
            name: {
                required: "Please enter your name",
            },
            password: {
                required: "Please enter password",
            },
            c_password:{
                required: "Please enter confirm password",
            }
        },
        errorPlacement: function(error, element) {
            if ( element.is(":radio") ){
                error.appendTo( element.parents('.radio') );
            }else{
                error.insertAfter( element );
            }
        }
    });
    
    $("#login").validate({
        rules: {

            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
            }
        },
        messages: {
            password: {
                required: "Please enter password",
            }
        },
    });
    
    $(document).ready(function() {
        $('#activity').DataTable();
    });
});

