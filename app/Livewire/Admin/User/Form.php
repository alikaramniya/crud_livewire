<?php

namespace App\Livewire\Admin\User;

use App\Livewire\Forms\UserForm;
use Livewire\Component;

class Form extends Component
{
    public UserForm $form;

    public $curentPage = 1;

    public $totalPage = 3;

    public $data = [];

    public function nextPage()
    {
        $this->form->checkValidate($this->curentPage);

        $this->insertToData();

        if ($this->curentPage == 3) {
            return;
        }

        $this->curentPage ++;
    }

    public function save()
    {
        $this->form->checkValidate($this->curentPage);

        $this->insertToData();

        $this->form->store($this->data);

        $this->curentPage = 1;

        $this->dispatch('users-list-updated')->to(Lists::class);
    }

    private function insertToData()
    {
        foreach($this->form->all() as $key => $value) {
            if ($value != null && !in_array($key, array_keys($this->data))) {
                $this->data[$key] = $value;
            }
        }
    }

    public function previousPage()
    {
        if ($this->curentPage == 1) {
            return;
        }
        $this->curentPage--;
    }

    public function render()
    {
        return view('livewire.admin.user.form');
    }
}
