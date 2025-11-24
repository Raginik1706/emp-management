import './bootstrap';

import $ from 'jquery';
window.$ = $;
window.jQuery = $;


$('#profile-upload-btn').on('click', function () {
    $('#profileInput').click();
});

$('#profileInput').on('change', function () {
    const file = this.files[0];
    if (!file) return;

    let reader = new FileReader();
    reader.onload = function (e) {
        $('#profile').html(`
            <img src="${e.target.result}" 
                 style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
        `);

        $('#profile-upload-btn').hide();   
        $('#profile-remove-btn').show();  
    };

    reader.readAsDataURL(file);
    console.log("File data",file);
    console.log("Reader data",reader);
});


$('#profile-remove-btn').on('click', function () {

   
    $('#profile').html(`<i class="fa-solid fa-user"></i>`);

   
    $('#profileInput').val('');

   
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


// REMOVE QUALIFICATION 
$('#remove-qual-btn').on('click', function () {

    let count = $('#qualifications-wrapper .qualifications-group').length;

    if (count > 1) {
        
        $('#qualifications-wrapper .qualifications-group').last().remove();
    }

  
    $('#qualifications-wrapper .qualifications-group').each(function (index) {
        $(this).find('p').text(`Qualifications ${index + 1}`);
    });

   
    if ($('#qualifications-wrapper .qualifications-group').length <= 1) {
        $('#remove-qual-btn').hide();
    }
});

/*  add experinces or remove*/


$('#add-exp-btn').on('click', function(e){
    
    let count =$('#experiences-wrapper .experiences-group').length + 1;

    if(count >0){
        $('#remove-exp-btn').show();
    }



    $('#experiences-wrapper').append(`<div class="experiences-group">
                        <p style="color: #9BA0AA;">Experiences ${count}</p>
                        <input type="text" name = "experience_name[]">
                    </div>`);
});


// REMOVE Experience
$('#remove-exp-btn').on('click', function () {

    let count = $('#experiences-wrapper .experiences-group').length;

    if (count > 1) {
        
        $('#experiences-wrapper .experiences-group').last().remove();
    }

  
    $('#experiences-wrapper .experiences-group').each(function (index) {
        $(this).find('p').text(`Experiences ${index + 1}`);
    });

   
    if ($('#experiences-wrapper .experiences-group').length <= 1) {
        $('#remove-exp-btn').hide();
    }
});

// profile edit section
$("#profileInput").on("change", function () {
    let reader = new FileReader();

    reader.onload = function (e) {
        $("#profileImage").attr("src", e.target.result);
    };

    reader.readAsDataURL(this.files[0]);
});

// Choose one regex:
  const reStrong = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,}$/; // strong
  const strong = reStrong; // pick your desired rule

  $("#password").on('input',function(){
    const val=$(this).val();
    const validStrong=strong.test(val);
    $("#strError").css({"color":validStrong?"green":"red"});
  });


$(document).on("click", ".edit-icon", function () {
    let input = $(this).siblings("input");

    // Agar ye DOB wala input hai
    if (input.attr("id") === "DobInput") {
        // Agar abhi text hai -> date me convert karo
        if (input.attr("type") === "text") {
            let dateObj = new Date(input.val());
            let isoDate = dateObj.toISOString().split("T")[0]; // "2006-06-06"

            input.attr("type", "date");
            input.prop("readonly", false);
            input.val(isoDate);
            // input.css("outline-style", "solid");
            input.focus();
        } else {
            // Agar abhi date hai -> wapas text me convert karo
            let dateObj = new Date(input.val());
            let formatted = ("0" + dateObj.getDate()).slice(-2) + " " +
                            dateObj.toLocaleString("default", { month: "short" }) + " " +
                            dateObj.getFullYear();

            input.attr("type", "text");
            input.prop("readonly", true);
            input.val(formatted);
            input.css("border", "none");
        }
    } else {
        // Normal text inputs ke liye simple toggle
        if (input.prop("readonly")) {
            input.prop("readonly", false);
            // input.css("outline-style", "solid");
            input.focus();
        } else {
            input.prop("readonly", true);
            input.css("border", "none");
        }
    }
});








