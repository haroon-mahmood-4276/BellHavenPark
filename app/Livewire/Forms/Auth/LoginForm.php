<?php

namespace App\Livewire\Forms\Auth;

use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate('required|email|max:255')]
    public $email = '';
    
    #[Validate('required|string|max:255')]
    public $password = '';
    
    #[Validate('required|boolean')]
    public $rememberMe = false;
}
