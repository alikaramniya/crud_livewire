<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Form;

class UserForm extends Form
{
    public $name;

    public $last_name;

    public $email;

    public $address;

    public $password;

    public $age;

    public function checkValidate($curentPage)
    {
        match ($curentPage) {
            1 => $this->validate([
                'name' => 'required',
                'last_name' => 'required',
            ]),
            2 => $this->validate([
                'email' => 'required|email',
            ]),
            default => $this->validate([
                'address' => 'required',
                'password' => 'required',
                'age' => 'required',
            ])
        };
    }

    public function store($data)
    {
        User::create($data);

        $this->reset();
    }
}
