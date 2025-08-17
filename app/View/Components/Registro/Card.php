<?php

namespace App\View\Components\Registro;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    /**
     * Create a new component instance.
     */
    public int $pago;
    public int $icon;
    public int $type;
    public string $title;
    public string $valor;
    public string $dtCriado;
    public string $dtAtualizado;
    public int $stars;

    public function __construct(
        int $pago = 1,
        int $type = 1,
        int $icon = 0,
        string $title = "INDEFINIDO",
        string $valor = "R$ 0,00",
        string $dtCriado = "20-08-2024",
        string $dtAtualizado = "20-08-2018",
        int $stars = 0
    ) {
        $this->pago = $pago;
        $this->type = $type;
        $this->icon = $icon;
        $this->title = $title;
        $this->valor = $valor;
        $this->dtCriado = $dtCriado;
        $this->dtAtualizado = $dtAtualizado;
        $this->stars = $stars;
    }

    public function getCategory(): string
    {
        switch ($this->icon) {
            case 1:
                return "bi-basket-fill";
            case 2:
                return "bi-car-front-fill";
            case 3:
                return "bi-house-fill";
            case 4:
                return "bi-heart-fill";
            case 5:
                return "bi-heart-fill";
            case 6:
                return "bi-mortarboard-fill";
            case 7:
                return "bi-sunglasses";
            case 8:
                return "bi-cash-stack";
            case 9:
                return "bi-graph-up-arrow";
            case 10:
                return "bi-mortarboard-fill";
            default:
                return "nothing";
        }
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view("components.registro.card", [
            'iconClass' => $this->getCategory(),
        ]);
    }
}
