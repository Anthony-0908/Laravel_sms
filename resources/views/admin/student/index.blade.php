<x-app-layout>
    <div class="p-6" x-data="studentForm()">
        <!-- Button to open the modal -->
        <button @click="open = true" class="bg-blue-600 text-white px-4 py-2 rounded">
            Register New Student
        </button>

        @include('admin.student.create-student') {{-- This has the modal HTML --}}

        <!-- Success Message -->
        <template x-if="successMessage">
            <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded" 
                 x-text="successMessage">
            </div>
        </template>
    </div>

    <!-- AlpineJS Component Script -->
    <script>
        function studentForm() {
            return {
                open: false,
                successMessage: '',
                form: {
                    name: '',
                    email: '',
                    password: '',
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
                        this.open = false;

                        this.form = { name: '', email: '', password: '', student_id: '' };

                    } catch (error) {
                        console.error(error);
                        alert('There was an error submitting the form.');
                    }
                }
            };
        }
    </script>
</x-app-layout>
