<?php   date_default_timezone_set('America/Sao_Paulo');?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consumo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <style>
    .text-right{
        text-align: right
    }
    table{
        font-size: 10pt;
    }
  </style>
</head>

<body>

<div class="container-fluid">

<table class="table ">
    <thead>
        <tr>
            <th colspan="1">Hospede:</th>
            <th colspan="5"><?= $consumo[0]['hospede'] ?></th>
        </tr>
        <tr>
            <th>Data reserva:</th>
            <th><?= implode("/",array_reverse(explode("-",$consumo[0]['dataReser']))) ?></th>
            <th>Data Entrada:</th>
            <th><?= implode("/",array_reverse(explode("-",$consumo[0]['dataEntrada']))) ?></th>
            <th>Data Saida:</th>
            <th><?= implode("/",array_reverse(explode("-",$consumo[0]['dataSaida']))) ?></th>
        </tr>
        <tr>
            <th colspan="2">Funcionario responsável:</th>
            <th colspan="1"><?= $consumo[0]['funcionario'] ?></th>
            <th colspan="1">Valor da Diária</th>
            <th colspan="2"><?= number_format(  $consumo[0]['valorReserva'],2,",",".")   ?></th>            
        </tr>
    </thead>
</table>

        <h4> Consumo da reserva </h4>

        <table class="table table-bordered">
            <thead>
                <th>Codigo</th>
                <th>Produto</th>
                <th>data Consumo</th>
                <th>Funcionário</th>
                <th>Quantidade</th>
                <th>Valor unitário</th>
                <th>Valor Total</th>
            </thead>
            <tbody>
                <?php
                $valorTotal = 0;
                    foreach ($consumo as $key => $value) {
                        $valorTotal +=  $value['valorconsumo'];

                        $data = explode(' ', $value['dataconsumo']);
                        ?>
                        <tr>
                            <td><?= $value['codigo']?></td>
                            <td><?= $value['produto']?></td>
                            <td><?= implode("/",array_reverse(explode("-",$data[0]))) . ' ' . $data[1]?></td>
                            <td><?= $value['funcConsumo']?></td>
                            <td><?= $value['quantidade']?></td>
                            <td><?= $value['valorUnitario']?></td>
                            <td>R$ <?= number_format($value['valorconsumo'],2,",",".")?></td>
                        </tr>
                        <?php
                    }
                ?>
                
                <tr>
                    <td class="text-center" colspan="3"> <b> Totais</b></td>
                    <td class="text-center" colspan="4"><b>Total: R$ </b> <?=number_format($valorTotal,2,",",".")?></td>
                </tr>
            </tbody>
        </table>

        <h4> Pagamentos da reserva </h4>

        <table class="table table-bordered">
            <thead>
                <th>Codigo</th>
                <th>Data Pagamento</th>
                <th>Funcionário</th>
                <th>Tipo de Pagamento</th>
                <th>Valor Pago</th>
            </thead>
            <tbody>
                <?php
                $valorTotalPag = 0;
                    foreach ($pagamento as $key => $value) { 
                        $valorTotalPag +=  $value['valorPago'];        
                        ?>
                        <tr>
                            <td><?= $value['codigo']?></td>
                            <td><?= implode("/",array_reverse(explode("-", $value['dataPag'])))?></td>
                            <td><?= $value['funcionario']?></td>
                            <td><?= $value['tipoPag']?></td>
                            <td>R$ <?= number_format($value['valorPago'],2,",",".")?></td>
                        </tr>
                        <?php
                    }
                ?>                
                <tr>
                    <td class="text-center" colspan="3"> <b> Totais</b></td>
                    <td class="text-center" colspan="4"><b>Total: R$ </b> <?=number_format($valorTotalPag,2,",",".")?></td>
                </tr>
            </tbody>
        </table>

        <hr>
        <table class="table ">
            <thead>                
                <tr>
                    <th>Valor Total Consumo R$</th>
                    <th><?= number_format($valorTotal,2,",",".") ?></th>
                    <th>Valor total Pagamentos R$ </th>
                    <th><?= number_format($valorTotalPag,2,",",".") ?></th>
                    <th>Débito em aberto R$</th>
                    <th><?= number_format($valorTotal - $valorTotalPag,2,",",".") ?></th>
                </tr>                
            </thead>
        </table>
</div>
</body>

</html>