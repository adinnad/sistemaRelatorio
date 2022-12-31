<?php

require_once "conexao.php";

class Query{
    private $instanciaConexaoAtiva;

    public function __construct(){
        $this->instanciaConexaoAtiva= Conexao::getInstancia();
    }

    public function checkin($start, $end)
    {
        $sqlStmt = "SELECT COALESCE((SELECT sum(qtdeCons*valorCons) from consumo where idReser = r.idReser and tipoCons != 'diaria' or 'pacote'),'0.00') as consumo,
        COALESCE((SELECT sum(valorCons) from consumo where idReser = r.idReser and tipoCons = 'diaria'),'0.00') as diaria,
        COALESCE((SELECT sum(valorCons) from consumo where idReser = r.idReser and tipoCons = 'pacote'),'0.00') as pacote,
        COALESCE((SELECT sum(valorTotal) from pagamento where idReser = r.idReser),'0.00') as adiantado,
        DATEDIFF(r.dataSaida,r.dataEntrada) as qtdeDias,
        COALESCE((SELECT sum(qtdeCons*valorCons) from consumo where idReser = r.idReser ),'0.00') as total,
        r.hospede,r.quarto,r.qtdeHosp,r.valorReserva,r.dataEntrada as entrada,r.funcionario,r.dataSaida as saida FROM `reserva` r  where r.statusReser = :status order by r.quarto asc";

        try {
            $operacao = $this->instanciaConexaoAtiva->prepare($sqlStmt);
            $operacao->bindValue(":status", "hospedada");
            $operacao->execute();
            $getRow = $operacao->fetchAll(PDO::FETCH_ASSOC);           
            return $getRow;
 
         } catch( PDOException $excecao ){
            return $excecao->getMessage();
         }
    }

    public function checkinHoje($start, $end)
    {
        $sqlStmt = "SELECT COALESCE((SELECT sum(qtdeCons*valorCons) from consumo where idReser = r.idReser and tipoCons != 'diaria' or 'pacote'),'0.00') as consumo,
        COALESCE((SELECT sum(valorCons) from consumo where idReser = r.idReser and tipoCons = 'diaria'),'0.00') as diaria,
        COALESCE((SELECT sum(valorCons) from consumo where idReser = r.idReser and tipoCons = 'pacote'),'0.00') as pacote,
        COALESCE((SELECT sum(valorTotal) from pagamento where idReser = r.idReser),'0.00') as adiantado,
        DATEDIFF(r.dataSaida,r.dataEntrada) as qtdeDias,
        COALESCE((SELECT sum(qtdeCons*valorCons) from consumo where idReser = r.idReser ),'0.00') as total,
        r.hospede,r.quarto,r.qtdeHosp,r.valorReserva,r.dataEntrada as entrada,r.funcionario,r.dataSaida as saida FROM `reserva` r  where r.statusReser = :status and r.dataEntrada = curdate() order by r.quarto asc";

        try {
            $operacao = $this->instanciaConexaoAtiva->prepare($sqlStmt);
            $operacao->bindValue(":status", "hospedada");
            $operacao->execute();
            $getRow = $operacao->fetchAll(PDO::FETCH_ASSOC);           
            return $getRow;
 
         } catch( PDOException $excecao ){
            return $excecao->getMessage();
         }
    }

