<x-app-layout>
    <div class="p-6" x-data="studentForm()">
        
        <!-- Top Bar -->
        <div class="card flex justify-between items-center mb-6">
            <h1 class="text-xl font-semibold text-gray-700">Students</h1>
            <a href="{{ route('students.create') }}"
                class="btn-primary">
                    Register New Student
            </a>
        </div>

        {{-- <!-- Include Modal -->
        @include('admin.student.create') --}}

        <!-- Success Message -->
        <template x-if="successMessage">
            <div 
                class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700 shadow-sm"
                x-text="successMessage">
            </div>
        </template>

        <!-- Data Table Card -->
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
            <table id="studentsTable" class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">#</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100"></tbody>
            </table>
        </div>

    </div>

    <!-- DataTables Script -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let dt = new DataTable('#studentsTable', {
                processing: true,
                serverSide: true,
                ajax: '{{ route('students.data') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                dom: '<"flex justify-between items-center mb-4"lf>rt<"flex justify-between items-center mt-4"ip>',
                stripeClasses: [],
                createdRow: (row) => {
                    $(row).addClass('hover:bg-gray-50');
                    $('td', row).addClass('px-4 py-3');
                },
                headerCallback: (thead) => {
                    $(thead).find('th').addClass('px-4 py-3');
                }
            });

            // Style controls with Tailwind
            function styleControls() {
                $('.dt-length select').addClass('rounded-lg border border-gray-300 bg-white px-2 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500');
                $('.dt-search input').addClass('rounded-lg border border-gray-300 bg-white px-3 py-1 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500');
                $('.dt-info').addClass('text-sm text-gray-500');
                $('.dt-paging button')
                    .addClass('rounded-lg border border-gray-300 bg-white px-3 py-1 text-sm shadow-sm hover:bg-gray-50')
                    .filter('.current')
                    .addClass('bg-indigo-600 text-white border-transparent');
            }

            styleControls();
            dt.on('draw', styleControls);
        });
    </script>
</x-app-layout>
