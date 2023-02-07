<?php

namespace App\Traits;

use Jantinnerezo\LivewireAlert\LivewireAlert;

trait AlertsTrait
{
    use LivewireAlert;

    public function created()
    {
        $this->alert('success', "Registro guardado correctamente");
    }

    public function deleted()
    {
        $this->alert('info', "Registro eliminado correctamente");
    }

    public function hasError($msj = "Ha ocurrido un error")
    {
        $this->alert('error', $msj);
    }
}
