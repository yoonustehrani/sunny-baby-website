<?php

namespace App\Livewire;

use App\Livewire\Forms\CheckoutForm;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class SearchModelInput extends Component
{
    public string $modelClass;
    public string $keys = 'name';
    public string $name;
    public string $label;
    public int|string|null $value = null;
    public ?string $where;
    public string $search = '';
    public ?Collection $results;
    public bool $required = false;

    public function mount()
    {
        $query = app($this->modelClass)->orderBy($this->getSearchKeys()[0]);
        if (isset($this->where)) {
            $query->whereRaw($this->where);
        }
        $this->results = $query->get();
    }

    protected function getSearchKeys()
    {
        return explode(',', $this->keys);
    }

    public function select(int|string $id)
    {
        if ($this->value == $id) {
            $this->unselect();
            return;
        }
        $this->dispatch("select.option.{$this->name}", id: $id);
        $this->value = $id;
    }

    public function unselect()
    {
        $this->value = null;
        $this->dispatch("unselect.option.{$this->name}");
    }

    public function updatedSearch()
    {
        if (strlen($this->search) < 2) {
            if (isset($this->results))
                unset($this->results);
            return;
        }
        /**
         * @var \Illuminate\Database\Eloquent\Model $model
         */
        $model = app($this->modelClass)->query();
        $model->where(function(Builder $query) {
            for ($i=0; $i < count($this->getSearchKeys()); $i++) { 
                if ($i == 0) {
                    $query->where($this->getSearchKeys()[$i], 'like', "%{$this->search}%");
                } else {
                    $query->orWhere($this->getSearchKeys()[$i], 'like', "%{$this->search}%");
                }
            }
        });
        if (isset($this->where)) {
            $model->whereRaw($this->where);
        }
        $this->results = $model->orderBy($this->getSearchKeys()[0])->get();
    }

    public function render()
    {
        $view = view('livewire.search-model-input', [
            'mainKey' => $this->getSearchKeys()[0]
        ]);
        $option = $this->value ? [
            'id' => $this->value,
            'name' => app($this->modelClass)->find($this->value)->{$this->getSearchKeys()[0]}
        ] : null;
        $view->with('option', $option);
        return $view;
    }
}
