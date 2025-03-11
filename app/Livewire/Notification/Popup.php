<?php

namespace App\Livewire\Notification;

use Livewire\Attributes\On;
use Livewire\Component;

class Popup extends Component
{
    public $isVisible = false;
    public $type = '';
    public $message = '';
    public $actionEvent = null; // Nama event yang akan dipicu
    public $actionParams = []; // Parameter untuk event

    #[On('notification')]
    public function notification($type, $message, $actionEvent = null, $actionParams = [])
    {
        $this->isVisible = true;
        $this->type = $type;
        $this->message = $message;
        $this->actionEvent = $actionEvent; // Simpan nama event
        $this->actionParams = $actionParams; // Simpan parameter
    }

    public function close()
    {
        $this->isVisible = false;
        $this->actionEvent = null; // Reset event
        $this->actionParams = []; // Reset parameter
    }

    public function executeAction()
    {
        if ($this->actionEvent) {
            // Trigger event dengan parameter yang diberikan
            $this->dispatch($this->actionEvent, ...$this->actionParams);
        }
        $this->close();
    }

    public function render()
    {
        return view('livewire.notification.popup');
    }
}
