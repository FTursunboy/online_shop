<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Order;
use Faker\Provider\ar_EG\Text;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

use MoonShine\Fields\Json;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

class OrderResource extends ModelResource
{
    protected string $model = Order::class;

    protected string $title = 'Заказы';



    public function fields(): array
    {
        return [
            Block::make([
                \MoonShine\Fields\Text::make('название', 'name'),
                \MoonShine\Fields\Text::make('телефон', 'phone'),
                \MoonShine\Fields\Text::make('Доставка', 'delivery'),
                \MoonShine\Fields\Text::make('Сумма', 'total_price'),
                Json::make('Товары', 'products')->fields([
                    \MoonShine\Fields\Text::make('цена', 'price'),
                    \MoonShine\Fields\Text::make('Товар', 'id'),
                    \MoonShine\Fields\Text::make('Количество', 'count')
                ])
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [
            'name' => 'required'
        ];
    }
}
