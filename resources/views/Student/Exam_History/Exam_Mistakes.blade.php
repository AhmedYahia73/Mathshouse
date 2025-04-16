@php
    $page_name = 'Exam History';
@endphp
@section('title','Chapters')
@include('Student.inc.header')
@include('Student.inc.menu')
@extends('Student.inc.nav')

@section('page_content')
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
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: center;
        row-gap: 20px;
        padding: 15px;
        border-radius: 20px;
        background: #c4c4c446;
    }

    .quesMisake {
        font-size: 1.2rem;
        font-weight: 500;
        color: #5c5a5a;
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
        width: auto;
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
</style>

<h3 class="txMista">Mistakes</h3>

<div class="allMistakes">
    @foreach ( $mistakes as $item )
        <div class="mistake">
            @if ( !empty($item->question->question) )
                <span class="quesMisake">{!!$item->question->question!!}</span>
            @endif
            @if ( !empty($item->question->q_url) )
            <img class="imgMistake"
            src="{{ asset('images/questions/' . $item->question->q_url) }}" data-bs-toggle="modal"
            data-bs-target="#kt_modal_edit{{$item->id}}{{$item->question->id}}" />

            <!-- Modal -->
            <div class="modal fade" id="kt_modal_edit{{$item->id}}{{$item->question->id}}" tabindex="-1"
                aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h5 class="modal-title" id="modalCenterTitle">Show Question</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class='p-3'>
                            <img style="height: 70vh;" src="{{ asset('images/questions/' . $item->question->q_url) }}" />
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
            <div class="footerMistake">
                <button type="button" class="my-2 btn viewMistake ans_item_btn btn-primary wallet_btn" data-bs-toggle="modal" data-bs-target="#modalCentermodalCenter{{$item->question->id}}">
                    View Answer
                </button>
                
                <a href="{{route('question_parallel', ['id' => $item->question->id])}}" class="btn btn-info parallelMistake my-2" >Solve Parallel</a>

            </div>
            <div class="modal q_ans_item show_wallet d-none" id="modalCenter{{$item->question->id}}" tabindex="-1" style="display: block;" aria-modal="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Quizze</h5>
                    <button type="button" class="btn-close close_form_btn" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            Are You Sure You Want to View Answer For this Question ?
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary close_qiuzze_btn" data-bs-dismiss="modal">
                        Close
                    </button>
                    <a href="{{route('quizze_ques_ans', ['id' => $item->question->id])}}" class="btn btn-primary">OK</a>
                    </div>
                </div>
                </div>
            </div>

        </div> 
    @endforeach
</div>
<script>
    let ans_item_btn = document.querySelectorAll('.ans_item_btn');
    let q_ans_item = document.querySelectorAll('.q_ans_item');
    let close_qiuzze_btn = document.querySelectorAll('.close_qiuzze_btn');
    let close_form_btn = document.querySelectorAll('.close_form_btn');
    
    for (let i = 0, end = ans_item_btn.length; i < end; i++) {
        ans_item_btn[i].addEventListener('click', ( e ) => {
            for (let j = 0; j < end; j++) {
                if ( e.target == ans_item_btn[j] ) {
                    q_ans_item[j].classList.toggle('d-none');
                }
            }
        })
    }
    for (let i = 0, end = close_qiuzze_btn.length; i < end; i++) {
        close_qiuzze_btn[i].addEventListener('click', ( e ) => {
            for (let j = 0; j < end; j++) {
                if ( e.target == close_qiuzze_btn[j] ) {
                    q_ans_item[j].classList.toggle('d-none');
                }
            }
        })
    }
    for (let i = 0, end = close_form_btn.length; i < end; i++) {
        close_form_btn[i].addEventListener('click', ( e ) => {
            for (let j = 0; j < end; j++) {
                if ( e.target == close_form_btn[j] ) {
                    q_ans_item[j].classList.toggle('d-none');
                }
            }
        })
    }
</script>
@endsection

@include('Student.inc.footer')
