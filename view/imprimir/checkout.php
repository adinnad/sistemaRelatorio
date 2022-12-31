<?php   date_default_timezone_set('America/Sao_Paulo');?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHECK-OUT</title>
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
    
        @media print {
            .footer {
              page-break-inside: avoid;
            }
        }
   
  </style>
</head>
<body>
    <div class="container-fluid">
        <h4>check-out  de <?= implode("/",array_reverse(explode("-",$param[0])))?> até <?= implode("/",array_reverse(explode("-",$param[1])))?></h4>
        <table class="table table-bordered">
            <thead>
                <th width="2%">Cod</th>
                <th width="2%">APT</th>
                <th width="20%">Hospede</th>
                <th width="5%">Func.</th>
                <th width="5%">Entrada</th>
                <th width="5%">Saída</th>                
                <th width="5%">Dinheiro R$</th>
                <th width="5%">Crédito R$</th>
                <th width="5%">Débito R$</th>
                <th width="5%">Depósito R$</th>
                <th width="5%">Cheque R$</th>
                <th width="5%">Cortesia R$</th>
                <th width="5%">Total R$</th>

            </thead>
            <tbody>
                <?php
                $dinheiro = 0;
                $deposito = 0;
                $credito = 0;
                $debito = 0;
                $totalGeral = 0;
                $cheque = 0;
                $cortesia = 0;

                $apt = count($dados);
                    foreach ($dados as $key => $value) {
                       $total = $value['dinheiro'] + $value['credito'] + $value['debito'] + $value['deposito'] + $value['cheque'] + $value['cortesia'];
                        $totalGeral += $total;
                        $dinheiro += $value['dinheiro'];
                        $deposito += $value['deposito'];
                        $credito += $value['credito'];
                        $debito += $value['debito'];
                        $cheque += $value['cheque'];
                        $cortesia += $value['cortesia'];
                        ?>

                        <tr>
                            <td><?= $value['idReser']?></td>
                            <td><?= $value['numQuarto']?></td>
                            <td><?= substr($value['nomeHosp'],0,20)."..."?></td>
                            <td><?= $value['funcionario']?></td>
                            <td><?= implode("/",array_reverse(explode("-",$value['entrada'])))?></td>
                            <td><?= implode("/",array_reverse(explode("-",$value['saida'])))?></td>
                            <td class="text-center"><?= number_format($value['dinheiro'],2,",",".")?></td>
                            <td class="text-center"><?= number_format($value['credito'],2,",",".")?></td>
                            <td class="text-right"><?= number_format($value['debito'],2,",",".")?></td>
                            <td class="text-right"><?= number_format($value['deposito'],2,",",".")?></td>
                            <td class="text-right"><?= number_format($value['cheque'],2,",",".")?></td>
                            <td class="text-right"><?= number_format($value['cortesia'],2,",",".")?></td>
                            <td class="text-right"><?= number_format(floatVal($total),2,',','.')?></td>
                        </tr>
        <?php
                   }
                ?>
            </tbody>
        </table>
        <div class="container-fluid" id="footer" style="page-break-inside: avoid;">
            <div class="row">
                <div class="col-sm-8">
                    <div class="row">
                            <div class="col-sm-6">
                                <p><b>Total em Dinheiro:</b> <span class="text-right" style="float:right">R$ <?= number_format($dinheiro,2,',','.')?></span></p>
                            </div>
                            <div class="col-sm-6">
                                <p><b>Total em Depósito:</b> <span class="text-right" style="float:right">R$ <?= number_format($deposito,2,',','.')?></span></p>
                            </div>                
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p><b>Total em Cartão de Crédito:</b> <span class="text-right" style="float:right">R$ <?= number_format($credito,2,',','.')?></span></p>
                        </div>
                        <div class="col-sm-6">
                            <p><b>Total em Cheque:</b> <span class="text-right" style="float:right">R$ <?= number_format($cheque,2,',','.')?></span></p>
                        </div>               
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p><b>Total em Débito:</b> <span class="text-right" style="float:right">R$ <?= number_format($debito,2,',','.')?></span></p>
                        </div>
                        <div class="col-sm-6">
                            <p><b>Total em Cortesia:</b> <span class="text-right" style="float:right">R$ <?= number_format($cortesia,2,',','.')?></span></p>
                        </div>               
                    </div>
                </div>
                <div class="col-sm-4 " style="float:right">
                    <div class="row">
                            <div class="col-sm-12" style="float:right">
                                <p><span class="text-right" style="float:right"><b>Total GERAL:</b> R$ <?= number_format($totalGeral,2,',','.')?></span></p>
                            </div>
                                        
                    </div>                   
                </div>
            </div>
            
        </div>
    </div>
    <script>
        $(()=>{
            window.print()
        });
    </script>
</body>
</html>