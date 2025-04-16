@php
    function fun_admin()
    {
        return 'admin';
    }
@endphp
<x-default-layout>
    @section('title', 'Parallel')
    <style>
        .modal.show .modal-dialog {
            max-width: 60% !important;
        }

        .imgModal {
            width: 70%;
            max-height: 500px;
            object-fit: cover;
            object-position: center;
            border-radius: 15px;
            border: 5px solid #CF202F;
        }
    </style>
    <main class="main_wrapper overflow-hidden">

        <!-- tution__section__start -->
        <div class="tution sp_bottom_100 sp_top_100">
            <div class="full__width__padding">
                @if (count($q_parallel) == 0)
                    <h2 class="text-danger text-center">
                        Parallel Question Is Empty.
                    </h2>
                @endif
                @foreach ($q_parallel as $question)
                    <form action="{{ route('ad_solve_parallel', ['id' => $question->id]) }}" method="POST">
                        @csrf
                        <button type="button" class="btn btn-primary show_question_btn">
                            Show Parallel {{ $loop->iteration }}
                        </button>
                        <div class="quiz__single__attemp show_question d-none">
                            <hr class="hr" />
                            <h3>{{ $loop->iteration }}.
                                @if (!empty($question->question))
                                    {!! $question->question !!}
                                @endif
                                @if (!empty($question->q_url))
                                    <!-- Image Element -->
                                    <img style="width: 300px; height: 240px;" data-bs-toggle="modal"
                                        data-bs-target="#showImage{{ $question->id }}"
                                        src="{{ asset('images/questions/' . $question->q_url) }}" />

                                    <!-- Modal View Image -->
                                    <div class="modal fade" id="showImage{{ $question->id }}" tabindex="-1"
                                        aria-labelledby="showImageLabel{{ $question->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="showImageLabel{{ $question->id }}">Show
                                                        Question</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body"
                                                    style="display: flex; align-items: center; justify-content: center;">
                                                    <img class="img-fluid imgModal"
                                                        src="{{ asset('images/questions/' . $question->q_url) }}" />
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </h3>
                            <div class="row">
                                @if ($question->ans_type == 'MCQ')
                                    @foreach ($question->mcq as $mcq)
                                        <div class="form-check mx-3">
                                            <input class="form-check-input" type="radio"
                                                value="{{ @$arr[$loop->iteration - 1] }}"
                                                id="flexCheckChecked{{ $mcq->id }}" name="ans{{ $question->id }}" />
                                            <label class="form-check-label" for="flexCheckChecked{{ $mcq->id }}">
                                                {{ $mcq->mcq_num . ' . ' . $mcq->mcq_ans }}
                                            </label>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="form-check px-3">
                                        <input name="ans{{ $question->id }}" class="form-control" />
                                    </div>
                                @endif
                            </div>
                            <button class="btn btn-primary my-2">
                                Submit
                            </button>

                        </div>

                        <br><br><br>
                    </form>
                @endforeach

            </div>
        </div>
        <!-- tution__section__end -->



    </main>

    <script>
        let show_question = document.querySelectorAll('.show_question');
        let show_question_btn = document.querySelectorAll('.show_question_btn');
        for (let i = 0, end = show_question_btn.length; i < end; i++) {
            show_question_btn[i].addEventListener('click', (e) => {
                for (let j = 0; j < end; j++) {
                    if (e.target == show_question_btn[j]) {
                        show_question[j].classList.toggle('d-none');
                    }
                }
            })
        }
    </script>
    
</x-default-layout>
