<?php

namespace App\Filament\Resources\Brands;

use App\Filament\Resources\Brands\Pages\CreateBrand;
use App\Filament\Resources\Brands\Pages\EditBrand;
use App\Filament\Resources\Brands\Pages\ListBrands;
use App\Filament\Resources\Brands\Schemas\BrandForm;
use App\Filament\Resources\Brands\Tables\BrandsTable;
use App\Models\Brand;
use App\Traits\TranslatableFilamentModelLabels;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BrandResource extends Resource
{
    use TranslatableFilamentModelLabels;

    protected static ?string $model = Brand::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Brand';

    public static function form(Schema $schema): Schema
    {
        return BrandForm::configure($schema)->statePath('data');
    }

    public static function table(Table $table): Table
    {
        return BrandsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBrands::route('/'),
            'create' => CreateBrand::route('/create'),
            'edit' => EditBrand::route('/{record}/edit'),
        ];
    }
}
