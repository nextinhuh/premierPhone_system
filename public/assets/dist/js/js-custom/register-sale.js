
    const vlr_uni = document.querySelector(".row .form-body #vlr_unitario");
    const estoque = document.querySelector(".row .form-body #qtd_estoque");
    const produto = document.querySelector(".row .form-body #produto");
    const quantidade = document.querySelector(".row .form-body #quantidade");
    const desconto = document.querySelector(".row .form-body #desconto");
    const btnAdc = document.querySelector(".row .form-body #btn_Adc");
    const img = document.querySelector(".row .form-body #prod_img");
    var idProd = 0;
    var count = 0;
    
    function selectProd(){
        prod.forEach(setParams);
        
    }
    
    function setParams(item, index, arr) {
    
        if(item[3] == produto.value){
            vlr_uni.value = 'R$ '+ item[1];
            estoque.value = item[0];
            img.src=  linkUrl +'/' +item[4];
        }
    }
    
    function setQtdMais(item, index, arr) {
    
        if(item[3] == produto.value){
            item[0] = item[0] - quantidade.value;
            idProd = item[2];
        }
        
    }
    
    
    
    var t = $('#zero_config').DataTable();
    
    
        $(btnAdc).on( 'click',  function () {
            estoque_num = parseInt(estoque.value);
            quantidade_num = parseInt(quantidade.value);
            desconto_num = 0;
            var vlr_uni2 = vlr_uni.value.replace(/[\R$ ]/g, '');
            vlr_uni2 = parseFloat(vlr_uni2);
            if(estoque_num >= quantidade_num){
            
            if(desconto.value != null){
                desconto_num = parseInt(desconto.value);
                desconto_num = vlr_uni2 * (desconto_num/100);
                vlr_uni2 = vlr_uni2 - desconto_num;
            }
            estoque.value = estoque.value - quantidade.value;
            prod.forEach(setQtdMais);
            var vlr_final = quantidade_num * vlr_uni2;
            t.row.add( [
                '<input type="text" name="nome_prod'+count+'" value="'+idProd +'" hidden>'+produto.value,
                '<input type="text" name="vlr_uni'+count+'" value="'+vlr_uni2 +'" hidden>'+vlr_uni.value,
                '<input type="text" name="qtd_prod'+count+'" value="'+quantidade_num +'" hidden>'+quantidade.value,
                desconto.value + "%",
                'R$ '+ parseFloat(vlr_final.toFixed(2)),
                '<button type="button" class="btn btn-danger btn-circle" title="Excluir Cliente" id="1" name="btn_Del"> <i class="fas fa-trash-alt"></i></button>'
            ] ).draw( false );
            
            count++;
            }else{
                alert("A quantidade que está tentando colocar é superior ao que temos em estoque!");
            }
        } );
    
    $('#zero_config tbody').on( 'click', '#1', function () {
    
        var linha = this.parentNode.parentNode.children;
        prod.forEach(setQtdMenos);
        t.row( $(this).parents('tr') )
        .remove()
        .draw();
    
        function setQtdMenos(item, index, arr) {
        
        quantidade_num = parseInt(linha[2].textContent);
    
        if(item[3] == linha[0].textContent){
        item[0] = item[0] + quantidade_num;
        if(produto.value == linha[0].textContent){
            estoque.value = item[0];
        }
    }
    }
        count--;
    } );

    const modal_fun = document.querySelector("#modal_fun")
    const modal_cos = document.querySelector("#modal_cos")
    const close_fun = document.querySelector("#modal_fun .header #close_fun")
    const close_cos = document.querySelector("#modal_cos .header #close_cos")
    const in1 = document.getElementById("tec_name")
    const in2 = document.getElementById("cos_name")
    const in3 = document.getElementById("cos_id")
    const in4 = document.getElementById("tec_id")
    
    function abre(){
        
        modal_fun.classList.remove("hide");
    
    }
    
    function abre2(){
        
        modal_cos.classList.remove("hide");
    
    }
    
    function exibirValoresLinha(e){
    
    var linha = e.parentNode.parentNode.children;
    in1.value = linha[1].textContent;
    in4.value = linha[0].textContent;
    
    modal_fun.classList.add("hide");
    
    }
    
    function exibirValoresLinha2(e){
    
    var linha = e.parentNode.parentNode.children;
    in2.value = linha[1].textContent;
    in3.value = linha[0].textContent;
    
    modal_cos.classList.add("hide");
    
    }
    
    close_fun.addEventListener("click", () => {
        modal_fun.classList.add("hide")
    })
    
    close_cos.addEventListener("click", () => {
        modal_cos.classList.add("hide")
    })
        
     
    $('#form_venda').submit( function() {
        var data = t.$('input').serialize();
        alert(
            "dados: \n"+
            data.substr( 0, 120 )+'...'
        );
        return true;
    } );
   