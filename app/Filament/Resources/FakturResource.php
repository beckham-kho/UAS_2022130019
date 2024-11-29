<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FakturResource\Pages;
use App\Filament\Resources\FakturResource\RelationManagers;
use App\Models\Faktur;
use App\Models\Kuota;
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
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Set;
use Filament\Forms\Get;
use Filament\Tables\Actions\Action;

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
                                $set('harga_modal', $kuota->modal);
                            }
                        })
                        ->afterStateHydrated(function($state, callable $set) {
                            $kuota = Kuota::find($state);

                            if($kuota) {
                                $set('nama_provider', $kuota->nama_provider);
                                $set('nominal_paket', $kuota->nominal_paket);
                                $set('masa_aktif', $kuota->masa_aktif);
                                $set('harga_kuota', $kuota->harga_jual);
                                $set('harga_modal', $kuota->modal);
                            }
                        })
                        ->label('ID Kuota'),
                TextInput::make('nama_provider')->readOnly()->label('Nama Provider'),
                TextInput::make('nominal_paket')->readOnly()->label('Nominal Paket'),
                TextInput::make('masa_aktif')->readOnly()->label('Masa Aktif'),
                Hidden::make('harga_modal'),
                TextInput::make('qty')
                    ->reactive()
                    ->afterStateUpdated(function (Set $set, $state, Get $get) {
                        $hargaKuota = $get('harga_kuota');
                        $hargaModalKuota = $get('harga_modal');
                        $set('subtotal', $state * $hargaKuota);
                        $set('subtotal_modal', $state * $hargaModalKuota);
                    })
                    ->numeric()
                    ->label('Quantity'),
                TextInput::make('diskon')
                    ->reactive()
                    ->afterStateUpdated(function (Set $set, $state, Get $get) {
                        $subtotal = $get('subtotal');
                        $nominalDiskon = $state/100;
                        $set('subtotal', $subtotal*(1-$nominalDiskon));
                    })
                    ->numeric()
                    ->label('Diskon (%)'),
                TextInput::make('harga_kuota')->readOnly()->label('Harga Kuota'),
                Hidden::make('subtotal_modal'),
                TextInput::make('subtotal')->readOnly()->label('Subtotal'),
                ])
                ->label('Detail Kuota')
                ->defaultItems(0)
                ->collapsible()
                ->dehydrated(false)
                ->live(),
                Repeater::make('detailAccessories')
                    ->relationship()
                    ->schema([
                        Select::make('id_accessories')
                        ->reactive()
                        ->relationship(name: 'accessories', titleAttribute: 'id')
                        ->afterStateUpdated(function($state, callable $set) {
                            $accessories = Accessories::find($state);

                            if($accessories) {
                                $set('nama_acc', $accessories->nama_acc);
                                $set('kategori', $accessories->kategori);
                                $set('harga_accessories', $accessories->harga_jual);
                                $set('harga_modal', $accessories->modal);
                            }
                        })
                        ->afterStateHydrated(function($state, callable $set) {
                            $accessories = Accessories::find($state);

                            if($accessories) {
                                $set('nama_acc', $accessories->nama_acc);
                                $set('kategori', $accessories->kategori);
                                $set('harga_accessories', $accessories->harga_jual);
                                $set('harga_modal', $accessories->modal);
                            }
                        })
                        ->label('ID Accessories'),
                TextInput::make('nama_acc')->readOnly()->label('Nama Accessories'),
                TextInput::make('kategori')->readOnly()->label('Kategori'),
                Hidden::make('harga_modal'),
                TextInput::make('qty')
                    ->reactive()
                    ->afterStateUpdated(function (Set $set, $state, Get $get) {
                        $hargaAccessories = $get('harga_accessories');
                        $hargaModalAccessories = $get('harga_modal');
                        $set('subtotal', $state * $hargaAccessories);
                        $set('subtotal_modal', $state * $hargaModalAccessories);
                    })
                    ->numeric()
                    ->label('Quantity'),
                TextInput::make('diskon')
                    ->reactive()
                    ->afterStateUpdated(function (Set $set, $state, Get $get) {
                        $subtotal = $get('subtotal');
                        $nominalDiskon = $state/100;
                        $set('subtotal', $subtotal*(1-$nominalDiskon));
                    })
                    ->numeric()
                    ->label('Diskon (%)'),
                TextInput::make('harga_accessories')->readOnly()->label('Harga Accessories'),
                Hidden::make('subtotal_modal'),
                TextInput::make('subtotal')->readOnly()->label('Subtotal'),
                ])
                ->collapsible()
                ->dehydrated(false)
                ->defaultItems(0)
                ->label('Detail Accessories')
                ->live(),
                TextInput::make('total_qty')
                    ->placeholder(function (Set $set, Get $get) {
                        $qtyKuota = collect($get('detailKuota'))->pluck('qty')->sum();
                        $qtyAcc = collect($get('detailAccessories'))->pluck('qty')->sum();

                        if($qtyKuota == null && $qtyAcc == null) {
                            $set('total_qty', 0);
                        } else {
                            $set('total_qty', $qtyKuota + $qtyAcc);
                        }
                    })
                    ->numeric()
                    ->readOnly()
                    ->label('Total Quantity'),
                TextInput::make('total_harga')
                    ->placeholder(function (Set $set, Get $get) {
                        $subtotalKuota = collect($get('detailKuota'))->pluck('subtotal')->sum();
                        $subtotalAcc = collect($get('detailAccessories'))->pluck('subtotal')->sum();

                        if($subtotalKuota == null && $subtotalAcc == null) {
                            $set('total_harga', 0);
                        } else {
                            $set('total_harga', $subtotalKuota + $subtotalAcc);
                        }
                    })
                    ->numeric()
                    ->readOnly()
                    ->label('Total Harga'),
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
                TextColumn::make('total_harga')->numeric()->money('IDR')->label('Total Harga'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                //
            ])
            ->emptyStateHeading('Data faktur tidak ditemukan')
            ->emptyStateDescription('Klik tombol dibawah ini untuk menambahkan data faktur')
            ->emptyStateActions([
                Action::make('create')
                    ->label('Tambah Data Faktur')
                    ->url(route('filament.admin.resources.faktur.create'))
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
            'index' => Pages\ListFakturs::route('/'),
            'create' => Pages\CreateFaktur::route('/create'),
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
