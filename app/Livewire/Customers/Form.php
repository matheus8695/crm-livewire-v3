<?php

namespace App\Livewire\Customers;

use App\Models\Customer;
use Illuminate\Validation\Rule;
use Livewire\Form as BaseForm;

class Form extends BaseForm
{
    public ?Customer $customer = null;

    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public function rules()
    {
        return [
            'name'  => ['required', 'max:255', 'min:3'],
            'email' => ['required_without:phone', 'email' , Rule::unique('customers')->ignore($this->customer?->id)],
            'phone' => ['required_without:email', Rule::unique('customers')->ignore($this->customer?->id)],
        ];
    }

    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;

        $this->name  = $customer->name;
        $this->email = $customer->email;
        $this->phone = $customer->phone;
    }

    public function create()
    {
        $this->validate();

        Customer::create([
            'name'  => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        $this->reset();
    }

    public function update(): void
    {
        $this->validate();

        $this->customer->name  = $this->name;
        $this->customer->email = $this->email;
        $this->customer->phone = $this->phone;

        $this->customer->update();
    }
}
