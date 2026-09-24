@props([
    'name',
    'id' => null,
    'label' => null,
    'type' => 'text',
    'placeholder' => '',
    'value' => null,
    'required' => false,
    'error' => null,
    'hint' => null,
])

@php
    $inputId = $id ?: $name;
    $hasError = $error || ($errors ?? null && $errors->has($name));
    $errorMessage = $error ?: ($errors ?? null ? $errors->first($name) : null);
@endphp

<div class="w-full flex flex-col gap-1.5">
    @if($label)
        <label for="{{ $inputId }}" class="font-headline text-xs sm:text-sm font-semibold text-slate-700 flex items-center justify-between">
            <span>
                {{ $label }}
                @if($required)
                    <span class="text-rose-500" aria-hidden="true">*</span>
                @endif
            </span>
        </label>
    @endif

    <div class="relative">
        <input 
            type="{{ $type }}" 
            name="{{ $name }}" 
            id="{{ $inputId }}" 
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            @if($required) required aria-required="true" @endif
            @if($hasError) aria-invalid="true" aria-describedby="{{ $inputId }}-error" @endif
            {{ $attributes->merge([
                'class' => 'w-full px-3.5 py-2.5 rounded-xl border bg-white text-slate-900 placeholder:text-slate-400 font-body text-base sm:text-sm transition-all focus:outline-none focus:ring-2 ' . 
                    ($hasError 
                        ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-500/20' 
                        : 'border-slate-300 focus:border-primary focus:ring-primary/20 hover:border-slate-400')
            ]) }}
        />
    </div>

    @if($hasError && $errorMessage)
        <p id="{{ $inputId }}-error" class="text-xs text-rose-600 font-medium flex items-center gap-1 mt-0.5" role="alert">
            <span class="material-symbols-outlined text-[14px]">error</span>
            <span>{{ $errorMessage }}</span>
        </p>
    @elseif($hint)
        <p class="text-xs text-slate-500 mt-0.5">{{ $hint }}</p>
    @endif
</div>
