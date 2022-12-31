<?php
class Controller
{
    public function mostrarIndex($view)
    {
        require_once "view/".$view.".php";
    }

    public function mostraimprimir($view, $dados,$param)
    {
        require_once "view/imprimir/".$view.".php";
    }

    public function consumoImprimir($view, $dados,$param)
    {
        require_once "view/consumo/".$view.".php";
    }

    public function pagamentoImprimir($view, $consumo, $pagamento)
    {
        require_once "view/pagamento/".$view.".php";
    }
}