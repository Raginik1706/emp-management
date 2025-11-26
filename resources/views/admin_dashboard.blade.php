<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>

<body>

<div class="page-container">

    <!-- Header -->
    <div class="header-row">
        <h2>Employee List</h2>

        <div class="admin-info">
            <span>Hi, Admin</span>
            <a href="{{ route('logout') }}" class="logout">Log Out</a>
        </div>
    </div>

    <!-- Table -->
    <div class="table-wrapper">
        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Qualification</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>

            @foreach($employees as $emp)
                <tr>
                    <td>{{ $emp->name }}</td>
                    <td>{{ $emp->email }}</td>

                    <td>
                        @if($emp->qualification->count() > 0)
                            @foreach($emp->qualification as $q)
                                {{ $q->qualification_name }}@if(!$loop->last), @endif
                            @endforeach
                        @else
                            N/A
                        @endif
                    </td>
                        <td>
                        <a href="{{ route('employee.view', $emp->id) }}" class="view-btn">View</a>

                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

</div>

</body>
</html>
