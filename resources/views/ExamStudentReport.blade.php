<!DOCTYPE html>
<html>

<head>
    <style>
        .header {
            text-align: center;
            font-size: 40px;
        }

        .sl {
            width: 10px;
        }

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid black;
            padding: 8px;
        }


        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="header">All Student List</div>
    <table id="customers">
        <tr>
            <th class="sl">Serial</th>
            <th>Student Name</th>
            <th>Student Number</th>
            <th>Deparment</th>
            <th>Status</th>
        </tr>
        @php
            $i = 0;
            $user = Auth::guard('admin')->user();
        @endphp
        @foreach ($data as $item)
            <tr>
                @if ($user->hasExactRoles('controller'))
                    <td>{{ ++$i }}</td>
                    <td>{{ $item->Name }}</td>
                    <td>{{ $item->student_id }}</td>
                    <td>{{ $item->Department }}</td>
                    <td>{{ $item->status }}</td>
                @endif
                @if ($user->hasRole('admin'))
                    <td>{{ ++$i }}</td>
                    <td>{{ $item->ApplicantName }}</td>
                    <td>{{ $item->RollNumber }}</td>
                    <td>{{ $item->Subject }}</td>
                    <td>{{ $item->status }}</td>
                @endif
                @if ($user->hasExactRoles('office'))
                    @if ($item->student_id)
                        <td>{{ ++$i }}</td>
                        <td>{{ $item->Name }}</td>
                        <td>{{ $item->student_id }}</td>
                        <td>{{ $item->Department }}</td>
                        <td>{{ $item->status }}</td>
                    @else
                        <td>{{ ++$i }}</td>
                        <td>{{ $item->ApplicantName }}</td>
                        <td>{{ $item->RollNumber }}</td>
                        <td>{{ $item->Subject }}</td>
                        <td>{{ $item->status }}</td>
                    @endif
                @endif
            </tr>
        @endforeach
    </table>
</body>

</html>
