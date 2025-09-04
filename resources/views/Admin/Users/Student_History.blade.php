
@php
    function fun_admin()
    {
        return 'admin';
    }
@endphp
<x-default-layout> 
    @section('title', 'Student History')
    <div class="container my-4">

    <!-- إجمالي المدفوعات -->
    <div class="card shadow-sm mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">💰 Total Payment</h5>
            <h4 class="text-success fw-bold mb-0">{{$total_payment}}</h4>
        </div>
    </div>

    <!-- زرار Chapters -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h4 class="mb-0">📚 Chapters</h4>
        <button class="btn btn-outline-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#chaptersCollapse" aria-expanded="false">
            Show/Hide
        </button>
    </div>

    <div class="collapse" id="chaptersCollapse">
        <div class="row g-4 animate__animated animate__fadeIn">
            @foreach ($chapters as $item)
                <div class="col-sm-6 col-xl-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <span class="text-muted small">Chapter Name</span>
                                <h5 class="fw-bold mt-2">{{$item['chapter_name']}}</h5>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-primary rounded-pill px-3 py-2">
                                    <i class="bx bx-book-open bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- زرار Packages -->
    <div class="d-flex justify-content-between align-items-center mt-5 mb-2">
        <h4 class="mb-0">🎁 Packages</h4>
        <button class="btn btn-outline-success btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#packagesCollapse" aria-expanded="false">
            Show/Hide
        </button>
    </div>

    <div class="collapse" id="packagesCollapse">
        <div class="row g-4 animate__animated animate__fadeIn">
            @foreach ($packages as $item)
                <div class="col-sm-6 col-xl-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <span class="text-muted small">Package Name</span>
                                <h5 class="fw-bold mt-2">{{$item['package']}}</h5>

                                <span class="text-muted small d-block mt-3">Count</span>
                                <h5 class="fw-bold text-info">{{$item['count_package']}}</h5>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-success rounded-pill px-3 py-2">
                                    <i class="bx bx-package bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

<!-- لو عاوز Animation أنعم استعمل Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

        

</x-default-layout>