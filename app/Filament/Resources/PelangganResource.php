<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PelangganResource\Pages;
use App\Filament\Resources\PelangganResource\RelationManagers;
use App\Models\Pelanggan;
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

class PelangganResource extends Resource
{
    protected static ?string $model = Pelanggan::class;
    protected static ?string $navigationGroup = 'Data';
    protected static ?string $modelLabel = 'Pelanggan';
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Daftar Pelanggan';
    protected static ?string $slug = 'pelanggan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_konter')->label('Nama Konter'),
                TextInput::make('alamat_konter')->label('Alamat Konter'),
                TextInput::make('nama_pemilik')->label('Nama Pemilik'),
                TextInput::make('no_telp')->label('Nomor Telepon'),
                TextInput::make('email')->email()->label('Email'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('nama_konter')->searchable()->label('Nama Konter'),
                TextColumn::make('alamat_konter')->label('Alamat Konter'),
                TextColumn::make('nama_pemilik')->label('Nama Pemilik'),
                TextColumn::make('no_telp')->label('Nomor Telepon'),
                TextColumn::make('email')->label('Email'),
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
            ->emptyStateHeading('Data pelanggan tidak ditemukan')
            ->emptyStateDescription('Klik tombol dibawah ini untuk menambahkan data pelanggan')
            ->emptyStateActions([
                Action::make('create')
                    ->label('Tambah Data Pelanggan')
                    ->url(route('filament.admin.resources.pelanggan.create'))
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
            'index' => Pages\ListPelanggans::route('/'),
            'create' => Pages\CreatePelanggan::route('/create'),
            'edit' => Pages\EditPelanggan::route('/{record}/edit'),
        ];
    }
}
