
window.onload = function() {
    get_members();
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

function remove_member(id, img) {
    $.ajax({
        url: "ajax/remove_member.php",
        type: "POST",
        data: {
            id,
            img
        },
        success: function(e) {
            get_members();
            $('#test').html(e)
        },
        error: function(e) {
            console.log(e);
        }
    })
}

function get_members() {
$.ajax({
    url: "ajax/get_members.php",
    type: "POST",
    success: function(e) {
        $('#team-data').html(e);
    },
    error: function(e) {
        console.log(e);
    }
})
}

$(document).ready(function() 
{
    $('#sub_general_settings').on('click', function() 
    {
        var formData = new FormData($('#general_settings')[0]);
        $.ajax({
            url: 'ajax/crud_modal.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(e) {
                location.reload();
                e;
            },
            error: function(e) {
                alert(e);
            }
        })
    })

    $('#cancel_general').on('click', function() 
    {
        $('#general_settings')[0].reset();
    })

    $('#switch_mode').on('change', function() 
    {
        var shutdown = $('#switch_mode').is(':checked') ? 1 : 0;
        $.ajax({
            url: 'ajax/shutdown.php',
            type: 'POST',
            data: {
                switch_mode: shutdown
            },
            success: function(e) {
                console.log(e);
            },
            error: function(e) {
                console.log(e);
            }
        })
    })

    $('#sub_contact_settings').on('click', function() 
    {
        var contact_formData = new FormData($('#contact_settings')[0]);
        $.ajax({
            url: "ajax/contact.php",
            type: "POST",
            data: contact_formData,
            contentType: false,
            processData: false,
            success: function(e) {
                location.reload();
                alert(e);
            },
            error: function(e) {
                alert(e);
                console.log("error");

            }
        })
    })

    $('#cancel_contact').on('click', function() 
    {
        $('#contact_settings')[0].reset();
    })

    $('#sub_member_add').on('click', function() 
    {
        var new_member = new FormData();
        new_member.append('member_name', $('#member_name').val());
        new_member.append('member_img', $('#member_img').get(0).files[0]);

        $.ajax({
            url: "ajax/add_member.php",
            type: "POST",
            data: new_member,
            contentType: false,
            processData: false,
            success: function(e) {
                $('#member_add')[0].reset();
                get_members();
            },
            error: function(e) {
                console.log(e);
            }
        })
    })
})