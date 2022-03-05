<select name="category_id" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
    <option selected value="0">Select Category</option>
    @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ $selectedCategory == $category->id ? 'selected="selected"' : '' }}>{{ $category->name }}</option>
    @endforeach
</select>
