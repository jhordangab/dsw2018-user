<?php

$css = <<<CSS
        
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
    {
        padding: 2px;
        font-size: 12px;
    }
        
    .table-balancete > tbody > tr.title-category,
    .table-balancete > thead > tr.title-category
    {
        color: #FFF;
    }
        
    .body-valor tr td
    {
        width: 10%;
    }
        
    .table-balancete > tbody > tr.title-category > td.title
    {
        width: 60%; 
        background-color: #247388c2; 
    }
        
    .table-balancete > tbody > tr.sum > td.title
    {
        width: 60%; 
    }
        
    .table-balancete > tbody > tr.sum
    {
        background-color: #247388c2; 
        color: #FFF;
    }
        
        
        
CSS;


$this->registerCss($css);

$meses = 
[
    1 => 'JANEIRO',
    2 => 'FEVEREIRO',
    3 => 'MARÇO',
    4 => 'ABRIL',
    5 => 'MAIO',
    6 => 'JUNHO',
    7 => 'JULHO',
    8 => 'AGOSTO',
    9 => 'SETEMBRO',
    10 => 'OUTUBRO',
    11 => 'NOVEMBRO',
    12 => 'DEZEMBRO'
];

$apelidos = 
[
    1 => 'jan', 
    2 => 'feb', 
    3 => 'mar', 
    4 => 'apr', 
    5 => 'may', 
    6 => 'jun', 
    7 => 'jul', 
    8 => 'aug',
    9 => 'sep', 
    10 => 'oct', 
    11 => 'nov', 
    12 => 'dez'
];
      
$df = [];
$df['total'] = 0;
$rf = [];
$rf['total'] = 0;

?>

<table class="table table-condensed table-bordered table-bordered table-balancete">

    <tbody class="body-valor">
        
        <tr class="title-category">

            <td scope="col" class="title">RECEITAS</td>

            <td scope="col" style="width: 10%;"></td>
               
            <td scope="col" style="width: 10%;"></td>
            
            <td scope="col" style="width: 10%;" class="empty"></td>
            
            <td scope="col" style="width: 10%;" class="bordered"></td>

        </tr>
        
        <tr>

            <td scope="col" class="title">Vendas / Remessas</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
        <tr>

            <td scope="col" class="title">Receitas de Serviços</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
        <tr>

            <td scope="col" class="title">(-) Devolução de Vendas</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
        <tr>

            <td scope="col" class="title">(-) Impostos s/Vendas / Remessas</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
        <tr>

            <td scope="col" class="title">(-) Impostos s/Serviços</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
        <tr class="sum">

            <td scope="col" class="title">RECEITA OPERACIONAL LÍQUIDA</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
    </tbody>

</table>

<table class="table table-condensed table-bordered table-bordered table-balancete">

    <tbody class="body-valor">
        
        <tr class="title-category">

            <td scope="col" class="title">CUSTO DAS MERCADORIAS</td>

            <td scope="col" style="width: 10%;"></td>
               
            <td scope="col" style="width: 10%;"></td>
            
            <td scope="col" style="width: 10%;" class="empty"></td>
            
            <td scope="col" style="width: 10%;" class="bordered"></td>

        </tr>
        
        <tr class="sum">

            <td scope="col" class="title">CMV / CPV</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
    </tbody>

</table>

<table class="table table-condensed table-bordered table-bordered table-balancete">

    <tbody class="body-valor">
        
        <tr class="sum">

            <td scope="col" class="title">MARGEM DE VENDAS</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
        <tr class="sum">

            <td scope="col" class="title">MARGEM DE CONTRIBUIÇÃO</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
    </tbody>

</table>

