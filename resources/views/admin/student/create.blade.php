<x-app-layout>
    <div x-data="studentForm()" class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-xl">

        <h2 class="text-2xl font-semibold mb-6">Register Student</h2>

        <template x-if="successMessage">
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                <span x-text="successMessage"></span>
            </div>
        </template>

        <form @submit.prevent="submitForm">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" x-model="form.name" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" x-model="form.email" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" x-model="form.password" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Student ID</label>
                <input type="text" x-model="form.student_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div>

            <div class="flex justify-end gap-2 mt-6">
                <a href="{{ route('students.index') }}"
                   class="bg-gray-400 hover:bg-gray-500 text-black px-4 py-2 rounded">
                    Cancel
                </a>
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Register
                </button>
            </div>
        </form>
    </div>

    <script>
        function studentForm() {
            return {
                successMessage: '',
                form: {
                    name: '',
                    email: '',
                    phone_no:'',
                    gender:'',
                    birthdate:'',
                    password: '',
                    grade:'',
                    section:'',
                    enrollment_date:'',
                    status_id:'',

                
                    student_id: ''
                },
                async submitForm() {
                    try {
                        const response = await fetch("{{ route('students.store') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(this.form)
                        });

                        if (!response.ok) throw new Error('Failed to register student');

                        const result = await response.json();
                        this.successMessage = result.message || 'Student registered successfully.';

                        // clear form
                        this.form = { name: '', email: '', password: '', student_id: '' };

                        // if you want, redirect back to list:
                        // window.location.href = "{{ route('students.index') }}";

                    } catch (error) {
                        console.error(error);
                        alert('There was an error submitting the form.');
                    }
                }
            };
        }
    </script>
</x-app-layout>
