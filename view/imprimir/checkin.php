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
        <h4>Checkin <?= date("d-m-Y H:i:s")?></h4>
        <table class="table table-bordered">
            <thead>
                <th width="2%">APT</th>
                <th width="25%">Hospede</th>
                <th width="5%">Func.</th>
                <th width="5%">Entrada</th>
                <th width="5%">Saída</th>
                <th width="5%">Qtdo Hosp</th>
                <th width="3%">Qtdo Diaria</th>
                <th width="5%">Diaria R$</th>
                <th width="5%">Valor R$</th>
                <th width="10%">Vl util. R$</th>
                <th width="10%">Consumo R$</th>
                <th width="10%">Adiant.</th>
                <th width="10%">Resta R$</th>

            </thead>
            <tbody>
                <?php
                $hospedes = 0;
                $diarias = 0;
                $consumo = 0;
                $adiantadao = 0;
                $total = 0;
                $totaldiaria = 0;
                $totalDiariaGeral = 0;
                $apt = count($dados);
                    foreach ($dados as $key => $value) {
                       $value['quarto'] == "0900" ? $apt-=1:'';
                        $hospedes += $value['qtdeHosp'];
                        $diarias  += $value['diaria'] ?? $value['pacote'];
                        $consumo += $value['consumo'];
                        $adiantadao += $value['adiantado'];
                        $total += $value['total'];
                        $totaldiaria = $value['valorReserva'] * $value['qtdeDias'];
                        $totalDiariaGeral += $totaldiaria;
                        ?>

                        <tr>
                            <td><?= $value['quarto']?></td>
                            <td><?= substr($value['hospede'],0,20)."..."?></td>
                            <td><?= $value['funcionario']?></td>
                            <td><?= implode("/",array_reverse(explode("-",$value['entrada'])))?></td>
                            <td><?= implode("/",array_reverse(explode("-",$value['saida'])))?></td>
                            <td class="text-center"><?= $value['qtdeHosp']?></td>
                            <td class="text-center"><?= $value['qtdeDias']?></td>
                            <td class="text-center"><?= number_format($value['valorReserva'],2,",",".")?></td>
                            <td class="text-center"><?= number_format($totaldiaria,2,",",".")?></td>
                            <td class="text-right"><?= number_format($value['diaria'] ?? $value['pacote'],2,",",".")?></td>
                            <td class="text-right"><?= number_format($value['consumo'],2,",",".")?></td>
                            <td class="text-right"><?= number_format($value['adiantado'],2,",",".")?></td>
                            <td class="text-right"><?= number_format(floatVal($value['total']) - floatVal($value['adiantado']),2,',','.')?></td>
                        </tr>

<?php                    }
                ?>
            </tbody>
        </table>

        <table class="table table-bordered" id="table2">
            <thead>
                <tr>
                    <th>Quantidade de APT.</th>
                    <th>Quantidade de Hosp.</th>    
                    <th>Consumo R$</th>
                    <th>Diarias utilizadas</th>
                    <th>Diarias Geral</th>
                    <th>Consumo + Diarias R$</th>
                    <th>Adiantamento R$</th>
                    <th>Total Geral</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $apt?>
                    </td>
                    <td><?= $hospedes?>
                    </td>                   
                    <td><?= number_format($consumo,2,',','.')?>
                    </td>
                    <td><?= number_format($diarias,2,',','.')?>
                    </td>
                    <td><?= number_format($totalDiariaGeral,2,',','.')?>
                    </td>
                    <td><?= number_format($consumo + $totalDiariaGeral,2,',','.')?>
                    </td>
                    <td><?= number_format($adiantadao,2,',','.')?>
                    </td>
                    <td><?= number_format($totalDiariaGeral - $adiantadao,2,',','.')?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <script>
        $(()=>{
            window.print()
        });
    </script>
</body>
</html>