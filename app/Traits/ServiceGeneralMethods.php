<?php

namespace App\Traits;

trait ServiceGeneralMethods
{
    protected string $name;
    protected string $description;
    protected string $logo_url;

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getLogoUrl(): string
    {
        return $this->logo_url;
    }
}
