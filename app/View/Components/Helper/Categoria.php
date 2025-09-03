<?php

namespace App\View\Components\Helper;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Categoria extends Component
{
    /**
     * Create a new component instance.
     */

    public ?int $cdCategoria;
    public string $iconClass;
    public string $titulo;

    public function __construct(?int $cdCategoria)
    {
        $this->cdCategoria = $cdCategoria;
    }

    public function getCategory(): string
    {
        return match ($this->cdCategoria) {
            1 => "bi-basket-fill",
            2 => "bi-car-front-fill",
            3 => "bi-house-fill",
            4 => "bi-heart-fill",
            5 => "bi-mortarboard-fill",
            6 => "bi-sunglasses",
            7 => "bi-cash-stack",
            8 => "bi-graph-up-arrow",
            9 => "bi-three-dots",
            default => "nothing",
        };
    }

    public function getTitulo(): string {
        return match ($this->cdCategoria) {
            1 => "Alimentação",
            2 => "Transporte",
            3 => "Moradia",
            4 => "Saúde",
            5 => "Educação",
            6 => "Lazer",
            7 => "Salário",
            8 => "Investimentos",
            9 => "Outros",
            default => "Indefinido",
        };
    }

    public function render(): View|Closure|string
    {
        $this->iconClass = $this->getCategory();
        $this->titulo = $this->getTitulo();
        return view("components.helper.categoria",[
            "iconClass" => $this->iconClass,
            "titulo" => $this->titulo,
        ]);
    }
}
