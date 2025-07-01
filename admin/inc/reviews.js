window.onload = function() {
    get_table();
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
function get_table(){
    m_data = '';
    $.ajax({
        url: 'ajax/reviews.php',
        type: 'POST',
        data: {m_data},
        success: function(e){
            $('#table').html(e);
        },
        error: function(e){
            console.log(e);
        }
    })
}

// DELETE USER 
function remove_rating(del){
    var del = del;
    if(confirm('Are you sure you want to delete the user ?')){
        $.ajax({
            url: 'ajax/reviews.php',
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