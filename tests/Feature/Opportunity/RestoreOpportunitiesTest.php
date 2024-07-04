<?php

use App\Livewire\Opportunities;
use App\Models\Opportunity;
use Livewire\Livewire;

use function Pest\Laravel\{assertNotSoftDeleted};

it('should be able to restore a opportunity', function () {
    $restore = Opportunity::factory()->deleted()->create();

    Livewire::test(Opportunities\Restore::class)
        ->set('opportunity', $restore)
        ->call('restore');

    assertNotSoftDeleted('opportunities', [
        'id' => $restore->id,
    ]);
});

test('when confirming we should load the opportunity and set modal to true', function () {
    $opportunity = Opportunity::factory()->deleted()->create();

    Livewire::test(Opportunities\Restore::class)
        ->call('confirmAction', $opportunity->id)
        ->assertSet('opportunity.id', $opportunity->id)
        ->assertSet('modal', true)
        ->assertPropertyEntangled('modal');
});

test('after restoring we should dispatch an event to tell the list to reload', function () {
    $opportunity = Opportunity::factory()->deleted()->create();

    Livewire::test(Opportunities\Restore::class)
        ->set('opportunity', $opportunity)
        ->call('restore')
        ->assertDispatched('opportunity::reload');
});

test('after restoring we should close the modal', function () {
    $opportunity = Opportunity::factory()->deleted()->create();

    Livewire::test(Opportunities\Restore::class)
        ->set('opportunity', $opportunity)
        ->call('restore')
        ->assertSet('modal', false);
});

test('making sure restore method is wired', function () {
    Livewire::test(Opportunities\Restore::class)
        ->assertMethodWired('restore');
});

test('checking if component is in the page', function () {
    Livewire::test(Opportunities\Index::class)
        ->assertContainsLivewireComponent('opportunities.restore');
});
