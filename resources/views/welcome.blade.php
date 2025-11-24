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
        <form action="\register" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="profile-section">
                <div id="profile">
                    <i class="fa-solid fa-user"></i>
                </div>
                <input type="file" id="profileInput" name="profile" accept="image/*" style="display:none;" >
                <button type="button" id="profile-upload-btn">Upload Profile Pic</button>
                <button type="button" id="profile-remove-btn" style="display:none;">Remove</button>
            </div>


            <label for="">Full Name</label>
            <input type="text" name="name" value="{{old('name')}}">
            @error('name')
                <span style="color:red; font-weight:600; font-size:13px; margin-top:-10px">{{ $message }}</span>
            @enderror

            <label for="">Date of Birth</label>
            <input type="date" name="dob" value="{{old('dob')}}">
             @error('dob')
                <span style="color:red; font-weight:600; font-size:13px; margin-top:-10px">{{ $message }}</span>
            @enderror

            <label for="">Email Address</label>
            <input type="email" name="email" value="{{old('email')}}">
             @error('email')
                <span style="color:red; font-weight:600; font-size:13px; margin-top:-10px">{{ $message }}</span>
            @enderror

            <div class="password-section">
                <div>
                    <label for="">Password</label>
                    <input type="password" name="password" id="password">
                    <p id="strError">Use A-Z,a-z,0-9, !@#$%^&* in password</p>
                    <span id="pwdError"></span><br/>
                    

                    @error('password')
                     <span style="color:red; font-weight:600; font-size:13px; margin-top:-10px">{{ $message }}</span>
                    @enderror

                </div>

                <div>
                    <label for="">Re - Password</label>
                    <input type="password" name="password_confirmation">
                     @error('password_confirmation')
                        <span style="color:red; font-weight:600; font-size:13px; margin-top:-10px">{{ $message }}</span>
                    @enderror

                </div>
            </div>
           
            <div class="career-section">
                <p><b>Add your Qualifications</b></p>
                
                <div id="qualifications-wrapper">
                    <div class="qualifications-group">
                        <p style="color: #9BA0AA;">Qualifications 1</p>
                        <input type="text" name = "qualification_name[]">
                        @error('qualification_name.*')
                            <span style="color:red; font-weight:600; font-size:13px; ">{{ $message }}</span>
                        @enderror
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
                        @error('experience_name.*')
                            <span style="color:red; font-weight:600; font-size:13px; ">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
               
                <div class="exp-btn-group">
                    <button type="button" id="add-exp-btn">Add Experience</button>
                    <button type="button" id="remove-exp-btn">remove</button>
                </div>
            </div>


            <div class="address">
                <p><b>Permanent Address</b></p>
                <input type="text"  name="p_line1" placeholder="Line1" value="{{old('p_line1')}}">
                <input type="text" name="p_line2"  placeholder="Line2" value="{{old('p_line2')}}">
                @error('p_line1')
                    <span style="color:red; font-weight:600; font-size:13px; margin-top:-10px">{{ $message }}</span>
                @enderror
             </div>

            <div class="locality">
                <div>
                    <p>City</p>
                    <input type="text" name="p_city"  placeholder="City" value="{{old('p_city')}}">
                    @error('p_city')
                        <span style="color:red; font-weight:600; font-size:13px; margin-top:-10px">{{ $message }}</span>
                    @enderror
                </div>
                

                <div>
                    <p>State</p>
                    {{-- <input type="text" name="p_state" > --}}
                    <select name="p_state" id="p_state">
                        <option value="" disable selected>Select State</option>
                        @foreach ($states as $state)
                            <option value="{{$state}}" >{{$state}}</option>
                        @endforeach
                    </select>
                    @error('p_state')
                        <span style="color:red; font-weight:600; font-size:13px; margin-top:-10px">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="address">
                <p><b>Current Address</b></p>

                <input type="text" name="c_line1" placeholder="Line1" value="{{old('c_line1')}}">
                <div>
                    <input type="text" name="c_line2"  placeholder="Line2" value="{{old('c_line2')}}">
                </div>
                 @error('c_line1')
                        <span style="color:red; font-weight:600; font-size:13px; margin-top:-10px">{{ $message }}</span>
                @enderror


            </div>
            <div class="locality">
                <div>
                    <p>City</p>
                    <input type="text" name="c_city"  placeholder="City" value="{{old('c_city')}}">
                     @error('c_city')
                        <span style="color:red; font-weight:600; font-size:13px; margin-top:-10px">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <p>State</p>
                     <select name="c_state" id="c_state">
                        <option value="" disable selected>Select State</option>
                        @foreach ($states as $state)
                            <option value="{{$state}}" >{{$state}}</option>
                        @endforeach
                    </select>
                    @error('c_state')
                        <span style="color:red; font-weight:600; font-size:13px; margin-top:-10px">{{ $message }}</span>
                    @enderror
                </div>

            </div>


            <button type="submit">Sign Up</button>
            <button type="button"><a href="/login">Login</a></button>
        </form>

    </div>

    {{-- <script src = "{{asset('script.js')}}"></script> --}}
</body>

</html>