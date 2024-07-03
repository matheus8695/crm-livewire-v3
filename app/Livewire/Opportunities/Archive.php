<?php

namespace App\Livewire\Opportunities;

use App\Models\Opportunity;
use Livewire\Attributes\On;
use Livewire\Component;

class Archive extends Component
{
    public Opportunity $opportunity;

    public bool $modal = false;

    public function render()
    {
        return view('livewire.opportunities.archive');
    }

    #[On('opportunity::archive')]
    public function confirmAction(int $id): void
    {
        $this->opportunity = Opportunity::findOrFail($id);
        $this->modal       = true;
    }

    public function archive(): void
    {
        $this->opportunity->delete();
        $this->modal = false;
        $this->dispatch('opportunity::reload')->to('opportunities.index');
    }
}
