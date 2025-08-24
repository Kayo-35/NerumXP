<?php

namespace App\View\Components\Registro;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Card extends Component
{
    /**
     * Create a new component instance.
     */
    //Registro a ser exibido
    public object $registro;

    public function __construct(object $registro) {
        $this->registro = $registro;
    }

    public function getCategory(): string
    {
        return match ($this->registro->cd_categoria) {
            1 => "bi-basket-fill",
            2 => "bi-car-front-fill",
            3 => "bi-house-fill",
            4 => "bi-heart-fill",
            5 => "bi-mortarboard-fill",
            6 => "bi-sunglasses",
            7 => "bi-cash-stack",
            8 => "bi-graph-up-arrow",
            9 => "bi-mortarboard-fill",
            default => "nothing",
        };
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view("components.registro.card", [
            "iconClass" => $this->getCategory(),
        ]);
    }
}
