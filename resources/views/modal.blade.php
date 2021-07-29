
{{--start add model--}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Новый контакт</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form enctype="multipart/form-data" action="{{action ([\App\Http\Controllers\ContactController::class,'store'])}}" method="POST">

                {{csrf_field()}}

                <div class="modal-body">

                    <div class="form-group">
                        <label>ФИО</label>
                        <input type="text" class="form-control" name="name" placeholder="name">
                    </div>

                    <div class="form-group">
                        <label>Номер телефона</label>
                        <input type="text" class="form-control" name="phone" placeholder="phone">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" placeholder="email">
                    </div>

                    <div class="form-group">
                        <label>Дата рождения</label>
                        <input type="date" class="form-control" name="data" placeholder="data">
                    </div>

                    <div class="form-group">
                        <label>Facebook</label>
                        <input type="text" class="form-control" name="facebook" placeholder="facebook">
                    </div>

                    <div class="form_social">
                        <label>Другие соц. сети</label>
                        <div id="input0"></div>
                        <div class="add btn-success text-center" onclick="addInput()">Добавит дополнительную строку</div>
                    </div>

                    <select name="prefix" id="prefix" class="form-select">
                        <option value="0" id="default">Страна не выбрана</option>
                        @foreach($country as $countries)
                            <option value="{{$countries->country_id}}" id="contry">{{$countries->name}}</option>
                        @endforeach
                    </select>

                    <div id="disappear" style="display: none">
                        <select id="city">
                            @foreach($city as $key => $cities)
                                <option id="city{{$key}}" class="city" value="{{$cities->name}},{{$cities->country_id}}">{{$cities->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="soc"></div>

                    <div class="form-group">
                        <label>Загрузить фото:</label>
                        <input type="file" class="form-control" name="photo"/>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--end add model--}}
{{--start show model--}}
<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Карточка контакта</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!--<form action="/index" method="POST" id="showForm">-->
            <form action="/" id="showForm">
                {{--csrf_field()--}}
                {{--method_field('PUT')--}}
                <div class="modal-body text-center">

                    <div class="form-group">
                        <label class="fw-bold">Фото</label>
                        <img id="photo" type="image" src="#" style="width: 100%">
                    </div>

                    <div class="form-group">
                        <label class="fw-bold">ФИО:</label>
                        <output type="text" class="form-control" id="name" name="name"></output>
                    </div>

                    <div class="form-group">
                        <label class="fw-bold">Номер телефона</label>
                        <output type="text" class="form-control" id="phone" name="phone"></output>
                    </div>

                    <div class="form-group">
                        <label class="fw-bold">Email</label>
                        <output type="text" class="form-control" id="email" name="email"></output>
                    </div>

                    <div class="form-group">
                        <label class="fw-bold">Дата рождения</label>
                        <output type="date" class="form-control" id="data" name="data"></output>
                    </div>

                    <div class="form-group">
                        <label class="fw-bold">Facebook</label>
                        <a type="text" class="form-control" id="facebook" name="facebook">Facebook</a>
                    </div>

                    <div class="form-group">
                        <label class="fw-bold">Страна</label>
                        <output type="text" class="form-control" id="country" name="country"></output>
                    </div>

                    <div class="form-group">
                        <label class="fw-bold">Город</label>
                        <output type="text" class="form-control" id="cities" name="city"></output>
                    </div>

                    <div class="form-group">
                        <label class="fw-bold">Другие соц. сети</label>
                        <div id="social"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--end show model--}}
