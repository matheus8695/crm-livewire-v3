<?php

namespace App\Livewire\Customers;

use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\{Component, WithPagination};

class Index extends Component
{
    use WithPagination;

    public function render(): View
    {
        return view('livewire.customers.index');
    }

    #[Computed]
    public function customers(): LengthAwarePaginator
    {
        return Customer::query()->paginate();
    }
}
