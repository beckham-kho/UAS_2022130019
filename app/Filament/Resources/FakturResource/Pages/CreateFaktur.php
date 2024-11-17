<?php

namespace App\Filament\Resources\FakturResource\Pages;

use App\Filament\Resources\FakturResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Kuota;
use App\Models\Accessories;
use App\Models\DetailFakturKuota;
use App\Models\DetailFakturAccessories;

class CreateFaktur extends CreateRecord
{
    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

    protected static string $resource = FakturResource::class;

    protected function afterCreate(): void
    {
        //untuk update kuota
        $kuotaUpdateTargetId = DetailFakturKuota::where('id_faktur', $this->record->id)->value('id_kuota');
        $qtyFakturKuota = DetailFakturKuota::where('id_faktur', $this->record->id)->value('qty');
        $jumlahKuota = Kuota::where('id', $kuotaUpdateTargetId)->value('jumlah');
        Kuota::where('id', $kuotaUpdateTargetId)->update(['jumlah' => $jumlahKuota-$qtyFakturKuota]);

        //untuk update accessories
        $accessoriesUpdateTargetId = DetailFakturAccessories::where('id_faktur', $this->record->id)->value('id_accessories');
        $qtyFakturAccessories = DetailFakturAccessories::where('id_faktur', $this->record->id)->value('qty');
        $jumlahAccessories = Accessories::where('id', $accessoriesUpdateTargetId)->value('jumlah');
        Accessories::where('id', $accessoriesUpdateTargetId)->update(['jumlah' => $jumlahAccessories-$qtyFakturAccessories]);
    }
}
