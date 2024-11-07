<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccessoriesResource\Pages;
use App\Filament\Resources\AccessoriesResource\RelationManagers;
use App\Models\Accessories;
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
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;

class AccessoriesResource extends Resource
{
    protected static ?string $model = Accessories::class;
    protected static ?string $navigationGroup = 'Data';
    protected static ?string $modelLabel = 'Accessories';
    protected static ?string $navigationIcon = 'heroicon-o-device-phone-mobile';
    protected static ?string $navigationLabel = 'Daftar Stok Accessories';
    protected static ?string $slug = 'accessories';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_acc')->label('Nama'),
                Select::make('kategori')
                    ->options([
                    'Casing' => 'Casing',
                    'Baterai' => 'Baterai',
                    'Charger' => 'Charger',
                    'Kabel Data' => 'Kabel Data',
                    'Earphone Kabel' => 'Earphone Kabel',
                    'Earphone Bluetooth' => 'Earphone Bluetooth',
                    ]),
                TextInput::make('harga_jual')->numeric()->label('Harga Jual per pcs'),
                TextInput::make('harga_beli')->numeric()->label('Harga Beli per pcs'),
                TextInput::make('jumlah')->numeric(),
                FileUpload::make('foto')->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('nama_acc')->searchable()->label('Nama'),
                TextColumn::make('kategori')->sortable()->label('Kategori'),
                TextColumn::make('harga_jual')->money('IDR')->label('Harga Jual per pcs'),
                TextColumn::make('harga_beli')->money('IDR')->label('Harga Beli per pcs'),
                TextColumn::make('jumlah'),
                ImageColumn::make('foto')->size(80),
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
            'index' => Pages\ListAccessories::route('/'),
            'create' => Pages\CreateAccessories::route('/create'),
            'edit' => Pages\EditAccessories::route('/{record}/edit'),
        ];
    }
}
