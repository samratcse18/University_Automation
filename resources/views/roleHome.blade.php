<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('role') }}" method="POST">
        @csrf
        role:<input type="text" name="role">
        <br>
        permission:<input type="text" name="permission">
        <br>
        guard: <select name="guard" id="">
            <option value="admin">admin</option>
            <option value="bank">bank</option>
        </select>
        <input type="submit" value="submit">
    </form>
</body>
</html>