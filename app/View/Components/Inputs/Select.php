<?php

namespace App\View\Components\Inputs;

use App\Models\Category;
use Illuminate\View\Component;

class Select extends Component
{
    public $selectedCategory;

    /**
     * Create the component instance.
     *
     * @param $selectedCategory
     * @return void
     */
    public function __construct($selectedCategory)
    {
        $this->selectedCategory = $selectedCategory;
    }
    /**
     * Get the view / contents that represent the component.
     *
     */
    public function render()
    {
        return view('components.inputs.select', [
            'categories' => Category::all(),
        ]);
    }
}