    public function checkout($start,$end)
    {
        $sqlStmt = "SELECT Distinct r.dataEntrada as entrada,r.dataSaida as saida, p.idReser,h.nomeHosp,
        (select coalesce(sum(valorTotal),0) from pagamento where tipoPag='Deposito' and idReser=r.idReser ) as deposito ,
        (select coalesce(sum(valorTotal),0) from pagamento where tipoPag='CARTAO DE DEBITO' and idReser=r.idReser ) as debito,
        (select coalesce(sum(valorTotal),0) from pagamento where tipoPag='CARTAO DE CREDITO' and idReser=r.idReser ) as credito ,
        (select coalesce(sum(valorTotal),0) from pagamento where tipoPag='CHEQUE' and idReser=r.idReser ) as cheque ,
        (select coalesce(sum(valorTotal),0) from pagamento where tipoPag='CORTESIA' and idReser=r.idReser ) as cortesia ,
        (select coalesce(sum(valorTotal),0) from pagamento where tipoPag='DINHEIRO' and idReser=r.idReser ) as dinheiro , 
        q.numQuarto, r.funcionario FROM reserva r 
        inner join pagamento p on r.idReser=p.idReser 
        inner join quarto q on q.idQuarto=r.idQuarto 
        inner join hospede h on h.idHosp=r.idHosp WHERE dataPag BETWEEN :start AND :end and statusReser = 'fechada'";

        try {
            $operacao = $this->instanciaConexaoAtiva->prepare($sqlStmt);
            $operacao->bindValue(":start", $start);
            $operacao->bindValue(":end", $end);
            $operacao->execute();
            $getRow = $operacao->fetchAll(PDO::FETCH_ASSOC);           
            return $getRow;

        } catch( PDOException $excecao ){
            return $excecao->getMessage();
        }
    }


    public function reserva($checkin, $checkout, $status)
    {
       
        if($status == '3')
        {
            $status = "reservada";
           
        }
        else if ($status == 4)
        {
            $status = "confirmada";
            
        }
        else{
            $status = 'hospedada';
        }

        if($status == "confirmada")   
        {     
            $stmt = "SELECT r.*, DATEDIFF(r.dataSaida,r.dataEntrada) as qtdeDias, p.valorTotal as valor FROM `reserva` r inner join pagamento p  on p.idReser = r.idReser where r.dataEntrada BETWEEN :start AND :end AND r.autoDiaria = :status";
           
        }
        else
        {
            $stmt =  "SELECT r.*, DATEDIFF(r.dataSaida,r.dataEntrada) as qtdeDias, 0 as valor FROM `reserva` r where r.dataEntrada BETWEEN :start AND :end AND r.statusReser = :status AND r.autoDiaria != 'confirmada'";
        }
        try {
            
            $query = $this->instanciaConexaoAtiva->prepare($stmt);
            $query->bindValue(':start', $checkin);
            $query->bindValue(':end', $checkout);
            $query->bindValue(':status', $status);
            $query->execute();
            $getRow = $query->fetchAll(PDO::FETCH_ASSOC);   

            return $getRow;

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    
    }

    public function prepareConsumo($id){
        $stmt = "SELECT r.hospede, r.quarto, r.funcionario, r.dataEntrada, r.dataSaida,r.dataReser,r.valorReserva, 
        c.produto,c.dataconsumo,sum(c.valorCons * c.qtdeCons) as valorconsumo, c.valorCons as valorUnitario, 
        sum(c.qtdeCons) as quantidade, c.funcionario as funcConsumo, c.idCons as codigo FROM `consumo` c INNER JOIN reserva r 
        on r.idReser = c.idReser where r.idReser = :id GROUP BY c.idProd;";
        try {
            
            $query = $this->instanciaConexaoAtiva->prepare($stmt);
            $query->bindValue(':id', $id);        
            $query->execute();
            $getRow = $query->fetchAll(PDO::FETCH_ASSOC);   

            return $getRow;

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function preparePagamento($id){
        $stmt = "SELECT sum(p.valorTotal) as valorPago, p.idPag as codigo, p.tipoPag, p.funcionario, p.dataPag 
        FROM `pagamento` p where p.idReser = :id GROUP BY p.tipoPag;";
        try {
            
            $query = $this->instanciaConexaoAtiva->prepare($stmt);
            $query->bindValue(':id', $id);        
            $query->execute();
            $getRow = $query->fetchAll(PDO::FETCH_ASSOC);   

            return $getRow;

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

}