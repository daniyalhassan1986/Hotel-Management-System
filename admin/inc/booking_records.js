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
        url: 'ajax/booking_records.php',
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
        url: 'ajax/booking_records.php',

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

// REFUND THE BOOKING 
function refund(booking_id){
    event.preventDefault();
    formData = new FormData();
    formData.append('refund_booking', '');
    formData.append('booking_id', booking_id);

    if(confirm("Are you sure to refund ?")){
        $.ajax({
            url: 'ajax/booking_records.php',
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
            url: 'ajax/booking_records.php',
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

function pdf_booking(id){

    window.location.pathname.split('/').pop();     
    window.location.href = 'ajax/generate_pdf.php?id=' + id;

}