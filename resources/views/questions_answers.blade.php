<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions Report</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 20px;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .headtitle {
            text-align: center;
            margin-bottom: 40px;
        }

        .headtitle h2 {
            margin: 5px 0;
            color: #00796b;
            font-weight: 700;
        }

        .info-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 40px;
            font-size: 15px;
            color: #555;
        }

        .info-grid>div {
            flex: 1 1 200px;
        }

        .info-grid span {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .question-card {
            background-color: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            padding: 20px;
            margin-bottom: 30px;
        }

        .question-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
            border-radius: 6px;
        }

        .section-title {
            font-weight: bold;
            font-size: 17px;
            color: #009879;
            margin-bottom: 10px;
        }

        .question-text {
            font-size: 18px;
            color: #444;
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .question-answer {
            font-size: 16px;
            color: #333;
        }

        .no-answer,
        .no-image {
            font-style: italic;
            color: #999;
            margin-bottom: 10px;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            /* margin: auto; */
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .question-card {
            page-break-inside: avoid !important;
            break-inside: avoid !important;
            padding: 20px !important;
            margin-bottom: 20px !important;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: none;
        }

        .question-image {
            display: block;
            max-width: 100%;
            max-height: 600px;
            width: auto;
            height: auto;
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }

        .page-section {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin: auto;
            max-width: 1000px;
            page-break-after: always;
        }

        .no-image {
            font-style: italic;
            color: #999;
            margin-bottom: 15px;
        }

        .section-title {
            font-weight: bold;
            font-size: 16px;
            color: #009879;
            margin-bottom: 5px;
        }

        .question-text {
            font-size: 18px;
            color: #444;
            margin-bottom: 15px;
        }

        .question-answer {
            font-size: 16px;
            color: #333;
        }

        .no-answer {
            font-style: italic;
            color: #aaa;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="page-section">

            <div class="headtitle">
                <h2>Ans - Questions ({{ $questions->count() }})
                for {{ $user->f_name . ' ' . $user->l_name }}</h2>
            </div>

            @php
                $lesson = $questions?->pluck('lessons')?->unique('id')?->values() ?? [];
                $chapter = $lesson?->pluck('chapter')?->flatten(1)?->unique('id')?->values() ?? [];
                $course = $chapter?->pluck('course')?->flatten(1)?->unique('id')?->values() ?? [];
                $category = $course?->pluck('category')?->flatten(1)?->unique('id')?->values() ?? [];
            @endphp
            <div class="info-grid">
                <div>
                    <span>Category:</span>
                    @foreach ($category as $item)
                        <div>{{ $item->cate_name }}</div>
                    @endforeach
                </div>
                <div>
                    <span>Course:</span>
                    @foreach ($course as $item)
                        <div>{{ $item->course_name }}</div>
                    @endforeach
                </div>
                <div>
                    <span>Chapter:</span>
                    @foreach ($chapter as $item)
                        <div>{{ $item->chapter_name }}</div>
                    @endforeach
                </div>
                <div>
                    <span>Lesson:</span>
                    @foreach ($lesson as $item)
                        <div>{{ $item->lesson_name }}</div>
                    @endforeach
                </div>
            </div>
        </div>

        @foreach ($questions as $question)
            {{-- <div class="mb-8 p-6 bg-white shadow-md rounded-2xl border border-gray-200"> --}}
            <div class="page-section">
                <div class="question-card">
                    @if (!empty($question->q_ans))
                        <img src="{{ asset('files/q_pdf/' . $question->q_ans[0]->ans_pdf) }}" class="question-image"
                            alt="Question Image">
                    @else
                        <div class="no-image">No Image</div>
                    @endif
                </div>
            </div>
        @endforeach

    </div>
</body>

</html>
