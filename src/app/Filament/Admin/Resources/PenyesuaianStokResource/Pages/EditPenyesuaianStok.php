<?php

namespace App\Filament\Admin\Resources\PenyesuaianStokResource\Pages;

use App\Filament\Admin\Resources\PenyesuaianStokResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenyesuaianStok extends EditRecord
{
    protected static string $resource = PenyesuaianStokResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
