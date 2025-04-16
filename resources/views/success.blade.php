
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />

<!-- Helpers -->
<script src="../assets/vendor/js/helpers.js"></script>
@section('style-header')
{{-- <style>
    div#alert_danger {
        position: absolute;
        z-index: 222222;
        left: 650px;
    }
</style> --}}

@endsection
<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
@if (session()->has('success'))




{{-- <div class="alert alert-solid-success text-center" role="alert">
    {{session()->get('success')}}
</div> --}}

<div class="swal2-container swal2-center swal2-backdrop-show " id="alert_success" style="overflow-y: auto;">
    <div aria-labelledby="swal2-title" aria-describedby="swal2-html-container"
        class="swal2-popup swal2-modal swal2-icon-success swal2-show" tabindex="-1" role="dialog" aria-live="assertive"
        aria-modal="true" style="display: grid;"><button type="button" class="swal2-close"
            aria-label="Close this dialog" style="display: none;">×</button>
        <ul class="swal2-progress-steps" style="display: none;"></ul>
        <div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;">
            <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
            <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>
            <div class="swal2-success-ring"></div>
            <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
            <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
        </div><img class="swal2-image" style="display: none;">
        <h2 class="swal2-title" id="swal2-title" style="display: block;">Success!</h2>
        <div class="swal2-html-container" id="swal2-html-container" style="display: block;">
            {{session()->get('success')}}
        </div><input class="swal2-input" style="display: none;"><input type="file" class="swal2-file"
            style="display: none;">
        <div class="swal2-range" style="display: none;"><input type="range"><output></output></div><select
            class="swal2-select" style="display: none;"></select>
        <div class="swal2-radio" style="display: none;"></div><label for="swal2-checkbox" class="swal2-checkbox"
            style="display: none;"><input type="checkbox"><span class="swal2-label"></span></label><textarea
            class="swal2-textarea" style="display: none;"></textarea>
        <div class="swal2-validation-message" id="swal2-validation-message" style="display: none;"></div>
        <div class="swal2-actions" style="display: flex;">
            <div class="swal2-loader"></div>
            <button type="button" class="swal2-confirm btn btn-primary" id="btn_hidden" aria-label=""
                style="display: inline-block;">OK</button>
            <button type="button" class="swal2-deny" aria-label="" style="display: none;">No</button><button
                type="button" class="swal2-cancel" aria-label="" style="display: none;">Cancel</button>
        </div>
        <div class="swal2-footer" style="display: none;"></div>
        <div class="swal2-timer-progress-bar-container">
            <div class="swal2-timer-progress-bar" style="display: none;"></div>
        </div>
    </div>
</div>
@elseif (session()->has('faild'))

{{-- <div class="alert alert-danger text-center" role="alert-danger">
    {{session()->get('faild')}}
</div> --}}


