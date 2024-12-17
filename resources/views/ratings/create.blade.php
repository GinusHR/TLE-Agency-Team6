<form action="{{ route('ratings.store', ['vacature' => $vacature->id]) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="rating">Rating (0-5)</label>
        <input type="number" name="rating" id="rating" step="0.1" min="0" max="5" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="review">Review</label>
        <textarea name="review" id="review" class="form-control" rows="4"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
</form>
