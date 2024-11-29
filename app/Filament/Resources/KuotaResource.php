<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KuotaResource\Pages;
use App\Filament\Resources\KuotaResource\RelationManagers;
use App\Models\Kuota;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;

class KuotaResource extends Resource
{
    protected static ?string $model = Kuota::class;
    protected static ?string $navigationGroup = 'Data';
    protected static ?string $modelLabel = 'Kuota';
    protected static ?string $navigationIcon = 'heroicon-o-signal';
    protected static ?string $navigationLabel = 'Daftar Stok Kuota';
    protected static ?string $slug = 'kuota';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('nama_provider')
                    ->options([
                    'Axis' => 'Axis',
                    'Indosat/IM3' => 'Indosat/IM3',
                    'Smartfren' => 'Smartfren',
                    'Telkomsel' => 'Telkomsel',
                    'Tri' => 'Tri',
                    'XL' => 'XL',
                    ]),
                TextInput::make('nominal_paket')->label('Nominal Paket (GB)'),
                TextInput::make('masa_aktif')->label('Masa Aktif (hari)'),
                TextInput::make('harga_jual')->numeric()->label('Harga Jual per pcs'),
                TextInput::make('modal')->numeric()->label('Modal per pcs'),
                TextInput::make('jumlah')->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('nama_provider')->sortable(),
                TextColumn::make('nominal_paket')->label('Nominal Paket (GB)'),
                TextColumn::make('masa_aktif')->label('Masa Aktif (hari)'),
                TextColumn::make('harga_jual')->money('IDR')->label('Harga Jual per pcs'),
                TextColumn::make('modal')->money('IDR')->label('Modal per pcs'),
                TextColumn::make('jumlah'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Data kuota tidak ditemukan')
            ->emptyStateDescription('Klik tombol dibawah ini untuk menambahkan data kuota')
            ->emptyStateActions([
                Action::make('create')
                    ->label('Tambah Data Kuota')
                    ->url(route('filament.admin.resources.kuota.create'))
                    ->icon('heroicon-m-plus')
                    ->button(),
            ]);
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
            'index' => Pages\ListKuotas::route('/'),
            'create' => Pages\CreateKuota::route('/create'),
            'edit' => Pages\EditKuota::route('/{record}/edit'),
        ];
    }
}
