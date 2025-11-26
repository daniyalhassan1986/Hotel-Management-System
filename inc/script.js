window.onload = function() {
    setActive();
}



// DYNAMIC NAVBAR ACTIVE
function setActive(){
    var navbar = $('#nav-bar');
    var a_tags = navbar.find('a');
    a_tags.each(function(){
        var file        = $(this).attr('href').split('/').pop();
        var file_name   = file.split('.')[0];
        if(document.location.href.indexOf(file_name) >= 0){
            $(this).addClass('active fw-bold');
        }    
    })    
}    


function reset_register(){
    $('#register_form')[0].reset();
}

// REGISTER USER AJAX
function registerUser(){
    event.preventDefault();

    formData = new FormData();
    formData.append('name', $('#name').val());
    formData.append('email', $('#email').val());
    formData.append('contact', $('#contact').val());
    formData.append('image', $('#image')[0].files[0]); 
    // formData.append('picture', $('#picture').files[0]);
    formData.append('pincode', $('#pincode').val());
    formData.append('dob', $('#dob').val());
    formData.append('password', $('#password').val());
    formData.append('cpassword', $('#cpassword').val());
    formData.append('address', $('#address').val());
    formData.append('register', $('#register').val());
    
    $.ajax({
        // inc\ajax\register.php
        url: 'inc/ajax/login_register.php',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(e){
            console.log(e);
            $('#alert').html(e);
        },
        error: function(e){
            console.log(e, "error");
        }
    })
    

}


// LOGIN USER AJAX
function loginUser(){
    event.preventDefault();

    formData = new FormData();
    formData.append('login', $('#login').val());
    formData.append('emailmob', $('#emailmob').val());
    formData.append('loginpass', $('#loginpass').val());
    
    $.ajax({
        url: 'inc/ajax/login_register.php',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(e){
            console.log(e);
            $('#user_alert').html(e);
        },
        error: function(e){
            console.log(e, "error");
        }
    })
    

}


// FORGOT PASSWORD AJAX
function forgotPassword(){
    event.preventDefault();

    formData = new FormData();
    formData.append('forgot', ' ');
    formData.append('forgotPassword', $('#forgotemail').val());
    
    $.ajax({
        url: 'inc/ajax/login_register.php',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(e){
            console.log(e);
            $('#user_alert').html(e);
        },
        error: function(e){
            console.log(e, "error");
        }
    })
}


// NEW PASSWORD AJAX
function newpassword(){
    event.preventDefault();

    formData = new FormData();
    formData.append('new_password', $('#newpassenter').val());
    formData.append('confirm_password', $('#cnewpassenter').val());
    formData.append('reset_email', $('#resetemail').val());
    
    $.ajax({
        url: 'inc/ajax/login_register.php',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(e){
            console.log(e);
            $('#user_alert').html(e);
            redirect('index.php');

        },
        error: function(e){
            console.log(e, "error");
        }
    })
}

// INDEX PAGE FILTER (THIS WILL REDIRECT USER TO THE ROOMS PAGE)
function redirection(){
    window.location.href = 'rooms.php';
}


document.addEventListener("DOMContentLoaded", function () {
    let urlParams = new URLSearchParams(window.location.search);

    if (urlParams.has("reset")) { // Now checking for reset=true
        let modal = document.getElementById("newpass");
        if (modal) {
            let modalInstance = new bootstrap.Modal(modal);
            modalInstance.show();
        }
    }
});


