<!-- Modal Add/Edit -->
<div x-show="showModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div x-show="showModal" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="showModal = false"
             class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

       <!-- Modal panel -->
        <div x-show="showModal"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            
            <form :action="editMode ? '/buku/' + editId : '/buku'" method="POST">
                @csrf
                <input type="hidden" name="_method" x-bind:value="editMode ? 'PUT' : 'POST'">
                
                <div class="bg-white px-8 pt-8 pb-4">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-gray-900" x-text="editMode ? 'Edit Buku' : 'Tambah Buku Baru'"></h3>
                        <button type="button" @click="showModal = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-5">
                        <!-- Judul Buku -->
                        <div>
                            <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">Judul Buku</label>
                            <input type="text" 
                                name="judul" 
                                id="judul" 
                                :value="formData.judul"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                placeholder="Masukkan judul buku"
                                required>
                        </div>

                        <!-- Kode Buku -->
                        <div>
                            <label for="code" class="block text-sm font-semibold text-gray-700 mb-2">Kode Buku</label>
                            <input type="text" 
                                name="code" 
                                id="code" 
                                :value="formData.code"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                placeholder="Masukan Kode Buku Minimal 5 Karakter"
                                required>
                        </div>

                        <!-- Penulis -->
                        <div>
                            <label for="penulis" class="block text-sm font-semibold text-gray-700 mb-2">Penulis</label>
                            <input type="text" 
                                name="penulis" 
                                id="penulis" 
                                :value="formData.penulis"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                placeholder="Nama penulis"
                                required>
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                            <select name="category_id" 
                                    id="category_id" 
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                    required>
                                <option value="">Pilih Kategori</option>
                                @foreach(\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}" :selected="formData.category_id == {{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tahun Terbit -->
                        <div>
                            <label for="tahun_terbit" class="block text-sm font-semibold text-gray-700 mb-2">Tahun Terbit</label>
                            <input type="number" 
                                name="tahun_terbit" 
                                id="tahun_terbit" 
                                :value="formData.tahun_terbit"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                placeholder="2024"
                                min="1900" 
                                max="2099"
                                required>
                        </div>

                        <!-- Body/Deskripsi -->
                        <div>
                            <label for="body" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                            <textarea name="body" 
                                    id="body" 
                                    rows="4" 
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none" 
                                    placeholder="Deskripsi singkat tentang buku..."
                                    required
                                    x-text="formData.body"></textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-8 py-5 sm:flex sm:flex-row-reverse gap-3">
                    <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/50 transition-all shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span x-text="editMode ? 'Update Buku' : 'Simpan Buku'"></span>
                    </button>
                    <button type="button" @click="showModal = false" class="mt-3 sm:mt-0 w-full sm:w-auto inline-flex justify-center px-6 py-3 bg-white text-gray-700 font-semibold rounded-xl hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-300 transition-all border-2 border-gray-200">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>