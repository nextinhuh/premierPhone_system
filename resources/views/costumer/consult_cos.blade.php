@extends('template')


@push('script')


<script src="{{asset('/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/assets/dist/js/pages/datatable/datatable-basic.init.js')}}"></script>

@endpush

@section('main')

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="col-md-12">
                <h4 class="card-title">Clientes cadastrados</h4>
                <br>
                @if (session('del-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Cliente deletado com sucesso!</div>
                @endif
                @if (session('del-status') == "fail" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado, favor tentar novamente.</div>
                @endif
                @if (session('save-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Cliente editado com sucesso!</div>
                @endif

                @if (session('save-status') == "fail_end" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado no endereço, favor verificar as informações
                    e tentar novamente.</div>
                @endif

                @if (session('save-status') == "fail_fun" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado nos dados do cliente, favor verificar as
                    informações e tentar novamente.</div>
                @endif

                @if (session('save-status') == "fail_pes" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado, favor recomeçe o procedimento.</div>
                @endif
            </div>


            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered no-wrap">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">CPF</th>
                            <th scope="col">Contato</th>
                            <th scope="col">Email</th>
                            <th scope="col">Editar</th>
                        </tr>
                    </thead>
                    <tbody>


                        

                        @foreach ($list as $emp2 )
                        <tr>
                            <td>{{$emp2['nome']}}</td>
                            <td>{{$emp2['cpf']}}</td>
                            <td>{{$emp2['telefone']}}</td>
                            <td>{{$emp2['email']}}</td>
                            <td>
                                <form method="get" action="{{route('del_costumer', ['id' => $emp2['id'] ])}}"
                                    onsubmit="return confirm('Tem certeza que deseja excluir?')">

                                    <button type="button" class="btn btn-primary btn-circle"
                                        onclick="location.href='{{route('edit_costumer', ['id' => $emp2['id']])}}';" title="Editar Cliente"><i class="fa fa-list"></i>
                                    </button>

                                    <button type="submit" class="btn btn-danger btn-circle" title="Excluir Cliente">
                                        <i class="fas fa-trash-alt"></i></button>

                                    <button type="button" class="btn btn-success btn-circle" onclick="location.href='{{route('equipment_list', ['id' => $emp2['cliente_id']])}}';"
                                        title="Gerir Aparelhos">
                                        <i class="fas fa-phone"></i>
                                    </button>

                                </form>

                            </td>
                        </tr>

                        @endforeach
                        



                    </tbody>
                </table>
            </div>
        </div>
    </div>



    @endsection