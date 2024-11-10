<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FakturResource\Pages;
use App\Filament\Resources\FakturResource\RelationManagers;
use App\Models\Faktur;
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
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Set;
use Filament\Forms\Get;

class FakturResource extends Resource
{
    protected static ?string $model = Faktur::class;

    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?string $modelLabel = 'Faktur Penjualan';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Faktur Penjualan';
    protected static ?string $slug = 'faktur';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode_trx')->label('Kode Transaksi'),
                DatePicker::make('tanggal_trx')->label('Tanggal Transaksi'),
                Select::make('id_pelanggan')
                    ->relationship(name: 'pelanggan', titleAttribute: 'nama_konter')
                    ->label('Pelanggan'),
                Select::make('id_kurir')
                    ->relationship(name: 'kurir', titleAttribute: 'nama_kurir')
                    ->label('Kurir'),
                Repeater::make('detailKuota')
                    ->relationship()
                    ->schema([
                        Select::make('id_kuota')
                        ->reactive()
                        ->relationship(name: 'kuota', titleAttribute: 'id')
                        ->afterStateUpdated(function($state, callable $set) {
                            $kuota = Kuota::find($state);

                            if($kuota) {
                                $set('nama_provider', $kuota->nama_provider);
                                $set('nominal_paket', $kuota->nominal_paket);
                                $set('masa_aktif', $kuota->masa_aktif);
                                $set('harga_kuota', $kuota->harga_jual);
                            }
                        })
                        ->label('ID Kuota'),
                TextInput::make('nama_provider')->disabled()->label('Nama Provider'),
                TextInput::make('nominal_paket')->disabled()->label('Nominal Paket'),
                TextInput::make('masa_aktif')->disabled()->label('Masa Aktif'),
                TextInput::make('qty')
                    ->reactive()
                    ->afterStateUpdated(function (Set $set, $state, Get $get) {
                        $hargaKuota = $get('harga_kuota');
                        $set('subtotal', $state * $hargaKuota);
                    })
                    ->numeric()
                    ->label('Quantity'),
                TextInput::make('diskon')
                    ->reactive()
                    ->afterStateUpdated(function (Set $set, $state, Get $get) {
                        $subtotal = $get('subtotal');
                        $set('subtotal', $state/100 * $subtotal);
                    })
                    ->numeric()
                    ->label('Diskon (%)'),
                TextInput::make('harga_kuota')->disabled()->label('Harga Kuota'),
                TextInput::make('subtotal')->label('Subtotal'),
                ])
                ->live(),
                TextInput::make('total_qty')->numeric()->label('Total Quantity'),
                TextInput::make('total_harga')->numeric()->label('Total Harga'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_trx')->searchable()->label('Kode Transaksi'),
                TextColumn::make('tanggal_trx')->sortable()->label('Tanggal Transaksi'),
                TextColumn::make('pelanggan.nama_konter')->label('Nama Konter'),
                TextColumn::make('kurir.nama_kurir')->label('Nama Kurir'),
                TextColumn::make('total_qty')->numeric()->label('Total Quantity'),
                TextColumn::make('total_harga')->numeric()->label('Total Harga'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListFakturs::route('/'),
            'create' => Pages\CreateFaktur::route('/create'),
            'edit' => Pages\EditFaktur::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
