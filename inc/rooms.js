function filter(){
    formData = new FormData();
    formData.append('f1', $('#f1').val());
    formData.append('f2', $('#f2').val());
    formData.append('f3', $('#f3').val());
    formData.append('adult', $('#adult').val());
    formData.append('child', $('#child').val());
    formData.append('filter', ' ');

    $.ajax({
        url: 'inc/ajax/filter.php',
        type: 'POST',
        data: formData,
        contentType: false, 
        processData: false,
        success: function(resp){
            // console.log(resp);
            if ($('#adult').val() != '' || $('#child').val() != '') {  
                $('#filteration').html(resp);
            }else{
               get_all_rooms(); 
            }
        },
        error: function(err){
            console.log(err);
        }
    })
}



function get_all_rooms(){
    formData = new FormData();
    formData.append('no_filter', ' ');

    $.ajax({
        url: 'inc/ajax/filter.php',
        type: 'POST',
        data: formData,
        contentType: false, 
        processData: false,
        success: function(resp){
            $('#filteration').html(resp);
        },
        error: function(err){
            console.log(err);
        }
    })

}