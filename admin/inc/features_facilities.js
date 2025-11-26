
window.onload = function() {
    setActive();
    get_features();
    get_facilities()

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

// FEATURES

function get_features() 
{
    $.ajax({
        url: "ajax/get_features.php",
        type: "POST",
        success: function(e) {
            $('#table').html(e);
        },
        error: function(e) {
            console.log(e);
        }
    })
}

function remove_feature(id){
    var formdata = new FormData();
    formdata.append('id',  id);
    $.ajax({
        url: "ajax/remove_feature.php",
        type: "POST",
        data: formdata,
        contentType: false,
        processData: false,
        success: function(e) {
            get_features();
            $('#alert').html(e);
            // $('#table').html(e)
        },
        error: function(e) {
            console.log(e);
        }
    })
}

function add_features(){
    event.preventDefault(); 
    var feature = new FormData();
    feature.append('feature_name', $('#feature_name').val());

    $.ajax({
        url: "ajax/add_features.php",
        type: "POST",
        data: feature,
        contentType: false,
        processData: false,
        success: function(e) {
            $('#feature_name').val('');
            get_features();
        },
        error: function(e) {
            console.log(e);
        }
    })
}
   

// FACILITIES

function get_facilities() {
    $.ajax({
        url: "ajax/get_facilities.php",
        type: "POST",
        success: function(e) {
            $('#table_facilities').html(e);
        },
        error: function(e) {
            console.log(e);
        }
    })

}


function remove_facilities(id, image) {
    
    $.ajax({
        url: "ajax/remove_facilities.php",
        type: "POST",
        data: {id, image},
        success: function(e) {
            $('#alert').html(e);
            get_facilities();
        },
        error: function(e) {
            console.log(e);
        }
    })
}

function add_facilities(){
    event.preventDefault(); 
    var facility = new FormData();
    
    facility.append('facilities_name', $('#facilities_name').val());
    facility.append('facilities_description', $('#facilities_description').val());
    facility.append('facilities_img', $('#facilities_img').get(0).files[0]);


    $.ajax({
        url: "ajax/add_facility.php",
        type: "POST",
        data: facility,
        contentType: false,
        processData: false,
        success: function(e) {
            $('#alert').html(e);
            $('#facility_form')[0].reset();
            get_facilities();
        },
        error: function(e) {
            console.log(e);
        }
    })
}
