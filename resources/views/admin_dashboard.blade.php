<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <link rel="stylesheet" href="{{asset('style.css')}}">
</head>
<body>

<div class="page-container">

    <div class="header-row">
        <h2>Employee List</h2>

        <div class="admin-info">
            <span>Hi, Admin</span>
            <a href="{{ route('logout') }}" class="logout">Log Out</a>
        </div>
    </div>

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
                <tr>
                    <td>Wade Warren</td>
                    <td>wade@warren.com</td>
                    <td>B.Tech +2</td>
                    <td><a href="#" class="view-btn">View</a></td>
                </tr>

                <tr>
                    <td>Courtney Henry</td>
                    <td>courtney@henry.com</td>
                    <td>B.Tech +2</td>
                    <td><a href="#" class="view-btn">View</a></td>
                </tr>

                <tr>
                    <td>Floyd Miles</td>
                    <td>floyd@miles.com</td>
                    <td>M.Tech +2</td>
                    <td><a href="#" class="view-btn">View</a></td>
                </tr>

                <tr>
                    <td>Eleanor Pena</td>
                    <td>eleanor@pena.com</td>
                    <td>B.Tech +2</td>
                    <td><a href="#" class="view-btn">View</a></td>
                </tr>

                <tr>
                    <td>Jacob Jones</td>
                    <td>jacob@jones.com</td>
                    <td>B.Tech +2</td>
                    <td><a href="#" class="view-btn">View</a></td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
