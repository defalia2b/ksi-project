<?php

namespace App\Filament\Admin\Resources\DetailTransaksiResource\Pages;

use App\Filament\Admin\Resources\DetailTransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDetailTransaksis extends ListRecords
{
    protected static string $resource = DetailTransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
