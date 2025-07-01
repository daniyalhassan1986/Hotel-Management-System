
window.onload = function() {
    get_carousels();
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

// REMOVING THE IMAGE
function remove_carousel(id, img) {
    $.ajax({
        url: "ajax/remove_carousel.php",
        type: "POST",
        data: {id,img},
        success: function(e) {
            get_carousels();
            $('#test_carousel').html(e)
            setTimeout(() => {
                $('#alert_custom').fadeOut();

            }, 1000);
            // console.log(e);
        },
        error: function(e) {
            console.log(e);
        }
    })
}

// GETTING THE IMAGES
function get_carousels() {
    $.ajax({
        url: "ajax/get_carousels.php",
        success: function(e) {
            $('#carousel-data').html(e);
        },
        error: function(e) {
            console.log(e);
        }
    })
}


$(document).ready(function() {
    
    // ADDING THE IMAGES
    $('#sub_carousel_add').on('click', function() {
        formdata = new FormData();
        if($('#carousel_img').val() != ''){
            formdata.append('carousel_img', $('#carousel_img').get(0).files[0])
            formdata.append('carousel', '')
        }
        $.ajax({
            url: "ajax/add_carousel.php",
            type: "POST",
            data: formdata,
            contentType: false,
            processData: false,
            success: function(e) {
                get_carousels();
                $('#test_carousel').html(e)
                setTimeout(() => {
                    $('#alert_custom').fadeOut();

                }, 1000);
                $('#carousel_img').val('');
            },
            error: function(e) {
                console.log(e);
            }
        })
    })
})