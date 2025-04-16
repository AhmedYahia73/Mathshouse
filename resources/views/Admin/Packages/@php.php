@php
    function fun_admin()
    {
        return 'admin';
    }
@endphp

<x-default-layout>
    @section('title', 'Add Package to Student')
    @include('success')

    <div style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; border-radius: 10px; padding: 30px;">
        <form action="{{ route('stu_package_add') }}" method="POST">
            @csrf

            <input type="hidden" class="users" value="{{ $users }}" />
            <div class="">
                <input class="form-control my-2 secUser" name="user" placeholder="Select Student ..." />
                <div class="allUser"></div>
            </div>
            <select name="module" class="form-control my-2">
                <option selected disabled>Select Package ...</option>
                <option value="Exam">Exam</option>
                <option value="Question">Question</option>
                <option value="Live">Live</option>
            </select>

            <input type="number" name="number" class="form-control my-2" placeholder="The Number of Package" />

            <div class="d-flex my-2">
                <button class="btn btn-primary mr-2">Submit</button>
                <button type="reset" class="btn btn-danger mx-2">Clear</button>
            </div>
        </form>
    </div>

    
    <script>
        $(document).ready(function() {
            $(".secUser").change(function() {
                var nickName = $(this).val();

                var results = searchArrayByNameAndPhoneNumber(JSON.parse($(".users").val()), nickName);
                displayResults(results);
            });

            function searchArrayByNameAndPhoneNumber(array, nickName, phone) {
                var results = [];

                $.each(array, function(index, item) {
                    if (item.nick_name === nickName && item.phone === phone) {
                        results.push(item);
                    }
                });

                return results;
            }

            function displayResults(results) {
                $(".allUser").empty();

                $.each(results, function(index, item) {
                    var newUser = `<span>${item}</span>`;
                    $(".allUser").append(newUser);
                });
            }
        });
    </script>
</x-default-layout>