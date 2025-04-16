@include('Visitor.inc.header')
@include('Visitor.inc.menu')
@include('success')
<style>
    .table td {
        padding: .50rem;
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

    .footerCardd {
        display: flex;
        flex-direction: column;
        row-gap: 20px;
    }

    .secApplayCoupone {
        background: #fff;
        width: 100%;
        height: 55px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        column-gap: 5px;
        border-radius: 10px;
        border: 2px solid #CF202F;
        overflow: hidden;
    }

    .secApplayCoupone img {
        width: 10% !important;
    }

    .secApplayCoupone input {
        width: 50% !important;
        height: 100%;
        border: none;
        padding: 20px;
        outline: none;
    }

    .secApplayCoupone button {
        width: 35% !important;
        height: 100%;
        font-size: 1.2rem;
        font-weight: 600;
        border: none;
        outline: none;
        background: #FDF4F5;
        padding: 10px;
        color: #CF202F;
        cursor: pointer;
    }

    .UpdateCard {
        background: #fff;
        color: #CF202F;
        font-size: 1.5rem;
        font-weight: 600;
        width: 100%;
        height: 55px;
        border: none;
        outline: none;
        border-radius: 10px;
        border: 3px solid #CF202F;
        cursor: pointer;
    }

    .sideTotal {
        padding: 15px;
        background: #FDF4F5;
        text-align: center;
        border-radius: 15px;
    }

    .btnCheckout {
        background: #CF202F;
        color: #fff;
        font-size: 1.5rem;
        font-weight: 600;
        padding: 12px 0;
        border-radius: 10px;
        width: 100%;
        border: none;
        outline: none;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    .btnCheckout:hover {
        background: #fff;
        color: #CF202F;
        border: 3px solid #CF202F;

    }
</style>
<div class="wrapper">
    <div class="preloader"></div>


    <!-- Main Header Nav For Mobile -->
    @include('Visitor.inc.mobile_menu')



    <!-- Shop Checkouts Content -->
    <section class="shop-checkouts">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8 col-xl-8">
                    <div>
                        <form action="#">
                            <table class="table col-12  mt-2">
                                <thead>
                                    <tr>
                                        <th class="col-4"
                                            style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                            scope="col">Chapters</th>
                                        <th class="col-3"
                                            style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                            scope="col">Duration</th>
                                        <th class="col-2"
                                            style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                            scope="col">Price</th>
                                        <th class="col-3"
                                            style="border-top: none !important; color: #CF202F;font-size: 1.1rem; "
                                            scope="col">Action</th>

                                        <input type="hidden" class="course_price" />
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($chapters as $chapter)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">

                                                <img width="132px" height="96px" style="border-radius: 10px"
                                                    src="{{ asset('images/Chapters/' . $chapter->ch_url) }}" />
                                                <span class="ml-3">
                                                    {{ $chapter->chapter_name }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>

                                            <select name="chapter_duration" class="form-control chapter_duration mx-2"
                                                style="width: 80%; margin-top: 20px; font-size: 1.1rem; border: none;border-bottom: 3px solid red;border-radius: 0;color: #B8B8B8;">
                                                @php
                                                $min = $chapter->price[0];
                                                foreach ($chapter->price as $item) {
                                                if ($item->duration < $min->duration) {
                                                    $min = $item;
                                                    }
                                                    }
                                                    @endphp
                                                    <option value="{{ $min->id }}">
                                                        {{ $min->duration }} Days
                                                    </option>
                                                    @foreach ($chapter->price as $item)
                                                    @if ( $min->id == $item->id )
                                                    <option selected value="{{ $item->id }}">
                                                        {{ $item->duration }} Days
                                                    </option>
                                                    @else
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->duration }} Days
                                                    </option>
                                                    @endif
                                                    @endforeach
                                            </select>
                                        </td>
                                        <input type="hidden" class="chapters_price"
                                            value="{{ json_encode($chapter->price) }}" />
                                        <input type="hidden" class="ch_price" name="ch_price[]"
                                            value="{{ $chapter->ch_price ?? 0 }}" />
                                        <input type="hidden" class="ch_price_discount" name="ch_price_discount[]" />
                                        <input type="hidden" class="chapter_data" name="chapter[]"
                                            value="{{ json_encode($chapter) }}" />
                                        <td class="tbl_chapter_price">
                                            <span class="d-flex align-items-center"
                                                style="margin-top: 35px !important;">

                                                ${{ $chapter->ch_price ?? 0 }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('remove_course_package', ['id' => $chapter->id]) }}"
                                                class="btn btn-danger" style="margin-top: 30px !important;">
                                                Remove
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </form>
                    </div>
                    <div style="margin-top: 3rem;">
                        <div>
                            <h3 style="margin-bottom: 2rem !important; color: #6D6D6D">Do you have a discount code?</h3>
                            <form method="POST" action="{{ route('use_promocode') }}" class="form-inline">
                                @csrf
                                {{-- <input name="promo_code" class="form-control" type="search"
                                    placeholder="Coupon Code" aria-label="Search">
                                <button class="btn btn2">Apply Coupon</button>
                                <button type="button" class="btn btn3">Update Cart</button> --}}

                                <div class="footerCardd">
                                    {{-- <div class="secApplayCoupone">
                                        <img src="{{ asset('images/payment/DiscountIcon.svg') }}" alt="">

                                        <input name="promo_code" class="form-control" type="search"
                                            placeholder="Coupon Code" aria-label="Search">
                                        <button class="btn btn2">Apply Coupon</button>
                                        <button type="button" class="btn btn3">Update Cart</button>
                                    </div> --}}


                                    <div class="footerCardd">
                                        <div class="secApplayCoupone">
                                            <img src="{{ asset('images/iconPayment/DiscountIcon.svg') }}" alt="">
                                            <input type="search" class="ponIn" name="promo_code"
                                                placeholder="Discount Code" aria-label="Search">
                                            <button class="applyBtn">Apply</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-4">
                <div class="sideTotal mb30">
                    <h3 style="color: #CF202F">Cart Totals</h3>
                    <ul>
                        <li>
                            <p
                                style="display: flex;align-items: center;justify-content: space-between;font-size: 1.5rem;font-weight: 600;">
                                Total <span class="float-right totals color-orose total_price">
                                    @if (isset($chapter_discount) && $chapter_discount != null && $chapter_discount !=
                                    0)
                                    <del style="margin-right: 10px;color: #787878 !important">
                                        ${{ $chapters_price }} </del>
                                    <span class="text-success ch_total_discount" style="color: #CF202F !important">
                                        ${{ $chapter_discount }}
                                    </span>
                                    @else
                                    <span class="text-success ch_total_discount" style="color: #CF202F !important">
                                        ${{ $chapters_price }}
                                    </span>
                                    @endif
                                </span></p>
                        </li>
                    </ul>
                </div>
                <form method="GET" action="{{ route('check_out') }}">
                    @csrf
                    @if (isset($chapter_discount) && $chapter_discount != null && $chapter_discount != 0)
                    <input type="hidden" class="chapters_pricing" name="chapters_pricing"
                        value="{{ $chapter_discount }}" />
                    @else
                    <input type="hidden" class="chapters_pricing" name="chapters_pricing"
                        value="{{ $chapters_price }}" />
                    @endif
                    <button class="btnCheckout">Proceed To Checkout</button>
                </form>
            </div>
        </div>
    </section>

    <input type="hidden" class="price_arr" value="{{ json_encode(@$price_arr) }}" />
    <a class="scrollToHome" href="#"><i class="flaticon-up-arrow-1"></i></a>
