<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 30px;
            color: #333;
        }

        .container {
            max-width: 800px;
            background: #fff;
            margin: auto;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            font-size: 32px;
            color: #00796b;
            margin: 0;
            letter-spacing: 1px;
        }

        .info {
            margin-bottom: 30px;
            line-height: 1.8;
        }

        .info h2 {
            font-size: 20px;
            margin: 8px 0;
            font-weight: 500;
        }

        .info .delay {
            color: #d32f2f;
            font-weight: bold;
        }

        table.styled-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            font-size: 16px;
            border: 1px solid #e0e0e0;
            background: #fafafa;
        }

        table.styled-table thead tr {
            background-color: #00796b;
            color: #ffffff;
            text-align: left;
            font-weight: bold;
        }

        table.styled-table th, 
        table.styled-table td {
            padding: 14px 18px;
            border: 1px solid #e0e0e0;
        }

        table.styled-table tbody tr:nth-of-type(even) {
            background-color: #f0f0f0;
        }

        table.styled-table tbody tr:hover {
            background-color: #e0f2f1;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Student Performance Report</h1>
        </div>

        <div class="info">
            <h2>Student: {{ $data?->student?->f_name ?? '' }} {{ $data?->student?->l_name ?? '' }}</h2>
            <h2>Course: {{ $quiz?->lesson?->chapter?->course?->course_name ?? '' }}</h2>
            <h2>Date: {{ $report['date'] }}</h2>
            <h2>Day: {{ date('l', strtotime($report['date'])) }}</h2>
            <h2>Time: {{ $report['time'] }}</h2>
            @if ($report['color']) 
                <h2 class="delay">Delay: {{ $report['delay'] }}</h2>
            @else
                <h2>Delay: {{ $report['delay'] }}</h2>
            @endif
            <h2>Score: {{ $data->score }}</h2>
        </div>

        <!-- Optional Table -->
        <!--
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Field</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Example Field</td>
                    <td>Example Value</td>
                </tr>
            </tbody>
        </table>
        -->

        <div class="footer">
            © {{ date('Y') }} Student Report System
        </div>
    </div>
</body>
</html>
