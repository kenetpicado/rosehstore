<?php

namespace App\Traits;

trait PropertiesTrait
{
    public function getTextStateProperty()
    {
        return $this->startDate == $this->endDate 
            ? 'del día' 
            : 'entre ' . $this->formating($this->startDate) . ' y ' . $this->formating($this->endDate);
    }

    public function formating($dateString)
    {
        return date('d/m/Y', strtotime($dateString));
    }

}
