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

it('should be able to update status and order of each opportunity', function () {
    $opp1 = Opportunity::factory()->create(['status' => 'open', 'sort_order' => 3]);
    $opp2 = Opportunity::factory()->create(['status' => 'won', 'sort_order' => 5]);
    $opp3 = Opportunity::factory()->create(['status' => 'lost', 'sort_order' => 1]);
    $opp4 = Opportunity::factory()->create(['status' => 'open', 'sort_order' => 2]);
    $opp5 = Opportunity::factory()->create(['status' => 'lost', 'sort_order' => 4]);

    $data = [
        0 => [
            'order' => 1,
            'value' => 'open',
            'items' => [
                0 => [
                    'open'  => 1,
                    'value' => $opp2->id,
                ],
            ],
        ],
        1 => [
            'order' => 2,
            'value' => 'won',
            'items' => [
                0 => [
                    'open'  => 1,
                    'value' => $opp3->id,
                ],
                1 => [
                    'open'  => 2,
                    'value' => $opp4->id,
                ],
            ],
        ],
        2 => [
            'order' => 3,
            'value' => 'lost',
            'items' => [
                0 => [
                    'open'  => 1,
                    'value' => $opp1->id,
                ],
                1 => [
                    'open'  => 2,
                    'value' => $opp5->id,
                ],
            ],
        ],
    ];

    Livewire::test(Board::class)
        ->call('updateOpportunities', $data)
        ->assertOk();

    $opp1->refresh();
    $opp2->refresh();
    $opp3->refresh();
    $opp4->refresh();
    $opp5->refresh();

    expect($opp1)->status->toBe('lost')->sort_order->toBe(4)
        ->and($opp2)->status->toBe('open')->sort_order->toBe(1)
        ->and($opp3)->status->toBe('won')->sort_order->toBe(2)
        ->and($opp4)->status->toBe('won')->sort_order->toBe(3)
        ->and($opp5)->status->toBe('lost')->sort_order->toBe(5);
});

it('should be able to update the board even if one of the statuses is empty', function ($status) {
    $opportunity = Opportunity::factory()->create(['status' => $status]);

    $data = [
        0 => [
            'order' => 1,
            'value' => 'open',
            'items' => [],
        ],
        1 => [
            'order' => 2,
            'value' => 'won',
            'items' => [],
        ],
        2 => [
            'order' => 3,
            'value' => 'lost',
            'items' => [],
        ],
    ];

    $groupId = match($status) {
        'open' => 0,
        'won'  => 1,
        'lost' => 2,
    };

    $data[$groupId]['items'] = [['order' => 1, 'value' => (string)$opportunity->id]];

    Livewire::test(Board::class)
        ->call('updateOpportunities', $data)
        ->assertOk();
})->with([
    'status: open' => ['open'],
    'status: won'  => ['won'],
    'status: lost' => ['lost'],
]);
