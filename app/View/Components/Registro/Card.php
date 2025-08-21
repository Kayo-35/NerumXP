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
        return match($this->icon) {
            1 => "bi-basket-fill",
            2 => "bi-car-front-fill",
            3 => "bi-house-fill",
            4 => "bi-heart-fill",
            5 => "bi-mortarboard-fill",
            6 => "bi-sunglasses",
            7 => "bi-cash-stack",
            8 => "bi-graph-up-arrow",
            9 => "bi-mortarboard-fill",
            default => "nothing"
        };
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
