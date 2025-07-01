window.onload = function() {
    get_table();
}


// TABLE GETTING
function get_table(){
    $.ajax({
        url: 'ajax/get_all_users.php',
        type: 'POST',
        success: function(e){
            $('#table_users').html(e);
        },
        error: function(e){
            console.log(e);
        }
    })
}

// SEARCH TABLE 
function search_user(username){

    if(username != ''){
        $.ajax({
            url: 'ajax/user_actions.php',
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
        get_table();
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


