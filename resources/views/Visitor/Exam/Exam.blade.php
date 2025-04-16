@include('Visitor.inc.header')
@include('Visitor.inc.menu')
<style>
    .heroSec {
        width: 100%;
        height: 87vh;
        padding: 0 !important;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-evenly;
        background: #fff;
        overflow: hidden;
    }

    .mainContent {
        width: 90%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        column-gap: 20px;
    }

    .mainContent .leftContent {
        width: 50%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: center;
        row-gap: 20px;
    }

    .mainContent .leftContent>h3 {
        font-size: 4rem !important;
        font-weight: 700 !important;
        margin-bottom: 0 !important;
        color: #CF202F;
    }

    .mainContent .leftContent>p {
        font-size: 1.5rem !important;
        font-weight: 600 !important;
        margin-bottom: 0 !important;
        color: #727272;
    }

    .mainContent .rightContent {
        width: 50%;
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .mainContent .rightContent img {
        max-width: 75% !important;
    }

    .footerSec {
        width: 90%;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .footerSec>img {
        border-radius: 5px !important;
        object-fit: cover !important;
        object-position: center !important;
    }

    .form-control:focus {
        color: #B8B8B8 !important;
        background-color: #fff;
        border-color: none !important;
        outline: 0;
        box-shadow: none !important;
    }

    @media (max-width: 1220px) {

        .stylehome1,
        .rightContent {
            display: none !important;
        }

        .mainContent .leftContent {
            width: 100% !important;
        }

        .footerSec {
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-around;
            margin-top: 15px;
        }

        .cate_sel,
        .course_sel,
        .year_sel,
        .month_sel,
        .examCode_sel {
            width: 80% !important;
        }
    }
</style>

<!-- Hero Page Exams -->
<section class="heroSec">
    <div class="mainContent">
        <div class="leftContent">
            <h3>Conquer Global Exams</h3>
            <p>Stop Guessing! Pinpoint Your Math Strengths & Weaknesses for Top Exam
                Scores 
            </p>
        </div>
        <div class="rightContent">
            <img src="{{ asset('images/HeroBackground/Exam Hero.png') }}" alt="Exams">
        </div>
    </div>
    <div class="footerSec">
        <img src="{{ asset('images/HeroBackground/sat.png') }}" alt="photo">
        <img src="{{ asset('images/HeroBackground/collegeBoard.png') }}" alt="photo">
        <img src="{{ asset('images/HeroBackground/act.png') }}" alt="photo">
        <img src="{{ asset('images/HeroBackground/est.png') }}" alt="photo">
    </div>
</section>
<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <div class="main-title text-center">
            <h3 class="mb0 mt0" style="color: #CF202F">Featured Courses</h3>
        </div>
    </div>
</div>
<form action="{{ route('filter_exam') }}" method="GET">
    <div
        style="display: flex !important;align-items: center;width: 100% !important;justify-content: center; flex-wrap: wrap !important;gap: 25px !important;">
        <select
            style="width: 30%;font-size: 1.1rem; border: none;border-bottom: 3px solid red;border-radius: 0;color: #B8B8B8;"
            name="cate_id" class="form-control mx-2 cate_sel">
            <option disabled selected>
                Select Category
            </option>
            @foreach ($categories as $item)
                @if (@$data['cate_id'] == $item->id)
                    <option value="{{ $item->id }}" selected>
                        {{ $item->cate_name }}
                    </option>
                @else
                    <option value="{{ $item->id }}">
                        {{ $item->cate_name }}
                    </option>
                @endif
            @endforeach
        </select>

        <input type="hidden" class="courses_data" value="{{ $courses }}" />
        <select
            style="width: 30%;font-size: 1.1rem; border: none;border-bottom: 3px solid red;border-radius: 0;color: #B8B8B8;"
            class="form-control mx-2 course_sel" name="course_id">
            <option disabled selected>
                Select Course
            </option>
            @foreach ($courses as $item)
                @if (@$data['cate_id'] == $item->category_id)
                    @if (@$data['course_id'] == $item->id)
                        <option value="{{ $item->id }}" selected>
                            {{ $item->course_name }}
                        </option>
                    @else
                        <option value="{{ $item->id }}">
                            {{ $item->course_name }}
                        </option>
                    @endif
                @endif
            @endforeach
        </select>

        <select
            style="width: 30%;font-size: 1.1rem; border: none;border-bottom: 3px solid red;border-radius: 0;color: #B8B8B8;"
            class="form-control mx-2 year_sel" name="year">
            <option disabled selected>
                Select Year
            </option>
            @for ($i = date('Y'); $i > 1950; $i--)
                @if (@$data['year'] == $i)
                    <option value="{{ $i }}" selected>
                        {{ $i }}
                    </option>
                @else
                    <option value="{{ $i }}">
                        {{ $i }}
                    </option>
                @endif
            @endfor
        </select>
        <select
            style="width: 30%;font-size: 1.1rem; border: none;border-bottom: 3px solid red;border-radius: 0;color: #B8B8B8;"
            class="form-control mx-2 month_sel" name="month">
            <option disabled selected>
                Select Month
            </option>
            @for ($i = 1; $i <= 12; $i++)
                @if (@$data['month'] == $i)
                    <option value="{{ $i }}" selected>
                        {{ date('M', ($i - 1) * 31 * 24 * 60 * 60) }}
                    </option>
                @else
                    <option value="{{ $i }}">
                        {{ date('M', ($i - 1) * 31 * 24 * 60 * 60) }}
                    </option>
                @endif
            @endfor
        </select>
        <select
            style="width: 30%;font-size: 1.1rem; border: none;border-bottom: 3px solid red;border-radius: 0;color: #B8B8B8;"
            class="form-control mx-2 examCode_sel" name="code_id">
            <option disabled selected>
                Select Exam Code
            </option>
            @foreach ($exam_code as $item)
                @if (@$data['code_id'] == $item->id)
                    <option value="{{ $item->id }}" selected>
                        {{ $item->exam_code }}
                    </option>
                @else
                    <option value="{{ $item->id }}">
                        {{ $item->exam_code }}
                    </option>
                @endif
            @endforeach
        </select>

    </div>
    <div class="d-flex align-items-center justify-content-center py-4">
        <button
            style="background: #CF202F !important;color: #fff;padding: 10px 40px !important;outline: none;border:none;border-radius: 10px;font-size: 1.5rem;font-weight: bold;cursor: pointer;">
            Search
        </button>
    </div>
</form>

@foreach ($popup as $item)
    <div class="modal show_popup fade show " id="modalCenter" tabindex="-1" style="display: block;" aria-modal="true"
        role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Exam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img style="width: 100%; height: 200px;"
                        src="{{ asset('images/MarketingPopup/' . $item->image) }}" />

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary close_popup_btn" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endforeach
<script>
    let show_popup = document.querySelectorAll('.show_popup');
    let btn_close = document.querySelectorAll('.btn-close');
    let close_popup_btn = document.querySelectorAll('.close_popup_btn');

    for (let i = 0, end = btn_close.length; i < end; i++) {

        btn_close[i].addEventListener('click', (e) => {
            for (let j = 0; j < end; j++) {
                if (e.target == show_popup[j]) {
                    show_popup[j].classList.add('d-none');
                }
            }
        })
        close_popup_btn[i].addEventListener('click', (e) => {
            for (let j = 0; j < end; j++) {
                if (e.target == close_popup_btn[j]) {
                    show_popup[j].classList.add('d-none');
                }
            }
        })
    }

    let cate_sel = document.querySelector('.cate_sel');
    let course_sel = document.querySelector('.course_sel');
    let courses_data = document.querySelector('.courses_data');
    courses_data = courses_data.value;
    courses_data = JSON.parse(courses_data);

    cate_sel.addEventListener('change', () => {
        course_sel.innerHTML = `
            <option disabled selected>
                Select Course
            </option>
            `;
        courses_data.forEach(item => {
            if (cate_sel.value == item.category_id) {
                course_sel.innerHTML += `
                <option value="${item.id}">
                    ${item.course_name}
                </option>
                `;
            }
        });
    });
</script>
@include('Visitor.inc.footer')
