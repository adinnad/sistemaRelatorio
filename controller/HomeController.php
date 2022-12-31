<?php

require_once "./model/query.php";
class HomeController extends Controller
{

    public function index()
    {
        $this->mostrarIndex("home");
    }

    public function hospedes()
    {
        $this->mostrarIndex("hospedes");
    }

    public function imprimir($dados)
    {
        $query =  new Query;

        $dados = explode("@",$dados);
        // var_dump($dados);
        switch ($dados[2]) {
            case '0':   
                $data = $query->checkin($dados[0],$dados[1]);
                 $this->mostraimprimir("checkin",$data,"");
                break;
                case '1':
                    $data = $query->checkout($dados[0],$dados[1]);
                    $this->mostraimprimir("checkout",$data,$dados);
                    break;
                    case '2':
                        $data = $query->checkinHoje($dados[0],$dados[1]);
                        $this->mostraimprimir("atual",$data,"");
                        break;
                        default:   
                            $data = $query->reserva($dados[0],$dados[1],$dados[2]);
                             $this->mostraimprimir("reservas",$data,"");
                            break;
        }
        // $this->imprimir($dados);
        
    }
    

}