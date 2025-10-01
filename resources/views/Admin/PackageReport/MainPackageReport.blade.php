@php 
    function fun_admin() { 
        return "admin"; 
    } 
@endphp
<x-default-layout>
    @section('title', 'Package Report')
    @include('success')

    <form method="POST" action="{{ route('report_package') }}">
        @csrf

        <div class="mb-3">
            <label for="student_ids" class="form-label">Select Students</label>
            <select id="student_ids" name="student_ids[]" multiple="multiple" class="form-control" style="width: 100%">
                @foreach($students as $student)
                    <option value="{{ $student['id'] }}">
                        {{ $student['nick_name'] }} - {{ $student['phone'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Generate Report</button>
    </form>

    {{-- Include Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#student_ids').select2({
                placeholder: "Search by Name or Phone",
                allowClear: true
            });
        });
    </script>
 
</x-default-layout>
