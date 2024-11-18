<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CatatanKeuanganResource\Pages;
use App\Filament\Resources\CatatanKeuanganResource\RelationManagers;
use App\Models\CatatanKeuangan;
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
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;

class CatatanKeuanganResource extends Resource
{
    protected static ?string $model = CatatanKeuangan::class;

    protected static ?string $navigationGroup = 'Keuangan';
    protected static ?string $modelLabel = 'Catatan Keuangan';
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Catatan Keuangan';
    protected static ?string $slug = 'keuangan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode_keuangan')->label('Kode Catatan'),
                DatePicker::make('tanggal_keuangan')->label('Tanggal Transaksi'),
                TextInput::make('nominal')->numeric()->label('Nominal'),
                ToggleButtons::make('kategori')
                    ->options([
                        'Tambahan Dana' => 'Tambahan Dana',
                        'Pemasukan' => 'Pemasukan',
                        'Pengeluaran' => 'Pengeluaran',
                    ])
                    ->colors([
                        'Tambahan Dana' => 'success',
                        'Pemasukan' => 'info',
                        'Pengeluaran' => 'danger',
                    ])
                    ->inline()
                    ->label('Kategori'),
                TextInput::make('keterangan')->label('Keterangan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_keuangan')->searchable()->label('Kode Catatan'),
                TextColumn::make('tanggal_keuangan')->sortable()->label('Tanggal Input'),
                TextColumn::make('nominal')->numeric()->money('IDR')->label('Nominal'),
                TextColumn::make('kategori')
                    ->badge()
                    ->label('Kategori')
                    ->color(fn (string $state): string => match ($state) {
                        'Tambahan Dana' => 'success',
                        'Pemasukan' => 'info',
                        'Pengeluaran' => 'danger',
                    }),
                TextColumn::make('keterangan')->label('Keterangan'),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
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
            'index' => Pages\ListCatatanKeuangans::route('/'),
            'create' => Pages\CreateCatatanKeuangan::route('/create'),
        ];
    }
}