</div>


<script>
    // let chapter_duration = document.querySelectorAll('.chapter_duration');
    // let chapters_price = document.querySelectorAll('.chapters_price');
    // let tbl_chapter_price = document.querySelectorAll('.tbl_chapter_price');
    // let ch_price = document.querySelectorAll('.ch_price');
    // let total_price = document.querySelector('.total_price');
    // let course_price = document.querySelector('.course_price');

    // for (let i = 0, end = chapter_duration.length; i < end; i++) {
    //     chapter_duration[i].addEventListener('change', (e) => {
    //         for (let j = 0; j < end; j++) {
    //             if (e.target == chapter_duration[j]) {
    //                 let money = chapters_price[j];
    //                 let discount = 0;
    //                 money = money.value;
    //                 money = JSON.parse(money);
    //                 money.forEach(element => {
    //                     if (element.id == chapter_duration[j].value) {
    //                         discount = element.discount;
    //                         money = element.price;
    //                     }
    //                 });
    //                 if (discount != 0 && discount != null) {
    //                     let total = money - (money * discount / 100);
    //                     tbl_chapter_price[j].innerHTML = `
	// 					<del>${money}$</del>
	// 					<span class="text-success">
	// 						${total}$
	// 					</span>
	// 					`;
    //                     course_price.value = total;
    //                     total_price.innerHTML = `
	// 					<del>${money}$</del>
	// 					<span>
	// 						${total}$
	// 					</span>`;
    //                     ch_price[j].value = total;
    //                 } else {
    //                     tbl_chapter_price[j].innerHTML = `
	// 					${money}$
	// 					`;
    //                     course_price.value = money;
    //                     total_price.innerHTML = `${money}$`;
    //                     ch_price[j].value = money;
    //                 }
    //             }
    //         }
    //     })
    // }


