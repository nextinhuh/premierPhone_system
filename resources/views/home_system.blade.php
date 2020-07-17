@extends('template')


@push('script')

<script>
    const venda = document.querySelector('.row .card-body #teste');
    const ordemServico = document.querySelector('.row .card-body #teste2');
</script>

<script src="{{asset('/assets/extra-libs/c3/d3.min.js')}}"></script>
    <script src="{{asset('/assets/extra-libs/c3/c3.min.js')}}"></script>
    <script src="{{asset('/assets/libs/chartist/dist/chartist.min.js')}}"></script>
    <script src="{{asset('/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
    <script src="{{asset('/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{asset('/assets/dist/js/pages/dashboards/dashboard1.js')}}"></script>
@endpush


@section('main')

<div class="card-group">
    <div class="card border-right">
        <div class="card-body">
            <div class="d-flex d-lg-flex d-md-block align-items-center">
                <div>
                    <div class="d-inline-flex align-items-center">
                        <h2 class="text-dark mb-1 font-weight-medium">236</h2>
                        
                    </div>
                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Novos clientes no mês</h6>
                </div>
                <div class="ml-auto mt-md-3 mt-lg-0">
                    <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-right">
        <div class="card-body">
            <div class="d-flex d-lg-flex d-md-block align-items-center">
                <div>
                    <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><sup
                            class="set-doller">R$</sup>18,306</h2>
                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Ganhos bruto do mês
                    </h6>
                </div>
                <div class="ml-auto mt-md-3 mt-lg-0">
                    <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-right">
        <div class="card-body">
            <div class="d-flex d-lg-flex d-md-block align-items-center">
                <div>
                    <div class="d-inline-flex align-items-center">
                        <h2 class="text-dark mb-1 font-weight-medium">1538</h2>
                        <span
                            class="badge bg-danger font-12 text-white font-weight-medium badge-pill ml-2 d-md-none d-lg-block">-18.33%</span>
                    </div>
                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Novos ordens de serviço na semana</h6>
                </div>
                <div class="ml-auto mt-md-3 mt-lg-0">
                    <span class="opacity-7 text-muted"><i data-feather="file-plus"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex d-lg-flex d-md-block align-items-center">
                <div>
                    <h2 class="text-dark mb-1 font-weight-medium">864</h2>
                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Ordens de serviço em aberto</h6>
                </div>
                <div class="ml-auto mt-md-3 mt-lg-0">
                    <span class="opacity-7 text-muted"><i data-feather="globe"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-lg-4 col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Total de vendas</h4>
                <div id="campaign-v2" class="mt-2" style="height:283px; width:100%;"></div>
                <ul class="list-style-none mb-0">
                    <li>
                        <i class="fas fa-circle text-primary font-10 mr-2"></i>
                        <span class="text-muted">Vendas</span>
                        <input type="text" hidden id="teste" value="15000">
                        <span class="text-dark float-right font-weight-medium" >R$ 500</span>
                    </li>
                    <li class="mt-3">
                        <i class="fas fa-circle text-danger font-10 mr-2"></i>
                        <span class="text-muted">Ordem de serviço</span>
                        <input type="text" hidden id="teste2" value="3000">
                        <span class="text-dark float-right font-weight-medium" id="teste2">R$ 300</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <h4 class="card-title mb-0">Estatistica de Ganhos</h4>
                    <div class="ml-auto">
                        <div class="dropdown sub-dropdown">
                            <button class="btn btn-link text-muted dropdown-toggle" type="button"
                                id="dd1" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i data-feather="more-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                <a class="dropdown-item" href="#">Insert</a>
                                <a class="dropdown-item" href="#">Update</a>
                                <a class="dropdown-item" href="#">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pl-4 mb-5">
                    <div class="stats ct-charts position-relative" style="height: 315px;"></div>
                </div>
                <ul class="list-inline text-center mt-4 mb-0">
                    <li class="list-inline-item text-muted font-italic">Earnings for this month</li>
                </ul>
            </div>
        </div>
    </div>

    @endsection