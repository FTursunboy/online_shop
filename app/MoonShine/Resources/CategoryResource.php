<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Faker\Provider\ar_EG\Text;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

class CategoryResource extends ModelResource
{
    protected string $model = Category::class;

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $showInModal = true;

    protected string $title = 'Категории';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make('id'),
                \MoonShine\Fields\Text::make('название', 'name')
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
