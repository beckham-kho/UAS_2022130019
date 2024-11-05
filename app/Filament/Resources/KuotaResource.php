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

class KuotaResource extends Resource
{
    protected static ?string $model = Kuota::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                TextInput::make('nominal_paket'),
                TextInput::make('masa_aktif'),
                TextInput::make('harga_jual')->numeric(),
                TextInput::make('harga_beli')->numeric(),
                TextInput::make('jumlah')->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('nama_provider'),
                TextColumn::make('nominal_paket'),
                TextColumn::make('masa_aktif'),
                TextColumn::make('harga_jual'),
                TextColumn::make('harga_beli'),
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
