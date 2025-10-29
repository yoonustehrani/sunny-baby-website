<?php

namespace App\Filament\Resources\Brands\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class BrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->translateLabel()
                    ->required(),
                TextInput::make('slug')
                    ->translateLabel()
                    ->required(),
                // 1) show the currently related image (if any)
                TextEntry::make('current_image')
                    ->label(__('Current :object', ['object' => __('Logo')]))
                    ->html(true)
                    ->getStateUsing(fn ($record) => $record && $record->image
                        ? '<img src="' . e(asset($record->image->url)) . '" style="max-width:200px; max-height:200px; object-fit:contain;" />'
                        : 'No image')
                    ->hidden(fn (Get $get): bool => $get('image_id') == null),
                // 2) upload a new image (temporary form state, not a DB column)
                FileUpload::make('uploaded_image')
                    ->disk('public')
                    ->label('Replace Image')
                    ->image()
                    ->directory('images/brands')
                    ->visibility('public')
                    ->preserveFilenames(),  
            ]);
    }
}
