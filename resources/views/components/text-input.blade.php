@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-suText focus:border-suText focus:ring-suText rounded-md shadow-sm bg-transparent text-suText']) }}>
