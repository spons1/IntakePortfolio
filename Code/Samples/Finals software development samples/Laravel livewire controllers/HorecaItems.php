<?php

namespace App\Livewire\Dashboard\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\HorecaProduct;

class HorecaItems extends Component
{
    use WithPagination;

    public string $query = '';
    public array $categories = [];
    public bool $activeOnly = true;

    public function mount(): void
    {
        $this->getFilter();
    }

    public function updatedQuery(): void
    {
        $this->saveFilter();
    }

    public function updatedCategories(): void
    {
        $this->saveFilter();
    }

    public function updatedActiveOnly(): void
    {
        $this->saveFilter();
    }

    public function saveFilter(): void
    {
        $filterService = app('App\Services\FilterService', [
            'filterName' => 'admin/products',
            'userId' => auth()->id(),
        ]);

        $filterData = [
            'query' => $this->query,
            'categories' => $this->categories,
            'activeOnly' => $this->activeOnly,
        ];

        $filterService->saveFilter($filterData);
    }

    public function getFilter(): void
    {
        $filterService = app('App\Services\FilterService', [
            'filterName' => 'admin/products',
            'userId' => auth()->id(),
        ]);

        $filterData = $filterService->getFilter();

        if ($filterData) 
        {
            $this->query = $filterData['query'] ?? '';
            $this->categories = $filterData['categories'] ?? [];
            $this->activeOnly = $filterData['activeOnly'] ?? true;
        }
    }

    public function render()
    {
        $sql = HorecaProduct::query()
            ->featuredFirst()
            ->orderBy('catagory')
            ->orderBy('name');

        if ($this->query != '')
        {
            $like = '%' . $this->query . '%';
            $sql->where(function ($q) use ($like) 
            {
                $q->where('name', 'like', $like)
                    ->orWhere('description', 'like', $like);
            });
        }

        if (!empty($this->categories)) 
        {
            $sql->whereIn('catagory', $this->categories);
        }

        if ($this->activeOnly)       
        {
            $sql->where('active', true);
        }

        $products = $sql->get();

        $allCategories = HorecaProduct::select('catagory')
            ->distinct()
            ->pluck('catagory')
            ->sort()
            ->toArray();

        return view('livewire.dashboard.admin.horeca-items', compact('products', 'allCategories'));
    }

    public function delete($id): void
    {
        HorecaProduct::findOrFail($id)->delete();
        session()->flash('message', 'Product deleted successfully.');
        $this->resetPage(); 
    }
}