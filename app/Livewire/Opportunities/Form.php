<?php

namespace App\Livewire\Opportunities;

use App\Models\Opportunity;
use Livewire\Attributes\Rule;
use Livewire\Form as BaseForm;

class Form extends BaseForm
{
    public ?Opportunity $opportunity = null;

    #[Rule(['required', 'min:3', 'max:255'])]
    public string $title = '';

    #[Rule(['required'])]
    public string $status = '';

    public int $amount = 0;

    public function setOpportunity(Opportunity $opportunity)
    {
        $this->opportunity = $opportunity;

        $this->title  = $opportunity->title;
        $this->status = $opportunity->status;
        $this->amount = $opportunity->amount;
    }

    public function create()
    {
        $this->validate();

        Opportunity::create([
            'title'  => $this->title,
            'status' => $this->status,
            'amount' => $this->amount,
        ]);

        $this->reset();
    }

    public function update(): void
    {
        $this->validate();

        $this->opportunity->title  = $this->title;
        $this->opportunity->status = $this->status;
        $this->opportunity->amount = $this->amount;

        $this->opportunity->update();
    }
}
