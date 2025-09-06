@include('Visitor.inc.header')
@include('Visitor.inc.menu')
@include('success')
<style>
    .heroSec {
        width: 100%;
        /* height: 87vh; */
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

    /* .mainContent .leftContent>h3 {
        font-size: 2rem !important;
        font-weight: 700 !important;
        margin-bottom: 0 !important;
        color: #CF202F;
    } */

    /* .mainContent .leftContent>p {
        font-size: 1.5rem !important;
        font-weight: 600 !important;
        margin-bottom: 0 !important;
        color: #727272;
    } */

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

        .sel_category,
        .sel_course,
        .year_sel,
        .month_sel,
        .section_sel,
        .examCode_sel,
        .q_num_sel {
            width: 80% !important;
        }
    }



        .heroSec {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
            margin-bottom: 10px
        }

        .mainContent {
            display: flex;
            flex-wrap: wrap;
        }

        .leftContent {
            flex: 1;
            min-width: 300px;
            padding: 30px;
        }

        .leftContent h3 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 15px;
            color: #dc3545;
            line-height: 1.2;
        }

        .leftContent p {
            font-size: 1rem;
            color: #4a5568;
            margin-bottom: 20px;
        }

        .features {
            margin: 20px 0;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .feature-icon {
            background: #dc3545;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            flex-shrink: 0;
            font-size: 12px;
        }

        .rightContent {
            flex: 1;
            min-width: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #fef5f3;
            padding: 20px;
        }

        .rightContent img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .footerSec {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }

        .footerSec img {
            height: 30px;
            opacity: 0.8;
            transition: all 0.3s ease;
        }

        .footerSec img:hover {
            opacity: 1;
            transform: scale(1.05);
        }

        .cta-button {
            display: inline-block;
            padding: 12px 25px;
            background: #dc3545;
            color: white;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(220, 53, 69, 0.3);
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 5px;
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(220, 53, 69, 0.4);
        }

        @media (max-width: 768px) {
            .mainContent {
                flex-direction: column;
            }

            .leftContent h3 {
                font-size: 1.8rem;
            }

            .leftContent, .rightContent {
                padding: 20px;
            }

            .footerSec {
                gap: 15px;
            }

            .footerSec img {
                height: 25px;
            }
        }
</style>



<!-- Hero Question Page -->
<section class="heroSec">
    <div class="mainContent">
        <div class="leftContent">
            <h3>Conquer Math Anxiety<br>Get Expert Solutions, Videos & PDFs</h3>
            <p>
                Feeling overwhelmed by math problems on global exams like SAT, ACT, EST, AP Calculus, and more? You're
                not alone! But what if you could find solutions, explanations, and different approaches to any math
                question?
            </p>

            <div class="features">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <div>
                        <b>Master Any Math Topic:</b> Search by exam and topic for detailed answers and clear visuals.
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <div>
                        <b>Multiple Learning Styles:</b> Choose from text, videos, and PDFs to suit your style.
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <div>
                        <b>Unlock Different Approaches:</b> See various problem-solving methods.
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <div>
                        <b>Boost Confidence:</b> Tackle exam questions with newfound clarity.
                    </div>
                </div>
            </div>

            <p>
                Stop wasting time! Our one-stop solution provides everything you need to conquer math on any global
                exam.
            </p>

            <a href="#" class="cta-button">Get Started Now</a>
        </div>
    </div>
    <div class="footerSec">
        <img src="https://placehold.co/100x40/cccccc/000000/png?text=SAT" alt="SAT">
        <img src="https://placehold.co/100x40/cccccc/000000/png?text=College+Board" alt="College Board">
        <img src="https://placehold.co/100x40/cccccc/000000/png?text=ACT" alt="ACT">
        <img src="https://placehold.co/100x40/cccccc/000000/png?text=EST" alt="EST">
    </div>
</section>

<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <div class="main-title text-center">
            <h3 class="mb0 mt0" style="color: #CF202F">Featured Courses</h3>
        </div>
    </div>
</div>

<form action="{{ route('v_filter_question') }}" method="GET">
    <div
        style="display: flex !important;align-items: center;width: 100% !important;justify-content: center; flex-wrap: wrap !important;gap: 25px !important;">
        <select
            style="width: 30%;font-size: 1.1rem; border: none;border-bottom: 3px solid red;border-radius: 0;color: #B8B8B8;"
            class="form-control sel_category mx-2" name="category_id">
            <option disabled selected>
                Select Category
            </option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->cate_name }}
                </option>
            @endforeach
        </select>
        <select
            style="width: 30%;font-size: 1.1rem; border: none;border-bottom: 3px solid red;border-radius: 0;color: #B8B8B8;"
            class="form-control mx-2 sel_course" name="course_id">
            <option disabled selected>
                Select Course
            </option>
        </select>
        <input type="hidden" value="{{ $categories }}" class="category" />
        <input type="hidden" value="{{ $courses }}" class="course" />

        <select
            style="width: 30%;font-size: 1.1rem; border: none;border-bottom: 3px solid red;border-radius: 0;color: #B8B8B8;"
            class="form-control mx-2 year_sel" name="year">
            <option disabled selected>
                Select Year
            </option>
            @for ($i = date('Y'); $i > 1950; $i--)
                <option value="{{ $i }}">
                    {{ $i }}
                </option>
            @endfor
        </select>
        <select
            style="width: 30%;font-size: 1.1rem; border: none;border-bottom: 3px solid red;border-radius: 0;color: #B8B8B8;"
            class="form-control mx-2 month_sel" name="month">
            <option disabled selected>
                Select Month
            </option>
            @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}">
                    {{ date('M', ($i - 1) * 31 * 24 * 60 * 60) }}
                </option>
            @endfor
        </select>
        <input
            style="width: 30%;font-size: 1.1rem; border: none;border-bottom: 3px solid red;border-radius: 0;color: #B8B8B8;"
            class="form-control mx-2 section_sel" name="section" placeholder="Section" />

        <select
            style="width: 30%;font-size: 1.1rem; border: none;border-bottom: 3px solid red;border-radius: 0;color: #B8B8B8;"
            name="q_code" class="form-control mx-2 examCode_sel">
            <option selected value="">
                Select Code
            </option>
            @foreach ($codes as $item)
                <option value="{{ $item->id }}">
                    {{ $item->exam_code }}
                </option>
            @endforeach
        </select>
        <input
            style="width: 30%;font-size: 1.1rem; border: none;border-bottom: 3px solid red;border-radius: 0;color: #B8B8B8;"
            class="form-control mx-2 q_num_sel" name="q_num" placeholder="Question Number" />
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


    let sel_category = document.querySelector('.sel_category');
    let sel_course = document.querySelector('.sel_course');
    let category = document.querySelector('.category');
    let course = document.querySelector('.course');
    course = course.value;
    course = JSON.parse(course);

    sel_category.addEventListener('change', () => {
        sel_course.innerHTML = `
        <option disabled selected>
            Select Course
        </option>`;
        course.forEach(element => {
            if (sel_category.value == element.category_id) {
                sel_course.innerHTML += `
                <option value="${element.id}">
                    ${element.course_name}
                </option>`;
            }
        });
    })
</script>

@include('Visitor.inc.footer')
