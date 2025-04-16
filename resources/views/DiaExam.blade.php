<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled Table</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #ffff;
    margin: 0;
    padding: 20px;
    }
    .studentName{
        text-align: center;
        color: #CF202F;
    }

.examInfo {
    background-color:#FDF3F4;
    padding: 10px;
  display: flex;
  flex-direction: column;
  gap: 10px; /* Space between rows */
}

.row{
  display: flex;
  gap: 10px;
  font-size: 18px;
  margin-top: 20px
}

.variable {
  color: #CF202F;;
  font-weight: bold;
  margin-left: 10px;
}

.variable span {
  color: black;
  font-weight: normal;
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
        /* background-color:FDF3F4; */
        color: #CF202F;
        text-align: left;
        font-weight: bold;
        border-bottom: 1px solid #CF202F;
        border-top: 1px solid #CF202F;

    }

    table.styled-table th,
    table.styled-table td {
        padding: 12px 15px;
    }

    table.styled-table tbody tr {
        border-bottom: 1px solid #CF202F;
    }

    table.styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    table.styled-table tbody tr:last-of-type {
        border-bottom: 2px solid #CF202F;
    }

    table.styled-table tbody tr:hover {
        background-color: #f1f1f1;
    }

    </style>
</head>
<body>
    <div>
        <div>
            <div class="studentName">
                <h1>StudentName</h1>
            </div>
            <div class="examInfo">
                <div class="row">
                    <span class="variable">Exam Name: <span>{{$exam->title}}</span></span>
                    <span class="variable">Delay Time: <span>{{$report['delay']}}</span></span>
                    <span class="variable">Exam Date: <span>{{$history->date}}</span></span>
                </div>
                <div class="row">
                    <span class="variable">Grade: <span>{{auth()->user()->grade}}</span></span>
                    <span class="variable">Course: <span>{{$exam->course->course_name}}</span></span>
                    <span class="variable">Category: <span>{{$exam->course->category->cate_name}}</span></span>
                </div>
              </div>

        </div>                
    @php
        $arr_id = [];
        $arr = [];
    @endphp
    @foreach ( $mistakes as $item )
        @php
            $arr[$item->question->lessons->chapter->id] = $item;
        @endphp
    @endforeach
        <table class="styled-table">
            <thead>
                <tr>
                    <th>N. of questions</th>
                    <th>Section</th>
                    <th>Name of chapter</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($arr as $item) 
                    <tr>
                        <td style="text-align: start !important">
                            {{ $item->question->q_num }}
                        </td>
                        <td style="text-align: start !important">
                            {{ $item->question->section }}
                        </td>
                        <td style="text-align: start !important">
                            {{ $item->question->lessons->chapter->chapter_name }}
                        </td>
                    </tr>
                @endforeach
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
</body>
</html>
