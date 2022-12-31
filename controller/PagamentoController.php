<?php

require_once "./model/query.php";
class PagamentoController extends Controller
{

    public function __construct()
    {
        $this->query =  new Query;
    }

    public function index()
    {
        $this->mostrarIndex("home");
    }
   
    public function imprimir($dados)
    {
        $consumo = $this->query->prepareConsumo($dados);
        $pagamento = $this->query->preparePagamento($dados);
        $this->pagamentoImprimir("imprimir",$consumo,$pagamento);
                
    }
    

}