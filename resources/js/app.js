import './bootstrap';

import $ from 'jquery';
window.$ = $;
window.jQuery = $;

import Swal from 'sweetalert2'


$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});

let originalData = {};
// Save initial values
    $("#emp-form :input[name]").each(function () {
        originalData[$(this).attr("name")] = $(this).val();
    });



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

// -------------- Update Add Qualification field --------------------
$('#add-update-qual-btn').on('click', function () {
    $(".insert-wrapper").show();
    $('.insert-wrapper').append(`
        <div class="updatable" style="padding: 0px">
            <input type="hidden" name="qualification_id[]" value="">
            <input type="text" name="qualification[]" value=""
                style="border:none; background-color:transparent; font-size:16px; outline-style:none; padding:2px 4px"
                 />
            <label class="edit-icon"><i class="fa-solid fa-pen"></i></label>
        </div>
    `);

    // show remove button if more than 1 field
    if ($('.insert-wrapper .updatable').length >= 1) {
        $('#remove-update-qual-btn').show();
    }
});



// REMOVE QUALIFICATION 
$('#remove-update-qual-btn').on('click', function () {

    let count = $('.insert-wrapper .updatable').length;

    if (count >= 1) {
        $('.insert-wrapper .updatable').last().remove();

    }

    if ($('.insert-wrapper .updatable').length <= 0) {
        $(".insert-wrapper").hide();
        $('#remove-update-qual-btn').hide();
    }
});


// -------------- Update Add Qualification field --------------------





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


// -------------- Update add - experience ------------
$('#add-update-exp-btn').on('click', function () {
    $(".insert-exp-wrapper").show();
    $('.insert-exp-wrapper').append(`
        <div class="updatable" style="padding: 0px">
           <input type="hidden" name="experience_id[]" value="">
            <input type="text" name="experience[]" value=""
                style="border:none; background-color:transparent; font-size:16px; outline-style:none; padding:2px 4px"
                 />
            <label class="edit-icon"><i class="fa-solid fa-pen"></i></label>
        </div>
    `);

    // show remove button if more than 1 field
    if ($('.insert-exp-wrapper .updatable').length >=1) {
        $('#remove-update-exp-btn').show();
    }
});


// REMOVE Experience
$('#remove-update-exp-btn').on('click', function () {

    let count = $('.insert-exp-wrapper .updatable').length;

    if (count >= 1) {
        $('.insert-exp-wrapper .updatable').last().remove();

    }

    if ($('.insert-exp-wrapper .updatable').length <= 0) {
        $(".insert-exp-wrapper").hide();
        $('#remove-update-exp-btn').hide();
    }   
});

// -------------- Update add - experience ------------


// profile edit section
$("#profileInput").on("change", function () {
    let reader = new FileReader();

    reader.onload = function (e) {
        $("#profileImage").attr("src", e.target.result);
    };

    reader.readAsDataURL(this.files[0]);
});


  const reStrong = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,}$/; 
  const strong = reStrong; 

  $("#password").on('input',function(){
    const val=$(this).val();
    const validStrong=strong.test(val);
    $("#strError").css({"color":validStrong?"green":"red"});
  });


