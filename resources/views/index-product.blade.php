<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>My Products</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Css style -->
    <link rel="stylesheet" href="style.css">

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    {{-- Datatables --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</head>

<body class="antialiased">
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="container">
            <h4>Server Side Laravel</h4>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success btn-sm mb-3 mt-1" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                + Create Product
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('store-product') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Color</label>
                                    <input type="text" name="color" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Number</label>
                                    <input type="number" name="number" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered" id="datatable-crud">
                    <thead>
                        <tr>
                            <th style="width:1%;text-align: center">Id</th>
                            <th style="text-align: center">Name</th>
                            <th style="text-align: center">Color</th>
                            <th style="text-align: center">Number</th>
                            <th style="text-align: center">Created at</th>
                            <th style="width:10%; text-align:center">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">
    // Get data
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#datatable-crud').DataTable({
            processing: true,
            serverSide: true,
            url: '/',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'color',
                    name: 'color'
                },
                {
                    data: 'number',
                    name: 'number'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                },
            ],
            order: [
                [0, 'asc']
            ]
        });
    });

    // Get data berdasarkan id
    function loadData(id) {
        $.ajax({
            url: '/get-data/' + id,
            type: 'GET',
            success: function(response) {
                // Mengisi formulir dengan data yang diterima
                $('#editId').val(response.id);
                $('#editName').val(response.name);
                $('#editColor').val(response.color);
                $('#editNumber').val(response.number);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }


    // Update data
    function updateData() {
        $.ajax({
            url: '/update-data', // Gantilah dengan URL yang sesuai di Laravel
            type: 'POST',
            data: $('#editForm').serialize(),
            success: function(response) {
                // Jika success
                $('#editModal').modal('hide');
                $('#datatable-crud').DataTable().ajax.reload();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }



    // Destroy data
    function deleteData(id) {
        if (confirm("Are you sure delete this data ?") == true) {
            $.ajax({
                type: "POST",
                url: '/destroy',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    // Jika success
                    $('#datatable-crud').DataTable().ajax.reload();
                }
            });
        }
    };
</script>

</html>
