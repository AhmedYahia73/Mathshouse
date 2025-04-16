@php
    function fun_admin()
    {
        return 'admin';
    }
@endphp
<x-default-layout>
    @include('success')
    @section('title', 'Logout Users')
    <style>
        #ship-list_filter>label {
            display: flex;
            align-items: baseline;
            justify-content: flex-end;
            color: #373f4d;
            font-size: 1.2rem;
        }

        #ship-list_length>label {
            font-size: 1.2rem;
            color: #373f4d;
        }

        /* ###### */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 8px;
            text-align: center;
            /* border: 1px solid #ccc; */
        }

        .table th {
            width: 18% !important;
            text-align: center !important;
            color: #fff !important;
            background-color: #23aac0 !important;

        }

        .table td {
            /* text-align: center !important; */
            color: #1e1e1e !important;
            font-size: 1rem;
            font-family: sans-serif;
            /* background-color: #386ca6; */
        }

        .table td p {
            margin-bottom: 0 !important;
            text-overflow: ellipsis;
            width: 90%;
            white-space: nowrap;
            overflow: hidden;
            transition: all 0.2s ease-in-out;
        }

        .table td p:hover {
            width: 100%;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />

    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <div style="display: flex; align-items: center;justify-content: flex-start">
        <input type="text" class="my-3 form-control" id="serchLog" placeholder="Search" style="width: 200px;"
            id="myInput">
    </div>
    <div class="card-datatable table-responsive" style="overflow-x: hidden">
        <table class="datatables-users border-top display table-hover table-striped" id="myTable">
            <thead>
                <tr>
                    <th scope="row">Name</th>
                    <th scope="row">Phone</th>
                    <th scope="row">Email</th>
                    <th scope="row">Position</th>
                    <th scope="row">Action</th>
            </thead>
            <tbody id="myTable">
                @foreach ($students as $item)
                    <tr>
                        <td style="width: 20%;">
                            <p>

                                {{ $item->f_name . ' ' . $item->l_name . ' (' . $item->nick_name . ')' }}
                            </p>
                        </td>
                        <td style="width: 15%;">
                            <p>
                                {{ $item->phone }}
                            </p>
                        </td>
                        <td style="width: 25%;">
                            <p>

                                {{ $item->email }}
                            </p>
                        </td>
                        <td style="width: 20%;">
                            <p>

                                {{ $item->position }}
                            </p>
                        </td>

                        <td style="width: 20%;">
                            <a href="{{ route('logout_account_users', ['id' => $item->id]) }}" class="btn btn-danger">
                                Logout
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <script>
        $(document).ready(function() {
            $("#serchLog").on("keyup", () => {
                var vale = $("#serchLog").val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(vale) > -1);
                })
            })
        });
    </script>

</x-default-layout>
