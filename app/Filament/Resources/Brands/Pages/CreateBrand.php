<?php

namespace App\Filament\Resources\Brands\Pages;

use App\Filament\Resources\Brands\BrandResource;
use App\Traits\HandleImageIdInFilament;
use Filament\Resources\Pages\CreateRecord;

class CreateBrand extends CreateRecord
{
    use HandleImageIdInFilament;
    
    protected static string $resource = BrandResource::class;
}
