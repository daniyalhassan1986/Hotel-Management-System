window.onload = function() {
    setActive();
    booking_analytics();
}

// DYNAMIC NAVBAR ACTIVE
function setActive() {
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

function booking_analytics(period=1){
    $.ajax({
        url: 'ajax/dashboard.php',
        type: 'POST',
        data: {period},
        success: function(resp){
            let data = JSON.parse(resp);

            $('#all_bookings').text(data.all_bookings);
            $('#all_amount').text('Rs '+(data.all_amount ?? '0'));

            $('#refund_bookings').text(data.refund_bookings);
            $('#refund_amount').text('Rs '+(data.refund_amount ?? '0'));

            $('#new_bookings').text(data.new_bookings);
            $('#new_amount').text('Rs '+(data.new_amount ?? '0'));

            $('#cancelled_bookings').text(data.cancelled_bookings);
            $('#cancelled_amount').text('Rs '+(data.cancelled_amount ?? '0'));

        },
        error: function(err){
            console.log("error"+err);
        }
    })

}