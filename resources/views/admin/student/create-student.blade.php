<!-- Modal -->
<div x-show="open" x-cloak
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div @click.away="open = false"
         class="bg-white p-6 rounded-lg shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-90"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-90">

        <h2 class="text-xl font-semibold mb-4">Register Student</h2>

        <form @submit.prevent="submitForm">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" x-model="form.name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" x-model="form.email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" x-model="form.password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Student ID</label>
                <input type="text" x-model="form.student_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div>

            <div class="flex justify-end gap-2 mt-6">
                <button type="button"
                    @click="open = false"
                    class="bg-gray-400 hover:bg-gray-500 text-black px-4 py-2 rounded">
                    Cancel
                </button>
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Register
                </button>
            </div>
        </form>
    </div>
</div>
