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
<body>
@include('modal')
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
<div class="container text-center">
    <button type="button" class="btn btn-primary" style="border-radius: 0;" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Добавить контакт
    </button>
    <button type="button" class="btn btn-danger" style="border-radius: 0;">
        <a href="/country" style="text-decoration: none; color: white;">Страна</a>
    </button>
    <button type="button" class="btn btn-success" style="border-radius: 0;">
        <a href="/city" style="text-decoration: none; color: white;">Город</a>
    </button>
</div>
<table id='datatable' class="table table-bordered table-striped table-dark">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Имя Фамилия</th>
            <th scope="col">Номер телефона</th>
            <th scope="col">Электронная почта</th>
            <th scope="col">Дата рождения</th>
            <th scope="col">Facebook</th>
            <th scope="col" style="display: none;"></th>
            <th scope="col" style="display: none;"></th>
            <th scope="col" style="display: none;"></th>
            <th scope="col" style="display: none;"></th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($contact as $contact)
            <tr>
                <th scope="col">{{$contact->id}}</th>
                <th scope="col" class="show text-center" style="color: mediumpurple;">{{$contact->name}}</th>
                <th scope="col">{{$contact->phone}}</th>
                <th scope="col">{{$contact->email}}</th>
                <th scope="col">{{$contact->data}}</th>
                <th scope="col">{{$contact->facebook}}</th>
                <th scope="col" style="display: none;">{{$contact->other_social}}</th>
                <th scope="col" style="display: none;">{{$contact->country}}</th>
                <th scope="col" style="display: none;">{{$contact->city}}</th>
                <th scope="col" style="display: none;">{{$contact->photo}}</th>
                <th scope="col">
                    <a href="{{route('destr', $contact->id)}}" class="btn btn-danger" style="width: 100%">Удалить</a>
                </th>
            </tr>
        @endforeach
    </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

<script type="text/javascript">

    $(document).ready(function (){

        var table = $('#datatable').DataTable();

        table.on('click', '.show', function () {

            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);

            $('#name').val(data[1]);
            $('#phone').val(data[2]);
            $('#email').val(data[3]);
            $('#data').val(data[4]);
            $('#facebook').attr('href', ''+(data[5]));

            var str = data[6];
            var spt = str.split(" | ");

            var socStringArr = spt;

            var arrayLength = socStringArr.length;
            var outputHTML = "";
            for (var i = 0; i < arrayLength; i++) {
                outputHTML += '<div class="btn btn-success ms-1 me-1 mt-1"><a class="text-white text-decoration-none" id="social" href="'+socStringArr[i]+'">'+socStringArr[i]+'</a></div>';
            }
            document.getElementById("social").innerHTML = outputHTML;

            $('#country').val(data[7]);
            $('#cities').val(data[8]);
            $('#photo').attr('src','http://notebook.com/storage/'+(data[9]));

            //$('#showForm').attr('action', '/index/'+data[0]);
            $('#showForm');
            $('#showModal').modal('show');

        })

    })

    var x = 0;

    function addInput() {
        if (x < x+1) {
            var str = '<input type="text" class="form-control" name="other_social'+(x+1)+'" placeholder="other_social"><div id="input' + (x + 1) + '"></div>';
            document.getElementById('input' + x).innerHTML = str;
            x++;
        }
    }

    $(document).change(function(){
        $id = $('#country').val();
    })

    $(document).ready(function () {
        $('#prefix').on("change", function () {

            $ids = $('#prefix').val();

            if ($(this).val()=='') {
                $("#disappear").css("display", "none");
            }
            else
            {
                $("#disappear").css("display", "none");
            }

            $city_id = $('#city').val();
            $country_id = $ids;

            var city_id = $country_id;
            var result = document.getElementsByClassName('city').length;

            var outputHTML = '<select name="city" class="form-select">';
            for (var i = 0; i < result; i++) {
                var element = document.getElementById('city'+i);
                var attribute = element.getAttribute("value");
                var name = attribute+[i];
                var spt = attribute.split(",");

                if(city_id == spt[1]){
                    outputHTML += '<div id="soc"><option id="'+i+'" value="'+spt[0]+'" class="country_id_'+spt[1]+'">'+spt[0]+'</option></div>';
                }
                document.getElementById("soc").innerHTML = outputHTML;
            }
        });
    })
</script>

</body>
</html>
