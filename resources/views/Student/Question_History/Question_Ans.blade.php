@php
$page_name = 'Quiestion Answer';
@endphp
@section('title', 'Chapters')
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

    .ansShow:hover {
        background: #fff;
        color: #CF202F;
        border: 2px solid #CF202F;
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
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<div class="col-12 mt-3 d-flex align-items-center justify-content-center">
    <h3 class="texRed">Answers</h3>
</div>
<div class="allAnswer">
    @if (isset($question->q_ans))
    @foreach ($question->q_ans as $q_ans)
    <div class="answer">
        <h5 class="ansName">Method
            {{$loop->iteration}}:</h5>

        <button class="ansShow" data-bs-toggle="modal" data-bs-target="#modalAnswer{{ $q_ans->id }}">Show
            Answer</button>

        <button class="ansVideo" data-bs-toggle="modal" data-bs-target="#modalVideo{{ $q_ans->id }}">Show
            Video</button>


        <a href="{{ asset('files/q_pdf/' . $q_ans->ans_pdf) }}" class="ansPdf"
            onclick="downloadAndOpenPdf('{{ asset('files/q_pdf/' . $q_ans->ans_pdf) }}'); return false;">
            Download and View PDF {{ $loop->iteration }}
        </a>
    </div>

    {{-- Modal Answer --}}
    <div class="modal fade" id="modalAnswer{{ $q_ans->id }}" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="modalCenterTitle">Answer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div
                    style="width: 100% !important;display: flex;align-items: center;justify-content: center;overflow: hidden;">
                    <img class="imgMistakeModal" src="{{ asset('files/q_pdf/' . $q_ans->ans_pdf) }}" />
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Video --}}
    <div class="modal fade" id="modalVideo{{ $q_ans->id }}" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="modalCenterTitle">Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div
                    style="width: 100% !important;display: flex;align-items: flex-start;justify-content: space-around;column-gap: 100px; overflow: hidden;padding: 10px 0;">

                    {{-- <iframe scrolling="no" allowfullscreen width="560" height="315" src="{{ $q_ans->ans_video }}"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe> --}}

                    <iframe scrolling="no" allowfullscreen width="1500" height="315" src="{{ $q_ans->ans_video }}"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>

                    @if (!empty($q_ans->ans_video))
                    <div class="list_cont">
                        <h4 class="pr-3 text-success">
                            If you have an issues must clicked here
                            <i class="fa fa-arrow-right"></i>
                        </h4>
                        <i class="fa-solid fa-ellipsis-vertical iconList"></i>
                        <div class="list_item d-none">
                            @foreach ($reports as $report)
                            <span class="report_item">
                                <input type="hidden" class="report_val" value="{{ $report }}" />
                                <input type="hidden" class="q_ans_val" value="{{ $q_ans }}" />
                                {{ $report->list }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>



<script>
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

       async function downloadAndOpenPdf(imageUrl) {
        try {
            // Fetch the image
            const response = await fetch(imageUrl);
            const blob = await response.blob();

            // Convert the image blob to a Base64 data URL
            const reader = new FileReader();
            reader.onload = function (event) {
                const imageData = event.target.result;

                // Create a PDF with jsPDF
                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF();

                // Add the image to the PDF
                pdf.addImage(imageData, 'JPEG', 10, 10, 180, 160);

                // Save the PDF to a Blob
                const pdfBlob = pdf.output('blob');

                // Open the PDF in a new window
                const pdfURL = URL.createObjectURL(pdfBlob);
                window.open(pdfURL, '_blank');

                // Trigger download
                pdf.save('downloaded.pdf');
            };

            reader.readAsDataURL(blob);
        } catch (error) {
            console.error('Error downloading and converting image to PDF:', error);
        }
    }
</script>
@endsection

@include('Student.inc.footer')