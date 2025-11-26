window.onload = function() {
    get_bookings();
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


// TABLE GETTING
function get_bookings(){

    booking = 'he';
    data = 'he';
    $.ajax({
        url: 'ajax/refund_bookings.php',
        type: 'POST',
        data: {booking, data},
        success: function(e){
            // console.log(e);

            $('#table_users').html(e);
        },
        error: function(e){
            console.log(e);
        }
    })
}

// ASSIGNING VALUE TO FORM BOOKING ID
function add_booking_id(booking_id){
    $('#booking_id').val(booking_id);
}

// ASSIGNING ROOM VIA AJAX
function assign_room(){
    event.preventDefault();
    formData = new FormData();
    formData.append('assign_room', '');
    formData.append('room_number', $('#room_number').val());
    formData.append('booking_id', $('#booking_id').val());

    $.ajax({
        url: 'ajax/refund_bookings.php',

        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(e){
            console.log(e);
            $('#user_alert').html(e);
            $('#assign_room_form').get(0).reset();
            get_bookings();
        },
        error: function(e){
            console.log(e);
        }
    })
    
}

// CANCELLING THE BOOKING 
function refund(booking_id){
    event.preventDefault();
    formData = new FormData();
    formData.append('refund_booking', '');
    formData.append('booking_id', booking_id);

    if(confirm("Are you sure to refund ?")){
        $.ajax({
            url: 'ajax/refund_bookings.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(e){
                console.log(e);
                $('#user_alert').html(e);   
                $('#assign_room_form').get(0).reset();
                get_bookings();
            },
            error: function(e){
                console.log(e);
            }
        })
    }
}

// SEARCH TABLE 
function search_bookings(username){

    if(username != ''){
        $.ajax({
            url: 'ajax/refund_bookings.php',
            type: 'POST',
            data: {username},
            success: function(e){
                $('#table_users').html(e);
                console.log(e);
            },
            error: function(e){
                console.log(e);
            }
        })
    }else{
        get_bookings();
    }
}

// DELETE USER 
function remove_user(del){
    var del = del;
    if(confirm('Are you sure you want to delete the user ?')){
        $.ajax({
            url: 'ajax/user_actions.php',
            type: 'POST',
            data: {del},
            success: function(e){
                $('#alert').html(e);
                setTimeout(() => {
                    $('#alert_custom').fadeOut();
                }, 4000);
                get_table();
    
            },
            error: function(e){
                console.log(e);
            }
        })
    }
}

// VERIFY USER 
function set_verified(id, status){
    var verify = '';

    if(status == 1){
        status = 0;
    }else{
        status = 1;
    }
    $.ajax({
        url: "ajax/user_actions.php",
        type: "POST",
        data: {id, status, verify},
        success: function(e) {
            console.log(e);
            $('#alert').html(e);
            setTimeout(() => {
                $('#alert_custom').fadeOut();
            }, 4000);
            get_table();
        },
        error: function(e) {
            console.log(e);
        }
    })
}

// ACTIVE USER 
function set_active(id, status){
    var active = '';

    if(status == 1){
        status = 0;
    }else{
        status = 1;
    }
    $.ajax({
        url: "ajax/user_actions.php",
        type: "POST",
        data: {id, status, active},
        success: function(e) {
            $('#alert').html(e);
            setTimeout(() => {
                $('#alert_custom').fadeOut();
            }, 4000);
            get_table();
        },
        error: function(e) {
            console.log(e);
        }
    })
}