let chapter_duration = document.querySelectorAll('.chapter_duration');
let chapters_price = document.querySelectorAll('.chapters_price');
let tbl_chapter_price = document.querySelectorAll('.tbl_chapter_price');
let ch_price = document.querySelectorAll('.ch_price');
let total_price = document.querySelector('.total_price');
let course_price = document.querySelector('.course_price');

// Function to save data to local storage
function saveToLocalStorage(data) {
    localStorage.setItem('chapterDetails', JSON.stringify(data));
}

// Function to load data from local storage
function loadFromLocalStorage() {
    let storedData = localStorage.getItem('chapterDetails');
    return storedData ? JSON.parse(storedData) : [];
}

// Array to store course details
let chapterDetails = loadFromLocalStorage();

function calculateTotalPrice() {
    let totalDiscountedPrice = 0;
    let totalOriginalPrice = 0;

    for (let i = 0; i < chapter_duration.length; i++) {
        let chapterName = JSON.parse(document.querySelectorAll('.chapter_data')[i].value).chapter_name;
        let money = JSON.parse(chapters_price[i].value);
        let discount = 0;
        let selectedDuration = chapter_duration[i].options[chapter_duration[i].selectedIndex].text;

        money.forEach(element => {
            if (element.id == chapter_duration[i].value) {
                discount = element.discount;
                money = element.price;
            }
        });

        let finalPrice = money;
        if (discount != 0 && discount != null) {
            finalPrice = money - (money * discount / 100);
        }

        totalDiscountedPrice += finalPrice;
        totalOriginalPrice += money;

        // Update individual chapter price display
        tbl_chapter_price[i].innerHTML = discount != 0 ? `
            <del>${money}$</del>
            <span class="text-success">${finalPrice.toFixed(2)}$</span>
        ` : `${money.toFixed(2)}$`;

        // Update hidden inputs with final prices
        ch_price[i].value = finalPrice.toFixed(2);

        // Store each chapter's details in the chapterDetails array
        chapterDetails[i] = {
            chapterName: chapterName,
            duration: selectedDuration,
            price: money,
            discount: discount,
            finalPrice: finalPrice.toFixed(2)
        };
    }

    // Round the total prices to the nearest two decimal places
    totalDiscountedPrice = totalDiscountedPrice.toFixed(2);
    totalOriginalPrice = totalOriginalPrice;

    // Update the total price display
    if (totalOriginalPrice !== totalDiscountedPrice) {
        total_price.innerHTML = `
            <del>${totalOriginalPrice}$</del>
            <span>${totalDiscountedPrice}$</span>
        `;
    } else {
        total_price.innerHTML = `${totalOriginalPrice}$`;
    }

    course_price.value = totalDiscountedPrice; // Store the total discounted price in course_price

    // // Store the total prices and discount in the chapterDetails array
    // chapterDetails.totalOriginalPrice = totalOriginalPrice;
    // chapterDetails.totalDiscountedPrice = totalDiscountedPrice;


// Store total prices as separate properties
localStorage.setItem('ChaptersTotalOriginalPrice', totalOriginalPrice);
localStorage.setItem('ChaptersTotalDiscountedPrice', totalDiscountedPrice);

    // Save the updated chapterDetails to local storage
    saveToLocalStorage(chapterDetails);

    console.log("chapterDetails",chapterDetails); // For debugging purposes
}

// Attach event listeners to all chapter_duration dropdowns
for (let i = 0; i < chapter_duration.length; i++) {
    chapter_duration[i].addEventListener('change', calculateTotalPrice);
}
// Initial calculation on page load
calculateTotalPrice();

</script>
@include('Visitor.inc.footer')