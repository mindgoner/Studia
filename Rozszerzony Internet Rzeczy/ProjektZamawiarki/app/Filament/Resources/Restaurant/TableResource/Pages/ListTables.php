<?php

namespace App\Filament\Resources\Restaurant\TableResource\Pages;

use App\Filament\Resources\Restaurant\TableResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTables extends ListRecords
{
    protected static string $resource = TableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
