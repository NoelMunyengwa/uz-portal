<html>
<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center; padding-bottom: 20px;">Timetable</h1>
    <table>
        <thead>
            <tr>
                <th>DEPARTMENT</th>
                <th>LEVEL</th>
                <th>COURSE CODE</th>
                <th>VENUE</th>
                <th>TIME</th>
                <th>DAY</th>
                <th>DURATION (Hours)</th>
                <th>LECTURER</th>
            </tr>
        </thead>
        <tbody>
            @foreach($models as $model)
            <tr>
                <td>{{ $model->department }}</td>
                <td>{{ $model->level }}</td>
                <td>{{ $model->course_code }}</td>
                <td>{{ $model->venue }}</td>
                <td>{{ $model->time }}</td>
                <td>{{ $model->day }}</td>
                <td>{{ $model->duration }}</td>
                <td>{{ $model->lecturer }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>