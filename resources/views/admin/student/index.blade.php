<x-app-layout>
    <div class="p-6" x-data="studentForm()">
        <!-- Button to open the modal -->
        <div class="w-full bg-gray-200">
            <button @click="open = true" class="bg-blue-600 text-white px-4 py-2 rounded">
            Register New Student
            </button>
        </div>
        

        @include('admin.student.create-student') {{-- This has the modal HTML --}}
    

        <!-- Success Message -->
        <template x-if="successMessage">
            <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded" 
                 x-text="successMessage">
            </div>
        </template>

    <div class="w-full flex items-center justify-center min-h-screen p-6">
        <table id="users-table" class="min-w-full h-full divide-y divide-gray-200 border w-full border-gray-300 rounded-md shadow-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">#</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Action</th>
            </tr>
        </thead>
    <tbody class="bg-white divide-y divide-gray-200"></tbody>
</table>
    </div>

    </div>

    <!-- AlpineJS Component Script -->
    <script>
   $('#users-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{{ route('students.data') }}',
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'names', name: 'name' },
        { data: 'email', name: 'email' },
        { data: 'action', name: 'action', orderable: false, searchable: false },
    ],
    dom: 'rt<"flex justify-between items-center mt-4"ip>',
});

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
