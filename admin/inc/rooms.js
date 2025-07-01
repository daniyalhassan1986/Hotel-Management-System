window.onload = function() {
    get_rooms();
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

// GET ROOMS FROM DB
function get_rooms() {
    $.ajax({
        url: "ajax/get_rooms.php",
        type: "POST",
        success: function(e) {
            $('#table_facilities').html(e);
        },
        error: function(e) {
            console.log(e);
        }
    })
}

// ADD ROOMS
function add_rooms(){
    event.preventDefault();
    
    var features = []
    $('.feature-checkbox:checked').each(function(){
        features.push($(this).val());
    });


    var facilities = [];
    $('.facility-checkbox:checked').each(function(){
        facilities.push($(this).val());
    })

    formData = new FormData();
    formData.append('add_room', '');
    formData.append('id', $('#id').val());
    formData.append('name', $('#name').val());
    formData.append('area', $('#area').val());
    formData.append('price', $('#price').val());
    formData.append('quantity', $('#quantity').val());
    formData.append('adult', $('#adult').val());
    formData.append('children', $('#children').val());
    formData.append('descp', $('#descp').val());
    formData.append('facilities', JSON.stringify(facilities));
    formData.append('features', JSON.stringify(features));
   
    $.ajax({
        url: "ajax/add_room.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(e) {
            $('#add_room_form')[0].reset();
            $('#alert').html(e);
            setTimeout(() => {
                $('#alert_custom').fadeOut();
            }, 2000);
            get_rooms();
        },
        error: function(e) {
            console.log(e);
        }
    })
}

// SET ACTIVE CLASS
function set_active(id, status){
    if(status == 1){
        status = 0;
    }else{
        status = 1;
    }
    $.ajax({
        url: "ajax/room_actions.php",
        type: "POST",
        data: {id, status},
        success: function(e) {
            console.log(e);
            $('#alert').html(e);
            setTimeout(() => {
                $('#alert_custom').fadeOut();
            }, 4000);
            get_rooms();
        },
        error: function(e) {
            console.log(e);
        }
    })
}

// EDIT THE ROOM
function edit_room(id){
    add_rest();
    $.ajax({
        url: "ajax/edit_room.php",
        type: "POST",
        data: {id: id},
        success: function(response) {
            console.log(JSON.parse(response));
            var room = JSON.parse(response);
            $('#id').val(room.room_data.id);
            $('#name').val(room.room_data.name);
            $('#adult').val(room.room_data.adult);
            $('#area').val(room.room_data.area);
            $('#children').val(room.room_data.children);
            $('#descp').val(room.room_data.descp);
            $('#price').val(room.room_data.price);
            $('#quantity').val(room.room_data.quantity);

            $('.facility-checkbox').each(function() {
                if(room.facilites.includes(String(this.value))){
                    $(this).prop('checked', true);
                }
            });
            
            $('.feature-checkbox').each(function() {
                if(room.features .includes(String(this.value))){
                    $(this).prop('checked', true);
                }
            });          
                        
        },
        error: function(e) {
            console.log(e);
        }
    })
}

// GET SPECIFIC IMAGE OF ROOM
function room_img(id){
    $('#room_id').val(id);
    get_room_images(id);

}

// ADD ROOM IMAGES
function add_rooms_images(){
    event.preventDefault();
    var room_image = new FormData();
    
    room_image.append('room_id', $('#room_id').val());
    room_image.append('room_img', $('#room_img').get(0).files[0]);

    $.ajax({
        url: "ajax/add_room_image.php",
        type: "POST",
        data: room_image,
        contentType: false,
        processData: false,
        success: function(e) {
            console.log(e);
            $('#alert-room-img').html(e);
            var room_id = $('#room_id').val();
            console.log(room_id);
            get_room_images(room_id);
            $('#room_img').val('');
        },
        error: function(e) {
            console.log(e);
        }
    })

}

// GET THE IMAGES OF ROOM 
function get_room_images(room_id){
    $.ajax({
        url: 'ajax/get_room_images.php',
        type: 'POST',
        data: {room_id: room_id},
        success: function(e){
            $('#room_images_show').html(e);
        }
    })
}

// REMOVES THE ROOM IMAGES
function remove_room_img(id, img, room_id){
    var remove_single = '';
    $.ajax({
        url: "ajax/remove_room_image.php",
        type: "POST",
        data: {
            id,
            img, 
            remove_single
        },
        success: function(e) {
            get_room_images(room_id);
            $('#alert-room-img').html(e);
        },
        error: function(e) {
            console.log(e);
        }
    })
    
}

// SETS THE THUMBNAIL
function thumbnail(id, img, room_id){

    $.ajax({
        url: "ajax/thumbnail.php",
        type: "POST",
        data: {
            id,
            img,
            room_id
        },
        success: function(e) {
            get_room_images(room_id);
            $('#alert-room-img').html(e);
        },
        error: function(e) {
            console.log(e);
        }
    })
    
}

// REMOVES ROOM
function remove_room(id){

    if(confirm('Are you sure you want to delete this ????')){
        $.ajax({
            url: "ajax/remove_room_image.php",
            type: "POST",
            data: {id},
            success: function(e) {
                console.log(e); 
                $('#alert').html(e);
                setTimeout(() => {
                    $('#alert_custom').fadeOut();
                }, 2000);
                get_rooms();
            },
            error: function(e) {
                console.log(e);
            }
        })
    }
    
}

// RESET THE FORM
function add_rest(){
    $('#add_room_form')[0].reset();

}