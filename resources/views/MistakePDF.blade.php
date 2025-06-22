{{--
@php
    $page_name = 'Mistakes';
@endphp

<style>
    .txMista {
        width: 100%;
        margin: 1rem 0 !important;
        text-align: center;
        font-family: sans-serif;
        font-weight: 600;
        font-size: 2rem;
        color: #cf202f;
    }

    .allMistakes {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        row-gap: 20px;
        padding-top: 20px;
        overflow: hidden;
    }

    .mistake {
        width: 100%;
        height: 95%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content:center;
        row-gap: 20px;
        padding: 30px;
        border-radius: 20px;
        background: #c4c4c446;
    }
    .course-title{
        text-align: center;
        color :#CF202F;
        font-size: 1.5rem;
        font-weight: 500;
    }
    .quesMisake {
        font-size: 1.2rem;
        font-weight: 500;
        /* color: #5c5a5a; */
        color: #000;
    }

    .imgMistake {
        width: 100%;
        height: auto;
        object-fit: cover;
        object-position: center;
        border-radius: 15px;
        cursor: pointer;
    }

    .imgMistakeModal {
        width: 100%;
        height: auto;
        object-fit: cover;
        object-position: center;
        border-radius: 15px;
    }

    .footerMistake {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        column-gap: 20px;
    }

    .viewMistake {
        border: none;
        background: #CF202F;
        padding: 6px 15px;
        border-radius: 20px;
        color: #fff;
        font-size: 1.1rem;
        font-weight: 500;
        cursor: pointer;
    }

    .parallelMistake {
        color: #CF202F !important;
        font-size: 1.1rem;
        font-weight: 500;
        cursor: pointer;
    }

    .q_ans_item {
        background: #00000087;
    }

    .modal-dialog {
        max-width: 70% !important;
    }

    .modal-backdrop.show {
        display: none !important;
    }
    .exam-details {
    border: 1px solid #ddd;
    padding: 15px;
    border-radius: 8px;
    background-color: #f9f9f9;
}

.exam-title {
    font-size: 1.5em;
    margin-bottom: 10px;
}

.student-name, .category, .course {
    font-size: 1em;
    margin: 5px 0;
}

</style>

<h3 class="txMista">Mistakes</h3>
<div class="allMistakes app-email card my-3 mistakes_questions">
    <div class="exam-details">
        <h2 class="exam-title">{{ $dai_exam->title }}</h2>
        <p class="student-name"><strong>Student:</strong> {{ auth()->user()->nick_name }}</p>
        <p class="category"><strong>Category:</strong> {{ $dai_exam->course->category->cate_name }}</p>
        <p class="course"><strong>Course:</strong> {{ $dai_exam->course->course_name }}</p>
        <p class="course"><strong>Time:</strong> {{ $history->time }}</p>
        <p class="course"><strong>Date:</strong> {{ $history->date }}</p>
        <p class="course"><strong>Delay:</strong> {{ $delay }}</p>
        <p class="course"><strong>Score:</strong> {{ $history->score }}</p>
    </div>

    @foreach ( $mistakes as $mistake )
        <div class="row mistake">
                <p class="course-title">{{ $mistake->question->lessons->chapter->chapter_name }}</p>
                @if ( !empty($mistake->question->question) )
                    <span class="quesMisake">{!! $mistake->question->question !!}</span>
                @endif
                @if ( !empty($mistake->question->q_url) )
                <div style="width: 100%; padding: 5px;">
                    <img class="imgMistake"
                    src="{{ asset('images/questions/' . $mistake->question->q_url) }}" data-bs-toggle="modal"
                    data-bs-target="#kt_modal_edit{{$mistake->id}}{{$mistake->question->id}}" />
                </div>
                @endif
        </div>
    @endforeach
</div> --}}

@php
    $page_name = 'Mistakes';
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
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
        }

        /* Header with Logo */
        .header {
            position: sticky;
            top: 0;
            width: 100%;
            background-color: #fff;
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            text-align: center;
        }

        .header img {
            max-width: 150px;
            height: auto;
        }

        /* Mistakes Title */
        .txMista {
            width: 100%;
            margin: 2rem 0;
            text-align: center;
            font-weight: 700;
            font-size: 2.5rem;
            color: #CF3F43;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Mistakes Container */
        .allMistakes {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            row-gap: 30px;
            padding: 20px 0;
        }

        /* Individual Mistake */
        .mistake {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            row-gap: 15px;
            padding: 25px;
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeIn 0.5s ease forwards;
        }

        .mistake:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        }

        /* Course Title */
        .course-title {
            text-align: center;
            color: #CF3F43;
            font-size: 1.8rem;
            font-weight: 600;
            width: 100%;
        }

        /* Question Text */
        .quesMisake {
            font-size: 1.3rem;
            font-weight: 500;
            color: #333;
            line-height: 1.6;
        }

        /* Mistake Image */
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

        .imgMistakeModal {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 10px;
        }

        /* Footer Buttons */
        .footerMistake {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            column-gap: 15px;
        }

        .viewMistake {
            border: none;
            background: #CF3F43;
            padding: 8px 20px;
            border-radius: 25px;
            color: #fff;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .viewMistake:hover {
            background: #b02a2e;
        }

        .parallelMistake {
            color: #CF3F43;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .parallelMistake:hover {
            color: #b02a2e;
        }

        /* Exam Details */
        .exam-details {
            width: 100%;
            padding: 20px;
            border-radius: 10px;
            background: linear-gradient(135deg, #FFE6E8, #fff);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .exam-title {
            font-size: 2rem;
            font-weight: 600;
            color: #CF3F43;
            margin-bottom: 15px;
        }

        .student-name, .category, .course {
            font-size: 1.1rem;
            margin: 8px 0;
            color: #333;
        }

        /* Modal */
        .modal-dialog {
            max-width: 80%;
            margin: 1.75rem auto;
        }

        .modal-backdrop.show {
            opacity: 0.5 !important;
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .txMista {
                font-size: 2rem;
            }

            .mistake {
                padding: 15px;
            }

            .modal-dialog {
                max-width: 95%;
            }

            .course-title {
                font-size: 1.5rem;
            }

            .quesMisake {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header with Logo -->
    <header class="header">
        <img src="{{ asset('logos/Maths-house.png') }}" alt="Maths House Logo">
    </header>

    <!-- Mistakes Section -->
    <h3 class="txMista">Mistakes</h3>
    <div class="allMistakes app-email card my-3 mistakes_questions">
        <div class="exam-details">
            <h2 class="exam-title">{{ $dai_exam->title }}</h2>
            <p class="student-name"><strong>Student:</strong> {{ auth()->user()->nick_name }}</p>
            <p class="category"><strong>Category:</strong> {{ $dai_exam->course->category->cate_name }}</p>
            <p class="course"><strong>Course:</strong> {{ $dai_exam->course->course_name }}</p>
            <p class="course"><strong>Time:</strong> {{ $history->time }}</p>
            <p class="course"><strong>Date:</strong> {{ $history->date }}</p>
            <p class="course"><strong>Delay:</strong> {{ $delay }}</p>
            <p class="course"><strong>Score:</strong> {{ $history->score }}</p>
        </div>

        @foreach ($mistakes as $mistake)
            <div class="row mistake">
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
</body>
</html>
