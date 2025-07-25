<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cars PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }
        th, td {
            border: 1px solid #888;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #ccc;
        }
    </style>
</head>
<body>
    <h2>Cars List</h2>
    <table>
        <thead>
            <tr>
                <th>Make</th>
                <th>Model</th>
                <th>Produced On</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cars as $car)
                <tr>
                    <td>{{ $car->make }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->produced_on }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
