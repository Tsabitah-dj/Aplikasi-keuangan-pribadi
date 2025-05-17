<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Transaction;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $pemasukan = Transaction::incomes()->sum('amount');
        $pengeluaran = Transaction::expenses()->sum('amount');
        return [
            Stat::make('Total Pemasukan', $pemasukan)
              ->descriptionIcon('heroicon-m-arrow-trending-up')
              ->color('success'),

            Stat::make('Total Pengeluaran', $pengeluaran)
              ->descriptionIcon('heroicon-m-arrow-trending-down')
              ->color('danger'),
              
            Stat::make('Selisih', $pemasukan - $pengeluaran)
                ->descriptionIcon('heroicon-m-scale')
                ->color($pemasukan >= $pengeluaran ? 'success' : 'danger'),
        ];
    }
}
