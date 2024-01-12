@props(['actions', 'model'])

@foreach ($actions as $action)
    @if ($action->renderIf($model, $this))
        <x-lv-tooltip :tooltip="$action->title">
            @if(property_exists($action, 'modalView'))
                <x-lv-icon-button :icon="$action->icon" size="sm"
                                  wire:click.prevent="$emit('openModal', '{{$action->modalView}}', {{json_encode(['model'=>$model])}})"/>
            @else
                <x-lv-icon-button :icon="$action->icon" size="sm"
                                  wire:click.prevent="executeAction('{{ $action->id }}', '{{ $model->getKey() }}')"/>
            @endif
        </x-lv-tooltip>
    @endif
@endforeach
