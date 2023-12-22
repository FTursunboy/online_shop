<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Characteristic;
use Illuminate\Database\Eloquent\Model;
use App\Models\Good;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MoonShine\Fields\Image;
use MoonShine\Fields\Number;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
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
                \MoonShine\Fields\Relationships\BelongsTo::make('категория', 'category', 'name'),
              Image::make('картинка', 'img')->disk('public'),
              Textarea::make('Описание', 'description'),
              HasMany::make('Характеристики', 'characteristics', resource: new CharacteristicsValuesResource())
                ->fields([
                  \MoonShine\Fields\Relationships\BelongsTo::make('характеристика', 'characteristics', 'name', resource: new CharacteristicsResource()),
                  Text::make('value'),


                ])

            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }

}
