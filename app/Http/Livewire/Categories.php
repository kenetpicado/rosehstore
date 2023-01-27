<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Traits\AlertsTrait;
use App\Traits\PaginationTrait;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Validation\ValidationException;

class Categories extends Component
{
    use AlertsTrait;
    use PaginationTrait;

    public $category;

    public function rules()
    {
        return [
            'category.name' => [
                'required',
                'max:50',
                Rule::unique('categories', 'name')->ignore($this->category->id),
            ],
            'category.parent_id' => [
                'nullable',
                'exists:categories,id',
            ],
        ];
    }

    public function render()
    {
        $categories = Category::query()
            ->whereNull('parent_id')
            ->with('childrens:id,name,parent_id')
            ->select(['id', 'name', 'parent_id'])
            ->paginate(15);

        $categoriesParents = Category::query()
            ->whereNull('parent_id')
            ->get(['id', 'name']);

        return view('livewire.categories', [
            'categories' => $categories,
            'categoriesParents' => $categoriesParents,
        ]);
    }

    public function mount()
    {
        $this->category = new Category();
    }

    public function store()
    {
        if ($this->category->parent_id == $this->category->id) {
            throw ValidationException::withMessages([
                'category.parent_id' => 'La categoría padre no puede ser la misma que la categoría hija.',
            ]);
        }
        
        $this->validate();
        $this->category->save();

        $this->resetInputFields();
        $this->created();
        $this->emit('close-create-modal');
    }

    public function edit(Category $category)
    {
        $this->category = $category;
         $this->emit('open-create-modal');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        $this->deleted();
    }

    public function resetInputFields()
    {
        $this->reset();
        $this->category = new Category();
    }
}
