<x-app-layout>
    <div class="py-8 max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Edit Course</h1>

        <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5 bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold mb-1">Title</label>
                <input type="text" name="title" value="{{ $course->title }}" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Description</label>
                <textarea name="description" rows="4" class="w-full border rounded p-2">{{ $course->description }}</textarea>
            </div>

            <div>
                <label class="block font-semibold mb-1">Status</label>
                <select name="status" class="w-full border rounded p-2">
                    <option value="draft" {{ $course->status == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ $course->status == 'published' ? 'selected' : '' }}>Published</option>
                </select>
            </div>

            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                Update Course
            </button>
        </form>
    </div>
</x-app-layout>
