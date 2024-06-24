<?php

use App\Livewire\Customers;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\{actingAs, assertDatabaseHas};

beforeEach(function () {
    $user = User::factory()->create();
    actingAs($user);
});

it('should be bale to create a costumer', function () {
    Livewire::test(Customers\Create::class)
        ->set('name', 'Jhon Doe')
        ->set('email', 'joe@doe.com')
        ->set('phone', '123456789')
        ->call('save')
        ->assertHasNoErrors();

    assertDatabaseHas('customers', [
        'name'  => 'Jhon Doe',
        'email' => 'joe@doe.com',
        'phone' => '123456789',
        'type'  => 'customer',
    ]);
});

describe('validations', function () {
    test('name', function ($rule, $value) {
        Livewire::test(Customers\Create::class)
            ->set('name', $value)
            ->call('save')
            ->assertHasErrors(['name' => $rule]);
    })->with([
        'required' => ['required', ''],
        'min'      => ['min', 'Jo'],
        'max'      => ['max', str_repeat('a', 256)],
    ]);

    test('email', function () {
        Livewire::test(Customers\Create::class)
            ->set('email', '')
            ->set('phone', '')
            ->call('save')
            ->assertHasErrors(['email' => 'required_without:phone']);
    });

    test('phone', function () {
        Livewire::test(Customers\Create::class)
            ->set('email', '')
            ->set('phone', '')
            ->call('save')
            ->assertHasErrors(['phone' => 'required_without:email']);
    });
});
