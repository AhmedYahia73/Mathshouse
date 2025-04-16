<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled Table</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;T
    margin: 0;
    padding: 20px;
}

table.styled-table {
    width: 100%;
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 18px;
    text-align: left;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    border-radius: 5px;
    overflow: hidden;
}

table.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
    font-weight: bold;
}

table.styled-table th,
table.styled-table td {
    padding: 12px 15px;
}

table.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

table.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

table.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}

table.styled-table tbody tr:hover {
    background-color: #f1f1f1;
}
table .delay{
    color: #ff0000;
}
table .not_delay{
    color: #009879;
}

    </style>
</head>
<body>
    <table class="styled-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Delay</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {{$report['date']}}
                </td>
                <td>
                    {{$report['time']}}
                </td>
                @if ( $report['color'] )
                <td class="delay">
                    {{$report['delay']}}
                </td>
                @else
                <td class="not_delay">
                    {{$report['delay']}}
                </td>
                @endif
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
</body>
</html>