$(document).on("click", ".edit-icon", function () {
    let input = $(this).siblings("input");

    
    if (input.attr("id") === "DobInput") {
        
        if (input.attr("type") === "text") {
            let dateObj = new Date(input.val());
            let isoDate = dateObj.toISOString().split("T")[0]; 

            input.attr("type", "date");
            input.prop("readonly", false);
            input.val(isoDate);
            // input.css("outline-style", "solid");
            input.focus();
        } else {
        
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
       
        if (input.prop("readonly")) {
            input.prop("readonly", false);
            
            input.focus();
        } else {
            input.prop("readonly", true);
            input.css("border", "none");
        }
    }
});

$("#emp-form").on("submit", function () {

    let dobInput = $("#DobInput");

    // अगर input अभी भी formatted mode में है (text mode)
    if (dobInput.attr("type") === "text") {

        let dateObj = new Date(dobInput.val());
        let isoDate = dateObj.toISOString().split("T")[0]; // yyyy-mm-dd

        dobInput.val(isoDate);
    }
});




// =============================================================================================
// ==================================  Ajext Request code ======================================
// =============================================================================================

$("#registerForm").on("submit", function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: "/register",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            Swal.fire({
                title: "Processing...",
                text: "Please wait",
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });
        },
        success: function (res) {
            Swal.fire({
                title: "Success!",
                text: res.message,
                icon: "success"
            }).then(() => {
                window.location.href = "/login";  // profile page URL
            });
        },
        error: function (xhr) {
            Swal.close();

            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                let html = "";

                $.each(errors, function (key, value) {
                    html += value + "<br>";
                });

                Swal.fire({
                    title: "Validation Errors",
                    html: html,
                    icon: "error"
                });
            } else {
                Swal.fire({
                    title: "Error",
                    text: "Something went wrong!",
                    icon: "error"
                });
            }
        }
    });
});



// ------------ Login Aject ----------

$("#loginForm").on("submit", function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: "/empLogin",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        beforeSend: function () {
            Swal.fire({
                title: "Checking...",
                text: "Please wait",
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });
        },

        success: function (res) {
            Swal.fire({
                icon: "success",
                title: "Login Successful",
                text: res.message,
                timer: 1500,
                showConfirmButton: false
            });

            setTimeout(() => {
                window.location.href = res.redirect;
            }, 1500);
        },

        error: function (xhr) {
            Swal.close();

            if (xhr.status === 422) {
                let err = xhr.responseJSON;

                Swal.fire({
                    icon: "error",
                    title: "Login Failed",
                    text: err.message
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Server Error",
                    text: "Something went wrong."
                });
            }
        }
    });
});



// --------------------- Logout Aject Code -------------------

$("#logoutBtn").on("click", function () {

    Swal.fire({
        title: "Are you sure?",
        text: "You will be logged out!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, Logout",
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: "/logout",
                type: "POST",
                data: {},
                success: function (res) {
                    Swal.fire({
                        title: "Logged Out",
                        text: res.message,
                        icon: "success",
                        timer: 1000,
                        showConfirmButton: false
                    });

                    setTimeout(() => {
                        window.location.href = res.redirect;
                    }, 1000);
                },

                error: function () {
                    Swal.fire({
                        title: "Error",
                        text: "Something went wrong.",
                        icon: "error"
                    });
                }
            });
        }
    });
});




// ------------------------ Profile Update Aject -----------------------



$("#emp-form").on("submit", function (e) {
    e.preventDefault();

    let isChanged = false;

    $("#emp-form :input[name]").each(function () {
        let name = $(this).attr("name");
        let currentValue = $(this).val();

        if (originalData[name] != currentValue) {
            isChanged = true;
            return false; // break loop
        }
    });

    if ($("#profileInput").val() !== "") {
        isChanged = true;
    }


    if (!isChanged) {
        Swal.fire({
            icon: "info",
            title: "Nothing to Update",
            text: "You didn't change anything.",
        });
        return; // AJAX abort
    }

    // If changes found → AJAX call run karega
    updateProfileAjax();
});

function updateProfileAjax() {
    let formData = new FormData(document.getElementById("emp-form"));

    $.ajax({
        url: "/employee/update",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        beforeSend: function () {
            Swal.fire({
                title: "Updating...",
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });
        },

        success: function (res) {
            Swal.fire({
                icon: "success",
                title: res.message,
                timer: 1500,
                showConfirmButton: false
            });

            setTimeout(() => {
                window.location.href = res.redirect;
            }, 1500);
        },

        error: function (xhr) {
            Swal.close();

            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                let list = "";

                $.each(errors, function (key, value) {
                    list += value + "<br>";
                });

                Swal.fire({
                    icon: "error",
                    title: "Validation Error",
                    html: list
                });

            } else {
                Swal.fire({
                    icon: "error",
                    title: "Server Error",
                    text: "Something went wrong."
                });
            }
        }
    });
}








