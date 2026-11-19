<?php

declare(strict_types=1);

use Filament\Panel;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Liberu\Accounting\SalesTaxAndGstFilament\Resources\SalesTaxResource;
use Liberu\Accounting\SalesTaxAndGstFilament\Resources\SalesTaxResource\Pages\ListSalesTax;
use Liberu\Accounting\SalesTaxAndGstFilament\SalesTaxAndGstFilamentPlugin;
use Liberu\Accounting\SalesTaxAndGstFilament\SalesTaxAndGstFilamentServiceProvider;

it('registers and configures accounting-sales-tax-and-gst-filament filament resources', function (): void {
    $provider = $this->app->register(SalesTaxAndGstFilamentServiceProvider::class, force: true);
    if (method_exists($provider, 'boot')) { $provider->boot(); }
    expect($provider)->toBeInstanceOf(SalesTaxAndGstFilamentServiceProvider::class);
    $plugin = SalesTaxAndGstFilamentPlugin::make();
    $panel = Panel::make()->id('test-accounting-sales-tax-and-gst-filament');
    $plugin->register($panel);
    $plugin->boot($panel);
    expect($plugin->getId())->toBeString()->not->toBeEmpty();
    $host = new ListSalesTax;
    expect(SalesTaxResource::getPages())->toBeArray();
    expect(SalesTaxResource::form(Schema::make($host)))->toBeInstanceOf(Schema::class);
    expect(SalesTaxResource::table(Table::make($host)))->toBeInstanceOf(Table::class);
});
