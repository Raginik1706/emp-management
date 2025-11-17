<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signupPage</title>
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

        @vite(['resources/js/app.js'])
</head>

<body>

    <div class="container">
        <h2>Employee Registration Form</h2>
        <form action="\register" method="POST">
            @csrf
            <div class="profile-section">
                <div id="profile">
                    <i class="fa-solid fa-user"></i>
                </div>
                <input type="file" id="profileInput" accept="image/*" style="display:none;">
                <button type="button" id="profile-upload-btn">Upload Profile Pic</button>
                <button type="button" id="profile-remove-btn" style="display:none;">Remove</button>
            </div>


            <label for="">Full Name</label>
            <input type="text" name="name">

            <label for="">Date of Birth</label>
            <input type="date" name="dob" >

            <label for="">Email Address</label>
            <input type="email" name="email" >

            <div class="password-section">
                <div>
                    <label for="">Password</label>
                    <input type="password" name="password" >
                    <p>Use A-Z,a-z,0-9, !@#$%^&* in password</p>
                </div>

                <div>
                    <label for="">Re - Password</label>
                    <input type="password" name="confirm_password" >
                </div>
                
            </div>

            <div class="career-section">
                <p><b>Add your Qualifications</b></p>
                
                <div id="qualifications-wrapper">
                    <div class="qualifications-group">
                        <p style="color: #9BA0AA;">Qualifications 1</p>
                        <input type="text" name = "qualification_name[]">
                    </div>
                </div>
               
                <div class="qual-btn-group">
                    <button type="button" id="add-qual-btn">Add Qualification</button>
                    <button type="button" id="remove-qual-btn">remove</button>
                </div>
            </div>

             <div class="career-section">
                <p><b>Add your Experiences</b></p>
                
                <div id="experiences-wrapper">
                    <div class="experiences-group">
                        <p style="color: #9BA0AA;">Experiences 1</p>
                        <input type="text" name = "experience_name[]">
                    </div>
                </div>
               
                <div class="exp-btn-group">
                    <button type="button" id="add-exp-btn">Add Experience</button>
                    <button type="button" id="remove-exp-btn">remove</button>
                </div>
            </div>


            <div class="address">
                <p><b>Permanent Address</b></p>
                <input type="text"  name="p_line1" placeholder="Line1">
                <input type="text" name="p_line2"  placeholder="Line2">
             </div>

            <div class="locality">
                <div>
                    <p>City</p>
                    <input type="text" name="p_city"  placeholder="City">
                </div>

                <div>
                    <p>State</p>
                    {{-- <input type="text" name="p_state" > --}}
                    <select name="p_state" id="">
                        <option value="">bihar</option>
                    </select>
                </div>

            </div>

            <div class="address">
                <p><b>Current Address</b></p>

                <input type="text" name="c_line1" placeholder="Line1" >
                <div>
                    <input type="text" name="c_line2"  placeholder="Line2" >
                </div>


            </div>
            <div class="locality">
                <div>
                    <p>City</p>
                    <input type="text" name="c_city"  placeholder="City">
                </div>

                <div>
                    <p>State</p>
                    <input type="text" name="c_state" >
                </div>

            </div>


            <button type="submit">Sign Up</button>
            <button type="button"><a href="/login">Login</a></button>
        </form>

    </div>

    {{-- <script src = "{{asset('script.js')}}"></script> --}}
</body>

</html>