<div class="swal2-container swal2-center swal2-backdrop-show " id="alert_danger" style="overflow-y: auto;">
    <div aria-labelledby="swal2-title" aria-describedby="swal2-html-container"
        class="swal2-popup swal2-modal swal2-icon-success swal2-show" tabindex="-1" role="dialog" aria-live="assertive"
        aria-modal="true" style="display: grid;"><button type="button" class="swal2-close"
            aria-label="Close this dialog" style="display: none;">×</button>
        <ul class="swal2-progress-steps" style="display: none;"></ul>
        <div class="swal2-icon swal2-error swal2-icon-show" style="display: flex;"><span class="swal2-x-mark">
                <span class="swal2-x-mark-line-left"></span>
                <span class="swal2-x-mark-line-right"></span>
            </span>
        </div>
        <img class="swal2-image" style="display: none;">
        <h2 class="swal2-title" id="swal2-title" style="display: block;">Faild!</h2>
        <div class="swal2-html-container" id="swal2-html-container" style="display: block;">
            {{session()->get('faild')}}
        </div><input class="swal2-input" style="display: none;"><input type="file" class="swal2-file"
            style="display: none;">
        <div class="swal2-range" style="display: none;"><input type="range"><output></output></div><select
            class="swal2-select" style="display: none;"></select>
        <div class="swal2-radio" style="display: none;"></div><label for="swal2-checkbox" class="swal2-checkbox"
            style="display: none;"><input type="checkbox"><span class="swal2-label"></span></label><textarea
            class="swal2-textarea" style="display: none;"></textarea>
        <div class="swal2-validation-message" id="swal2-validation-message" style="display: none;"></div>
        <div class="swal2-actions" style="display: flex;">
            <div class="swal2-loader"></div>
            <button type="button" class="swal2-confirm btn btn-primary" id="btn_hidden" aria-label=""
                style="display: inline-block;">OK</button>
            <button type="button" class="swal2-deny" aria-label="" style="display: none;">No</button><button
                type="button" class="swal2-cancel" aria-label="" style="display: none;">Cancel</button>
        </div>
        <div class="swal2-footer" style="display: none;"></div>
        <div class="swal2-timer-progress-bar-container">
            <div class="swal2-timer-progress-bar" style="display: none;"></div>
        </div>
    </div>
</div>

{{--
<div aria-labelledby="swal2-title" aria-describedby="swal2-html-container"
    class="swal2-popup swal2-modal swal2-icon-error swal2-show" id='alert_danger' tabindex="-1" role="dialog"
    aria-live="assertive" aria-modal="true" style="display: grid;"><button type="button" class="swal2-close"
        aria-label="Close this dialog" style="display: none">×</button>
    <ul class="swal2-progress-steps" style="display: none"></ul>
    <div class="swal2-icon swal2-error swal2-icon-show" style="display: flex;"><span class="swal2-x-mark">
            <span class="swal2-x-mark-line-left"></span>
            <span class="swal2-x-mark-line-right"></span>
        </span>
    </div>
    <img class="swal2-image" style="display: none">
    <h2 class="swal2-title" id="swal2-title" style="display: block;">{{session()->get('faild')}}</h2>
    <div class="swal2-html-container" id="swal2-html-container" style="display: block;"> عملية غير ناجحة</div>
    <input class="swal2-input" style="display: none"><input type="file" class="swal2-file" style="display: none">
    <div class="swal2-range" style="display: none"><input type="range"><output></output></div><select
        class="swal2-select" style="display: none"></select>
    <div class="swal2-radio" style="display: none"></div><label for="swal2-checkbox" class="swal2-checkbox"
        style="display: none"><input type="checkbox"><span class="swal2-label"></span></label><textarea
        class="swal2-textarea" style="display: none"></textarea>
    <div class="swal2-validation-message" id="swal2-validation-message" style="display: none"></div>
    <div class="swal2-actions" style="display: flex;">
        <div class="swal2-loader"></div>
        <button type="button" class="swal2-confirm btn btn-primary" id="btn_hidden" aria-label=""
            style="display: inline-block;">OK</button>
        <button type="button" class="swal2-deny" aria-label="" style="display: none">No</button><button type="button"
            class="swal2-cancel" aria-label="" style="display: none">Cancel</button>
    </div>
    <div class="swal2-footer" style="display: none"></div>
    <div class="swal2-timer-progress-bar-container">
        <div class="swal2-timer-progress-bar" style="display: ;"></div>
    </div>
</div> --}}



@endif

@if(session()->get('faild'))
<script>
    let btn = document.getElementById('btn_hidden');
    let alert = document.getElementById('alert_danger');
    btn.onclick = function() {
        alert.classList.add("d-none");
    };

</script>
@endif
@if(session()->get('success') )
<script>
    let btn = document.getElementById('btn_hidden');
    let alert = document.getElementById('alert_success');
    btn.onclick = function() {
        alert.classList.add("d-none");
    };

</script>
@endif

<!-- Vendors JS -->
<script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>



<!-- Main JS -->