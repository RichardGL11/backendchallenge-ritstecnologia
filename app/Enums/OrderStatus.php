<?php

namespace App\Enums;
enum OrderStatus:string
{
    case Pendente = 'PENDENTE';
    case EmPreparo = 'EmPreparo';
    case EmEntrega = 'EmEntrega';
    case Entregue = 'Entregue';
    case Cancelado = 'Cancelado';
}
