{{-- components.form.input-group.blade

Renders a input group component
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIERE DIRECTIVES

props:
 - $label
 - $name
 - $placeholder
 - $value
 - $model
 - $id
 - $onClick
 - $icon
--}}

<div class="relative text-left mb-4">
    <label class="block">
        {{ $label ?? '' }}
    </label>
    <input
        class="appearance-none w-full bg-white border-gray-300 hover:border-gray-500 px-3 py-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 focus:border-2 border text-gray-700"
        type="text"
        name="{{ $name ?? '' }}"
        placeholder="{{ $placeholder ?? ''}}"
        autocomplete="off"
        @if (isset($id))
            id="{{ $id ?? ''}}"
        @endif
        wire:model="{{ $model ?? '' }}"
    >
    <div class="absolute right-0 mr-2 text-purple-lighter" style="top:18%">
        <a wire:click.prevent="{{ $onClick ?? '' }}" href="#" class="text-gray-400 hover:text-blue-600">
            <i data-feather="{{ $icon }}" class="w-4"></i>
        </a>
    </div>
</div>
