<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Relatório</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>
<body>

<div class="container-fluid bg-secondary">
        <h3 class="text-center mt-4">Sistema de Relatório</h3>

        <div class="row">
            <div class="col-sm-4 mt-4">
                <a class="btn btn-warning text-right" href="<?=ROTA_GERAL?>">Voltar</a>
            </div>
        </div>
        <h4 class="text-center mt-4">Relatório de situação da reserva</h4>
    <div class="row mt-4 mb-4">
        <form action="" method="post">
           <div class="col-sm-12  mb-4">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="data_inicio">Check-in</label>
                            <input type="date" class="form-control" name="data_inicio" id="data_inicio" value="<?php echo date('Y-m-d')?>" >
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="data_fim">Check-out</label>
                            <input type="date" class="form-control" name="data_fim" id="data_fim" value="<?php echo date('Y-m-d', strtotime("+1 days") ) ?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="3">Reservadas</option>
                                <option value="4">Confirmada</option>
                                <option value="5">Hospedadas</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="">&nbsp;</label>
                        <button class="form-control btn btn-info" type="button" onclick="buscar()">Buscar</button>
                    </div>
                </div>
           </div>
        </form>
    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
 

function buscar(){
    var start = $('#data_inicio').val();
    var end  = $('#data_fim').val();
    var status = $('#status').val();
   
    if(status == '1')
    {        
        verifica(start, end,status);       
        window.open("<?=ROTA_GERAL?>"+"/Home/imprimir/"+start+"@"+end+"@"+status,"_blank");
    }else {
        window.open("<?=ROTA_GERAL?>"+"/Home/imprimir/"+start+"@"+end+"@"+status,"_blank");
    }
    console.log(start);
}

function verifica(start,end,status)
{
    if(start != '' && end != '' && status != '')
        return true;
    
    alert('existe campos vazios')
    window.location.reload();
}

  </script>
</body>
</html>