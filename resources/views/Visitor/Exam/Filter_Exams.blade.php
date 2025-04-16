@include('Visitor.inc.header')
@include('Visitor.inc.menu')
<style>
    .table td {
        font-weight: 600;
        color: #787878 !important;
    }

    .form-control:focus {
        color: #B8B8B8 !important;
        background-color: #fff;
        border-color: none !important;
        outline: 0;
        box-shadow: none !important;
    }

    .conBtn {
        background: #CF202F;
        color: #fff;
        font-size: 1.3rem;
        font-weight: 500;
        padding: 5px 20px;
        border: none;
        outline: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    .conBtn:hover {
        background: #ae101d
    }

    @media (max-width: 1220px) {

        .cate_sel,
        .course_sel,
        .year_sel,
        .month_sel,
        .examCode_sel {
            width: 80% !important;
        }
    }
</style>
@include('success')
<form action="{{ route('filter_exam') }}" method="GET">
    <div style="display: flex !important;align-items: center;justify-content: center; flex-wrap: wrap !important;gap: 25px !important;">
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

{{-- <table class="table">
    @foreach ($exam_items as $item)
    <tr>
        <td class="px-5">
            <div style="font-size: 19px; color:black;font-weight: bold;" type="button" class="btn btn-primary wallet_btn" data-bs-toggle="modal" data-bs-target="#modalCenter">
                {{date('M', ($item->month - 1)* 31 * 24 * 60 *60)}}
                {{$item->year}}
            </div> 

            <div class="modal show_wallet fade show d-none" id="modalCenter" tabindex="-1" style="display: block;" aria-modal="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Exam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Start Exam ??

                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary close_wallet_btn" data-bs-dismiss="modal">
                        Close
                    </button>
                    <a class="btn btn-success" href="{{route('exam_page', ['id' => $item->id])}}">
                        Start
                    </a>
                    </div>
                </div>
                </div>
            </div>
        </td>
    </tr>
    @endforeach
</table> --}}
<div class="col-12 d-flex align-items-center justify-content-center">
    <table class="table col-11  mt-2">
        <thead>
            <tr>
                <th class="col-2" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                    scope="col">Exam
                </th>
                <th class="col-2" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                    scope="col">Course</th>
                <th class="col-2" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                    scope="col">Code</th>
                <th class="col-2" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                    scope="col">Year</th>
                <th class="col-2" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                    scope="col">Month</th>
                <th class="col-2" style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                    scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($exam_items as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->course->course_name }}</td>
                    <td>{{ @$item->code->exam_code }}</td>
                    <td>{{ $item->year }}</td>
                    <td>{{ $item->month }}</td>
                    <td>
                        <div type="button" class="conBtn wallet_btn text-center" data-bs-toggle="modal"
                            data-bs-target="#modalCenter">
                            Start
                        </div>

                        <div class="modal show_wallet fade show d-none" id="modalCenter" tabindex="-1"
                            style="display: block;" aria-modal="true" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalCenterTitle">Exam</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Start Exam ??

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-label-secondary close_wallet_btn"
                                            data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <a class="btn btn-success"
                                            href="{{ route('exam_page', ['id' => $item->id]) }}">
                                            Start
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
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

<script>
    let wallet_btn = document.querySelectorAll('.wallet_btn');
    let show_wallet = document.querySelectorAll('.show_wallet');
    let btn_close = document.querySelectorAll('.btn-close');
    let close_wallet_btn = document.querySelectorAll('.close_wallet_btn');

    for (let i = 0, end = wallet_btn.length; i < end; i++) {
        wallet_btn[i].addEventListener('click', (e) => {
            for (let j = 0; j < end; j++) {
                if (e.target == wallet_btn[j]) {
                    show_wallet[j].classList.remove('d-none');
                }
            }
        })
        btn_close[i].addEventListener('click', (e) => {
            for (let j = 0; j < end; j++) {
                if (e.target == show_wallet[j]) {
                    show_wallet[j].classList.add('d-none');
                }
            }
        })
        close_wallet_btn[i].addEventListener('click', (e) => {
            for (let j = 0; j < end; j++) {
                if (e.target == close_wallet_btn[j]) {
                    show_wallet[j].classList.add('d-none');
                }
            }
        })
    }
</script>

@include('Visitor.inc.footer')
