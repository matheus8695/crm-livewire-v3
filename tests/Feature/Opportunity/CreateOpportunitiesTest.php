<?php

use App\Livewire\Opportunities;
use App\Models\{User};
use Livewire\Livewire;

use function Pest\Laravel\{actingAs, assertDatabaseHas};

beforeEach(function () {
    $user = User::factory()->create();
    actingAs($user);
});

it('should be bale to create a opportunity', function () {
    Livewire::test(Opportunities\Create::class)
        ->set('form.title', 'John Doe')
        ->assertPropertyWired('form.title')
        ->set('form.status', 'open')
        ->assertPropertyWired('form.status')
        ->set('form.amount', '1239')
        ->assertPropertyWired('form.amount')
        ->call('save')
        ->assertMethodWiredToForm('save')
        ->assertHasNoErrors();

    assertDatabaseHas('opportunities', [
        'title'  => 'John Doe',
        'status' => 'open',
        'amount' => '1239',
    ]);
});

describe('validations', function () {
    test('title', function ($rule, $value) {
        Livewire::test(Opportunities\Create::class)
            ->set('form.title', $value)
            ->call('save')
            ->assertHasErrors(['form.title' => $rule]);
    })->with([
        'required' => ['required', ''],
        'min'      => ['min', 'Jo'],
        'max'      => ['max', str_repeat('a', 256)],
    ]);

    test('status should be required', function () {
        Livewire::test(Opportunities\Create::class)
            ->set('form.status', '')
            ->call('save')
            ->assertHasErrors(['form.status' => 'required']);
    });
});

test('checking if component is in the page', function () {
    Livewire::test(Opportunities\Index::class)
        ->assertContainsLivewireComponent('opportunities.create');
});
