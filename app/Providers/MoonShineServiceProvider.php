<?php

namespace App\Providers;

use App\Models\Characteristic_values;
use App\MoonShine\Resources\CategoryResource;
use App\MoonShine\Resources\CharacteristicsResource;
use App\MoonShine\Resources\CharacteristicsValuesResource;
use App\MoonShine\Resources\GoodResource;
use App\MoonShine\Resources\OrderResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function resources(): array
    {
        return [];
    }

    protected function pages(): array
    {
        return [];
    }

    protected function menu(): array
    {
        return [
            MenuItem::make('Категории', new CategoryResource()),
            MenuItem::make('Товары', new GoodResource()),
            MenuItem::make('Заказы', new OrderResource()),
            MenuItem::make('Ключи характеристики', new CharacteristicsResource()),
            MenuItem::make('Значении характеристик', new CharacteristicsValuesResource()),
        ];
    }

    /**
     * @return array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [];
    }
}
