
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
        width: auto;
        height: 300px;
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
    </div>

    @foreach ( $mistakes as $mistake )
        <div class="row mistake">
                <p class="course-title"><strong>Chapter:</strong> {{ $mistake->question->lessons->chapter->chapter_name }}</p>
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
</div>
