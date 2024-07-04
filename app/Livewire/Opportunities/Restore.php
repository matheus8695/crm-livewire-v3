<?php

namespace App\Livewire\Opportunities;

use App\Models\Opportunity;
use Livewire\Attributes\On;
use Livewire\Component;

class Restore extends Component
{
    public Opportunity $opportunity;

    public bool $modal = false;

    public function render()
    {
        return view('livewire.opportunities.restore');
    }

    #[On('opportunity::restore')]
    public function confirmAction(int $id): void
    {
        $this->opportunity = Opportunity::query()->onlyTrashed()->findOrFail($id);
        $this->modal       = true;
    }

    public function restore(): void
    {
        $this->opportunity->restore();
        $this->modal = false;
        $this->dispatch('opportunity::reload')->to('opportunities.index');
    }
}
