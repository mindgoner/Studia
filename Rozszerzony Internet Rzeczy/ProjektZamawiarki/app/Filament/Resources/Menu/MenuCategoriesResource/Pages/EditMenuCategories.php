<?php

namespace App\Filament\Resources\Menu\MenuCategoriesResource\Pages;

use App\Filament\Resources\Menu\MenuCategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMenuCategories extends EditRecord
{
    protected static string $resource = MenuCategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
