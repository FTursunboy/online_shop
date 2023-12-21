<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Characteristic;
use App\Models\Order;
use Faker\Provider\ar_EG\Text;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

use MoonShine\Fields\Json;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

class CharacteristicsResource extends ModelResource
{
  protected string $model = Characteristic::class;

  protected string $title = 'Характеристики';



  public function fields(): array
  {
    return [
      Block::make([
       \MoonShine\Fields\Text::make('название', 'name')
        ])

    ];
  }

  public function rules(Model $item): array
  {
    return [

    ];
  }


}
