@extends('template')

@push('css')
<link href="{{asset('/assets/dist/css/css_custom/modal_fun.css')}}" rel="stylesheet">
<link href="{{asset('/assets/dist/css/css_custom/modal_cos.css')}}" rel="stylesheet">
<link href="{{asset('/assets/dist/css/css_custom/modal_equip.css')}}" rel="stylesheet">
@endpush

@push('script')

<script src="{{asset('/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/assets/dist/js/pages/datatable/datatable-basic.init.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>


<script>
    var t = $('#zero_config3').DataTable();
    var URL ='{{ URL::asset('/api/cli/') }}';

    $(document).ready(function()
{
     $("#money").maskMoney({
         prefix: "R$ ",
         decimal: ",",
         thousands: "."
     });
});

$(document).ready(function()
{
     $("#money2").maskMoney({
         prefix: "R$ ",
         decimal: ",",
         thousands: "."
     });
});

    function buscarCli(id) {
        
        limpaEquipCampos();
        delEquip();   
        req = URL + '/list/'+id;
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", req, false);
        xhttp.send();//A execução do script pára aqui até a requisição retornar do servidor
        var myObject = JSON.parse(xhttp.responseText);
        adcEquip(myObject[0]['id_cliente']);
        return myObject;
}
    function buscarEquip(id) {
    
     
        req = URL + '/equip/'+id;
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", req, false);
        xhttp.send();//A execução do script pára aqui até a requisição retornar do servidor
        var myObject = JSON.parse(xhttp.responseText);
        return myObject;
}

    
    
     function adcEquip (id) {

        req = URL + '/list/equip/'+id;
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", req, false);
        xhttp.send();//A execução do script pára aqui até a requisição retornar do servidor
        var myObject = JSON.parse(xhttp.responseText);

        myObject.forEach(setParams);

    }
    
    function delEquip () {
    t.clear()
    .draw();
    } 

    function setParams(item, index, arr) {
    
        t.row.add( [
            item['id'],
            item['modelo'] + '<button type="button" class="btn btn-success btn-circle" onclick="exibirValoresLinha3(this);"><i class="fa fa-check"></i></button>',
            item['marca'],
            item['cor']
        ] ).draw( false );
}

    function limpaEquipCampos(){
    equipImei1.value = "";
    equipImei2.value = "";
    equipMarca.value = "";
    equipSenha.value = "";
    equipModelo.value = "";
    equipCor.value = "";
    equipNumSerie.value = "";
    equipCodBateria.value = "";
    equipAcessorio.value = "";
    equipEmail.value = "";
    }


//const btn_search_fun = document.getElementById("fun")
//const btn_search_cos = document.getElementById("cos")
const modal_fun = document.querySelector("#modal_fun")
const modal_cos = document.querySelector("#modal_cos")
const modal_equip = document.querySelector("#modal_equip")
const close_fun = document.querySelector("#modal_fun .header #close_fun")
const close_cos = document.querySelector("#modal_cos .header #close_cos")
const close_equip = document.querySelector("#modal_equip .header #close_equip")
const in1 = document.getElementById("tec_name")
const cosName = document.getElementById("cos_name")
const cosCpf = document.getElementById("cos_cpf")
const cosRg= document.getElementById("cos_rg")
const cosTelefone= document.getElementById("cos_telefone")
const cosEmail = document.getElementById("cos_email")
const cosCep = document.getElementById("cos_cep")
const cosLogradouro = document.getElementById("cos_logradouro")
const cosBairro = document.getElementById("cos_bairro")
const cosCidade = document.getElementById("cos_cidade")
const equipImei1 = document.getElementById("equip_imei1")
const equipImei2 = document.getElementById("equip_imei2")
const equipMarca = document.getElementById("equip_marca")
const equipSenha = document.getElementById("equip_senha")
const equipModelo = document.getElementById("equip_modelo")
const equipCor = document.getElementById("equip_cor")
const equipNumSerie = document.getElementById("equip_num_serie")
const equipCodBateria = document.getElementById("equip_cod_bateria")
const equipAcessorio = document.getElementById("equip_acessorio")
const equipEmail = document.getElementById("equip_email")

