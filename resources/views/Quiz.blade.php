<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Report</title>
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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

        /* Sticky Header with Logo */
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

        /* Main Container */
        .container {
            max-width: 100%;
            display:flex;
            flex-direction: column;
            background: #fbe5e6;
            margin: 2rem auto;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
            animation: fadeIn 0.5s ease forwards;
        }

        /* Header Title */
        .header {
            margin-bottom: 1.5rem;
        }

        .header h1 {
            font-size: 2rem;
            color: #CF3F43;
            margin: 0;
            letter-spacing: 1.2px;
            font-weight: 700;
            text-transform: uppercase;
        }

        /* Info Section Grid */
        .info {
            margin-bottom: 2rem;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-radius: 8px;
            transition: transform 0.3s ease;
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
        }

        .info-item .delay {
            color: #CF3F43;
            font-weight: 600;
        }

        /* Table Styling */
        .styled-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
            font-size: 1rem;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .styled-table thead tr {
            background-color: #CF3F43;
            color: #fff;
            font-weight: 600;
        }

        .styled-table th,
        .styled-table td {
            padding: 15px 20px;
            border: 1px solid #e0e0e0;
            text-align: left;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f9f9f9;
        }

        .styled-table tbody tr:hover {
            background-color: #FFE6E8;
            transition: background-color 0.3s ease;
        }

        /* Footer */
        .footer {
            margin-top: 3rem;
            text-align: center;
            font-size: 0.9rem;
            color: #666;
            background: #f9f9f9;
            padding: 1rem;
            border-radius: 10px;
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .info {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin: 1rem;
            }

            .header h1 {
                font-size: 1rem;
            }

            .info {
                grid-template-columns: 1fr;
            }

            .info-item h2 {
                font-size: 1rem;
            }

            .styled-table {
                font-size: 0.9rem;
            }

            .styled-table th,
            .styled-table td {
                padding: 10px 12px;
            }

            .header-logo img {
                max-width: 120px;
            }
        }
    </style>
</head>
<body>
    <!-- Sticky Header with Logo -->
    <header class="header-logo">
        <img src="{{ asset('assets/media/logos/mathshouse_white_logoHeader.png') }}" alt="Maths House Logo" style="height: 80px !important;" class="app-sidebar-logo-default" />
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="header">
            <h1>Student Performance Report</h1>
        </div>

        <div class="info">
            <div class="info-item">
                <h2> <i class="fas fa-user"></i> Student: {{ $data?->student?->f_name ?? '' }} {{ $data?->student?->l_name ?? '' }}</h2>
            </div>
            <div class="info-item">
                <h2><i class="fas fa-book"></i> Course: {{ $quiz?->lesson?->chapter?->course?->course_name ?? '' }}</h2>
            </div>
            <div class="info-item">
                <h2><i class="fas fa-calendar"></i> Date: {{ $report['date'] }}</h2>
            </div>
            <div class="info-item">
                <h2><i class="fas fa-calendar-day"></i> Day: {{ date('l', strtotime($report['date'])) }}</h2>
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
