@props(['actions' => [], 'model' => null])

<x-lv-drop-down>
  <x-slot name="trigger">
    <x-lv-icon-button icon="align-right" size="sm"/>
  </x-slot>
  <x-lv-actions.icon-and-title :actions="$actions" :model="$model" />
</x-lv-drop-down>