const funId = document.getElementById("tec_id")
const cosId = document.getElementById("cos_id")
const equipId = document.getElementById("equip_id")

/*
btn_search_fun.addEventListener("click", () => {
    modal_fun.classList.remove("hide")
});

btn_search_cos.addEventListener("click", () => {
    modal_cos.classList.remove("hide")
});*/

function abre(){
    
    modal_fun.classList.remove("hide");

}

function abre2(){
    
    modal_cos.classList.remove("hide");

}

function abre3(){
    
    modal_equip.classList.remove("hide");

}


function exibirValoresLinha(e){

var linha = e.parentNode.parentNode.children;
in1.value = linha[1].textContent;
funId.value = linha[0].textContent;

modal_fun.classList.add("hide");

}

function exibirValoresLinha2(e){

var linha = e.parentNode.parentNode.children;
var list = buscarCli(linha[0].textContent);

cosId.value = list[0]['id_cliente']
cosName.value = list[0]['nome']
cosCpf.value = list[0]['cpf']
cosRg.value= list[0]['rg']
cosTelefone.value= list[0]['telefone']
cosEmail.value = list[0]['email']
cosCep.value = list[0]['cep']
cosLogradouro.value = list[0]['logradouro']
cosBairro.value = list[0]['bairro']
cosCidade.value = list[0]['cidade']

modal_cos.classList.add("hide");

}

function exibirValoresLinha3(e){

var linha = e.parentNode.parentNode.children;
var list = buscarEquip(linha[0].textContent);

equipId.value = list[0]['id']
equipImei1.value = list[0]['imei_1']
equipImei2.value = list[0]['imei_2']
equipMarca.value = list[0]['marca']
equipSenha.value = list[0]['senha_cel']
equipModelo.value = list[0]['modelo']
equipCor.value = list[0]['cor']
equipNumSerie.value = list[0]['num_serie']
equipCodBateria.value = list[0]['cod_bateria']
equipAcessorio.value = list[0]['acessorios']
equipEmail.value = list[0]['email_celular']


modal_equip.classList.add("hide");

}

close_fun.addEventListener("click", () => {
    modal_fun.classList.add("hide")
})

close_cos.addEventListener("click", () => {
    modal_cos.classList.add("hide")
})

close_equip.addEventListener("click", () => {
    modal_equip.classList.add("hide")
})
   
</script>




@endpush

