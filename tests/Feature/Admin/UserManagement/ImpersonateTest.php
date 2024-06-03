<?php

use App\Livewire\Admin;
use App\Models\User;
use Livewire\Livewire;

use function PHPUnit\Framework\{assertSame, assertTrue};

it('should add a key impersonate to the session with the given user', function () {
    $user = User::factory()->create();

    Livewire::test(Admin\Users\Impersonate::class)
        ->call('impersonate', $user->id);

    assertTrue(session()->has('impersonate'));
    assertSame(session()->get('impersonate'), $user->id);
});
