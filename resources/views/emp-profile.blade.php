<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee-Profile</title>
    <link rel="stylesheet" href="{{asset('style.css')}}">
</head>

<body>
    <div class="container">
        <h2>Employee Profile</h2>
        <div class="profile-section">
            <div class="profile">
                njknj
            </div>
        </div>
        <h2>{{$user?->name}}</h2>
        {{-- <h2>{{session('userid')}}</h2> --}}
        <p>{{$user?->email}}</p>
        <p>DOB - {{ $user?->dob_formatted }}</p>

   

    <div class="location">
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

            <div>{{ $permanent[0] ?? 'N/A' }}adsgfryjgkjhbjvgngknkkmmkdsovjsdoivjcweoicjes nskoegvfdkvendkefwefclkdsssssssssssssssssssssssssssssocfsd cefjewiofjwofjoewfjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjoqqwdjsdosdojdnji</div>
            <div>{{ $permanent[1] ?? 'N/A' }}</div>
            <div>{{ $user->address->per_city ?? 'N/A' }}</div>
           <div>{{$user->address->per_state ?? 'N/A'}}</div>

        </div>
    </div>
     </div>
</body>

</html>