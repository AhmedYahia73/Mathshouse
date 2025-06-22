{{-- <!DOCTYPE html>
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
</html> --}}

@php
    $page_name = 'Student Report';
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Report</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            padding: 20px;
        }

        .header-logo {
            position: sticky;
            top: 0;
            width: 100%;
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .header-logo img {
            max-width: 150px;
            height: auto;
        }

        .container {
            max-width: 1200px;
            display: flex;
            flex-direction: column;
            background: #fbe5e6;
            margin: 2rem auto;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
            animation: fadeIn 0.5s ease forwards;
        }

        .header {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .header h1 {
            font-size: 2rem;
            color: #CF3F43;
            margin: 0;
            letter-spacing: 1.2px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .info {
            margin-bottom: 2rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-radius: 8px;
            transition: transform 0.3s ease;
            max-width: 100%;
            overflow: hidden;
            background: #fff;
        }

        .info-item:hover {
            transform: translateY(-3px);
        }

        .info-item i {
            font-size: 1.5rem;
            color: #CF3F43;
            margin-right: 10px;
        }

        .info-item h2 {
            font-size: 1.1rem;
            font-weight: 500;
            color: #333;
            overflow-wrap: break-word;
            white-space: normal; /* Allow wrapping */
        }

        .info-item .delay {
            color: #CF3F43;
            font-weight: 600;
        }

        .footer {
            margin-top: 3rem;
            text-align: center;
            font-size: 0.9rem;
            color: #666;
            background: #f9f9f9;
            padding: 1rem;
            border-radius: 10px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 992px) {
            .info {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin: 1rem;
            }

            .header h1 {
                font-size: 1.5rem;
            }

            .info {
                grid-template-columns: 1fr;
            }

            .info-item h2 {
                font-size: 1rem;
                overflow-wrap: break-word;
                white-space: normal;
            }

            .header-logo img {
                max-width: 120px;
            }
        }
    </style>
</head>
<body>
    <header class="header-logo">
        <img src="{{ asset('assets/media/logos/mathshouse_white_logoHeader.png') }}" alt="Maths House Logo" style="height: 80px !important;" class="app-sidebar-logo-default" />
    </header>

    <div class="container">
        <div class="header">
            <h1>Student Performance Report</h1>
        </div>

        <div class="info">
            <div class="info-item">
                <h2><i class="fas fa-user"></i> Student: {{ trim(str_replace('  ', ' ', $data?->student?->f_name ?? '')) }} {{ trim(str_replace('  ', ' ', $data?->student?->l_name ?? '')) }}</h2>
            </div>
            <div class="info-item">
                <h2><i class="fas fa-book"></i> Course: {{ $quiz?->lesson?->chapter?->course?->course_name ?? '' }}</h2>
            </div>
            <div class="info-item">
                <h2><i class="fas fa-calendar"></i> Date: {{ $report['date'] }}</h2>
            </div>
            <div class="info-item">
                <h2><i class="fas fa-calendar-day"></i> Day: {{ date('l', strtotime($report['date }')) }}</h2>
            </div>
            <div class="info-item">
                <h2><i class="fas fa-clock"></i> Time: {{ $report['time'] }}</h2>
            </div>
            <div class="info-item">
                @if ($report['color'])
                    <h2 class="delay"><i class="fas fa-hourglass-half"></i> Delay: {{ $report['delay'] }}</h2>
                @else
                    <h2><i class="fas fa-hourglass-half"></i> Delay: {{ $report['delay'] }}</h2>
                @endif
            </div>
            <div class="info-item">
                <h2><i class="fas fa-star"></i> Score: {{ $data->score }}</h2>
            </div>
        </div>

        <div class="footer">
            © {{ date('Y') }} Student Report System
        </div>
    </div>
</body>
</html>
