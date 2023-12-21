<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Characteristic;
use App\Models\Characteristic_values;
use App\Models\Order;
use Faker\Provider\ar_EG\Text;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

use MoonShine\Fields\Json;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

class CharacteristicsValuesResource extends ModelResource
{
  protected string $model = Characteristic_values::class;

  protected string $title = 'Характеристики';

  public function fields(): array
  {
    return [
      Block::make([
       \MoonShine\Fields\Text::make('значение', 'value'),
        BelongsTo::make('товар', 'good', 'name'),
        BelongsTo::make('характеристика', 'characteristics', 'name', resource: new CharacteristicsResource()),
      ])

    ];
  }

  public function rules(Model $item): array
  {
    return [

    ];
  }


}
