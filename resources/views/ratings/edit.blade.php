
<form action="{{ route('ratings.update', $rating->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="rating">Beoordeling</label>
        <input type="number" name="rating" id="rating" value="{{ $rating->rating }}" min="1" max="5" required>
    </div>

    <div>
        <label for="review">Review</label>
        <textarea name="review" id="review" required>{{ $rating->review }}</textarea>
    </div>

    <button type="submit">Beoordeling Bijwerken</button>
</form>
