<?php

namespace App\Filament\Admin\Resources\DetailTransaksiResource\Pages;

use App\Filament\Admin\Resources\DetailTransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDetailTransaksi extends EditRecord
{
    protected static string $resource = DetailTransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