<table class="table table-condensed table-bordered table-bordered table-balancete">

    <tbody class="body-valor">
        
        <tr class="title-category">

            <td scope="col" class="title">DESPESAS</td>

            <td scope="col" style="width: 10%;"></td>
               
            <td scope="col" style="width: 10%;"></td>
            
            <td scope="col" style="width: 10%;" class="empty"></td>
            
            <td scope="col" style="width: 10%;" class="bordered"></td>

        </tr>
        
        <tr>

            <td scope="col" class="title">Recursos Humanos</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
        <tr>

            <td scope="col" class="title">Ocupação</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
        <tr>

            <td scope="col" class="title">Utilidades e Serviços</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
        <tr>

            <td scope="col" class="title">Funcionamento</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
        <tr>

            <td scope="col" class="title">Serviços Profissionais</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
        <tr>

            <td scope="col" class="title">Comunicação</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
        <tr>

            <td scope="col" class="title">Propaganda e Publicidade</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
        <tr>

            <td scope="col" class="title">Frota</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
        <tr>

            <td scope="col" class="title">Transporte / Logísticas</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
        <tr>

            <td scope="col" class="title">Tributos e Contribuições</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
        <tr>

            <td scope="col" class="title">Bancárias</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
        <tr class="sum">

            <td scope="col" class="title">DESPESAS TOTAIS</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
    </tbody>

</table>

<table class="table table-condensed table-bordered table-bordered table-balancete">

    <tbody class="body-valor">
        
        <tr class="title-category">

            <td scope="col" class="title">RECEITAS / DESPESAS FINANCEIRAS</td>

            <td scope="col" style="width: 10%;"></td>
               
            <td scope="col" style="width: 10%;"></td>
            
            <td scope="col" style="width: 10%;" class="empty"></td>
            
            <td scope="col" style="width: 10%;" class="bordered"></td>

        </tr>
        
        <tr>

            <td scope="col" class="title">Receitas Financeiras</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
        <tr>

            <td scope="col" class="title">(-) Despesas Financeiras</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
        <tr class="sum">

            <td scope="col" class="title">RESULTADO FINANCEIRO LÍQUIDO</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
    </tbody>

</table>

<table class="table table-condensed table-bordered table-bordered table-balancete">

    <tbody class="body-valor">
        
        <tr class="title-category">

            <td scope="col" class="title">LUCRO / PREJUÍZO</td>

            <td scope="col" style="width: 10%;"></td>
               
            <td scope="col" style="width: 10%;"></td>
            
            <td scope="col" style="width: 10%;" class="empty"></td>
            
            <td scope="col" style="width: 10%;" class="bordered"></td>

        </tr>
        
        <tr class="sum">

            <td scope="col" class="title">LUCRO / PREJUÍZO ANTES DO IRPJ / CSLL</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
    </tbody>

</table>

<table class="table table-condensed table-bordered table-bordered table-balancete">

    <tbody class="body-valor">
        
        <tr class="sum">

            <td scope="col" class="title">I.R.E</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
    </tbody>

</table>

<table class="table table-condensed table-bordered table-bordered table-balancete">

    <tbody class="body-valor">
        
        <tr class="sum">

            <td scope="col" class="title">I.L.C</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
    </tbody>

</table>

<table class="table table-condensed table-bordered table-bordered table-balancete">

    <tbody class="body-valor">
        
        <tr class="sum">

            <td scope="col" class="title">I.L.S</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
    </tbody>

</table>

<table class="table table-condensed table-bordered table-bordered table-balancete">

    <tbody class="body-valor">
        
        <tr class="sum">

            <td scope="col" class="title">I.L.G</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
    </tbody>

</table>

<table class="table table-condensed table-bordered table-bordered table-balancete">

    <tbody class="body-valor">
        
        <tr class="sum">

            <td scope="col" class="title">Participação de Capital de Terceiros</td>

            <td scope="col" class="text-center">50</td>
                
            <td scope="col" class="text-center">50</td>
            
            <td scope="col" class="empty"></td>
            
            <td scope="col" class="text-center">50</td>

        </tr>
        
    </tbody>

</table>