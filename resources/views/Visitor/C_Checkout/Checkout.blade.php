@include('Visitor.inc.header')
@include('Visitor.inc.menu')
<style>
    span,
    .col-12,
    .col-8,
    .col-6 {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }

    h3 {
        margin-bottom: 0 !important;
    }

    .leftCheckout span,
    .rightCheckout span {
        font-size: 1.3rem;
        font-weight: 600;
        color: #727272;
    }

    .btnCheckout {
        background: #CF202F;
        color: #fff;
        font-size: 1.5rem;
        font-weight: 500;
        padding: 10px 30px;
        border: none;
        outline: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    .btnCheckout:hover {
        background: #ae101d
    }

    #selImg {
        /* width: 30% !important;
        background: #FDF4F5;
        color: #fff;
        padding: 10px 30px;
        border-radius: 10px;
        cursor: pointer; */
        background: #CF202F;
        color: #fff;
        font-size: 1.5rem;
        font-weight: 500;
        padding: 10px 30px;
        border: none;
        outline: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    .#selImg:hover {
        background: #ae101d
    }

    .phoneNum {
        width: 80% !important;
        border: none;
        outline: none;
        border-bottom: 4px solid #CF202F;
        color: #727272;
        font-size: 1.2rem;
        font-weight: 600;
        padding: 10px 0;
    }

    /* Radio package */
    .radio-buttons-container {
        display: flex;
        align-items: center;
        gap: 24px;
    }

    .radio-button {
        display: inline-block;
        position: relative;
        cursor: pointer;
    }

    .radio-button__input {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .radio-button__label {
        display: inline-block;
        padding-left: 30px;
        margin-bottom: 10px;
        position: relative;
        font-size: 1.3rem;
        font-weight: 600;
        color: #727272;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
    }

    .radio-button__custom {
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        width: 22px;
        height: 22px;
        border-radius: 50%;
        border: 2px solid #555;
        transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
    }

    .radio-button__input:checked+.radio-button__label .radio-button__custom {
        transform: translateY(-50%) scale(0.9);
        border: 5px solid #CF202F;
        color: #CF202F;
    }

    .radio-button__input:checked+.radio-button__label {
        color: #CF202F;
    }

    .radio-button__label:hover .radio-button__custom {
        transform: translateY(-50%) scale(1.2);
        border-color: #CF202F;
        box-shadow: 0 0 10px #CF202F;
    }

    /* Check Wallet */
    /* Hide the default checkbox */
    .containerCheck input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    .containerCheck {
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        cursor: pointer;
        font-size: 20px;
        user-select: none;
        border-radius: 50%;
        background-color: white;
        border: 4px solid #CF202F;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: relative;
        top: 0;
        left: 0;
        height: 1.3em;
        width: 1.3em;
        transition: .3s;
        transform: scale(0);
        border-radius: 50%;
    }

    /* When the checkbox is checked, add a blue background */
    .containerCheck input:checked~.checkmark {
        background-color: #CF202F;
        transform: scale(1);
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .containerCheck input:checked~.checkmark:after {
        display: block;
    }

    .containerCheck input:checked~.celebrate {
        display: block;
    }

    /* Style the checkmark/indicator */
    .containerCheck .checkmark:after {
        left: 0.45em;
        top: 0.25em;
        width: 0.40em;
        height: 0.7em;
        border: solid white;
        border-width: 0 0.15em 0.15em 0;
        transform: rotate(45deg);
    }

    .containerCheck .celebrate {
        position: absolute;
        transform-origin: center;
        animation: kfr-celebrate .4s;
        animation-fill-mode: forwards;
        display: none;
        stroke: #CF202F;
    }

    @keyframes kfr-celebrate {
        0% {
            transform: scale(0);
        }

        50% {
            opacity: 1;
        }

        100% {
            transform: scale(1.2);
            opacity: 0;
            display: none;
        }
    }

    .secDescription {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        row-gap: 20px;
    }

    .secDescription>h3 {
        color: #CF202F;
    }

    .secDescription>p {
        color: #B9B9B9;
        font-weight: 600;
    }

    /* Default flex direction (row) */
    .flex-container {
        display: flex;
        flex-direction: row;
        column-gap: 1rem;
    }

    /* Media query for screens with a minimum width of 600px */
    @media (max-width: 600px) {
        .flex-container {
            flex-direction: column;
        }
    }
</style>
<div class="wrapper">
    <div class="preloader"></div>
    @include('success')
    <!-- Shop Checkouts Content -->
    {{-- <section class="shop-checkouts">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 col-xl-8">
                </div>
                <div class="col-lg-4 col-xl-4">
                    <div class="order_sidebar_widget mb30">
                        <h4 class="title">Your Order</h4>
                        <ul>
                            <li class="subtitle">
                                <p>Product <span class="float-right">Total</span></p>
                            </li>

                            <li>
                                <p>{{ $course->course_name }} <span class="float-right">{{ $price }}</span></p>
                            </li>

                            <li class="subtitle">
                                <p>Subtotal <span class="float-right">Subtotal</span></p>
                            </li>
                            <li class="subtitle">
                                <p>Total <span class="float-right totals color-orose">${{ $price }}</span></p>
                            </li>
                        </ul>
                    </div>
                    <form action="{{ route('course_payment_money') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="payment_widget">
                            <div class="ui_kit_checkbox style2">
                                @foreach ($payment_methods as $item)
                                <div class="custom-control custom-checkbox my-3">
                                    <input type="radio" name="payment_method_id" value="{{ $item->id }}"
                                        class="custom-control-input payment_method_radio"
                                        id="customCheck80{{ $item->id }}" checked />
                                    <label class="custom-control-label" for="customCheck80{{ $item->id }}">{{
                                        $item->payment }}
                                        <img style="height:50px; width:70px;"
                                            src="{{ asset('images/payment/' . $item->logo) }}" class="pr15" />
                                    </label>

                                </div>

                                <input type="file" id="reset_img{{ $item->id }}" name="image[]"
                                    class="form-control d-none" />
                                <label class="upload_img d-none" style="cursor: pointer;" for="reset_img">
                                    <div class="bt_details">
                                        <p>
                                            {{ $item->description }}
                                        </p>
                                    </div>
                                    <label for="reset_img{{ $item->id }}" class="btn btn-info">
                                        <i class="fa-solid fa-upload mr-2"></i>
                                        Upload Reseipt
                                    </label>
                                </label>
                                @endforeach
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" name="payment_method_id" value="Wallet"
                                        class="custom-control-input payment_method_radio" id="customCheck80" checked />
                                    <label class="custom-control-label" for="customCheck80">
                                        <h3>
                                            Using Wallet
                                        </h3>
                                    </label>

                                </div>
                                <script>
                                    let payment_method_radio = document.querySelectorAll('.payment_method_radio');
                                    let upload_img = document.querySelectorAll('.upload_img');
                                    upload_img[upload_img.length - 1].classList.remove('d-none');
                                    for (let i = 0, end = payment_method_radio.length; i < end; i++) {
                                        payment_method_radio[i].addEventListener('change', (e) => {
                                            for (let j = 0; j < end; j++) {
                                                if (e.target == payment_method_radio[j]) {
                                                    upload_img[j].classList.remove('d-none');
                                                } else {
                                                    upload_img[j].classList.add('d-none');
                                                }
                                            }
                                        })
                                    }
                                </script>
                            </div>
                        </div>
                        <div class="ui_kit_button payment_widget_btn">
                            <button class="btn dbxshad btn-lg btn-thm3 circle btn-block">Place Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section> --}}


    <section>

        <!-- Pop-up Modal (Hidden by Default) -->
        <form class="col-12 d-flex flex-column justify-content-center align-items-center" style="row-gap: 3rem"
            action="{{ route('course_payment_money') }}" method="POST" enctype="multipart/form-data" id="orderForm">
            @csrf
            <div class="col-9 d-flex align-items-center justify-content-center">
                <h1 style="color: #CF202F">Check Out</h1>
            </div>
            {{-- Order && Payment --}}
            <div class="col-9 d-flex align-items-start justify-content-start" style="column-gap: 1rem">
                {{-- Left Section --}}
                <div class="leftCheckout col-6 d-flex flex-column align-items-start justify-content-start"
                    style="row-gap: 1rem">
                    <h3 style="color: #CF202F">Your Order:</h3>
                    <div class="col-12 d-flex align-items-start justify-content-start" style="column-gap: 10px;">
                        <span class="text-align-center">Product:</span>
                        <span class=" text-align-center">{{ $course->course_name }}</span>
                    </div>
                    <div class="col-12 d-flex align-items-start justify-content-start" style="column-gap: 10px;">
                        <span class="text-align-center">Subtotal:</span>
                        <span class=" text-align-center" id=subtotal>${{ $price }}</span>
                    </div>
                    <div class="col-12 d-flex align-items-start justify-content-start" style="column-gap: 10px;">
                        <span class="text-align-center" style="color: #CF202F">Total:</span>
                        <span class=" text-align-center" id=discountPrice>${{ $price }}</span>
                    </div>
                </div>
                {{-- Right Section --}}
                <div class="rightCheckout col-6 d-flex flex-column align-items-start justify-content-start"
                    style="row-gap: 1rem">
                    <h3 style="color: #CF202F">Choose Payment Methods:</h3>

                    @foreach ($payment_methods as $item)
                    {{-- <div class="custom-control custom-checkbox my-3">
                        <input type="radio" name="payment_method_id" value="{{ $item->id }}"
                            class="custom-control-input payment_method_radio" id="customCheck80{{ $item->id }}"
                            checked />
                        <label class="custom-control-label" for="customCheck80{{ $item->id }}">{{ $item->payment }}
                            <img style="height:50px; width:70px;" src="{{ asset('images/payment/' . $item->logo) }}"
                                class="pr15" />
                        </label>
                    </div>--}}

                    {{-- <input type="file" id="reset_img{{ $item->id }}" name="image[]" class="form-control d-none" />
                    <label class="upload_img d-none" style="cursor: pointer;" for="reset_img">
                        <div class="bt_details">
                            <p>
                                {{ $item->description }}
                            </p>
                        </div>
                        <label for="reset_img{{ $item->id }}" class="btn btn-info">
                            <i class="fa-solid fa-upload mr-2"></i>
                            Upload Reseipt
                        </label>
                    </label> --}}


                    <div class="radio-button">
                        <input value="{{ $item->id }}" name="payment_method_id" id="radio{{ $item->id }}"
                            class="radio-button__input payment_method_radio" type="radio">

                        @if ($item->payment == 'Instapay')
                        <label for="radio{{ $item->id }}" class="radio-button__label">
                            <div class="">
                                <img width="30px" src="{{ asset('images/payment/' . $item->logo) }}" alt="">
                                <span class="radio-button__custom"></span>
                                <a class="btn btn-danger" target="_blank" href="{{ $item->description }}">
                                    {{ $item->payment }}
                                </a>
                            </div>
                        </label>
                        @else
                        <label for="radio{{ $item->id }}" class="radio-button__label">
                            <div class="">
                                <img width="30px" src="{{ asset('images/payment/' . $item->logo) }}" alt="">
                                <span class="radio-button__custom"></span>
                                {{ $item->payment }}
                            </div>
                        </label>
                        @endif
                        <div class="col-6 secDescription d-none" data-method-id="{{ $item->id }}">
                            <h3>Description {{ $item->payment }}:</h3>
                            <p class="desPay">{{ $item->description }}</p>
                        </div>
                    </div>
                    @endforeach


                    {{-- Using Wallet --}}
                    <div class="radio-button d-flex align-items-center justify-content-start"
                        style="column-gap: 0.6rem">
                        <label class="containerCheck">
                            {{-- <input type="checkbox" checked="checked"> --}}
                            <input type="checkbox" class="walletRadio" name="payment_method_id" value="Wallet">
                            <div class="checkmark"></div>
                        </label>
                        <h3 style="color: #727272;font-weight: 700">Using Wallet</h3>
                    </div>

                </div>
            </div>

            {{-- Receipt && Phone --}}
            <div class="col-9 d-none upload_receipt align-items-start justify-content-start upload_receipt flex-container"
                style="column-gap: 1rem">
                <div id="selImg" class="d-flex align-items-center justify-content-center"
                    style="height: 70px; column-gap: 0.3rem">
                    <h3 style="color: #fff;font-weight: 700">Upload Receipt</h3>
                    <img width="35px" src="{{ asset('images/payment/UploadIcon.svg') }}" alt="">
                </div>
                <input type="file" style="visibility: hidden;width: 2px;" id="img" name="image" accept="image/*">
                <!-- <div class="col-6 secDescription d-none">
                    <h3>Description:</h3>
                    <p class="desPay"></p>
                </div> -->

                <div class="d-flex align-items-center justify-content-start"
                    style="column-gap: 0.6rem ;padding: 10px; background-color: #f8f9fa;border-radius: 5px;">
                    <h3 id="fileUrl" class="desPay"></h3>
                </div>
            </div>
            {{-- Footer Check Out --}}
            <div class="col-9 d-flex align-items-center justify-content-start">
                <button class="btnCheckout" id="placeOrderBtn">Place Order</button>
            </div>
        </form>

        <!-- Modal Structure -->
        <div id="orderModal" class="modal fade" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderModalLabel">Order Review</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        This process is under review and will be completed within 24 hours.
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="confirmBtn" class="btn btn-primary">OK</button>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <a class="scrollToHome" href="#"><i class="flaticon-up-arrow-1"></i></a>
</div>
<!-- <script>
    let payment_method_radio = document.querySelectorAll('.payment_method_radio');
    let walletRadio = document.querySelector('.walletRadio');
    let upload_receipt = document.querySelector('.upload_receipt');

    for (let i = 0, end = payment_method_radio.length; i < end; i++) {
        payment_method_radio[i].addEventListener('change', ( e ) => {
            for (let j = 0; j < end; j++) {
                if ( e.target.value == payment_method_radio[j].value ) {
                    upload_receipt.classList.remove('d-none');
                    upload_receipt.classList.add('d-flex');
                }
            }
        });
    }

    walletRadio.addEventListener('change', () => {
        upload_receipt.classList.add('d-none');
        upload_receipt.classList.remove('d-flex');
    });

    $(document).ready(function() {
        /* radio-button__input */
        console.log("first")
        $("#selImg").click(function() {
            $("#img").click();
        })
        /*$(".radio-button__input").click(function() {
            $.ajax({
                type: "GET",
                url: "{{ route('api_chechout_description') }}",
                data: {
                    id: $(this).val()
                },
                success: function(data) {
                    console.log(data)
                    $(".desPay").text(data.description)
                    if ($(".walletRadio").is(':checked')) {
                        $(".secDescription").addClass("d-none")
                    } else {
                        $(".secDescription").removeClass("d-none")

                    }
                }
            })
        })
        $(".radio-button__input").click(function() {
            $(".radio-button__input").each((val, ele) => {
                if ($(".walletRadio").is(':checked')) {
                    console.log(val)
                    console.log(ele)
                    $(".secDescription").addClass("d-none")
                    $(ele).removeAttr("checked")
                }
            })
        })
        $(".walletRadio").click(function() {
            if ($(this).is(':checked')) {
                $(".radio-button__input").each((val, ele) => {
                    console.log(val)
                    console.log(ele)
                    $(ele).removeAttr("checked")
                    $(".secDescription").addClass("d-none")
                })
            }
        })*/

        $(".radio-button__input").on('change', function() {
        // Get the value of the selected radio button
        var selectedMethodId = $(this).val();

        // Make an AJAX request to get the description
        $.ajax({
            type: "GET",
            url: "{{ route('api_chechout_description') }}",
            data: {
                id: selectedMethodId
            },
            success: function(data) {
                console.log(data);

                // Hide all descriptions
                $(".secDescription").addClass("d-none");

                // Update and show the description for the selected radio button
                $(".secDescription[data-method-id='" + selectedMethodId + "']").removeClass("d-none").find(".desPay").text(data.description);
            }
        });

        // Uncheck walletRadio if any payment method is selected
        $(".walletRadio").prop("checked", false);
    });

    // Event handler for walletRadio change
    $(".walletRadio").on('change', function() {
        if ($(this).is(':checked')) {
            // Uncheck all payment method radio buttons
            $(".radio-button__input").prop("checked", false);

            // Hide all descriptions
            $(".secDescription").addClass("d-none");
        }
    });
    })

// Function to load specific data (totalPrice and chapterDiscount) from local storage
function loadPriceDetails() {
    let storedData = localStorage.getItem('courseDetails');
    if (storedData) {
        let courseDetails = JSON.parse(storedData);

        // Loop through the stored course details
        courseDetails.forEach((detail, index) => {
            if (detail) {
                // Retrieve and display the totalPrice and chapterDiscount
                let storedTotalPrice = detail.totalPrice;
                let storedDiscountedPrice = detail.chapterDiscount;

                // Assuming you want to display these in specific spans or elements
                document.getElementById(`subtotal`).textContent = `$${storedDiscountedPrice}`;
                document.getElementById(`discountPrice`).textContent = `$${storedTotalPrice }`;
            }
        });
    }
}
// Call the function to load and display the totalPrice and chapterDiscount
loadPriceDetails();
</script> -->



<script>
    // Save the selected payment method to local storage when radio buttons are clicked
    document.querySelectorAll('.payment_method_radio').forEach(radio => {
        radio.addEventListener('change', (e) => {
            // Save the payment method name to local storage
            localStorage.setItem('C_selectedPaymentMethod', e.target.nextElementSibling.textContent.trim());
        });
    });

    // Save "Wallet" to local storage when the wallet checkbox is clicked
    document.querySelector('.walletRadio').addEventListener('change', (e) => {
        if (e.target.checked) {
            localStorage.setItem('C_selectedPaymentMethod', 'Wallet');
        } else {
            localStorage.removeItem('C_selectedPaymentMethod'); // Remove if unchecked
        }
    });

    let payment_method_radio = document.querySelectorAll('.payment_method_radio');
    let walletRadio = document.querySelector('.walletRadio');
    let upload_receipt = document.querySelector('.upload_receipt');

    for (let i = 0, end = payment_method_radio.length; i < end; i++) {
        payment_method_radio[i].addEventListener('change', (e) => {
            for (let j = 0; j < end; j++) {
                if (e.target.value == payment_method_radio[j].value) {
                    upload_receipt.classList.remove('d-none');
                    upload_receipt.classList.add('d-flex');
                }
            }
        });
    }

    walletRadio.addEventListener('change', () => {
        upload_receipt.classList.add('d-none');
        upload_receipt.classList.remove('d-flex');
    });

    $(document).ready(function() {
    /* radio-button__input */
        console.log("first")
        // $("#selImg").click(function() {
        //     $("#img").click();
        // })

    // Get the elements
    const selImg = document.getElementById('selImg');
    const imgInput = document.getElementById('img');
    const fileUrl = document.getElementById('fileUrl');

    // Trigger file input click when the div is clicked
    selImg.addEventListener('click', () => {
        imgInput.click();
    });

    // Display file URL and make it clickable when an image is selected
    imgInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            let url = URL.createObjectURL(file);

            // Remove "blob:" from the beginning of the URL
            url = url.replace('blob:', '');

            // Create an anchor tag with the URL and make it clickable
            fileUrl.innerHTML = `<a href="${url}" target="_blank" style="font-size: 18px; font-weight: bold; color: #CF202F; text-decoration: none;">
                                ${url}
                            </a>`;
            fileUrl.style.display = 'block'; // Make the file URL visible
        }
    });

// Get elements
  let placeOrderBtn = document.getElementById('placeOrderBtn');
  let orderModal = new bootstrap.Modal(document.getElementById('orderModal'));
  let confirmBtn = document.getElementById('confirmBtn');
  let orderForm = document.getElementById('orderForm');

  // Show the modal when clicking the Place Order button
//   placeOrderBtn.onclick = function(event) {
//     event.preventDefault(); // Prevent form from submitting immediately
//     orderModal.show(); // Show modal using Bootstrap's modal method
//   }

//   // Proceed with form submission when clicking OK
//   confirmBtn.onclick = function() {
//     orderModal.hide(); // Hide modal using Bootstrap's modal method
//     orderForm.submit(); // Submit the form
//   }

 // Show the modal only if a payment method other than Wallet is selected
 placeOrderBtn.onclick = function(event) {
        event.preventDefault(); // Prevent immediate form submission
        const selectedPaymentMethod = localStorage.getItem('C_selectedPaymentMethod');

        if (selectedPaymentMethod === 'Wallet') {
            // If Wallet is selected, submit the form directly without showing the modal
            orderForm.submit();
        } else {
            // Show the modal for other payment methods
            orderModal.show();
        }
    };

    // Proceed with form submission when clicking OK in the modal
    confirmBtn.onclick = function() {
        orderModal.hide();
        orderForm.submit();
    };



        $(".radio-button__input").on('change', function() {
            var selectedMethodId = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ route('api_chechout_description') }}",
                data: {
                    id: selectedMethodId
                },
                success: function(data) {
                    $(".secDescription").addClass("d-none");
                    $(".secDescription[data-method-id='" + selectedMethodId + "']").removeClass("d-none").find(".desPay").text(data.description);
                }
            });
            $(".walletRadio").prop("checked", false);
        });

        $(".walletRadio").on('change', function() {
            if ($(this).is(':checked')) {
                $(".radio-button__input").prop("checked", false);
                $(".secDescription").addClass("d-none");
            }
        });
    });

</script>
@include('Visitor.inc.footer')