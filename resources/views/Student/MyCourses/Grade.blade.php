@php
    $page_name = 'Grade';
@endphp
@section('title', 'Lessons')
@include('Student.inc.header')
@include('Student.inc.menu')
@extends('Student.inc.nav')

@section('page_content')


<style>
    .modal-dialog {
        max-width: 70% !important;
    }

    .imgMistakeModal {
        width: 70%;
        max-height: 500px;
        object-fit: cover;
        object-position: center;
        border-radius: 15px;
        border: 5px solid #CF202F;
    }

    .list_cont {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .list_cont>i {
        font-size: 30px;
        color: #CF202F;
        cursor: pointer;
        margin-right: 25px
    }

    .list_item {
        position: absolute;
        top: 0;
        right: 40px;
        width: 200px;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: #CF202F;
        border: 3px solid #CF202F;
        z-index: 10000;
        overflow: hidden;
    }

    .list_item>span {
        width: 100%;
        text-align: center;
        font-size: 1.3rem;
        padding: 10px 20px;
        color: #fff;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }

    .list_item>span:hover {
        background: #fff;
        color: #CF202F;

    }

    .texRed {
        color: #CF202F;
        margin-bottom: 0 !important;
    }

    .ansName {
        margin-bottom: 0 !important;
        color: #5E5E5E;
    }

    .Solve {
        border: none !important;
        outline: none !important;
    }

    .Solve>a {
        color: #fff !important;
        background: #CF202F !important;
        font-size: 1.4rem !important;
        padding: 10px 20px !important;
        border: none !important;
        outline: none !important;
        border-radius: 10px !important;
        transition: all 0.3s ease-in-out;
    }

    .ansShow {
        background: #CF202F;
        color: #fff;
        font-size: 1.2rem;
        padding: 8px 20px;
        border: none;
        outline: none;
        border-radius: 10px;
        transition: all 0.3s ease-in-out;
    }

    .ansShow:hover,
    .Solve:hover>a {
        background: #fff !important;
        color: #CF202F !important;
        border: 2px solid #CF202F !important;
    }

    .ansVideo {
        background: #fff;
        color: #CF202F;
        font-size: 1.2rem;
        padding: 8px 20px;
        border: 2px solid #CF202F;
        outline: none;
        border-radius: 10px;
        transition: all 0.3s ease-in-out;
    }

    .ansPdf {
        color: #CF202F !important;
        font-size: 1.3rem;
        font-weight: 600;
        padding-bottom: 0px !important;
        border-bottom: 3px solid #CF202F;
    }

    .ansPdf:hover {
        color: #CF202F !important;
    }

    .ansVideo:hover {
        background: #CF202F;
        color: #fff;
    }

    .allAnswer {
        width: 100%;
        margin-top: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .answer {
        width: 99%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        column-gap: 10px;
        border-bottom: 2px solid #DBDBDB;
        padding: 20px 0;

    }

    .list_cont {
        position: relative;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        margin-bottom: 20px;
    }

    .list_cont>i {
        font-size: 30px;
        cursor: pointer;
    }

    .list_item {
        position: absolute;
        top: 0;
        right: 35px;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: #efefef;
        z-index: 10000;
        overflow: hidden;
    }

    .list_item>span {
        width: 100%;
        text-align: center;
        font-size: 1.3rem;
        padding: 10px 20px;
        color: #000;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }

    .list_item>span:hover {
        background: #cacaca;
        color: #fff;

    }
    .list_cont {
        position: relative;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        margin-bottom: 20px;
    }

    .list_cont>i {
        font-size: 30px;
        cursor: pointer;
    }

    .list_item {
        position: absolute;
        top: 0;
        right: 35px;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: #efefef;
        z-index: 10000;
        overflow: hidden;
    }

    .list_item>span {
        width: 100%;
        text-align: center;
        font-size: 1.3rem;
        padding: 10px 20px;
        color: #000;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }

    .list_item>span:hover {
        background: #cacaca;
        color: #fff;

    }
</style>

<div class="app-email card my-3">
    <div class="border-0">
        <div class="row g-0">


            <!-- Emails List -->
            <div class="col app-emails-list">
                <div class="card shadow-none border-0">
                    <div class="card-body emails-list-header p-3 py-lg-3 py-2">
                        <!-- Email List: Search -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center w-100">
                                <i class="bx bx-menu bx-sm cursor-pointer d-block d-lg-none me-3" data-bs-toggle="sidebar"
                                    data-target="#app-email-sidebar" data-overlay=""></i>
                                <div class="mb-0 mb-lg-2 w-100">
                                    <div class="d-flex justify-content-center">
                                        @if ($deg >= ($quizze->pass_score / $quizze->score) * 100)
                                            <button class="btn btn-success">
                                                Success
                                            </button>
                                        @else
                                            <button class="btn btn-danger">
                                                Faild
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="mx-n3 emails-list-header-hr">
                        <!-- Email List: Actions -->


                        <!-- Email View -->
                        <div class="col app-email-view flex-grow-0 bg-body" id="app-email-view">

                            <table class="table">
                                <tr>
                                    <td>Quizze : </td>
                                    <td>{{ $quizze->title }}</td>
                                </tr>
                                <tr>
                                    <td>Score : </td>
                                    <td>{{ $deg }} %</td>
                                </tr>
                                <tr>
                                    <td>Total Question : </td>
                                    <td>{{ $total_question }}</td>
                                </tr>
                                <tr>
                                    <td>Right Question : </td>
                                    <td>{{ $right_question }}</td>
                                </tr>
                                <tr>
                                    <td>Wrong Question : </td>
                                    <td>{{ $total_question - $right_question }}</td>
                                </tr>
                                <tr>
                                    <td>Delay : </td>
                                    <td class="{{$color ? 'text-success' : 'text-danger'}}">{{ $delay }}</td>
                                </tr>
                                <tr colspan="2">
                                    <td class="d-flex justify-content-center">
                                        <button class="btn btn-primary mistake_btn mx-2">
                                            View Mistakes
                                        </button>

                                        <form method="POST" action="{{route('stu_quize_pdf')}}">
                                            @csrf
                                            <input type="hidden" name="mistakes" value="{{json_encode($mistakes)}}">
                                            <button class="btn btn-info mx-2">
                                                Download Mistakes
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="app-email card my-3 d-none mistakes_questions">
    <div class="border-0">
        <div class="row g-0  p-3">
            @foreach ( $mistakes as $item )
                @if ( !empty($item->question) )
                {!! $item->question !!}
                @endif
                @if ( !empty($item->q_url) )
                <img style="width: 200px; height: 200px;"
                    src="{{ asset('images/questions/' . $item->q_url) }}" data-bs-toggle="modal"
                    data-bs-target="#kt_modal_edit{{ $item->id }}" />
    
                    <!-- Modal -->
                    <div class="modal fade" id="kt_modal_edit{{ $item->id }}" tabindex="-1"
                        aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
        
                                    <h5 class="modal-title" id="modalCenterTitle">Show Question</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
        
                                <div class='p-3'>
                                    <img style="height: 70vh;" src="{{ asset('images/questions/' . $item->q_url) }}" />
                                </div>
        
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-label-secondary"
                                        data-bs-dismiss="modal">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="ans_item ">
                    <div class="answer">
                        <button class="ansShow" data-bs-toggle="modal" data-bs-target="#modalAnswer{{ $item->id }}">Show
                            Answer</button>
                    </div>
    
                    {{-- Modal Answer --}}
                    <div class="modal fade" id="modalAnswer{{ $item->id }}" tabindex="-1" aria-hidden="true"
                        style="display: none;">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
    
                                   Show answer it will deduct from question package ??
                                </div>
    
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <a href="{{route('parallel_answer', $item->id)}}" class="btn btn-success">
                                        Show
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <hr />
            @endforeach
        </div>
    </div>
</div>

<script>
    let mistakes_questions = document.querySelector('.mistakes_questions');
    let mistake_btn = document.querySelector('.mistake_btn');
    let ans_item_btn = document.querySelectorAll('.ans_item_btn');
    let ans_item = document.querySelectorAll('.ans_item');
    
    for (let i = 0, end = ans_item_btn.length; i < end; i++) {
        ans_item_btn[i].addEventListener('click', ( e ) => {
            for (let j = 0; j < end; j++) {
                if ( e.target == ans_item_btn[j] ) {
                    ans_item[j].classList.toggle('d-none');
                }
            }
        })
    }
    mistake_btn.addEventListener('click', () => {
        mistakes_questions.classList.toggle('d-none');
    }) 
        $(document).ready(function() {
            console.log("first")
            $(".accordion-button").click(function() {
                console.log("ssss", $(this).closest(".accordion-item").find(".accordion-collapse")
                    .toggleClass("collapse"))
            })
            $(".iconList").click(function() {
                console.log("ssss")
                // $(".list_item").addClass("d-none")
                $(this).next().toggleClass("d-none")
            })
        })

        //___________________________________________________________________________________________
        let report_item = document.querySelectorAll('.report_item');
        let report_val = document.querySelectorAll('.report_val');
        let q_ans_val = document.querySelectorAll('.q_ans_val');

        for (let i = 0, end = report_item.length; i < end; i++) {
            report_item[i].addEventListener('click', (e) => {
                for (let j = 0; j < report_item.length; j++) {
                    if (report_item[j] == e.target) {
                        let report_obj = report_val[j].value;
                        report_obj = JSON.parse(report_obj);
                        let q_ans_obj = q_ans_val[j].value;
                        q_ans_obj = JSON.parse(q_ans_obj);

                        obj = {
                            'list_id': report_obj.id,
                            'q_video_id': q_ans_obj.id
                        }

                        console.log("obj", obj)

                        $(".list_item").addClass("d-none")

                        $.ajax("{{ route('report_q_video_api') }}", {
                            type: 'GET', // http method
                            data: {
                                obj: obj
                            }, // data to submit
                            success: function(data) {
                                console.log("asdasd", data);
                            },
                        });
                    }
                }
            })
        }

        // $(document).ready(function() {
        //     $(".report_item").each((index, val) => {
        //         $(val).on("click", function() {
        //             console.log('caaa', $(this).val())
        //         })
        //     })
        // })
    </script>

@endsection

@include('Student.inc.footer')
