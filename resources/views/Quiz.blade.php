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
    $page_name = 'Mistakes';
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mistakes</title>
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for Icons -->
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
            background-color: #fff;
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            text-align: center;
        }

        .header-logo img {
            max-width: 150px;
            height: auto;
        }

        /* Main Container */
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 40px;
            background: #fbe5e6;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
            animation: fadeIn 0.5s ease forwards;
        }

        /* Header Title */
        .header {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .header h1 {
            font-size: 2rem;
            color: #CF3F43;
            letter-spacing: 1.2px;
            font-weight: 700;
            text-transform: uppercase;
        }

        /* Info Section Grid */
        .info {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            padding: 15px;
            background: #fff;
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

        /* Mistakes Section */
        .mistakes-section {
            margin-top: 2rem;
        }

        .mistake {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .mistake:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        }

        .course-title {
            font-size: 1.8rem;
            color: #CF3F43;
            font-weight: 600;
            margin-bottom: 10px;
            text-align: center;
        }

        .quesMisake {
            font-size: 1.2rem;
            font-weight: 500;
            color: #333;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .imgMistake {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .imgMistake:hover {
            transform: scale(1.02);
        }

        /* Modal Styling */
        .modal-dialog {
            max-width: 80%;
            margin: 1.75rem auto;
        }

        .modal-backdrop.show {
            opacity: 0.5 !important;
        }

        .imgMistakeModal {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 10px;
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
                font-size: 1.5rem;
            }

            .info {
                grid-template-columns: 1fr;
            }

            .info-item h2 {
                font-size: 1rem;
            }

            .course-title {
                font-size: 1.5rem;
            }

            .quesMisake {
                font-size: 1.1rem;
            }

            .header-logo img {
                max-width: 120px;
            }

            .modal-dialog {
                max-width: 95%;
            }
        }
    </style>
</head>
<body>
    <!-- Sticky Header with Logo -->
    <header class="header-logo">
        <img src="{{ asset('logos/Maths-house.png') }}" alt="Maths House Logo">
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="header">
            <h1>Mistakes</h1>
        </div>

        <!-- Exam Details -->
        <div class="info">
            <div class="info-item">
                <h2><i class="fas fa-user"></i> Student: {{ auth()->user()->nick_name }}</h2>
            </div>
            <div class="info-item">
                <h2><i class="fas fa-book"></i> Course: {{ $dai_exam->course->course_name }}</h2>
            </div>
            <div class="info-item">
                <h2><i class="fas fa-folder"></i> Category: {{ $dai_exam->course->category->cate_name }}</h2>
            </div>
            <div class="info-item">
                <h2><i class="fas fa-file-alt"></i> Exam: {{ $dai_exam->title }}</h2>
            </div>
            <div class="info-item">
                <h2><i class="fas fa-calendar"></i> Date: {{ $history->date }}</h2>
            </div>
            <div class="info-item">
                <h2><i class="fas fa-clock"></i> Time: {{ $history->time }}</h2>
            </div>
            <div class="info-item">
                <h2 class="delay"><i class="fas fa-hourglass-half"></i> Delay: {{ $delay }}</h2>
            </div>
            <div class="info-item">
                <h2><i class="fas fa-star"></i> Score: {{ $history->score }}</h2>
            </div>
        </div>

        <!-- Mistakes Section -->
        <div class="mistakes-section">
            @foreach ($mistakes as $mistake)
                <div class="mistake">
                    <p class="course-title">{{ $mistake->question->lessons->chapter->chapter_name }}</p>
                    @if (!empty($mistake->question->question))
                        <span class="quesMisake">{!! $mistake->question->question !!}</span>
                    @endif
                    @if (!empty($mistake->question->q_url))
                        <div style="width: 100%; padding: 5px;">
                            <img class="imgMistake"
                                 src="{{ asset('images/questions/' . $mistake->question->q_url) }}"
                                 data-bs-toggle="modal"
                                 data-bs-target="#kt_modal_edit{{$mistake->id}}{{$mistake->question->id}}" />
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Footer -->
        <div class="footer">
            © {{ date('Y') }} Maths House
        </div>
    </div>
</body>
</html>
