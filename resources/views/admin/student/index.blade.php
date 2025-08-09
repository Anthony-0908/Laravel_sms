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


    <table class="table" id="users-table">
   <table id="users-table" class="min-w-full divide-y divide-gray-200 border border-gray-300 rounded-md shadow-sm">
    <thead class="bg-gray-100">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                #
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                Name
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                Email
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                Action
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        {{-- DataTables will inject rows here --}}
    </tbody>
</table>
    </div>

    <!-- AlpineJS Component Script -->
    <script>

    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('students.data') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        dom: 'rt<"flex justify-between items-center mt-4"ip>', // minimal DOM elements for paging info & pagination styled by Tailwind
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
