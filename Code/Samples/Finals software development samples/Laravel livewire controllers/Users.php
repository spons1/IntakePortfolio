<?php

namespace App\Livewire\Dashboard\Admin;

use App\Enums\UserStatus;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public string $query = '';

    public array $statuses = [];

    public function mount(): void
    {
        $this->statuses = [
            UserStatus::GAST->value,
            UserStatus::EMPLOYEE->value,
            UserStatus::OWNER->value,
        ];

        $this->getFilter();
    }

    public function updatedQuery(): void
    {
        $this->resetPage();
        $this->saveFilter();
    }

    public function updatedStatuses(): void
    {
        $this->resetPage();
        $this->saveFilter();
    }

    #[On('userUpdated')]
    public function refreshUsers(): void
    {
        $this->resetPage();
    }

    public function saveFilter(): void
    {
        $filterService = app('App\Services\FilterService', [
            'filterName' => 'admin/users',
            'userId' => auth()->id(),
        ]);

        $filterData = [
            'query' => $this->query,
            'statuses' => $this->statuses,
        ];

        $filterService->saveFilter($filterData);
    }

    public function getFilter(): void
    {
        $filterService = app('App\Services\FilterService', [
            'filterName' => 'admin/users',
            'userId' => auth()->id(),
        ]);

        $filterData = $filterService->getFilter();

        if ($filterData) {
            $this->query = $filterData['query'] ?? '';
            $this->statuses = $filterData['statuses'] ?? [];
        }
    }

    public function render()
    {
        $sql = User::query();

        if ($this->query != '') 
        {
            $like = '%' . $this->query . '%';
            $sql->where(function ($q) use ($like) {
                $q->where('name', 'like', $like)
                    ->orWhere('email', 'like', $like);
            });
        }

        if (!empty($this->statuses)) {
            // filter op VALUES (strings). Werkt zowel met/zonder enum cast.
            $sql->whereIn('status', $this->statuses);
        }

        $users = $sql->paginate(10);

        return view('livewire.dashboard.admin.users', compact('users'));
    }
}
