<?php   date_default_timezone_set('America/Sao_Paulo');?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkin</title>
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
        <h4> Lista de Reservas </h4>

        <table class="table table-bordered">
            <thead>
                <th width="5%">Codigo</th>
                <th width="2%">APT</th>
                <th width="20%">Hospede</th>
                <th width="5%">Func.</th>
                <th width="5%">Entrada</th>
                <th width="5%">Saída</th>
                <th width="5%">Hospedes</th>
                <th width="5%">Diarias</th>
                <th width="5%">Valor</th>
                <th width="5%">Situação</th>
                <th width="5%">Adiant.</th>

            </thead>
            <tbody>
                <?php 
                $total = 0;
                $adiantado =0;
                    foreach ($dados as $key => $value) {
                        $total += $value['valorReserva'];
                        $adiantado += $value['valor'];
                ?>
                    <tr>
                        <td><?= $value['idReser']?></td>
                        <td><?= $value['quarto']?></td>
                        <td><?= $value['hospede']?></td>
                        <td><?= $value['funcionario']?></td>
                        <td><?= implode('/',array_reverse(explode( '-', $value['dataEntrada'])))?></td>
                        <td><?= implode('/',array_reverse(explode( '-', $value['dataSaida'])))?></td>
                        <td><?= $value['qtdeHosp']?></td>
                        <td><?= $value['qtdeDias']?></td>
                        <td><?= number_format($value['valorReserva'],2,",",".")?></td>        
                        <td><?php 
                        if($value['autoDiaria'] == "confirmada")
                                { echo "Confirmada" ;}else{
                                    echo $value['statusReser'];
                                }
                            ?></td> 
                        <td><?= number_format($value['valor'],2,",",".")?></td>                
                        
                    
                    </tr>
                <?php } ?>
                <tr>
                    <td class="text-center" colspan="5"> <b> Totais</b></td>
                    <td class="text-center" colspan="4"><b>Total: </b> <?=number_format($total,2,",",".")?></td>
                    <td class="text-center" colspan="2"><b>Tl. Adiantado</b> <?=number_format($adiantado,2,",",".")?></td>
                </tr>
            </tbody>
        </table>
</div>
</body>

</html>