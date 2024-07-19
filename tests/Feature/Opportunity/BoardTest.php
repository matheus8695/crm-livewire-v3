<?php

use App\Livewire\Opportunities\Board;
use App\Models\Opportunity;
use Illuminate\Support\Collection;
use Livewire\Livewire;

it('should render', function () {
    Livewire::test(Board::class)
        ->assertOk();
});

it('should list all opportunities ordered by status', function () {
    Opportunity::factory()->create(['status' => 'won']);
    Opportunity::factory()->create(['status' => 'lost']);
    Opportunity::factory()->create(['status' => 'open']);

    Livewire::test(Board::class)
        ->assertSet('opportunities', function (Collection $collection) {
            expect($collection)
                ->first()->status->toBe('open')
                ->offsetGet(1)->status->toBe('won')
                ->last()->status->toBe('lost');

            return true;
        });
});

it('should list all opportunities ordered by sort_order', function () {
    $opp3 = Opportunity::factory()->create(['status' => 'open', 'sort_order' => 3]);
    $opp5 = Opportunity::factory()->create(['status' => 'won', 'sort_order' => 5]);
    $opp1 = Opportunity::factory()->create(['status' => 'lost', 'sort_order' => 1]);
    $opp2 = Opportunity::factory()->create(['status' => 'open', 'sort_order' => 2]);
    $opp4 = Opportunity::factory()->create(['status' => 'lost', 'sort_order' => 4]);

    Livewire::test(Board::class)
        ->assertSet('opportunities', function (Collection $collection) use ($opp1, $opp2, $opp3, $opp4, $opp5) {
            expect($collection)
                ->offsetGet(0)->id->toBe($opp2->id)
                ->offsetGet(1)->id->toBe($opp3->id)
                ->offsetGet(2)->id->toBe($opp5->id)
                ->offsetGet(3)->id->toBe($opp1->id)
                ->offsetGet(4)->id->toBe($opp4->id);

            return true;
        });
});
