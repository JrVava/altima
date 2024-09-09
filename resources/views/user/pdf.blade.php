<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Users PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Users List</h1>
    <table>
        <thead>
            <tr>
                <th>User Name</th>
                <th>Position Code</th>
                <th>Employee Code</th>
                <th>Position Name</th>
                <th>HQ Code</th>
                <th>HQ Name</th>
                <th>Role</th>
                <th>Role</th>
                <th>Doctor Name</th>
                <th>Speciality</th>
                <th>Place</th>
                <th>Poster</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->user_name }}</td>
                    <td>{{ $user->position_code }}</td>
                    <td>{{ $user->emp_code }}</td>
                    <td>{{ $user->position_name }}</td>
                    <td>{{ $user->hq_code }}</td>
                    <td>{{ $user->hq_name }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->userDetail->doctor_name }}</td>
                    <td>{{ $user->userDetail->speciality }}</td>
                    <td>{{ $user->userDetail->place }}</td>
                    <td>{{ route('download', ['user_id' => $user->id]) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
