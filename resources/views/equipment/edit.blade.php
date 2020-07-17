@extends('template')

@section('main')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Editar equipamento</h4>
                <br>
                @foreach($list as $l)
                <form action="{{route('save_edit_equip', ['id' => $l['id'], 'id_cliente' => $l['id_cliente']])}}" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="form-group row">

                            <div class="col-md-10">
                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">IMEI-1</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o IMEI-1 do aparelho" class="form-control"
                                        placeholder="IMEI-1 do aparelho" id="equip_name" name="imei1" value="{{$l['imei_1']}}">
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">IMEI-2</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o IMEI-2 do aparelho" class="form-control"
                                                placeholder="IMEI-2 do aparelho" id="prod_name" name="imei2" value="{{$l['imei_2']}}">
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Marca</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a marca do aparelho" class="form-control"
                                                placeholder="Marca do aparelho" id="prod_name" name="marca" value="{{$l['marca']}}">
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Senha do
                                                aparelho</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a senha do aparelho" class="form-control"
                                                placeholder="Senha do aparelho" id="quantity" name="senha_equip" value="{{$l['senha_cel']}}">
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Modelo</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o modelo do aparelho" class="form-control"
                                                placeholder="Modelo do aparelho" id="prod_name" name="modelo" value="{{$l['modelo']}}">
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Cor</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a cor do aparelho" class="form-control"
                                                placeholder="Cor do aparelho" id="prod_name" name="cor" value="{{$l['cor']}}">
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Número de série</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o número de série do aparelho" class="form-control"
                                                placeholder="Número de série do aparelho" id="prod_name"
                                                name="num_serie" value="{{$l['num_serie']}}">
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Código da
                                                bateria</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o código da bateria do aparelho" class="form-control"
                                                placeholder="Código da bateria do aparelho" id="quantity"
                                                name="cod_bateria" value="{{$l['cod_bateria']}}">
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Acessórios</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe os acessórios do aparelho" class="form-control"
                                                placeholder="Acessórios do aparelho" id="quantity" name="acessorio" value="{{$l['acessorios']}}">
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Email
                                                (Android/Icloud)</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o email do aparelho" class="form-control"
                                                placeholder="Email do aparelho" id="quantity" name="email" value="{{$l['email_celular']}}">
                                        </div>

                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="text-right">
                                <button type="submit" class="btn btn-info">Editar equipamento</button>
                            </div>
                        </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection