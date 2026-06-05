<!-- @extends('layouts.sidebar')

@section('title', $ingredient->name)

@section('content')
<div class="container">
    <h2>{{ $ingredient->name }}</h2>
    <p><strong>Quantity:</strong> {{ $ingredient->quantity }}</p>
    <p><strong>Unit:</strong> {{ $ingredient->unit ?? 'N/A' }}</p>
    <p><strong>Recipe:</strong> 
        <a href="{{ route('recipes.show', $ingredient->recipe_id) }}">
            {{ $ingredient->recipe->name }}
        </a>
    </p>

    <a href="{{ route('ingredients.edit', $ingredient->id) }}" class="btn btn-primary">Edit</a>
    <a href="{{ route('recipes.show', $ingredient->recipe_id) }}" class="btn btn-secondary">Back to Recipe</a>
</div>
@endsection -->