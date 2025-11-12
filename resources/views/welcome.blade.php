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

        {{-- @vite(['resources/js/app.js']); --}}
</head>

<body>

    <div class="container">
        <h2>Employee Registration Form</h2>
        <form action="\register" method="POST">
            @csrf
            <div class="profile-section">
                <div id="profile"><i class="fa-solid fa-user"></i></div>

                <button type="file" id="profile-upload-btn">Upload Profile Pic</button>
            </div>


            <label for="">Full Name</label>
            <input type="text" name="name">

            <label for="">Date of Birth</label>
            <input type="date" name="dob" id="">

            <label for="">Email Address</label>
            <input type="email" name="email" id="">

            <div class="password-section">
                <div>
                    <label for="">Password</label>
                    <input type="password" name="password" id="">
                    <p>Use A-Z,a-z,0-9, !@#$%^&* in password</p>
                </div>

                <div>
                    <label for="">Re - Password</label>
                    <input type="password" name="" id="">
                </div>
                
            </div>

            <div class="career-section">
                <p><b>Add your Qualifications</b></p>
                <p style="color: #9BA0AA;">Qualifications 1</p>
                <input type="text" name = "qualification_name[]">
                <div>
                    <a href="">Add Qualification</a>
                </div>

            </div>

            <div class="career-section">
                <p><b>Add your Experiences</b></p>
                <p style="color: #9BA0AA;">Experiences 1</p>
                <input type="text" name="experience_name[]">
                <div>
                    <a href="">Add Experience</a>
                </div>

            </div>

            <div class="address">
                <p><b>Permanent Address</b></p>
                <input type="text"  name="p_line1" placeholder="Line1">
                <input type="text" name="p_line2" id="" placeholder="Line2">
             </div>

            <div class="locality">
                <div>
                    <p>City</p>
                    <input type="text" name="p_city" id="" placeholder="City">
                </div>

                <div>
                    <p>State</p>
                    <input type="text" name="p_state" id="">
                </div>

            </div>

            <div class="address">
                <p><b>Current Address</b></p>

                <input type="text" name="c_line1" placeholder="Line1" >
                <div>
                    <input type="text" name="c_line2" id="" placeholder="Line2" >
                </div>


            </div>
            <div class="locality">
                <div>
                    <p>City</p>
                    <input type="text" name="c_city" id="" placeholder="City">
                </div>

                <div>
                    <p>State</p>
                    <input type="text" name="c_state" id="">
                </div>

            </div>


            <button type="submit">Sign Up</button>
            <button type="submit"><a href="/login">Login</a></button>
        </form>

    </div>

    {{-- <script src = "{{asset('script.js')}}"></script> --}}
</body>

</html>