@section('main')


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Registrar ordem de serviço</h4>
                <br>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Erro(s):</strong>
                    @foreach ($errors->all() as $e)
                    <p>{{$e}}</p>
                    @endforeach
                </div>@endif

                @if (session('save-status') == "sucess" )
                <div class="alert alert-success"><b>Ótimo!</b> Venda registrada com sucesso!</div>
                @endif

                @if (session('save-status') == "fail" )
                <div class="alert alert-danger"><b>Ops!</b> Algo deu errado, favor verificar as informações
                    e tentar novamente.</div>
                @endif
                <h5 class="card-title">Dados da OS</h5>
                <br>
            <form action="{{route('save_order')}}" method="POST">
                @csrf
                    <div class="form-body">
                        <div class="form-group row">

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Número da OS</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Número da OS" class="form-control" id="num_os" name="num_os"
                                                readonly=“true” value="@if ($ordem_serv != null) {{$ordem_serv+1}} @else 1 @endif">
                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Técnico
                                                responsável</label>
                                            <input type="text" hidden name="tec_name" id="tec_id">
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o nome do técnico" class="form-control"
                                                placeholder="Nome do técnico" id="tec_name" >
                                        </div>

                                    </div>

                                    <div class="col-md-1">
                                        <br>
                                        <button type="button" class="btn btn-primary btn-circle" id="fun"
                                            onclick="abre();"><i class="fas fa-search"></i>
                                        </button>
                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Data</label>
                                            <input type="date" class="form-control" value="" data-toggle="tooltip"
                                                data-placement="top" title="Informe a data de compra do produto"
                                                id="date" name="dt_os">
                                        </div>

                                    </div>

                                    <div class="col-md-12">

                                        <br>
                                        <h5 class="card-title">Dados do cliente <button type="button"
                                                class="btn btn-primary btn-circle" id="cos" onclick="abre2();"><i
                                                    class="fas fa-search"></i>
                                            </button></h5>

                                    </div>


                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Nome do Cliente</label>
                                            <input type="text" hidden name="cos_name" id="cos_id">
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o nome do cliente" class="form-control"
                                                placeholder="Nome do Cliente" id="cos_name" >
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">CPF</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a quantidade comprada" class="form-control"
                                                placeholder="Quantidade" id="cos_cpf" name="cos_cpf">
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">RG</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o RG do cliente" class="form-control"
                                                placeholder="RG do cliente" id="cos_rg" name="cos_rg">
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Telefone</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o telefone do cliente" class="form-control"
                                                placeholder="Telefone do cliente" id="cos_telefone" name="cos_telefone">
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Email</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o email do cliente" class="form-control"
                                                placeholder="Email do cliente" id="cos_email" name="cos_email">
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                    </div>

                                    <div class="col-md-12">
                                        <h6 class="card-title">Enederço do cliente</h6>
                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">CEP</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o CEP do cliente" class="form-control"
                                                placeholder="CEP do cliente" id="cos_cep" name="cos_cep">
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Logradouro</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o logradouro do cliente" class="form-control"
                                                placeholder="Logradouro do cliente" id="cos_logradouro"
                                                name="cos_logradouro">
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Bairro</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o bairro do cliente" class="form-control"
                                                placeholder="Bairro do cliente" id="cos_bairro" name="cos_bairro">
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Cidade</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a cidade do cliente" class="form-control"
                                                placeholder="Cidade do cliente" id="cos_cidade" name="cos_cidade">
                                        </div>

                                    </div>

                                    <div class="col-md-12">

                                        <br>
                                        <h5 class="card-title">Equipamento <button type="button"
                                                class="btn btn-primary btn-circle" id="cos" onclick="abre3();"><i
                                                    class="fas fa-search"></i>
                                            </button></h5>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">IMEI-1</label>
                                            <input type="text" hidden name="equip_name" id="equip_id">
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o IMEI-1 do aparelho" class="form-control"
                                                placeholder="IMEI-1 do aparelho" id="equip_imei1" name="equip_imei1">
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">IMEI-2</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o IMEI-2 do aparelho" class="form-control"
                                                placeholder="IMEI-2 do aparelho" id="equip_imei2" name="equip_imei2">
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Marca</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a marca do aparelho" class="form-control"
                                                placeholder="Marca do aparelho" id="equip_marca" name="equip_marca">
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Senha do
                                                aparelho</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a senha do aparelho" class="form-control"
                                                placeholder="Senha do aparelho" id="equip_senha" name="equip_senha">
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Modelo</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o modelo do aparelho" class="form-control"
                                                placeholder="Modelo do aparelho" id="equip_modelo" name="equip_modelo">
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Cor</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe a cor do aparelho" class="form-control"
                                                placeholder="Cor do aparelho" id="equip_cor" name="equip_cor">
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Número de série</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o número de série do aparelho" class="form-control"
                                                placeholder="Número de série do aparelho" id="equip_num_serie"
                                                name="equip_num_serie">
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Código da
                                                bateria</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o código da bateria do aparelho" class="form-control"
                                                placeholder="Código da bateria do aparelho" id="equip_cod_bateria"
                                                name="equip_cod_bateria">
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Acessórios</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe os acessórios do aparelho" class="form-control"
                                                placeholder="Acessórios do aparelho" id="equip_acessorio"
                                                name="equip_acessorio">
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Email
                                                (Android/Icloud)</label>
                                            <input type="text" data-toggle="tooltip" data-placement="top"
                                                title="Informe o email do aparelho" class="form-control"
                                                placeholder="Email do aparelho" id="equip_email" name="equip_email">
                                        </div>

                                    </div>

                                    <div class="col-md-12">

                                        <br>
                                        <h5 class="card-title">Descrição do problema</h5>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1" name="customCheck[]" value="Não liga">
                                            <label class="custom-control-label" for="customCheck1">Não liga</label>
                                        </div>



                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck2" name="customCheck[]" value="Reinicia">
                                            <label class="custom-control-label" for="customCheck2">Reinicia</label>
                                        </div>



                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck3" name="customCheck[]" value="Touch não funciona">
                                            <label class="custom-control-label" for="customCheck3">Touch não
                                                funciona</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck4" name="customCheck[]" value="Display quebrado">
                                            <label class="custom-control-label" for="customCheck4">Display
                                                quebrado</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="customCheck[]" value="Frontal completa quebrada">
                                            <label class="custom-control-label" for="customCheck5">Frontal completa
                                                quebrada</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck6" name="customCheck[]" value="Sem brilho na tela">
                                            <label class="custom-control-label" for="customCheck6">Sem brilho na
                                                tela</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck7" name="customCheck[]" value="Tela piscando">
                                            <label class="custom-control-label" for="customCheck7">Tela piscando</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck8" name="customCheck[]" value="Liga com tela preta">
                                            <label class="custom-control-label" for="customCheck8">Liga com tela
                                                preta</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck9" name="customCheck[]" value="Não carrega">
                                            <label class="custom-control-label" for="customCheck9">Não carrega</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck10" name="customCheck[]" value="Travado">
                                            <label class="custom-control-label" for="customCheck10">Travado</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck11" name="customCheck[]" value="Touch fantasma">
                                            <label class="custom-control-label" for="customCheck11">Touch
                                                fantasma</label>
                                        </div>

                                    </div>

                                    <!-- Segunda Coluna CheckBox -->

                                    <div class="col-md-4">

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck12" name="customCheck[]" value="Carga falsa">
                                            <label class="custom-control-label" for="customCheck12">Carga falsa</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck13" name="customCheck[]" value="Não segura carga">
                                            <label class="custom-control-label" for="customCheck13">Não segura
                                                carga</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck14" name="customCheck[]" value="Sem áudio ou estourado">
                                            <label class="custom-control-label" for="customCheck14">Sem áudio ou
                                                estourado</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck15" name="customCheck[]" value="Entrada de fone não funciona">
                                            <label class="custom-control-label" for="customCheck15">Entrada de fone não
                                                funciona</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck16" name="customCheck[]" value="Não grava voz">
                                            <label class="custom-control-label" for="customCheck16">Não grava
                                                voz</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck17" name="customCheck[]" value="Câmera frontal não funciona">
                                            <label class="custom-control-label" for="customCheck17">Câmera frontal não
                                                funciona</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck18" name="customCheck[]" value="Câmera traseira não funciona">
                                            <label class="custom-control-label" for="customCheck18">Câmera traseira não
                                                funciona</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck19" name="customCheck[]" value="Flash não funciona">
                                            <label class="custom-control-label" for="customCheck19">Flash não
                                                funciona</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck20" name="customCheck[]" value="Wi-fi não funciona">
                                            <label class="custom-control-label" for="customCheck20">Wi-fi não
                                                funciona</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck21" name="customCheck[]" value="Bluetooth não funciona">
                                            <label class="custom-control-label" for="customCheck21">Bluetooth não
                                                funciona</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck22" name="customCheck[]" value="Digital não funciona">
                                            <label class="custom-control-label" for="customCheck22">Digital não
                                                funciona</label>
                                        </div>

                                    </div>

                                    <!-- Terceira Coluna CheckBox -->

                                    <div class="col-md-4">

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck23" name="customCheck[]" value="Bússola não funciona">
                                            <label class="custom-control-label" for="customCheck23">Bússola não
                                                funciona</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck24" name="customCheck[]" value="Não vibra">
                                            <label class="custom-control-label" for="customCheck24">Não vibra</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck25" name="customCheck[]" value="Sem sinal SIM">
                                            <label class="custom-control-label" for="customCheck25">Sem sinal
                                                SIM</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck26" name="customCheck[]" value="Não faz ligação">
                                            <label class="custom-control-label" for="customCheck26"> Não faz
                                                ligação</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck27" name="customCheck[]" value="Super aquecendo">
                                            <label class="custom-control-label" for="customCheck27">Super
                                                aquecendo</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck28" name="customCheck[]" value="Não reconhece o chip">
                                            <label class="custom-control-label" for="customCheck28">Não reconhece o
                                                chip</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck29" name="customCheck[]" value="Não reconhece cartão SD">
                                            <label class="custom-control-label" for="customCheck29">Não reconhece cartão
                                                SD</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck30" name="customCheck[]" value="Não abre galeria de fotos">
                                            <label class="custom-control-label" for="customCheck30">Não abre galeria de
                                                fotos</label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck31" name="customCheck[]" value="Molhou">
                                            <label class="custom-control-label" for="customCheck31">Molhou</label>
                                        </div>

                                    </div>

                                    <div class="col-md-12"><br></div>

                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Problemas
                                                adicionais</label>
                                            <textarea class="form-control" rows="3"
                                                placeholder="Digite aqui.." name="prob_adicional"></textarea>
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Valor de custo</label>
                                            <input type="text" data-toggle="tooltip" data-placement="left"
                                                title="Informe o valor de custo da OS" class="form-control"
                                                placeholder="Custo" id="money" name="vlr_custo">
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Valor total</label>
                                            <input type="text" data-toggle="tooltip" data-placement="right"
                                                title="Informe o valor de total da OS" class="form-control"
                                                placeholder="Total" id="money2" name="vlr_venda">
                                        </div>

                                    </div>

                                </div>
                                <div class="form-actions">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-info">Gerar ordem de serviço</button>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
            </div>


            </form>
        </div>
    </div>
