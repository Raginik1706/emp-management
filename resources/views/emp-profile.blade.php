<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Employee-Profile</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    
  @vite(['resources/js/app.js'])


</head>

<body style="display: flex; flex-direction:column">
    <div style="display: flex; gap:5px; align-items:center; width:100%; justify-content:end; padding:40px 100px">
       <button id="logoutBtn" style="border:2px dotted red; paddin:5px; background:rgb(255, 255, 255); cursor:pointer; width:100px; height:35px; color:red">
            Logout
        </button>
    </div>
    <form class="container emp-container" enctype="multipart/form-data" id="emp-form">
        @csrf
        <h2>Employee Profile</h2>
        <div class="profile-section">
            <div class="profile-wrapper">
                <img id="profileImage" src="{{ asset('profileImages/' . $user->profile) }}">

                <label for="profileInput" class="edit-icon" style="margin:105px 30px 0px 0px; opacity:1">
                    <i class="fa-solid fa-pen"></i>
                </label>

                <input type="file" id="profileInput" name="profile" accept="image/*" hidden>
            </div>

        </div>

        <input type="hidden" name="userId" value="{{ session('userid')}}">


        <div class = "edit-wrapper" style="position:relative;">
           
            <input type="text" id="nameInput" name="name" value="{{ $user?->name }}"
                style="border:none; background-color:transparent; font-weight:600; font-size:18px; text-align:center; outline-style:none;"
                readonly>
            <label for="nameInput" class="edit-icon" style="margin:-15px 0px 0px 0px;">
                <i class="fa-solid fa-pen" style="color:gray"></i>
            </label>
            <br/>
        </div>
         @error('name')
            <span style="color:red; font-weight:600; font-size:13px; margin-top:-10px">{{ $message }}</span>
         @enderror
        <p>{{ $user?->email }}</p>
        @php
            $dob = $user?->dob ? \Carbon\Carbon::parse($user->dob)->format('d M Y') : '';
       @endphp

        <div class="edit-wrapper" style="position:relative;">
            DOB -
            <input type="text" id="DobInput" name="dob"value="{{ $dob }}"
            style="border:none; background-color:transparent; font-weight:600; font-size:18px; outline-style:none; max-width:135px;"
            readonly>
            <label for="DobInput" class="edit-icon" style="margin:-15px 0px 0px 0px;">
                <i class="fa-solid fa-pen" style="color:gray" id="edit-icon-date"></i>
            </label>
        </div>
                 @error('dob')
            <span style="color:red; font-weight:600; font-size:13px; margin-top:-10px">{{ $message }}</span>
         @enderror


        {{-- qualification and experiences --}}

        <div class="box1" class="edit-wrapper">

            <div>
                <p><b>Qualifications</b></p>
                @foreach ($user?->qualification as $item)
                    <div class="editable" style="padding:0px 4px">
                        <!-- Hidden ID -->
                        <input type="hidden" name="qualification_id[]" value="{{ $item->id }}">

                        <input type="text" name="qualification[]" value="{{ $item->qualification_name }}"
                            style="border:none; background-color:transparent; font-size:16px; outline-style:none; padding:5px 2px"
                            readonly />
                        <label class="edit-icon"><i class="fa-solid fa-pen"></i></label>
                    </div>
                @endforeach
                @error('qualification.*')
                    <span style="color:red; font-weight:600; font-size:13px; margin-top:-10px">{{ $message }}</span>
                @enderror

                   <div class="insert-wrapper" style="display:none; gap:10px; flex-direction:column; background:transparent;padding:0px;">
                    </div>

                    <div class="qual-btn-group" style="background: transparent;">
                        <button type="button" id="add-update-qual-btn" style="text-align:left; padding:0px 8px">Add Qualification</button>
                        <button type="button" id="remove-update-qual-btn" style="text-align:left; padding:0px 8px">remove</button>
                    </div>
             </div>


            <div>
                <p><b>Experiences</b></p>
                @foreach ($user?->experience as $item)
                    <div class="editable">
                        <input type="hidden" name="experience_id[]" value="{{ $item->id }}">
                        <input type="text" name="experience[]" value="{{ $item->experience_name }}"
                            style="border:none; background-color:transparent; font-size:16px; outline-style:none; padding:5px 2px"
                            readonly />
                        <label class="edit-icon"><i class="fa-solid fa-pen"></i></label>
                    </div>
                @endforeach
                @error('experience.*')
                    <span style="color:red; font-weight:600; font-size:13px; margin-top:-10px">{{ $message }}</span>
                @enderror
                <div class="insert-exp-wrapper" style="display:none; gap:10px; flex-direction:column; background:transparent;padding:0px;">
                </div>
                <div class="exp-btn-group" style="background: transparent;">
                    <button type="button" id="add-update-exp-btn" style="text-align:left; padding:0px 8px">Add Experience</button>
                    <button type="button" id="remove-update-exp-btn" style="text-align:left; padding:0px 8px">remove</button>
                </div>
            </div>
        </div>

        <div class="box1">
            <div>
                <p><b>Current Address</b></p>
                @php
                    $current = explode('||', $user->address?->curr_address ?? '');
                @endphp

                
                <div class="editable">
                    <input type="text" name="c_line1" value="{{ $current[0] ?? 'N/A' }}"
                            style="border:none; background-color:transparent; font-size:16px; outline-style:none; padding:2px 2px"
                            readonly />
                    <label class="edit-icon"><i class="fa-solid fa-pen"></i></label>
                </div>
                @error('c_line1')
                    <span style="color:red; font-weight:600; font-size:13px; margin-top:-10px">{{ $message }}</span>
                @enderror
                <div class="editable">
                    <input type="text" name="c_line2" value="{{ $current[1] ?? 'N/A' }}"
                            style="border:none; background-color:transparent; font-size:16px; outline-style:none; padding:2px 2px"
                            readonly />
                    <label class="edit-icon"><i class="fa-solid fa-pen"></i></label>
                </div>
                <div class="editable">
                    <input type="text" name="c_city" value="{{ $user->address->curr_city ?? 'N/A' }}"
                            style="border:none; background-color:transparent; font-size:16px; outline-style:none; padding:2px 2px"
                            readonly />
                    <label class="edit-icon"><i class="fa-solid fa-pen"></i></label>
                </div>
                 @error('c_city')
                    <span style="color:red; font-weight:600; font-size:13px; margin-top:-10px">{{ $message }}</span>
                @enderror
                <div class="editable">
                    <input type="text" name="c_state" value="{{ $user->address->curr_state ?? 'N/A' }}"
                            style="border:none; background-color:transparent; font-size:16px; outline-style:none; padding:2px 2px"
                            readonly />
                    <label class="edit-icon"><i class="fa-solid fa-pen"></i></label>
                </div>
                 @error('c_state')
                    <span style="color:red; font-weight:600; font-size:13px; margin-top:-10px">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <p><b>Permanent Address</b></p>
                @php
                    $permanent = explode('||', $user->address?->per_address ?? '');
                @endphp
                <div class="editable">
                    <input type="text" name="p_line1" value="{{ $permanent[0] ?? 'N/A' }}"
                            style="border:none; background-color:transparent; font-size:16px; outline-style:none; padding:2px 2px"
                            readonly />
                    <label class="edit-icon"><i class="fa-solid fa-pen"></i></label>
                </div>
                @error('p_line1')
                    <span style="color:red; font-weight:600; font-size:13px; margin-top:-10px">{{ $message }}</span>
                @enderror
                <div class="editable">
                    <input type="text" name="p_line2" value="{{ $permanent[1] ?? 'N/A' }}"
                            style="border:none; background-color:transparent; font-size:16px; outline-style:none; padding:2px 2px"
                            readonly />
                    <label class="edit-icon"><i class="fa-solid fa-pen"></i></label>
                </div>
                <div class="editable">
                    <input type="text" name="p_city" value="{{ $user->address->per_city ?? 'N/A' }}"
                            style="border:none; background-color:transparent; font-size:16px; outline-style:none; padding:2px 2px"
                            readonly />
                    <label class="edit-icon"><i class="fa-solid fa-pen"></i></label>
                </div>
                 @error('p_city')
                    <span style="color:red; font-weight:600; font-size:13px; margin-top:-10px">{{ $message }}</span>
                @enderror
                <div class="editable">
                    <input type="text" name="p_state" value="{{ $user->address->per_state ?? 'N/A' }}"
                            style="border:none; background-color:transparent; font-size:16px; outline-style:none; padding:2px 2px"
                            readonly />
                    <label class="edit-icon"><i class="fa-solid fa-pen"></i></label>
                </div>
                @error('p_state')
                    <span style="color:red; font-weight:600; font-size:13px; margin-top:-10px">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div>
            <button type="submit" style="width: 100px">Save</button>
        </div>
    </form>
</body>

</html>
