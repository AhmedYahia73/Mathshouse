{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }
        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .question-image {
            max-width: 100px;
            height: auto;
            display: block;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Questions Report</h2>
        <table>
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach($questions as $question)
                <tr>
                    <td>{{ $question->question }}</td>
                    <td>
                        @if (!empty($question->mcq))
                            {{ $question->mcq[0]->mcq_answers }}
                        @elseif(!empty($question->g_ans))
                            {{ $question->g_ans[0]->grid_ans }}
                        @endif
                    </td>
                    <td>
                        @if (!empty($question->q_url))
                            <img src="{{ asset('images/questions/' . $question->q_url) }}" class="question-image" alt="Question Image">
                        @else
                            No Image
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html> --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions Report</title>
    <style>
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
        .headtitle {
            text-align: center;
            color: #333;
            height: 95%;
        }
        .question-card {
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 20px;
            background-color: #fff;
            padding: 40px;
            padding-top: 80px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            height: 100%;
        }

        .question-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px;
            border-radius: 6px;
            display: block;
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
        <div class="headtitle">
            <h2>Questions Report</h2>
        </div>
        @foreach($questions as $question)
        <div class="question-card">
            @if (!empty($question->q_url))
                <img src="{{ asset('images/questions/' . $question->q_url) }}" class="question-image" alt="Question Image">
            @else
                <div class="no-image">No Image</div>
            @endif

            <div class="question-section">
                <div class="section-title">Question:</div>
                <div class="question-text">{{ $question->question }}</div>
            </div>

            <div class="answer-section">
                <div class="section-title">Answer:</div>
                <div class="question-answer">
                    @if (!empty($question->mcq) && count($question->mcq) > 0)
                        {{ $question->mcq[0]->mcq_answers }}
                    @elseif(!empty($question->g_ans))
                        {{ $question->g_ans[0]->grid_ans }}
                    @else
                        <span class="no-answer">No Answer</span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach

    </div>
</body>
</html>

