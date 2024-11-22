<form method="POST" action="{{ route('admin.saveshare') }}">
    @csrf
    <div class="form-group">
        <label for="rate">Share Rate</label>
        <input type="number" step="0.01" name="rate" class="form-control w-50" id="rate"
            value="{{ old('rate', $shareRate ? $shareRate->rate : '') }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Save Share Rate</button>
</form>
