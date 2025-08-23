<?php
namespace App\View\Components\Registro;

use App\Models\Categorizadores\Gerais\Categoria;
use App\Models\Categorizadores\Gerais\Localizacao;
use App\Models\Categorizadores\Gerais\Nivel_imp;
use App\Models\Categorizadores\Pagamento\FormaPagamento;
use App\Models\Categorizadores\Pagamento\MetodoPagamento;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Categorizadores\Registros\Tipo;
use App\Models\Personas\Realizador;
use Illuminate\Database\Eloquent\Collection;

class Form extends Component
{
    /**
     * Create a new component instance.
     */
    //Propriedades
    //Marcação
    public ?string $titulo = null;
    public ?string $rotaProcessamento = null;

    //Registro
    public ?object $registro;

    //Conjuntos
    public Collection $tipos;
    public Collection $metodos;
    public Collection $formas;
    public Collection $importancias;
    public Collection $categorias;
    public Collection $localizacoes;
    public Collection $realizadores;

    //Dados em lotes
    //Atributos para tabela associativa, apenas para edição
    public array $metodosProprios;

    public function __construct() {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view("components.registro.form");
    }
}
