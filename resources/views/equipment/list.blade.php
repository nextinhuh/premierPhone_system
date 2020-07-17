@extends('template')

@push('script')

<script src="{{asset('/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/assets/dist/js/pages/datatable/datatable-basic.init.js')}}"></script>
@endpush

@section('main')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Registrar novo equipamento</h4>
                <br>
                @if (session('save-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Aparelho cadastrado com sucesso!</div>
                @endif

                @if (session('save-status') == "fail" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado, favor verificar as informações
                    e tentar novamente.</div>
                @endif
                @if (session('edit-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Aparelho editado com sucesso!</div>
                @endif
                @if (session('edit-status') == "fail" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado, favor verificar as informações
                    e tentar novamente.</div>
                @endif
                @if (session('save-status') == "exist" )
                <div class="alert alert-danger"><b>Ops!</b> O IMEI fornecido já existe, favor recomeçe o procedimento.</div>
                @endif
                @if (session('del-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Aparelho excluído com sucesso!</div>
                @endif
                @if (session('del-status') == "fail" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado, favor verificar as informações
                    e tentar novamente.</div>
                @endif
                <form action="{{route('save_equipment', ['id' => $id_cliente])}}" method="POST">
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
                                                placeholder="IMEI-1 do aparelho" id="equip_name" name="imei1">
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">IMEI-2</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o IMEI-2 do aparelho" class="form-control"
                                                placeholder="IMEI-2 do aparelho" id="prod_name" name="imei2">
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Marca</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a marca do aparelho" class="form-control"
                                                placeholder="Marca do aparelho" id="prod_name" name="marca">
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Senha do
                                                aparelho</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a senha do aparelho" class="form-control"
                                                placeholder="Senha do aparelho" id="quantity" name="senha_equip">
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Modelo</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o modelo do aparelho" class="form-control"
                                                placeholder="Modelo do aparelho" id="prod_name" name="modelo">
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Cor</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a cor do aparelho" class="form-control"
                                                placeholder="Cor do aparelho" id="prod_name" name="cor">
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Número de série</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o número de série do aparelho" class="form-control"
                                                placeholder="Número de série do aparelho" id="prod_name"
                                                name="num_serie">
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Código da
                                                bateria</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o código da bateria do aparelho" class="form-control"
                                                placeholder="Código da bateria do aparelho" id="quantity"
                                                name="cod_bateria">
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Acessórios</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe os acessórios do aparelho" class="form-control"
                                                placeholder="Acessórios do aparelho" id="quantity" name="acessorio">
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Email
                                                (Android/Icloud)</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o email do aparelho" class="form-control"
                                                placeholder="Email do aparelho" id="quantity" name="email">
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="text-right">
                                <button type="submit" class="btn btn-info">Cadastrar equipamento</button>
                            </div>
                        </div>

                </form>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Equipamentos cadastrados</h4>
                    <br>

                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th scope="col">Marca</th>
                                    <th scope="col">Modelo</th>
                                    <th scope="col">Cor</th>
                                    <th scope="col">Editar</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($list as $emp2 )
                                <tr>
                                    <td>{{$emp2['marca']}}</td>
                                    <td>{{$emp2['modelo']}}</td>
                                    <td>{{$emp2['cor']}}</td>
                                    <td>
                                        <form method="get" action="{{route('equipment_del', ['id' => $emp2['id'], 'id_cli' => $id_cliente ])}}"
                                            onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                            
                                            <button type="button" class="btn btn-primary btn-circle"
                                            onclick="location.href='{{route('equipment_edit', ['id' => $emp2['id'] ])}}';"
                                                title="Editar Equipamento"><i class="fa fa-list"></i>
                                            </button>

                                            <button type="submit" class="btn btn-danger btn-circle"
                                                title="Excluir Equipamento">
                                                <i class="fas fa-trash-alt"></i></button>

                                        </form>

                                    </td>
                                </tr>

                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection