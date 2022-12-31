<?php

require_once "./model/query.php";
class ConsumoController extends Controller
{
    private $query;

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
        $data = $this->query->prepareConsumo($dados);
        $this->consumoImprimir("imprimir",$data,"");
                
    }
    

}