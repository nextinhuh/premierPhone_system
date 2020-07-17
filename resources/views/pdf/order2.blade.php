<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
  <title>Ordem de Serviço {{$num_ordem}}</title>
   <link rel="stylesheet" href="./assets/dist/css/css_custom/order_pdf.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img style="width: 100px; height: 100px;" src="./assets/images/logo-icon.png" >
      </div>
      <div id="company">
        <h2 class="name">Premier Phone</h2>
        <div>Av. Pres. Getúlio Vargas, 473 D, Serraria</div>
        <div>Maceió - Alagoas</div>
        <div>(82) 99931-0285 | (82) 99929-2959</div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
            @foreach($fun as $f)
          <div class="to">TÉCNICO RESPONSÁVEL:</div>
          <h2 class="name">{{$f['nome']}}</h2>   
          @endforeach      
          @foreach($list as $l)
          <div class="to">NOME DO CLIENTE:</div>
          <h2 class="name">{{$l['nome']}}</h2> 
        </div>
        <div id="invoice">
          <h1>Nº ORDEM DE SERVIÇO {{$l['id_ordem']}}</h1>
          <div class="date">Date da ordem: {{$l['dt_realizada']}}</div>
        </div>
      </div>
      <div id="invoice2">
        <div class="to">APARELHO:</div>
        <h2 class="name">{{$l['marca']}} {{$l['modelo']}} - {{$l['cor']}}</h2>         
        <div class="to">ACESSÓRIOS:</div>
        <h2 class="name">{{$l['acessorios']}}</h2> 
      </div>

      <table border="0" cellspacing="0" cellpadding="0" >
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">DESCRIÇÃO DO PROBLEMA</th>
            
          </tr>
        </thead>
        <tbody>
            @foreach($tes as $key => $value)
                
            
          <tr>
            <td class="no">{{$key+1}}</td>
          <td class="desc">{{$value}}</td>
           
          </tr>
          @endforeach
        </tbody>
      </table>
      
      <div id="notices">

      <div class="notice">{{$ultimo}}</div>
      </div>
      @endforeach

      <div id="notices2">
        <div>LEIA COM ATENÇÃO!</div>
        <div class="notice2">Não aceitamos reclamações posteriores. Por isso confira seu equipamento no ato do recebimento do mesmo!!
          Só efetuamos a entrega do equipamento mediante apresentação deste documento! Retirada por terceiros só com autorização e apresentação dos documentos do titular!
          Prazo para retirada do aparelho é de 90 dias. A partir deste prazo, será cobrada uma taxa diária de 5% do valor do reparo.
          ‘’Declaro ter lido atentamente e estar ciente que o aparelho está nas condições assinaladas acima’’ </div>
      </div>

       

      <div id="thanks">Obrigado pela preferência!</div>

    </main>
    <footer>
      Ordem de serviço criada a partir de um computador.
    </footer>
  </body>
</html>