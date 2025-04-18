@php
    function fun_admin()
    {
        return 'admin';
    }
@endphp
<x-default-layout>
    @section('title', 'Diagnostic Exam')
    @include('success')
    {{-- Bootstrap pack --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    {{-- ////Bootstrap pack --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        /* Hide the default checkbox */
        .btn-container input {
            display: none;
        }

        .btn-container {
            width: 30px;
            display: block;
            position: relative;
            cursor: pointer;
            font-size: 20px;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: relative;
            top: 0;
            left: 0;
            height: 1em;
            width: 1em;
            background-color: #2196F300;
            border-radius: 0.25em;
            transition: all 0.25s;
        }

        /* When the checkbox is checked, add a blue background */
        .btn-container input:checked~.checkmark {
            background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            transform: rotate(0deg);
            border: 0.1em solid #ddd;
            left: 0;
            top: 0;
            width: 1.05em;
            height: 1.05em;
            border-radius: 0.25em;
            transition: all 0.25s, border-width 0.1s;
        }

        /* Show the checkmark when checked */
        .btn-container input:checked~.checkmark:after {
            left: 0.4em;
            top: 0.2em;
            width: 0.25em;
            height: 0.5em;
            border-color: #fff;
            border-width: 0 0.15em 0.15em 0;
            border-radius: 0em;
            transform: rotate(45deg);
        }

        #kt_app_toolbar {
            display: none;
        }

        .section_add {
            display: flex;
            align-items: center;
            justify-content: end;
        }

        .btn_add_quizz {
            border: none;
            outline: none;
            background: #1b84ff;
            padding: 10px 25px;
            border-radius: 10px;
            font-size: 1.2rem;
            color: #fff !important;
            font-weight: 500;
            transition: all 0.3s ease-in-out;
            cursor: pointer;
        }

        .btn_add_quizz:hover {
            -webkit-box-shadow: 0px 0px 10px 5px rgba(0, 0, 0, 0.22);
            -moz-box-shadow: 0px 0px 10px 5px rgba(0, 0, 0, 0.22);
            box-shadow: 0px 0px 10px 5px rgba(0, 0, 0, 0.22);
        }

        .nav-tabs .nav-link {
            border-top-left-radius: 0.8rem !important;
            border-top-right-radius: 0.8rem !important;

        }

        .nav-tabs .nav-link {
            margin-bottom: 0 !important;
            padding: 8px 0px;
            font-size: 1.5rem;
            font-weight: 500;
        }

        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            color: #fff !important;
            background-color: #1b84ff !important;
            border-color: #dee2e6 #dee2e6 #fff;
        }

        .add_qz {
            font-size: 1.2rem;
            font-weight: 500;
            padding: 5px 10px;
            border: none;
            outline: none;
            text-align: center;
            margin-top: 2px;
            color: #fff;
            background: #14bc14;
            border-radius: 10px;
            transition: all 0.3s ease-in-out;
        }

        .selected_qz {
            font-size: 1.2rem;
            font-weight: 500;
            padding: 5px 10px;
            border: none !important;
            outline: none !important;
            text-align: center;
            margin-top: 2px;
            color: #fff;
            background: #1761c6;
            border-radius: 10px;
            transition: all 0.3s ease-in-out;
            cursor: context-menu !important;
        }

        .add_qz:hover {
            box-shadow: 0px 0px 5px 5px rgb(134 134 134 / 22%);
        }

        .remove_qz {
            font-size: 1.2rem;
            font-weight: 500;
            padding: 5px 25px;
            border: none;
            outline: none;
            text-align: center;
            margin-top: 2px;
            color: #fff;
            background: red;
            border-radius: 10px;
            transition: all 0.3s ease-in-out;
        }

        .remove_qz:hover {
            box-shadow: 0px 0px 5px 5px rgb(134 134 134 / 22%);
        }

        .edit_qz {
            font-size: 1.2rem;
            font-weight: 500;
            padding: 5px 10px;
            border: none;
            outline: none;
            text-align: center;
            margin-top: 2px;
            color: #fff;
            background: #14bc14;
            border-radius: 10px;
            transition: all 0.3s ease-in-out;
        }

        .edit_qz:hover {
            box-shadow: 0px 0px 5px 5px rgb(134 134 134 / 22%);
        }

        .remove_qz_edit {
            font-size: 1.2rem;
            font-weight: 500;
            padding: 5px 25px;
            border: none;
            outline: none;
            text-align: center;
            margin-top: 2px;
            color: #fff;
            background: red;
            border-radius: 10px;
            transition: all 0.3s ease-in-out;
        }

        .remove_qz_edit:hover {
            box-shadow: 0px 0px 5px 5px rgb(134 134 134 / 22%);
        }

        .avil {
            font-size: 1.3rem !important;
            font-weight: 500 !important;
            color: #62a8aa !important;
            letter-spacing: 1px !important;
            text-align: center !important;
        }
    </style>
    <div class="section_add d-flex justify-content-start">
        <button class="btn_add_quizz my-3" type="button" data-toggle="modal" data-target="#exampleModalCenter">New
            Diagnostic
            Exam</button>
    </div>
    <!-- Modal Add Quizze -->
    <div class="modal fade" id="exampleModalCenter" style="transform: translate(20px, 0px); " tabindex="-1"
        role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"
            style="max-width: 1300px !important; display: flex;align-items: center;justify-content: center;"
            role="document">
            <div class="modal-content" style="border-radius: 15px;">
                <form action="{{ route('add_diaexam') }}" method="POST">
                    @csrf
                    <input type="hidden" class="questions_data" name="ques_id" />
                    <div class="modal-header" style="border-bottom: 0 !important;">
                        <h2 class="modal-title" id="exampleModalLongTitle">New Diagnostic Exam</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"
                                style="font-size: 3rem;padding: 0;font-weight: 600 !important;color: #1b84ff;margin: 0;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="padding: 0 1rem !important">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" style="margin-top: 20px;">
                            <li class="nav-item" style="width: calc(100% / 3);text-align: center;">
                                <a class="nav-link active" data-bs-toggle="tab" href="#home">INFO</a>
                            </li>
                            <li class="nav-item" style="width: calc(100% / 3);text-align: center;">
                                <a class="nav-link" data-bs-toggle="tab" href="#menu1">DETAILS</a>
                            </li>
                            <li class="nav-item" style="width: calc(100% / 3);text-align: center;">
                                <a class="nav-link" data-bs-toggle="tab" href="#menu2">QUESTIONS</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            {{-- Info --}}
                            <div class="tab-pane container active"
                                style="min-height: 300px; max-width: 1340px !important;margin: 15px 0;" id="home">

                                <div class=""
                                    style="display: flex;flex-direction: column;align-items: flex-start;row-gap: 15px;">

                                    <div class="col-md-12 d-flex align-items-center justify-content-around">
                                        <span class="col-md-2" style="font-size: 1.2rem;">Title: </span>
                                        <input type="text" name="title" class="col-md-9 form-control" required />
                                    </div>

                                    <div class="col-md-12 d-flex align-items-center justify-content-around">
                                        <span class="col-md-2" style="font-size: 1.2rem;">Description: </span>
                                        <textarea class="col-md-9 form-control" name="description" id="dec_quizze" cols="30" rows="3"></textarea>
                                    </div>

                                    <div class="col-md-12 d-flex align-items-center justify-content-around">
                                        <span class="col-md-2" style="font-size: 1.2rem;">Duration: </span>
                                        <div class="col-md-9"
                                            style="display: flex; align-items: center;padding: 0;justify-content: start">
                                            <div class="d-flex col-md-2"
                                                style="align-items: center;padding: 0;  column-gap: 10px">
                                                <span>Houre: </span>
                                                <input type="number" name="time_h_1" max="9" min="0"
                                                    class=" form-control" value="0">
                                                <input type="number" name="time_h_2" max="9" min="0"
                                                    class="col-md-4 form-control" value="0">
                                            </div>
                                            <div class="d-flex col-md-2"
                                                style="align-items: center;padding: 0;  column-gap: 10px">
                                                <span>Minets: </span>
                                                <input type="number" name="time_m_1" max="5" min="0"
                                                    class="col-md-4 form-control" value="0" />
                                                <input type="number" name="time_m_2" max="9" min="0"
                                                    class="col-md-4 form-control" value="0" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 d-flex align-items-center justify-content-around">
                                        <span class="col-md-2" style="font-size: 1.2rem;">Score Name: </span>
                                        <select class="col-md-9 form-control" name="score_id">
                                            <option disabled selected>
                                                Select Score Name ...
                                            </option>
                                            @foreach ($scores as $score)
                                                <option value="{{ $score->id }}">
                                                    {{ $score->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12 d-flex align-items-center justify-content-around">
                                        <span class="col-md-2" style="font-size: 1.2rem;">Total Score: </span>
                                        <input type="text" name="score" class="col-md-9 form-control" required>
                                    </div>

                                    <div class="col-md-12 d-flex align-items-center justify-content-around">
                                        <span class="col-md-2" style="font-size: 1.2rem;">Pass Score: </span>
                                        <input type="text" name="pass_score" class="col-md-9 form-control"
                                            required>
                                    </div>

                                    <div class="col-md-12 d-flex align-items-center justify-content-around">
                                        <span class="col-md-2" style="font-size: 1.2rem;">Active: </span>
                                        <div class="col-md-9 p-0">
                                            <label class="btn-container">
                                                <input name="state" value="1" type="checkbox">
                                                <div class="checkmark"></div>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end" style="column-gap: 16px">
                                    <a class="btnNext btn_add_quizz">Next</a>
                                </div>
                            </div>
                            {{-- Details --}}
                            <div class="tab-pane container fade"
                                style="height: 300px; max-width: 1340px !important;margin: 10px 0;" id="menu1">

                                <div class=""
                                    style="display: flex;flex-direction: column;justify-content: space-between;height: 100%;">

                                    <div class=""
                                        style="display: flex;flex-direction: column;align-items: flex-start; row-gap: 30px;">

                                        <div style="width: 100%;"
                                            class="d-flex align-items-center justify-content-start">
                                            <span class="col-md-2" style="font-size: 1.2rem;">Category: </span>
                                            <select name="select" id="sel_category" class="col-md-2 form-control">
                                                <option value="" selected>Select Category ...</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->cate_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div style="width: 100%;"
                                            class="d-flex align-items-center justify-content-start">
                                            <span class="col-md-2" style="font-size: 1.2rem;">Course: </span>
                                            <select name="course_id" id="sel_course" class="col-md-2 form-control">
                                                <option value="" selected>Select Course ...</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="d-flex justify-content-end" style="column-gap: 16px">
                                        <a class="btnPrevious btn_add_quizz">Prev</a>
                                        <a class="btnNext btn_add_quizz next_btn">Next</a>
                                    </div>
                                </div>
                            </div>
                            {{-- Questions --}}
                            <div class="tab-pane container fade"
                                style="min-height: 300px; max-width: 1340px !important;margin: 10px 0;"
                                id="menu2">

                                <div
                                    style="display: flex;flex-direction: column;justify-content: space-between;height: 100%;">

                                    <div class="d-flex"
                                        style="margin-bottom: 1rem; align-items: center;flex-wrap: wrap; justify-content: flex-start; gap: 10px">
                                        <span style="font-size: 1.2rem;font-weight: 600;">Filter Diagnostic :</span>

                                        <div class="col-md-2 d-flex" style="align-items: center; column-gap:10px">
                                            <span style="font-size: 1.2rem;font-weight: 600;">Year:</span>
                                            <select id="sel_year" name="year" class="form-control">
                                                <option value="">Select Year</option>
                                                @for ($i = date('Y'); $i >= 1990; $i--)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-2 d-flex" style="align-items: center; column-gap:10px">
                                            <span style="font-size: 1.2rem;font-weight: 600;">Month:</span>
                                            <select id="sel_month" name="month" class="form-control">
                                                <option value="">Select Month</option>
                                                <option value="1">January</option>
                                                <option value="2">February</option>
                                                <option value="3">March</option>
                                                <option value="4">April</option>
                                                <option value="5">May</option>
                                                <option value="6">June</option>
                                                <option value="7">July</option>
                                                <option value="8">August</option>
                                                <option value="9">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 d-flex" style="align-items: center; column-gap:10px">
                                            <span style="font-size: 1.2rem;font-weight: 600;">Section:</span>
                                            <select id="sel_section" name="section" class="form-control">
                                                <option value="">Select Section</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 d-flex" style="align-items: center; column-gap:10px">
                                            <span style="font-size: 1.2rem;font-weight: 600;">Code:</span>
                                            <select id="sel_code" name="names" class="form-control">
                                                <option value="">Select Code</option>
                                                @foreach ($codes as $code)
                                                    <option value="{{ $code->id }}">
                                                        {{ $code->exam_code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2 d-flex p-0" style="align-items: center; column-gap:10px">
                                            <span class="col-md-7 pr-0"
                                                style="font-size: 1.2rem;font-weight: 600;">Question Num:</span>
                                            <input type="number" id="sel_questionNum" class="col-md-4 form-control"
                                                style="padding:.375rem 0 !important; padding-left: 5px !important;"
                                                placeholder="Question Num">
                                        </div>
                                        <div class="col-md-2 d-flex" style="align-items: center; column-gap:10px">
                                            <span style="font-size: 1.2rem;font-weight: 600;">Chapter:</span>
                                            <select id="sel_chp" name="names" class="form-control">
                                                <option value="">Select Chapter</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 d-flex" style="align-items: center; column-gap:10px">
                                            <span style="font-size: 1.2rem;font-weight: 600;">Lesson:</span>
                                            <select id="sel_less" name="names" class="form-control">
                                                <option value="">Select Lessone</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 d-flex" style="align-items: center; column-gap:10px">
                                            <span style="font-size: 1.2rem;font-weight: 600;">Type:</span>
                                            <select id="sel_type" name="names" class="form-control">
                                                <option value="">Select Type</option>
                                                <option value="Trail">Trail</option>
                                                <option value="Parallel">Parallel</option>
                                                <option value="Extra">Extra</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 d-flex"
                                            style="align-items: center;justify-content: space-between; column-gap:20px">
                                            <button type="button" id="filterBtn"
                                                style="font-size: 1.4rem;font-weight: 500;border: none;background: #1b84ff;border-radius: 8px;padding: 5px 25px;letter-spacing: 1px;color: #fff;">Filter</button>
                                            <button type="button" class="d-none" id="addAllBtn"
                                                style="font-size: 1.4rem;font-weight: 500;border: none;background: #1b84ff;border-radius: 8px;padding: 5px 25px;letter-spacing: 1px;color: #fff;">Add
                                                All</button>
                                        </div>

                                    </div>
                                    <input class="category" type="hidden" value="{{ $categories }}" />
                                    <input class="course" type="hidden" value="{{ $courses }}" />

                                    <div
                                        style="max-height: 300px;overflow: scroll;padding: 12px 0; border-bottom: 2px solid #8f8f8f">
                                        <table class="table table-striped" id="tblData_Quizzes">
                                            <thead class="border-bottom">
                                                <tr>
                                                    <th scope="col" style="font-weight: 500; font-size: 1.1rem">#
                                                    </th>
                                                    <th scope="col" style="font-weight: 500; font-size: 1.1rem">
                                                        Type</th>
                                                    <th scope="col" style="font-weight: 500; font-size: 1.1rem">
                                                        Year</th>
                                                    <th scope="col" style="font-weight: 500; font-size: 1.1rem">
                                                        Month</th>
                                                    <th scope="col" style="font-weight: 500; font-size: 1.1rem">
                                                        Code</th>
                                                    <th scope="col" style="font-weight: 500; font-size: 1.1rem">
                                                        Section</th>
                                                    <th scope="col" style="font-weight: 500; font-size: 1.1rem">No
                                                    </th>
                                                    <th scope="col" style="font-weight: 500; font-size: 1.1rem">
                                                        Difficulty</th>
                                                    <th scope="col" style="font-weight: 500; font-size: 1.1rem">
                                                        Chapter</th>
                                                    <th scope="col" style="font-weight: 500; font-size: 1.1rem">
                                                        Lessone</th>
                                                    <th scope="col" style="font-weight: 500; font-size: 1.1rem">
                                                        Select</th>
                                                </tr>
                                            </thead>

                                            <tbody class="quizze_item"></tbody>

                                        </table>
                                    </div>

                                    <div class="d-flex" style="align-items: center; justify-content: center">
                                        <span
                                            style="font-size: 2rem;font-weight: 500;background: #1b84ff;color: #fff;border-radius: 10px;padding: 10px 15px;margin-top: 10px;">Diagnostic
                                            Exam</span>
                                    </div>

                                    <div
                                        style="max-height: 300px;overflow: scroll;padding: 12px 0; border-bottom: 2px solid #8f8f8f">
                                        <table class="table table-striped" id="tblData">
                                            <thead class="border-bottom">
                                                <tr>
                                                    <th scope="col" style="font-weight: 500; font-size: 1.1rem">#
                                                    </th>
                                                    <th scope="col" style="font-weight: 500; font-size: 1.1rem">
                                                        Type</th>
                                                    <th scope="col" style="font-weight: 500; font-size: 1.1rem">
                                                        Year</th>
                                                    <th scope="col" style="font-weight: 500; font-size: 1.1rem">
                                                        Month</th>
                                                    <th scope="col" style="font-weight: 500; font-size: 1.1rem">
                                                        Code</th>
                                                    <th scope="col" style="font-weight: 500; font-size: 1.1rem">
                                                        Section</th>
                                                    <th scope="col" style="font-weight: 500; font-size: 1.1rem">No
                                                    </th>
                                                    <th scope="col" style="font-weight: 500; font-size: 1.1rem">
                                                        Difficulty</th>
                                                    <th scope="col" style="font-weight: 500; font-size: 1.1rem">
                                                        Chapter</th>
                                                    <th scope="col" style="font-weight: 500; font-size: 1.1rem">
                                                        Lessone</th>
                                                    <th scope="col" style="font-weight: 500; font-size: 1.1rem">
                                                        Action</th>
                                                </tr>
                                            </thead>

                                            <tbody class="sel_quz"></tbody>

                                        </table>
                                    </div>

                                    <div class="d-flex justify-content-end"
                                        style="column-gap: 16px; margin-top: 10px">
                                        <a class="btnPrevious btn_add_quizz">Prev</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary add_btn">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <table id="kt_profile_overview_table"
        class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold dataTable no-footer">
        <thead class="fs-7 text-gray-500 text-uppercase">
            <th class="sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width:calc(100% / 7);">
                Serial no.</th>
            <th class="sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width:calc(100% / 7);">
                Title</th>
            <th class="sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width:calc(100% / 7);">
                Time</th>
            <th class="sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width:calc(100% / 7);">
                Score</th>
            <th class="sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width:calc(100% / 7);">No.
                of Questions</th>
            <th class="sorting" tabindex="0" aria-controls="kt_profile_overview_table" rowspan="1"
                colspan="1" aria-label="Date: activate to sort column ascending" style="width:calc(100% / 7);">
                Action</th>
        </thead>
        <tbody class="fs-6">
            @foreach ($exams as $item)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $item->title }}
                    </td>
                    <td>
                        {{ $item->time }}
                    </td>
                    <td>
                        {{ $item->score }}
                    </td>
                    <td>
                        {{ count($item->question) }}
                    </td>
                    <td>
                        <div style="position: relative; text-align: left;">

                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalCenter{{ $item->id }}">
                                Edit
                            </button>

                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalDelete{{ $item->id }}">
                                Delete
                            </button>

                            {{-- Modal Edit Quizze --}}

                            <div class="modal fade modal_edit" id="modalCenter{{ $item->id }}"
                                style="transform: translate(20px, 0px); " tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered"
                                    style="max-width: 1300px !important; display: flex;align-items: center;justify-content: center;"
                                    role="document">
                                    <div class="modal-content" style="border-radius: 15px;">
                                        <form class="form_editquizze"
                                            action="{{ route('edit_dia_exam_item', ['id' => $item->id]) }}"
                                            method="POST">
                                            @csrf 
                                            <div class="modal-header" style="border-bottom: 0 !important;">
                                                <h2 class="modal-title" id="exampleModalLongTitle">Edit Diagnostic
                                                </h2>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true" class="cls_edite"
                                                        style="font-size: 3rem;padding: 0;font-weight: 600 !important;color: #1b84ff;margin: 0;">&times;</span>
                                                </button>
                                            </div>
                                            {{-- Content Modal --}}
                                            <div class="modal-body" style="padding: 0 1rem !important">
                                                <!-- Nav tabs -->
                                                <ul class="nav nav-edit nav-tabs" style="margin-top: 20px;">
                                                    <li class="nav-item nav-info"
                                                        style="width: calc(100% / 2);text-align: center;">
                                                        <a class="nav-link active" data-bs-toggle="tab"
                                                            href="#info_edit{{ $item->id }}">INFO</a>
                                                    </li>
                                                    <li class="nav-item nav-question"
                                                        style="width: calc(100% / 2);text-align: center;">
                                                        <a class="nav-link" data-bs-toggle="tab"
                                                            href="#question_edit{{ $item->id }}">QUESTIONS</a>
                                                    </li>
                                                </ul>

                                                <!-- Tab panes -->
                                                <div class="tab-content" id="tab_info{{ $item->id }}">
                                                    {{-- Info --}}
                                                    <input type="hidden" value="{{ $item->id }}"
                                                        id="dia_id">
                                                    <div class="tab-pane container active"
                                                        style="min-height: 300px; max-width: 1340px !important;margin: 15px 0;"
                                                        id="info_edit{{ $item->id }}">

                                                        <div class=""
                                                            style="display: flex;flex-direction: column;align-items: flex-start;row-gap: 15px;">

                                                            <div
                                                                class="col-md-12 d-flex align-items-center justify-content-around">
                                                                <span class="col-md-2"
                                                                    style="font-size: 1.2rem;">Title:
                                                                </span>
                                                                <input type="text" name="title"
                                                                    value="{{ $item->title }}"
                                                                    class="col-md-9 form-control quizze_title">
                                                            </div>

                                                            <div
                                                                class="col-md-12 d-flex align-items-center justify-content-around">
                                                                <span class="col-md-2"
                                                                    style="font-size: 1.2rem;">Description: </span>
                                                                <textarea class="col-md-9 form-control quizze_description" name="description" id="dec_quizze" cols="30"
                                                                    rows="3">{{ $item->description }}</textarea>
                                                            </div>

                                                            <div
                                                                class="col-md-12 d-flex align-items-center justify-content-around">
                                                                <span class="col-md-2"
                                                                    style="font-size: 1.2rem;">Duration: </span>
                                                                <div class="col-md-9"
                                                                    style="display: flex; align-items: center;padding: 0;justify-content: start">
                                                                    <input name="time" value="{{ $item->time }}"
                                                                        max="60" min="0"
                                                                        class="col-md-4 form-control quizze_duration">
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="col-md-12 d-flex align-items-center justify-content-around">
                                                                <span class="col-md-2"
                                                                    style="font-size: 1.2rem;">Score
                                                                    Name: </span>
                                                                <select class="col-md-9 form-control"
                                                                    id="score_id_edit" name="score_id">
                                                                    <option value="{{ @$item->score_id }}">
                                                                        {{ @$item->dia_score->name }}
                                                                    </option>
                                                                    @foreach ($scores as $score)
                                                                        <option value="{{ $score->id }}">
                                                                            {{ $score->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div
                                                                class="col-md-12 d-flex align-items-center justify-content-around">
                                                                <span class="col-md-2"
                                                                    style="font-size: 1.2rem;">Total
                                                                    Score: </span>
                                                                <input type="text" name="score"
                                                                    value="{{ $item->score }}"
                                                                    class="col-md-9 form-control quizze_Total_Score">
                                                            </div>

                                                            <div
                                                                class="col-md-12 d-flex align-items-center justify-content-around">
                                                                <span class="col-md-2" style="font-size: 1.2rem;">Pass
                                                                    Score: </span>
                                                                <input type="text" name="pass_score"
                                                                    value="{{ $item->pass_score }}"
                                                                    class="col-md-9 form-control quizze_Pass_Score">
                                                            </div>


                                                            <div
                                                                class="col-md-12 d-flex align-items-center justify-content-around">
                                                                <span class="col-md-2"
                                                                    style="font-size: 1.2rem;">Active:
                                                                </span>
                                                                <div class="col-md-9 p-0">
                                                                    <label class="btn-container">
                                                                        @if ($item->state == 0)
                                                                            <input name="state" value="0"
                                                                                type="checkbox"
                                                                                class="quizze_Active" />
                                                                        @else
                                                                            <input name="state"
                                                                                class="quizze_Active" value="1"
                                                                                type="checkbox" checked />
                                                                        @endif
                                                                        <div class="checkmark"></div>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    {{-- Questions --}}
                                                    <div class="tab-pane container fade question_edit_parQ"
                                                        style="min-height: 300px; max-width: 1340px !important;margin: 10px 0;"
                                                        id="question_edit{{ $item->id }}">

                                                        <div class=""
                                                            style="display: flex;flex-direction: column;justify-content: space-between;height: 100%;">

                                                            <div class="d-flex all_filter"
                                                                id="all_filter{{ $item->id }}"
                                                                style="margin-bottom: 1rem; align-items: center; flex-wrap: wrap;justify-content: flex-start;gap: 10px">
                                                                <span
                                                                    style="font-size: 1.2rem;font-weight: 600;">Filter
                                                                    Diagnostic:</span>

                                                                <div class="col-md-2 d-flex"
                                                                    style="align-items: center; column-gap:10px">
                                                                    <span
                                                                        style="font-size: 1.2rem;font-weight: 600;">Year:</span>
                                                                    <select id="sel_year_edit" name="year"
                                                                        class="form-control">
                                                                        <option value="">Select Year</option>
                                                                        @for ($i = date('Y'); $i >= 1990; $i--)
                                                                            <option value="{{ $i }}">
                                                                                {{ $i }}</option>
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 d-flex"
                                                                    style="align-items: center; column-gap:10px">
                                                                    <span
                                                                        style="font-size: 1.2rem;font-weight: 600;">Month:</span>
                                                                    <select id="sel_month_edit" name="month"
                                                                        class="form-control">
                                                                        <option value="">Select Month</option>
                                                                        <option value="1">January</option>
                                                                        <option value="2">February</option>
                                                                        <option value="3">March</option>
                                                                        <option value="4">April</option>
                                                                        <option value="5">May</option>
                                                                        <option value="6">June</option>
                                                                        <option value="7">July</option>
                                                                        <option value="8">August</option>
                                                                        <option value="9">September</option>
                                                                        <option value="10">October</option>
                                                                        <option value="11">November</option>
                                                                        <option value="12">December</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 d-flex"
                                                                    style="align-items: center; column-gap:10px">
                                                                    <span
                                                                        style="font-size: 1.2rem;font-weight: 600;">Section:</span>
                                                                    <select id="sel_section_edit" name="section"
                                                                        class="form-control">
                                                                        <option value="">Select Section</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 d-flex"
                                                                    style="align-items: center; column-gap:10px">
                                                                    <span
                                                                        style="font-size: 1.2rem;font-weight: 600;">Code:</span>
                                                                    <select id="sel_code_edit" name="names"
                                                                        class="form-control">
                                                                        <option value="">Select Code</option>
                                                                        @foreach ($codes as $code)
                                                                            <option value="{{ $code->id }}">
                                                                                {{ $code->exam_code }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 d-flex p-0"
                                                                    style="align-items: center; column-gap:10px">
                                                                    <span class="col-md-8 pr-0"
                                                                        style="font-size: 1.2rem;font-weight: 600;">Question
                                                                        Num:</span>
                                                                    <input type="number" id="sel_question_edit"
                                                                        class="col-md-4 form-control"
                                                                        style="padding:.375rem 0 !important; padding-left: 5px !important;"
                                                                        placeholder="Select Question Num">
                                                                </div>
                                                                <div class="col-md-2 d-flex"
                                                                    style="align-items: center; column-gap:10px">
                                                                    <span
                                                                        style="font-size: 1.2rem;font-weight: 600;">Chapter:</span>
                                                                    <select id="sel_chp_edit{{ $item->id }}"
                                                                        name="names"
                                                                        class="form-control sel_chp_edit">
                                                                        <option value="">Select Chapter</option>
                                                                        @foreach ($chapters as $chapter)
                                                                            @if ($item->course->id == $chapter->course_id)
                                                                                <option value="{{ $chapter->id }}">
                                                                                    {{ $chapter->chapter_name }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 d-flex"
                                                                    style="align-items: center; column-gap:10px">
                                                                    <span
                                                                        style="font-size: 1.2rem;font-weight: 600;">Lesson:</span>
                                                                    <select id="sel_less_edit" name="names"
                                                                        class="form-control">
                                                                        <option value="">Select Lesson</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 d-flex"
                                                                    style="align-items: center; column-gap:10px">
                                                                    <span
                                                                        style="font-size: 1.2rem;font-weight: 600;">Type:</span>
                                                                    <select id="sel_type_edit" name="names"
                                                                        class="form-control">
                                                                        <option value="">Select Type</option>
                                                                        <option value="Trail">Trail</option>
                                                                        <option value="Parallel">Parallel</option>
                                                                        <option value="Extra">Extra</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3 d-flex"
                                                                    style="align-items: center;justify-content: space-between; column-gap:20px">
                                                                    <button type="button" class="filterBtn_edit"
                                                                        id="filterBtn_edit{{ $item->id }}"
                                                                        style="font-size: 1.4rem;font-weight: 500;border: none;background: #1b84ff;border-radius: 8px;padding: 5px 25px;letter-spacing: 1px;color: #fff;">Filter</button>
                                                                    <button type="button" class="d-none"
                                                                        id="addAllBtn{{ $item->id }}"
                                                                        style="font-size: 1.4rem;font-weight: 500;border: none;background: #1b84ff;border-radius: 8px;padding: 5px 25px;letter-spacing: 1px;color: #fff;">Add
                                                                        All</button>
                                                                </div>

                                                            </div>

                                                            <input class="category" type="hidden"
                                                                value="{{ $categories }}" />
                                                            <input class="course" type="hidden"
                                                                value="{{ $courses }}" />

                                                            <div
                                                                style="max-height: 300px;overflow: scroll;padding: 12px 0; border-bottom: 2px solid #8f8f8f">
                                                                <table class="table table-striped"
                                                                    id="tblData_Quizzes_Edite">
                                                                    <thead class="border-bottom">
                                                                        <tr>
                                                                            <th scope="col"
                                                                                style="font-weight: 500; font-size: 1.1rem">
                                                                                #</th>
                                                                            <th scope="col"
                                                                                style="font-weight: 500; font-size: 1.1rem">
                                                                                Type</th>
                                                                            <th scope="col"
                                                                                style="font-weight: 500; font-size: 1.1rem">
                                                                                Year</th>
                                                                            <th scope="col"
                                                                                style="font-weight: 500; font-size: 1.1rem">
                                                                                Month</th>
                                                                            <th scope="col"
                                                                                style="font-weight: 500; font-size: 1.1rem">
                                                                                Code</th>
                                                                            <th scope="col"
                                                                                style="font-weight: 500; font-size: 1.1rem">
                                                                                Section</th>
                                                                            <th scope="col"
                                                                                style="font-weight: 500; font-size: 1.1rem">
                                                                                No</th>
                                                                            <th scope="col"
                                                                                style="font-weight: 500; font-size: 1.1rem">
                                                                                Difficulty</th>
                                                                            <th scope="col"
                                                                                style="font-weight: 500; font-size: 1.1rem">
                                                                                Chapter</th>
                                                                            <th scope="col"
                                                                                style="font-weight: 500; font-size: 1.1rem">
                                                                                Lesson</th>
                                                                            <th scope="col"
                                                                                style="font-weight: 500; font-size: 1.1rem">
                                                                                Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="quizze_item lesson_quizze">

                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                            <div class="d-flex"
                                                                style="align-items: center; justify-content: center">
                                                                <span
                                                                    style="font-size: 2rem;font-weight: 500;background: #1b84ff;color: #fff;border-radius: 10px;padding: 10px 15px;margin-top: 10px;">Diagnostic
                                                                    Exam</span>
                                                            </div>

                                                            <div
                                                                style="max-height: 300px;overflow: scroll;padding: 12px 0; border-bottom: 2px solid #8f8f8f">
                                                                <table class="table table-striped" id="tblData_Edite">
                                                                    <thead class="border-bottom">
                                                                        <tr>
                                                                            <th scope="col"
                                                                                style="font-weight: 500; font-size: 1.1rem">
                                                                                Type</th>
                                                                            <th scope="col"
                                                                                style="font-weight: 500; font-size: 1.1rem">
                                                                                Year</th>
                                                                            <th scope="col"
                                                                                style="font-weight: 500; font-size: 1.1rem">
                                                                                Month</th>
                                                                            <th scope="col"
                                                                                style="font-weight: 500; font-size: 1.1rem">
                                                                                Code</th>
                                                                            <th scope="col"
                                                                                style="font-weight: 500; font-size: 1.1rem">
                                                                                Section</th>
                                                                            <th scope="col"
                                                                                style="font-weight: 500; font-size: 1.1rem">
                                                                                No</th>
                                                                            <th scope="col"
                                                                                style="font-weight: 500; font-size: 1.1rem">
                                                                                Difficulty</th>
                                                                            <th scope="col"
                                                                                style="font-weight: 500; font-size: 1.1rem">
                                                                                Chapter</th>
                                                                            <th scope="col"
                                                                                style="font-weight: 500; font-size: 1.1rem">
                                                                                Lesson</th>
                                                                            <th scope="col"
                                                                                style="font-weight: 500; font-size: 1.1rem">
                                                                                Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <input type="hidden" class="add_new_questions"
                                                                        name="add_new_questions" />

                                                                    <tbody class="sel_quz_edit"
                                                                        id="sel_quz_edit{{ $item->id }}">



                                                                        @foreach ($item->question->sortBy('q_num') as $question)


                                                                            <tr class="tr_edite{{ $item->id }}"
                                                                            id="tr_edite{{ $question->id }}">

                                                                                <input type="hidden"
                                                                                    value="{{ $question->id }}"
                                                                                    name="question_id[]"
                                                                                    class="question_edite_id"
                                                                                    id="question_edite_id{{ $question->id }}" />

                                                                                <input type="hidden"
                                                                                    value="{{ $item->id }}" 
                                                                                    class='diagnostic_edite_id'
                                                                                    id='diagnostic_edite_id{{ $question->id }}' />

                                                                                <td class="question_edite_type"
                                                                                    id="question_edite_type{{ $question->id }}"
                                                                                    style="font-weight: 500; font-size: 1.1rem">
                                                                                    {{ $question->q_type }}
                                                                                </td>

                                                                                <td class="question_edite_year"
                                                                                    id="question_edite_year{{ $question->id }}"
                                                                                    style="font-weight: 500; font-size: 1.1rem">
                                                                                    {{ $question->year }}
                                                                                </td>

                                                                                <td class="question_edite_month"
                                                                                    id="question_edite_month{{ $question->id }}"
                                                                                    style="font-weight: 500; font-size: 1.1rem">
                                                                                    {{ $question->month }}
                                                                                </td>

                                                                                <td class="question_edite_code"
                                                                                    id="question_edite_code{{ $question->id }}"
                                                                                    style="font-weight: 500; font-size: 1.1rem">
                                                                                    {{ @$question->code->exam_code }}
                                                                                </td>

                                                                                <td class="question_edite_section"
                                                                                    id="question_edite_section{{ $question->id }}"
                                                                                    style="font-weight: 500; font-size: 1.1rem">
                                                                                    {{ $question->section }}
                                                                                </td>

                                                                                <td class="question_edite_num"
                                                                                    id="question_edite_num{{ $question->id }}"
                                                                                    style="font-weight: 500; font-size: 1.1rem">
                                                                                    {{ $question->q_num }}
                                                                                </td>

                                                                                <td class="question_edite_difficulty"
                                                                                    id="question_edite_difficulty{{ $question->id }}"
                                                                                    style="font-weight: 500; font-size: 1.1rem">
                                                                                    {{ $question->difficulty }}
                                                                                </td>
                                                                                <td class="question_edite_chapter"
                                                                                    id="question_edite_chapter{{ $question->id }}"
                                                                                    style="font-weight: 500; font-size: 1.1rem">
                                                                                    {{ $question->lessons->chapter->chapter_name }}
                                                                                </td>
                                                                                <td class="question_edite_lesson"
                                                                                    id="question_edite_lesson{{ $question->id }}"
                                                                                    style="font-weight: 500; font-size: 1.1rem">
                                                                                    {{ $question->lessons->lesson_name }}
                                                                                </td>

                                                                                <td
                                                                                    style='width: 150px !important; padding: 0 !important;'>
                                                                                    <button type='button'
                                                                                        class='remove_qz_edit'>Remove</button>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>

                                                                </table>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary close_btn"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary add_btn btn_Edit_quizze"
                                                    id="btn_Edit_quizze{{ $item->id }}">Edit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal To Delete Quizze -->
                        <div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1"
                            aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <h5 class="modal-title" id="modalCenterTitle">Delete Quizze</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class='p-3'>
                                        Are You Sure To Delete
                                        <span class='text-danger'>
                                            {{ $item->title }} ??
                                        </span>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-label-secondary"
                                            data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <a href="{{ route('del_dia_exam', ['id' => $item->id]) }}"
                                            class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </div>
                    </td>
                </tr>
            @endforeach

            {{ $exams->links() }}
        </tbody>
    </table>

    <script>
        $(document).ready(function() {

            $("#show_menu").click(function() {

                $("#menu_action").toggle(function() {

                    $(this).addClass("d-flex");
                }, function() {
                    $(this).removeClass("d-flex");

                })

                $("#menu_action").click(function() {
                    $(this).hide()
                })
            });


            $('.btnNext').click(function() {
                const nextTabLinkEl = $('.nav-tabs .active').closest('li').next('li').find('a')[0];
                const nextTab = new bootstrap.Tab(nextTabLinkEl);
                nextTab.show();
            });

            $('.btnPrevious').click(function() {
                const prevTabLinkEl = $('.nav-tabs .active').closest('li').prev('li').find('a')[0];
                const prevTab = new bootstrap.Tab(prevTabLinkEl);
                prevTab.show();
            });

            // $('.nex_btn').click(function() {
            //   const nextTabLinkEl = $('.nav-edit .active').closest('.nav-item').next('li').find('a')[0];
            //   const nextTab = new bootstrap.Tab(nextTabLinkEl);
            //   nextTab.show();
            // });

            // $('.pre_btn').click(function() {
            //   const prevTabLinkEl = $('.nav-edit .active').closest('.nav-question').prev('li').find('a')[0];
            //   const prevTab = new bootstrap.Tab(prevTabLinkEl);
            //   prevTab.show();
            // });

            $(".cls_edite").click(() => {
                $(".modal_edit").modal("hide");
            })
            $(".close_btn").click(() => {
                $(".modal_edit").modal("hide");
            })



            var emptyRow = "<tr><td colspan='12' class='avil'> No Quizzes Available</td></tr>"

            function addEmptyRow() {
                if ($("#tblData tbody").html() == "") {
                    $("#tblData tbody").append(emptyRow);
                };
                if ($("#tblData_Quizzes tbody").html() == "") {
                    $("#tblData_Quizzes tbody").append(emptyRow);
                };
                if ($("#tblData_Edite tbody").html() == "") {
                    $("#tblData_Edite tbody").append(emptyRow);
                };
                if ($("#tblData_Quizzes_Edite tbody").html() == "") {
                    $("#tblData_Quizzes_Edite tbody").append(emptyRow);
                };
            };
            addEmptyRow();
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#sel_course").change(function() {
                $("#sel_chp").empty();
                $("#sel_less").empty();
                var defOptionChapter = `<option value="">Select Chapter</option>`;
                $("#sel_chp").append(defOptionChapter);
                /* ########### */
                var defOptionLess = `<option value="">Select Lessone</option>`;
                $("#sel_less").append(defOptionLess);
                $.ajax({
                    url: "{{ route('lessons') }}",
                    type: "GET",
                    data: {
                        course_id: $(this).val(),
                    },
                    success: function(data) {
                        $(data.chapters).each((val, ele) => {
                            var newChapter = `<option value="${ele.id}">
                                                ${ele.chapter_name}
                                            </option>`;
                            $("#sel_chp").append(newChapter);
                        })
                    }
                })
            })
            $("#sel_chp").change(function() {
                $("#sel_less").empty();
                var defOptionLess = `<option value="">Select Lessone</option>`;
                $("#sel_less").append(defOptionLess);
                $.ajax({
                    url: "{{ route('lessons') }}",
                    type: "GET",
                    data: {
                        chapter_id: $(this).val(),
                    },
                    success: function(data) {
                        $(data.lessons).each((val, ele) => {
                            var newLessone = `<option value="${ele.id}">
                                                ${ele.lesson_name}
                                            </option>`;
                            $("#sel_less").append(newLessone);
                        })
                    }
                })
            })
        })
        $("#menu_action").css("display", "none");


        let sel_category = document.querySelector('#sel_category');
        let sel_course = document.querySelector('#sel_course');
        let category = document.querySelector('.category');
        let course = document.querySelector('.course');
        let questions_data = document.querySelector('.questions_data');
        course = course.value;
        course = JSON.parse(course);

        sel_category.addEventListener('change', () => {
            sel_course.innerHTML = `
            <option selected disabled>
                Select Course ...
            </option>
            `;
            course.forEach(element => {
                if (sel_category.value == element.category_id) {
                    sel_course.innerHTML += `
                <option value="${element.id}">
                ${element.course_name}
                </option>
                `;
                }
            })
        });

        let quizze_item = document.querySelector('.quizze_item');

        let add_question_btn = document.querySelectorAll('.add_question');
        let ques_id = document.querySelectorAll('.ques_id');
        let quizze_id = document.querySelectorAll('.quizze_id');
        let arr = [];
        // for (let i = 0, end = add_question_btn.length; i < end; i++) {
        //     add_question_btn[i].addEventListener('click', (e) => {
        //         for (let j = 0; j < end; j++) {
        //             if (e.target == add_question_btn[j]) {
        //                 let ques = ques_id[j].value;
        //                 let quizze = quizze_idd[j].value;
        //                 let obj = {
        //                     'ques_id': ques,
        //                     'quizze_id': quizze
        //                 }
        //                 arr = [...arr, obj];
        //             }
        //         }
        //     })
        // }

        sel_course.addEventListener('change', () => {

            console.log(865);
            $(".next_btn").removeClass("d-none");

            $.ajax("{{ route('dia_exam_data') }}", {
                type: 'GET', // http method
                data: {
                    course_id: sel_course.value,
                }, // data to submit
                success: function(data) {
                    console.log("darar", data)
                    quizze_item.innerHTML = null;
                    data.forEach((element, index) => {

                            // Check if exam_code exists in element.code, otherwise set it to 'null'
                            const examCode = element.code && element.code.exam_code ? element.code.exam_code : 'null';
                            
                        quizze_item.innerHTML += `<tr>
                          <th scope="row" class="idd d-none">${element.question_id}</th>
                          <th>${index + 1}</th>
                          <td class="type" id="type">${element.q_type}</td>
                          <td class="year" id="year">${element.year}</td>
                          <td class="month" id="month">${element.month}</td>
                          <td class="code" id="code">${examCode}</td>
                          <td class="section" id="section">${element.section}</td>
                          <td class="noNum" id="noNum">${element.q_num}</td>
                          <td class="diff" id="diff">${element.difficulty}</td>
                          <td class="chapter" id="chapter">${element.chapter_name}</td>
                          <td class="lessone" id="lessone">${element.lesson_name}</td>
                          <td class="p-0">
                            <button type="button" class="add_qz">Add</button>
                          </td>
                        </tr>`;
                    });
                    var quizzes = [];

                    $(document).on('click', ".add_qz", function() {

                        var quziId = $(this).closest("tr").find(".idd").text();
                        var quziType = $(this).closest("tr").find(".type").text();
                        var quziYear = $(this).closest("tr").find(".year").text();
                        var quziMonth = $(this).closest("tr").find(".month").text();
                        var quziCode = $(this).closest("tr").find(".code").text();
                        var quziNoNum = $(this).closest("tr").find(".noNum").text();
                        var quziSection = $(this).closest("tr").find(".section").text();
                        var quziChapter = $(this).closest("tr").find(".chapter").text();
                        var quziLessone = $(this).closest("tr").find(".lessone").text();
                        var quziDiff = $(this).closest("tr").find(".diff").text();


                        $(this).addClass("selected_qz");
                        $(this).removeClass("add_qz");
                        $(this).text("Selected");


                        var allData = [];


                        var quziObject = {
                            id: quziId,
                            type: quziType,
                            year: quziYear,
                            month: quziMonth,
                            code: quziCode,
                            section: quziSection,
                            noNum: quziNoNum,
                            diff: quziDiff,
                            chap: quziChapter,
                            less: quziLessone,
                        }

                        allData.push(quziObject);

                        quizzes.push(...allData);

                        var object_serialized = JSON.stringify(allData);


                        var allObject_serialized = JSON.stringify(quizzes);

                        localStorage.setItem("Allquizzes", allObject_serialized)



                        localStorage.setItem("quizzes", object_serialized)


                        var myObjectDeserialized = JSON.parse(localStorage.getItem("quizzes"));


                        var quizz_container = $(".sel_quz");

                        var index = quizzes.length;
                        var removeBtn =
                            "<button type='button' class='remove_qz'>Remove</button>";


                        myObjectDeserialized.forEach(element => {
                            var dynamicTR = "<tr>";
                            dynamicTR = dynamicTR + "<td class='iddd'> " + index +
                                "</td>";
                            dynamicTR = dynamicTR + "<td> " + element.type + "</td>";
                            dynamicTR = dynamicTR + "<td> " + element.year + "</td>";
                            dynamicTR = dynamicTR + "<td> " + element.month + "</td>";
                            dynamicTR = dynamicTR + "<td> " + element.code + "</td>";
                            dynamicTR = dynamicTR + "<td> " + element.section + "</td>";
                            dynamicTR = dynamicTR + "<td> " + element.noNum + "</td>";
                            dynamicTR = dynamicTR + "<td> " + element.diff + "</td>";
                            dynamicTR = dynamicTR + "<td> " + element.chap + "</td>";
                            dynamicTR = dynamicTR + "<td> " + element.less + "</td>";
                            dynamicTR = dynamicTR +
                                "<td style='width: 150px !important; padding: 0 !important;'  > " +
                                removeBtn + "</td>";

                            dynamicTR = dynamicTR + " </tr>";

                            index++;
                            //_____________________________________________________________________________
                            quizz_container.append(dynamicTR);
                            questions_data.value = JSON.stringify(quizzes);
                            //_____________________________________________________________________________
                        });

                        if ($("tbody").length <= 1) {
                            addEmptyRow();
                        } else {
                            $(".avil").parent().remove();
                        };
                    });

                    $(document).on('click', '.remove_qz', function() {
                        var emptyRow =
                            "<tr><td colspan='12' class='avil'> No Quizzes Available</td></tr>";


                        var getIndex = $(this).closest("tr").index();

                        quizzes.splice(getIndex, 1);


                        $(this).closest("tr").remove();

                        if ($("#tblData .sel_quz").html() == "") {
                            $("#tblData .sel_quz").append(emptyRow);
                        };
                    });


                    /* #### Filter #### */
                    $("#filterBtn").click(function() {
                        $.ajax({
                            url: "{{ route('dia_filter_question') }}",
                            type: "GET",
                            data: {
                                year: $("#sel_year").val(),
                                month: $("#sel_month").val(),
                                section: $("#sel_section").val(),
                                code: $("#sel_code").val(),
                                q_num: $("#sel_questionNum").val(),
                                chapter: $("#sel_chp").val(),
                                lesson: $("#sel_less").val(),
                                q_type: $("#sel_type").val(),
                            },
                            success: function(data) {
                                console.log("data filter", data)
                                if (data.faild == undefined) {
                                    console.log("yes faild")
                                    $("#addAllBtn").removeClass('d-none')
                                    /* data.questions */
                                    quizze_item.innerHTML = null;
                                    (data.questions).forEach((element, index) => {

                                        // Check if exam_code exists in element.code, otherwise set it to 'null'
                            const examCode = element.code && element.code.exam_code ? element.code.exam_code : 'null';

                                        quizze_item.innerHTML += `<tr class="filterResult">
                                    <th scope="row" class="idd d-none">${element.id}</th>
                                    <th>${index + 1}</th>
                                    <td class="type" id="type">${element.q_type}</td>
                                    <td class="year" id="year">${element.year}</td>
                                    <td class="month" id="month">${element.month}</td>
                                    <td class="code" id="code">${examCode}</td>
                                    <td class="section" id="section">${element.section}</td>
                                    <td class="noNum" id="noNum">${element.q_num}</td>
                                    <td class="diff" id="diff">${element.difficulty}</td>
                                    <td class="chapter" id="chapter">${element.api_lesson.api_chapter.chapter_name}</td>
                                    <td class="lessone" id="lessone">${element.api_lesson.lesson_name}</td>
                                    <td class="p-0">
                                    <button type="button" class="add_qz">Add</button>
                                    </td>
                                </tr>`;
                                    });
                                } else {
                                    $("#addAllBtn").addClass('d-none')
                                    console.log("NotFaild")
                                    quizze_item.innerHTML = null;
                                    quizze_item.innerHTML +=
                                        `<td colspan="12" class="avil">${data.faild}</td>`
                                }
                                $("#addAllBtn").click(function() {
                                    $(".filterResult").each((
                                        index, ele) => {
                                        $(ele).find(".add_qz")
                                            .click();
                                    })
                                })
                            }

                        })
                    })
                    /* #### Filter #### */
                },
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            var quizzesEdit = [];
            $(".sel_chp_edit").change(function() {
                console.log("changeee")
                var parFilterEdit = `#${$(this).closest(".all_filter").attr("id")}`;
                var chapterSelect = `#${$(this).attr("id")}`;
                var lessonSelect = $(parFilterEdit).find("#sel_less_edit");
                console.log("parFilterEdit", parFilterEdit)
                console.log("chapterSelect", chapterSelect)
                console.log("lessonSelect", lessonSelect)
                $(lessonSelect).empty();
                var defOptionLess = `<option value="">Select Lesson</option>`;
                $(parFilterEdit).find("#sel_less_edit").append(defOptionLess);
                $.ajax({
                    url: "{{ route('lessons') }}",
                    type: "GET",
                    data: {
                        chapter_id: $(chapterSelect).val(),
                    },
                    success: function(data) {
                        $(data.lessons).each((val, ele) => {
                            var newLessone = `<option value="${ele.id}">
                                                ${ele.lesson_name}
                                            </option>`;
                            $(lessonSelect).append(newLessone);
                        })
                    }
                })

            });
            /* #### Filter Edit #### */
            $(document).on("click", ".filterBtn_edit", function() {
                var parFilterEdit = `#${$(this).closest(".all_filter").attr("id")}`;
                var filterBtnEdit = `#${$(parFilterEdit).find(".filterBtn_edit").attr("id")}`;
                var addAllBtnEdit = `#${$(filterBtnEdit).next().attr("id")}`;
                var tableEdite = $(this).closest(".question_edit_parQ").find(".quizze_ID");
                console.log("tableEdite", tableEdite)
                console.log("parFilterEdit", parFilterEdit)
                console.log("filterBtn_edit", filterBtnEdit)
                console.log("addAllBtnEdit", addAllBtnEdit)
                $.ajax({
                    url: "{{ route('dia_filter_question') }}",
                    type: "GET",
                    data: {
                        year: $(parFilterEdit).find("#sel_year_edit").val(),
                        month: $(parFilterEdit).find("#sel_month_edit").val(),
                        section: $(parFilterEdit).find("#sel_section_edit").val(),
                        code: $(parFilterEdit).find("#sel_code_edit").val(),
                        q_num: $(parFilterEdit).find("#sel_question_edit").val(),
                        chapter: $(parFilterEdit).find(".sel_chp_edit").val(),
                        lesson: $(parFilterEdit).find("#sel_less_edit").val(),
                        q_type: $(parFilterEdit).find("#sel_type_edit").val(),
                    },
                    success: function(data) {
                        console.log("data filter", data)
                        if (data.faild == undefined) {
                            console.log("yes faild")
                            $(addAllBtnEdit).removeClass('d-none')
                            /* data.questions */
                            $(parFilterEdit).parent().find(".lesson_quizze").empty();
                            (data.questions).forEach((element, index) => {

                            // Check if exam_code exists in element.code, otherwise set it to 'null'
                            const examCode = element.code && element.code.exam_code ? element.code.exam_code : 'null';
                        $(parFilterEdit).parent().find(".lesson_quizze").append(`<tr class="filterResultEdit">
                          <input type="hidden" value=${element.id} class="question_id ques_id quizze_ID" />
                          <th>${index + 1}</th>
                          <td class="type" id="type">${element.q_type}</td>
                          <td class="year" id="year">${element.year}</td>
                          <td class="month" id="month">${element.month}</td>
                          <td class="code" id="code">${examCode}</td>
                          <td class="section" id="section">${element.section}</td>
                          <td class="noNum" id="noNum">${element.q_num}</td>
                          <td class="diff" id="diff">${element.difficulty}</td>
                          <td class="chapE" id="chapter">${element.api_lesson.api_chapter.chapter_name}</td>
                          <td class="lessE" id="lessone">${element.api_lesson.lesson_name}</td>
                          <td class="p-0">
                            <button type="button" class="edit_qz add_question">Add</button>
                          </td>
                        </tr>`);
                            });
                        } else {
                            $(addAllBtnEdit).addClass('d-none')
                            console.log("NotFaild")
                            $(parFilterEdit).parent().find(".lesson_quizze").empty();
                            $(parFilterEdit).parent().find(".lesson_quizze").append(
                                `<td colspan="12" class="avil">${data.faild}</td>`)
                        }
                        $(addAllBtnEdit).click(function() {
                            $(".filterResultEdit").each((
                                index, ele) => {
                                $(ele).find(".edit_qz")
                                    .click();
                            })
                        })
                    }

                })

            })

            $(document).on("click", ".edit_qz", function() {

                var question_idd = $(this).closest("tr").find(".ques_id").val();
                var quizze_idd = $(this).closest(".lesson_quizze").find(".quizze_ID").val();

                // var quziId = $(this).closest("tr").find(".idd").text();
                var quziType = $(this).closest("tr").find(".type").text();
                var quziYear = $(this).closest("tr").find(".year").text();
                var quziMonth = $(this).closest("tr").find(".month").text();
                var quziCode = $(this).closest("tr").find(".code").text();
                var quziNoNum = $(this).closest("tr").find(".noNum").text();
                var quziSection = $(this).closest("tr").find(".section").text();
                var quziDiff = $(this).closest("tr").find(".diff").text();
                var quziChap = $(this).closest("tr").find(".chapE").text();
                var quziLess = $(this).closest("tr").find(".lessE").text();
                var edit_eray =
                    `#${$(this).closest(".form_editquizze").find(".sel_quz_edit").attr("id")}`;


                var indexx =
                    `#${$(this).closest(".form_editquizze").find(".sel_quz_edit").attr("id")}`;
                var count_tr_edit = $(indexx).find("tr").length;
                // var indexQuizze = $(count_tr_edit);


                $(this).addClass("selected_qz");
                $(this).removeClass("edit_qz");
                $(this).text("Selected");



                console.log("##############")

                console.log("indexx", indexx)
                console.log("count_edit_lenght", count_tr_edit)
                // console.log("indexQuizze", indexQuizze)
                console.log("##############")


                console.log("question_idd", question_idd);
                console.log("quizze_idd", quizze_idd);

                // console.log("quziId", quziId);
                console.log("quziType", quziType);
                console.log("quziYear", quziYear);
                console.log("quziMonth", quziMonth);
                console.log("quziCode", quziCode);
                console.log("quziNoNum", quziNoNum);
                console.log("quziSection", quziSection);
                console.log("quziDiff", quziDiff);
                console.log("##########")
                console.log("edit_eray", edit_eray);

                var new_Ele_Edit = `<tr class='tr_edite${quizze_idd}' id='tr_edite${question_idd}'>
                                <input type="hidden"
                                value=${question_idd}
                                name='question_id[]'
                                class='question_edite_id' id='question_edite_id${question_idd}'/>

                                <input type="hidden"
                                value=${quizze_idd} 
                                class='diagnostic_edite_id' id='diagnostic_edite_id${question_idd}'/>

                                <td class="question_edite_type" id='question_edite_type${question_idd}' style="font-weight: 500; font-size: 1.1rem">
                                    ${quziType}
                                </td>
                                <td class="question_edite_year" id='question_edite_year${question_idd}' style="font-weight: 500; font-size: 1.1rem">
                                    ${quziYear}</td>
                                <td class="question_edite_month" id='question_edite_month${question_idd}' style="font-weight: 500; font-size: 1.1rem">
                                    ${quziMonth}</td>
                                <td class="question_edite_code" id='question_edite_code${question_idd}' style="font-weight: 500; font-size: 1.1rem">
                                    ${quziCode}</td>
                                <td class="question_edite_section" id='question_edite_section${question_idd}' style="font-weight: 500; font-size: 1.1rem">
                                    ${quziSection}</td>
                                <td class="question_edite_num" id='question_edite_num${question_idd}' style="font-weight: 500; font-size: 1.1rem">
                                    ${quziNoNum}</td>
                                <td class="question_edite_difficulty" id='question_edite_difficulty${question_idd}' style="font-weight: 500; font-size: 1.1rem">
                                    ${quziDiff}</td>
                                <td class="question_edite_chapter" id='question_edite_chapter${question_idd}' style="font-weight: 500; font-size: 1.1rem">
                                    ${quziChap}</td>
                                <td class="question_edite_lesson" id='question_edite_lesson${question_idd}' style="font-weight: 500; font-size: 1.1rem">
                                    ${quziLess}</td>
                                <td style="width: 150px !important; padding: 0 !important;">
                                    <button type="button" class="remove_qz_edit">Remove</button>
                                </td>
                            </tr>`;

                $(edit_eray).append(new_Ele_Edit);

                if ($("tbody").length <= 1) {
                    addEmptyRow();
                } else {
                    $(".avil").parent().remove();
                };
            });
            /* #### Filter Edit #### */

            $(document).on('click', '.remove_qz_edit', function() {

                var emptyRowEdit = "<tr><td colspan='12' class='avil'> No Quizzes Available</td></tr>";
                var countEle = `#${$(this).closest(".form_editquizze").find(".sel_quz_edit").attr("id")}`;
                var indexQuizzes =
                    `#${$(this).closest(".form_editquizze").find(".sel_quz_edit").attr("id")}`;
                var count_tr_editt = $(indexQuizzes).find("tr").length;

                var getIndexEdit = $(this).closest("tr").index();

                quizzesEdit.splice(getIndexEdit, 1);


                $(this).closest("tr").remove();
                console.log("this", $(this).attr("class"))
                console.log("ele", $(this).closest(".sel_quz_edit").html())
                console.log("first");

                console.log("count_tr_editt", count_tr_editt)
                if (count_tr_editt <= 1) {
                    $("#tblData_Edite tbody").append(emptyRowEdit);
                };
            });

            var allDataEdite = [];
            $(document).on("click", ".btn_Edit_quizze", function() {
                console.clear();

                allDataEdite = [];
                var InfoEdite = [];

                var btn_editee = `#${$(this).attr("id")}`;
                /* Parent from Modal */
                var parModel =
                    `#${$(btn_editee).closest(".form_editquizze").find(".tab-content").attr("id")}`;

                /* ########### */
                // var diagnostic_edit_id =
                //     `#${$(parModel).find(".diagnostic_edite_id").attr("id")}`;
                var diag_ID = $(parModel).find(".quizze_ID").val();

                /* Quizze Title */
                var info_Title = $(parModel).find(".quizze_title").val();
                /* Quizze Description */
                var info_Description = $(parModel).find(".quizze_description").val();
                /* Quizze Duration */
                var info_Duration = $(parModel).find(".quizze_duration").val();
                /* Quizze Score Id */
                var info_Score_Id = $(parModel).find("#score_id_edit").val();
                /* Quizze Total Score */
                var info_Total_Score = $(parModel).find(".quizze_Total_Score").val();
                /* Quizze Pass Score */
                var info_Pass_Score = $(parModel).find(".quizze_Pass_Score").val();
                /* Quizze Active */
                var info_Active = $(parModel).find(".quizze_Active");

                if ($(info_Active).is(":checked") == true) {
                    info_Active = 1;
                } else {
                    info_Active = 0;
                }


                var info_obj = {
                    diagnostic_ID: diag_ID,
                    title: info_Title,
                    description: info_Description,
                    time: info_Duration,
                    scoreId: info_Score_Id,
                    score: info_Total_Score,
                    pass_score: info_Pass_Score,
                    state: info_Active,
                }
                InfoEdite.push(info_obj);

                allDataEdite.push(InfoEdite)


                /* Parent from table */
                var parEdite =
                    `#${$(btn_editee).closest(".form_editquizze").find(".sel_quz_edit").attr("id")}`;
                var childEdite = `.${$(parEdite).find("tr").attr("class")}`

                console.log("childEdite", childEdite)
                console.log("childEdite length", $(childEdite).length)


                $(childEdite).each((childEle, childVal) => {

                    var parEle = `#${$(childVal).attr("id")}`;

                    /* ########### */
                    var question_edit_id = `#${$(parEle).find(".question_edite_id").attr("id")}`;
                    var ques_ID = $(question_edit_id).val();

                    /* ########### */
                    var question_edit_type =
                        `#${$(parEle).find(".question_edite_type").attr("id")}`;
                    var ques_TYPE = $(question_edit_type).text().trim();

                    /* ########### */
                    var question_edit_year =
                        `#${$(parEle).find(".question_edite_year").attr("id")}`;
                    var ques_YEAR = $(question_edit_year).text();

                    /* ########### */
                    var question_edit_month =
                        `#${$(parEle).find(".question_edite_month").attr("id")}`;
                    var ques_MONTH = $(question_edit_month).text();

                    /* ########### */
                    var question_edit_code =
                        `#${$(parEle).find(".question_edite_code").attr("id")}`;
                    var ques_CODE = $(question_edit_code).text().trim();

                    /* ########### */
                    var question_edit_section =
                        `#${$(parEle).find(".question_edite_section").attr("id")}`;
                    var ques_SECTION = $(question_edit_section).text();

                    /* ########### */
                    var question_edit_num = `#${$(parEle).find(".question_edite_num").attr("id")}`;
                    var ques_NUM = $(question_edit_num).text();
                    /* ########### */
                    var question_edit_difficulty =
                        `#${$(parEle).find(".question_edite_difficulty").attr("id")}`;
                    var ques_DIFFICULTY = $(question_edit_difficulty).text().trim();
                    /* ########### */
                    var question_edit_chapter =
                        `#${$(parEle).find(".question_edite_chapter").attr("id")}`;
                    var ques_chapter = $(question_edit_chapter).text().trim();
                    /* ########### */
                    var question_edit_lesson =
                        `#${$(parEle).find(".question_edite_lesson").attr("id")}`;
                    var ques_Lesson = $(question_edit_lesson).text().trim();
                    /* ########### */


                    var question_obj = {
                        question_ID: JSON.parse(ques_ID),
                        question_Type: ques_TYPE,
                        question_Year: ques_YEAR,
                        question_Month: ques_MONTH,
                        question_Code: ques_CODE,
                        question_Section: ques_SECTION,
                        question_Num: ques_NUM,
                        question_Difficulty: ques_DIFFICULTY,
                        question_Chapter: ques_chapter,
                        // question_Lesson: ques_lesson,
                    }

                    console.log("childEle", childEle)
                    console.log("childVal", childVal)

                    allDataEdite.push(question_obj);
                })

                $("#allQuestion").val(JSON.stringify(allDataEdite))
                console.log("#############")
                // console.log("parEdite", parEdite)
                // console.log("parModel", parModel)
                console.log("#############")
                console.log("InfoEdite", InfoEdite)
                console.log("allDataEdite", allDataEdite)
                console.log("#############")
                $.ajax({
                    url: "{{ route('edit_q_dia_exam') }}",
                    type: 'GET', // http method
                    data: {
                        data: allDataEdite
                    }, // data to submit
                    success: function(data) {
                        console.log(data);
                        console.log(allDataEdite);
                        location.reload();
                    }
                });
            })
        });
        
    </script>
</x-default-layout>
