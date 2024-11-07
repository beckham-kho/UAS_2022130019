<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KurirResource\Pages;
use App\Filament\Resources\KurirResource\RelationManagers;
use App\Models\Kurir;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ToggleButtons;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;

class KurirResource extends Resource
{
    protected static ?string $model = Kurir::class;
    protected static ?string $navigationGroup = 'Data';
    protected static ?string $modelLabel = 'Kurir';
    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationLabel = 'Daftar Kurir';
    protected static ?string $slug = 'kurir';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_kurir')->label('Nama Kurir'),
                TextInput::make('no_telp')->label('Nomor Telepon'),
                ToggleButtons::make('status')
                    ->options([
                        'Tersedia' => 'Tersedia',
                        'Bertugas' => 'Bertugas',
                        'Libur' => 'Libur'
                    ])
                    ->colors([
                        'Tersedia' => 'success',
                        'Bertugas' => 'warning',
                        'Libur' => 'danger',
                    ])
                    ->inline(),
                FileUpload::make('foto')->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('id')->label('ID'),
                TextColumn::make('nama_kurir')->searchable()->label('Nama Kurir'),
                TextColumn::make('no_telp')->label('Nomor Telepon'),
                TextColumn::make('status')
                    ->badge()
                    ->label('Status')
                    ->color(fn (string $state): string => match ($state) {
                        'Tersedia' => 'success',
                        'Bertugas' => 'warning',
                        'Libur' => 'danger',
                    }),
                ImageColumn::make('foto')->circular()->size(60),
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
            'index' => Pages\ListKurirs::route('/'),
            'create' => Pages\CreateKurir::route('/create'),
            'edit' => Pages\EditKurir::route('/{record}/edit'),
        ];
    }
}
