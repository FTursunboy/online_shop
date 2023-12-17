<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Good;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MoonShine\Fields\Number;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

class GoodResource extends ModelResource
{
    protected string $model = Good::class;

    protected string $title = 'Goods';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('название', 'name'),
                Number::make('цена', 'price'),
                \MoonShine\Fields\Relationships\BelongsTo::make('категория', 'category', 'name')
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
