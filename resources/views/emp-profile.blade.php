<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee-Profile</title>
    <link rel="stylesheet" href="{{asset('style.css')}}">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
     @vite(['resources/js/app.js'])
</head>

<body>
    <div class="container emp-container">
        <h2>Employee Profile</h2>
        <div class="profile-section">
   <div class="profile-wrapper">
    <img id="profileImage" src="{{ asset('profileImages/'.$user->profile) }}">

    <label for="profileInput" class="edit-icon">
        <i class="fa-solid fa-pen"></i>
    </label>

    <input type="file" id="profileInput" accept="image/*" hidden>
</div>

</div>

       
        <div class = "edit-wrapper" style="position:relative;">
             <h2>{{$user?->name}}</h2>
            <label for="nameInput" class="edit-icon" style="margin:-15px 0px 0px 0px;">
                <i class="fa-solid fa-pen" style="color:gray"></i>
            </label>
             <input type="file" id="nameInput" accept="image/*" hidden>
        </div>
        <p>{{$user?->email}}</p>
        <div class="edit-wrapper" style="position:relative;">
            <p>DOB - {{ $user?->dob_formatted }}</p>
            <label for="DOBInput" class="edit-icon" style="margin:-15px 0px 0px 0px;">
                <i class="fa-solid fa-pen" style="color:gray"></i>
            </label>
             <input type="file" id="DOBInput" accept="image/*" hidden>
        </div>

    {{-- qualification and experiences --}}

     <div class="box1" class="edit-wrapper">
        
        <div>
            <p><b>Qualifications</b></p>
            @foreach ($user?->qualification as $item)
    <div class="editable">
        <span>{{ $item->qualification_name }}</span>
        <label class="edit-icon"><i class="fa-solid fa-pen"></i></label>
    </div>
    @endforeach
            
             
        </div>
        

        <div>
            <p><b>Experiences</b></p>
             @foreach ($user?->experience as $item)
    <div class="editable">
        <span>{{ $item->experience_name }}</span>
        <label class="edit-icon"><i class="fa-solid fa-pen"></i></label>
    </div>
    @endforeach
        </div>
    </div>

    <div class="box1">
        <div>
            <p><b>Current Address</b></p>
            @php
            $current = explode('||', $user->address?->curr_address ?? '');
            @endphp

            <div>{{ $current[0] ?? 'N/A' }}</div>
            <div>{{ $current[1] ?? 'N/A' }}</div>
            <div>{{ $user->address->curr_city ?? 'N/A' }}</div>
            <div>{{$user->address->curr_state ?? 'N/A'}}</div>
        </div>

        <div>
            <p><b>Permanent Address</b></p>
            @php
            $permanent = explode('||', $user->address?->per_address ?? '');
            @endphp

            <div>{{ $permanent[0] ?? 'N/A' }}</div>
            <div>{{ $permanent[1] ?? 'N/A' }}</div>
            <div>{{ $user->address->per_city ?? 'N/A' }}</div>
           <div>{{$user->address->per_state ?? 'N/A'}}</div>

        </div>
    </div>
     </div>
</body>

</html>