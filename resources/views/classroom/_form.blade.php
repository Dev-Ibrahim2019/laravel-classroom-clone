 <div class="space-y-12">
     <div class="border-b border-gray-900/10 pb-12">
         <h2 class="text-2xl font-semibold text-gray-900">Edit Classroom</h2>
         <p class="mt-1 text-sm/6 text-gray-600">Here you can create a new classroom</p>

         <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
             <x-form-input label="Class Name" name="name" :value="old('name', $classroom->name)" placeholder="e.g., Biology 101" />
             <x-form-input label="Section" name="section" :value="old('section', $classroom->section)" placeholder="e.g., A" />
             <x-form-input label="Subject" name="subject" :value="old('subject', $classroom->subject)" placeholder="e.g., Science" />
             <x-form-input label="Room" name="room" :value="old('room', $classroom->room)" placeholder="e.g., 205" />
             <x-form-input type="file" label="Cover Image" name="cover_image" />
             @if ($classroom->cover_image_path)
                 <p class="text-sm text-gray-500 mt-2">Current image: <a
                         href="{{ Storage::disk('public')->url($classroom->cover_image_path) }}" target="_blank"
                         class="text-blue-500 hover:underline">View</a></p>
             @endif
             @error('cover_image')
                 <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
             @enderror
         </div>
     </div>
 </div>
 <div class="mt-6 flex items-center justify-end gap-x-6">
     <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
     <x-primary-btn>{{ $action ?? 'Save' }}</x-primary-btn>
      </div>
