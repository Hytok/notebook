<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Записная книжка</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="js/jquery.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('custom_css')
</head>
<div class="container text-center mt-3">
    @if(count($errors) > 0)
        <div class="alert alert-warning">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{\Session::get('success')}}</p>
        </div>
    @endif

</div>
<h3 class="text-center"><a href="{{route('index')}}" class="text-decoration-none btn-danger p-2 rounded-3">На главную</a></h3>
<form enctype="multipart/form-data" action="{{action ([\App\Http\Controllers\CountryController::class,'store'])}}" method="POST">

    {{csrf_field()}}

    <div class="modal-body">

        <div class="form-group">
            <label>Название страны</label>
            <input type="text" class="form-control" name="name" placeholder="country">
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</form>

<table id='datatable' class="table table-bordered table-striped table-dark">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col" class="text-center" style="color: #3cbaea;">Страна</th>
        <th></th>
        <th></th>
    </tr>
    </thead>

    <tbody>
    @foreach($country as $counties)
        <tr>
            <th scope="row" style="width: 1%;">{{$counties->id}}</th>
            <th class="text-center">{{$counties->name}}</th>
            <th class="text-center" style="width: 5%;"><a href="#" class="btn btn-success text-decoration-none p-2 edit">Изменить</a></th>
            <th class="text-center" style="width: 5%;"><a href="{{route('destroy_country', $counties->id)}}" class="btn btn-danger text-decoration-none p-2">Удалить</a></th>
        </tr>
    @endforeach
    </tbody>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Редактировать страну</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="/city" method="POST" id="editForm">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="modal-body text-center">

                        <div class="form-group">
                            <label class="fw-bold">Страна</label>
                            <input type="text" class="form-control text-center" id="country" name="country">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

<script type="text/javascript">

    $(document).ready(function (){

        var table = $('#datatable').DataTable();

        table.on('click', '.edit', function () {

            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);

            $('#country').val(data[1]);

            $('#editForm').attr('action', '/country/'+data[0]);
            //$('#showForm');
            $('#editModal').modal('show');

        })

    })

</script>
