import './bootstrap';

import $ from 'jquery';
window.$ = $;
window.jQuery = $;

// Upload button triggers file input
$('#profile-upload-btn').on('click', function () {
    $('#profileInput').click();
});

// When file selected
$('#profileInput').on('change', function () {
    const file = this.files[0];
    if (!file) return;

    let reader = new FileReader();
    reader.onload = function (e) {
        $('#profile').html(`
            <img src="${e.target.result}" 
                 style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
        `);

        $('#profile-upload-btn').hide();   // hide upload button
        $('#profile-remove-btn').show();  // show remove button
    };

    reader.readAsDataURL(file);
    console.log("File data",file);
    console.log("Reader data",reader);
});

// Remove button resets everything
$('#profile-remove-btn').on('click', function () {

    // restore default icon
    $('#profile').html(`<i class="fa-solid fa-user"></i>`);

    // clear selected file
    $('#profileInput').val('');

    // buttons UI
    $('#profile-remove-btn').hide();
    $('#profile-upload-btn').show();
});

$('#add-qual-btn').on('click', function(e){
    
    let count =$('#qualifications-wrapper .qualifications-group').length + 1;

    if(count >0){
        $('#remove-qual-btn').show();
    }



    $('#qualifications-wrapper').append(`<div class="qualifications-group">
                        <p style="color: #9BA0AA;">Qualifications ${count}</p>
                        <input type="text" name = "qualification_name[]">
                    </div>`);
});


// REMOVE QUALIFICATION (last one)
$('#remove-qual-btn').on('click', function () {

    let count = $('#qualifications-wrapper .qualifications-group').length;

    if (count > 1) {
        // remove last qualification block
        $('#qualifications-wrapper .qualifications-group').last().remove();
    }

    // update numbering after removal
    $('#qualifications-wrapper .qualifications-group').each(function (index) {
        $(this).find('p').text(`Qualifications ${index + 1}`);
    });

    // if only 1 qualification left → hide remove button
    if ($('#qualifications-wrapper .qualifications-group').length <= 1) {
        $('#remove-qual-btn').hide();
    }
});
