<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Component;

/**
 * @property-read LengthAwarePaginator|User[] $users
 */
class Index extends Component
{
    public function render(): View
    {
        return view('livewire.admin.users.index');
    }

    #[Computed]
    public function users(): LengthAwarePaginator
    {
        return User::paginate();
    }
}
