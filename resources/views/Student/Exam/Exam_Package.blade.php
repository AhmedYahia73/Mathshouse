@php
$page_name = 'Exam';
@endphp
@section('title', 'Packages')
@include('Student.inc.header')
@include('Student.inc.menu')
@extends('Student.inc.nav')

@section('page_content')
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
<link href="
https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css
" rel="stylesheet">

<!-- Link to the file hosted on your server, -->
<link rel="stylesheet" href="path-to-the-file/splide.min.css">


<!-- or link to the CDN -->
<link rel="stylesheet" href="url-to-cdn/splide.min.css">
<style>
    .texRed {
        color: #CF202F;
        margin-bottom: 0 !important;
    }

    .allPackages {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: flex-start;
        gap: 20px;
    }

    .package {
        width: calc(100% / 3.3);
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        /* background: red; */
        border-radius: 15px;
        padding: 15px;
        box-shadow: 0px 0px 15px -3px rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }

    .package>span {
        color: #6D6D6D;
        font-size: 1.3rem;
        font-weight: 600
    }
</style>

<div class="d-flex justify-content-center align-items-center my-3">
    <input type="hidden" class="{{$currency}}" />
    <select name="category_id" style="width: 300px" class="form-control mx-2" id="selectedCurrency">
        <option disabled selected>Select Currency ...</option>
        @foreach ($currency as $item)
        <option value="{{$item->id}}" data-amount="{{$item->amount}}">
            {{$item->currency}}
        </option>
        @endforeach
    </select>
</div>

<form action="{{route('filter_package')}}" method="get">
    <div class="d-flex justify-content-center align-items-center my-3">
        <select name="category_id" style="width: 300px" class="form-control mx-2 selCategory">
            <option disabled selected>
                Select Category ...
            </option>
            @foreach ($categories as $item)
            @if ( @$data['category_id'] == $item->id)
            <option selected value="{{$item->id}}">{{$item->cate_name}}</option>
            @else
            <option value="{{$item->id}}">{{$item->cate_name}}</option>
            @endif
            @endforeach
        </select>
        <select name="course_id" style="width: 300px" class="form-control mx-2 selCourse">
            <option disabled selected>
                Select Course ...
            </option>
            @foreach ($courses as $item)
            @if ( @$data['course_id'] == $item->id)
            <option selected value="{{$item->id}}">{{$item->course_name}}</option>
            @else
            <option value="{{$item->id}}">{{$item->course_name}}</option>
            @endif
            @endforeach
        </select>
        <input type="hidden" name="module" value="{{$module}}" />
        <button class="btn btn-danger">Filter</button>
    </div>
</form>

<input type="hidden" class="courses_data" value="{{$courses}}" />
<div class="col-12 d-flex align-items-center justify-content-center">
    <h3 class="texRed mt-3">
        Package Details
    </h3>
</div>
<div class="col-12 allPackages">
    @foreach ($package as $item)
    <a href="{{ route('package_checkout', ['id' => $item->id]) }}" class="package" data-id="{{ $item->id }}">
        <h3 class="packName texRed">{{ $item->name }}</h3>
        <span class="packDuration">Duration: {{ $item->duration }} days</span>
        <!-- Store original price in data-original-price -->
        <span class="packPrice" data-original-price="{{ $item->price }}">price: {{ $item->price }}$ </span>
        {{-- <span class="packPrice">price: {{ $item->price }}$ </span> --}}
        <span class="packNum">Number: {{ $item->number }}</span>
    </a>
    @endforeach
</div>

<script>
    let selCategory = document.querySelector('.selCategory');
        let selCourse = document.querySelector('.selCourse');
        let courses_data = document.querySelector('.courses_data');
        console.log(courses_data);

        courses_data = courses_data.value;
        courses_data = JSON.parse(courses_data);

        selCategory.addEventListener('change', (e) => {
            if (e.target == selCategory) {
                selCourse.innerHTML = '<option disabled selected>Select Course ...</option>';
                courses_data.forEach(element => {
                    if (selCategory.value == element.category_id) {
                        selCourse.innerHTML += `
                        <option value="${element.id}">
                            ${element.course_name}
                        </option>`;
                    }
                });
            }
        })
</script>

<script>
    // Listen for changes in the currency dropdown
        document.getElementById('selectedCurrency').addEventListener('change', function () {
            // Get the selected currency's amount (exchange rate)
            const selectedOption = this.options[this.selectedIndex];
            const currencyAmount = selectedOption.getAttribute('data-amount');  // The exchange rate
            const currencySymbol = selectedOption.text;  // The selected currency symbol

            // Get all package elements
            const packageElements = document.querySelectorAll('.allPackages .package');

            // Loop through each package and update the price only once
            packageElements.forEach(packageElement => {
                // Get the original price from the data-original-price attribute
                const originalPrice = parseFloat(packageElement.querySelector('.packPrice').getAttribute('data-original-price'));

                // Multiply the original price by the currency amount (exchange rate)
                const newPrice = (originalPrice * currencyAmount).toFixed(2);  // Keep 2 decimal places

                // Update the price displayed on the package element
                packageElement.querySelector('.packPrice').textContent = `price: ${newPrice} ${currencySymbol}`;
            });
        });
</script>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
            // Get all the package elements
            const packageElements = document.querySelectorAll('.allPackages .package');

            // Create an array to store the package details
            const packages = Array.from(packageElements).map(packageElement => {
                return {
                    id: packageElement.getAttribute('data-id'),
                    name: packageElement.querySelector('.packName')?.textContent.trim() || 'N/A',
                    duration: packageElement.querySelector('.packDuration')?.textContent.replace('Duration: ', '').trim() || 'N/A',
                    price: packageElement.querySelector('.packPrice')?.textContent.replace('price: ', '').replace('$', '').trim() || '0',
                    number: packageElement.querySelector('.packNum')?.textContent.replace('Number: ', '').trim() || 'N/A'
                };
            });

            // Store the packages array in localStorage
            localStorage.setItem('packages', JSON.stringify(packages));
            console.log(packages);  // Log to console for debugging
        });
</script>

@include('Student.inc.footer')