</div>


<div id="modal_fun" class="hide">
    <div class="content">
        <div class="header">
            <h4>Buscar funcionário:</h4>
            <button type="button" class="btn btn-outline-secondary" id="close_fun"><i class="fas fa-window-close"></i>
                Fechar</button>
            </button>
        </div>
        <form action="/search">
            <div class="form-body">
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="row" id="row">
                            <div class="col-md-12">

                                <div class="table-responsive">
                                    <table id="zero_config1" class="table table-striped table-bordered no-wrap"
                                        style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nome</th>
                                                <th scope="col">Função</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($fun as $f)
                                            <tr>
                                            <td>{{$f['id_funcionario']}}</td>
                                                <td>{{$f['nome']}} <button type="button"
                                                        class="btn btn-success btn-circle"
                                                        onclick="exibirValoresLinha(this);"><i class="fa fa-check"></i>
                                                    </button></td>
                                                <td>{{$f['funcao']}}</td>
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
        </form>
    </div>
</div>

<div id="modal_cos" class="hide">
    <div class="content">
        <div class="header">
            <h4>Buscar clientes:</h4>
            <button type="button" class="btn btn-outline-secondary" id="close_cos"><i class="fas fa-window-close"></i>
                Fechar</button>
            </button>
        </div>
        <form action="/search">
            <div class="form-body">
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="row" id="row">
                            <div class="col-md-12">

                                <div class="table-responsive">
                                    <table id="zero_config2" class="table table-striped table-bordered no-wrap"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nome</th>
                                                <th scope="col">CPF</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($list as $l)


                                            <tr>
                                                <td>{{$l['id']}}</td>
                                                <td>{{$l['nome']}} <button type="button"
                                                        class="btn btn-success btn-circle"
                                                        onclick="exibirValoresLinha2(this);"><i class="fa fa-check"></i>
                                                    </button></td>
                                                <td>{{$l['cpf']}}</td>

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
        </form>
    </div>
</div>


<div id="modal_equip" class="hide">
    <div class="content">
        <div class="header">
            <h4>Buscar equipamento:</h4>
            <button type="button" class="btn btn-outline-secondary" id="close_equip"><i class="fas fa-window-close"></i>
                Fechar</button>
            </button>
        </div>
        <form action="/search">
            <div class="form-body">
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="row" id="row">
                            <div class="col-md-12">

                                <div class="table-responsive">
                                    <table id="zero_config3" class="table table-striped table-bordered no-wrap"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Modelo</th>
                                                <th scope="col">Marca</th>
                                                <th scope="col">Cor</th>
                                            </tr>
                                        </thead>

                                    </table>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection