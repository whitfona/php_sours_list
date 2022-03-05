<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\Component;

class CategoryDropdown extends Component
{
    public $categoryUrl;

    /**
     * Create the component instance.
     *
     * @param $categoryUrl
     * @return void
     */
    public function __construct($categoryUrl)
    {
        $this->categoryUrl = $categoryUrl;
    }

    /**
     * Get the view / contents that represents the component.
     *
     */
    public function render()
    {
        return view('components.category-dropdown', [
            'categories' => Category::all(),
            'currentCategory' => Category::firstWhere('name', request('category'))
        ]);
    }
}
