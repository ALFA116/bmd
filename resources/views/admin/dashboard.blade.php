<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .user-info {
            display: flex;
            align-items: center;
        }
        .user-info i {
            margin-right: 10px;
            color: #888;
        }
        .button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-left: 10px;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .stats {
            display: flex;
            width: 100%;
            justify-content: space-around;
            margin-bottom: 20px;
        }
        .stat {
            text-align: center;
        }
        .stat i {
            display: block;
            font-size: 38px;
            margin-bottom: 5px;
            color: #888;
        }
        .user-list {
            list-style: none;
            padding: 0;
        }
        .user-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #fff;
            margin-bottom: 10px;
            border-radius: 4px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .user-list button {
            margin-left: 10px;
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .user-list button:hover {
            background-color: #0056b3;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="header">
        <div class="user-info">
            <i class="fa fa-user-circle" style="color: rgb(197, 111, 183);"></i>
            @if(auth()->check())
                <span>{{ auth()->user()->name }} | {{ auth()->user()->role->name }}</span>
            @else
                <span>Guest | Admin</span>
            @endif
        </div>
        <div>
            <button class="button" onclick="window.location.href='/admin/create-user'">Create User</button>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="button" style="background-color: orange; color: black;">Logout</button>
            </form>
        </div>
    </div>
    <div class="stats">
        <div class="stat">
            <i class="fa fa-box" style="color: brown;"></i>
            {{-- <h2>{{ $products->count() }}</h2> --}}
            <p>Products</p>
        </div>
        <div class="stat">
            <i class="fa fa-wallet" style="color: blue;"></i>
            <h2>{{ $totalTransactions }}</h2>
            <p>Transactions</p>
        </div>
        <div class="stat">
            <i class="fa fa-users" style="color: rgb(211, 182, 95);"></i>
            <h2>{{ $users->count() }}</h2>
            <p>User</p>
        </div>
    </div>
    <ul class="user-list">
        @foreach($users as $user)
        <li>
            <span><i class="fa fa-user"></i> {{ $user->name }} | {{ $user->role->name }}</span>
            <div>
                <button onclick="window.location.href='/admin/edit-user/{{ $user->id }}'" style="background-color: green; color: white;">Edit</button>
                <form method="POST" action="/admin/delete-user/{{ $user->id }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background-color: red; color: white;">Delete</button>
                </form>
            </div>
        </li>
        @endforeach
    </ul>
</body>
</html>
