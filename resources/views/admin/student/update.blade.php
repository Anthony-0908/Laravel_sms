<x-app-layout>
    <div x-data="updateStudentForm()" class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-xl">
        <h2 class="text-2xl font-semibold mb-6">Update Student</h2>

        <!-- Success Message -->
        <template x-if="successMessage">
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                <span x-text="successMessage"></span>
            </div>
        </template>

        <!-- Update Form -->
        <form @submit.prevent="submitForm">
            <!-- Name -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" x-model="form.name"
                       :class="errors.name ? 'border-red-500' : 'border-gray-300'"
                       class="mt-1 block w-full rounded-md shadow-sm" />
                <template x-if="errors.name">
                    <p class="text-sm text-red-600 mt-1" x-text="errors.name[0]"></p>
                </template>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" x-model="form.email"
                       :class="errors.email ? 'border-red-500' : 'border-gray-300'"
                       class="mt-1 block w-full rounded-md shadow-sm" />
                <template x-if="errors.email">
                    <p class="text-sm text-red-600 mt-1" x-text="errors.email[0]"></p>
                </template>
            </div>

            <!-- Address -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" x-model="form.address"
                       :class="errors.address ? 'border-red-500' : 'border-gray-300'"
                       class="mt-1 block w-full rounded-md shadow-sm" />
                <template x-if="errors.address">
                    <p class="text-sm text-red-600 mt-1" x-text="errors.address[0]"></p>
                </template>
            </div>

            <!-- Phone -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" x-model="form.phone_no"
                       :class="errors.phone_no ? 'border-red-500' : 'border-gray-300'"
                       class="mt-1 block w-full rounded-md shadow-sm" />
                <template x-if="errors.phone_no">
                    <p class="text-sm text-red-600 mt-1" x-text="errors.phone_no[0]"></p>
                </template>
            </div>

            <!-- Gender -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Gender</label>
                <select x-model="form.gender"
                        :class="errors.gender ? 'border-red-500' : 'border-gray-300'"
                        class="block w-full rounded-md shadow-md">
                    <option value="">Select Gender</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
                <template x-if="errors.gender">
                    <p class="text-sm text-red-600 mt-1" x-text="errors.gender[0]"></p>
                </template>
            </div>

            <!-- Birthdate -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Birthdate</label>
                <input type="date" x-model="form.birthdate"
                       :class="errors.birthdate ? 'border-red-500' : 'border-gray-300'"
                       class="block w-full rounded-md shadow-md" />
                <template x-if="errors.birthdate">
                    <p class="text-sm text-red-600 mt-1" x-text="errors.birthdate[0]"></p>
                </template>
            </div>

            <!-- Student ID -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Student ID</label>
                <input type="text"
                       x-model="form.student_id"
                       @input="form.student_id = form.student_id.replace(/^STU-?/, ''); form.student_id = 'STU-' + form.student_id"
                       :class="errors.student_id ? 'border-red-500' : 'border-gray-300'"
                       class="mt-1 block w-full rounded-md shadow-sm" />
                <template x-if="errors.student_id">
                    <p class="text-sm text-red-600 mt-1" x-text="errors.student_id[0]"></p>
                </template>
            </div>

            <!-- Grade -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Grade</label>
                <select x-model="form.grade"
                        :class="errors.grade ? 'border-red-500' : 'border-gray-300'"
                        class="block w-full rounded-md shadow-md">
                    <option value="">Select Grade</option>
                    <option value="7">Grade 7</option>
                    <option value="8">Grade 8</option>
                    <option value="9">Grade 9</option>
                    <option value="10">Grade 10</option>
                </select>
                <template x-if="errors.grade">
                    <p class="text-sm text-red-600 mt-1" x-text="errors.grade[0]"></p>
                </template>
            </div>

            <!-- Section -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Section</label>
                <select x-model="form.section"
                        :class="errors.section ? 'border-red-500' : 'border-gray-300'"
                        class="block w-full rounded-md shadow-md">
                    <option value="">Select Section</option>
                    <option value="A">Section A</option>
                    <option value="B">Section B</option>
                    <option value="C">Section C</option>
                </select>
                <template x-if="errors.section">
                    <p class="text-sm text-red-600 mt-1" x-text="errors.section[0]"></p>
                </template>
            </div>

            <!-- Enrollment Status -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Enrollment Status</label>
                <select x-model="form.status_id"
                        :class="errors.status_id ? 'border-red-500' : 'border-gray-300'"
                        class="block w-full rounded-md shadow-md">
                    @foreach ($studentStatus as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                <template x-if="errors.status_id">
                    <p class="text-sm text-red-600 mt-1" x-text="errors.status_id[0]"></p>
                </template>
            </div>

            <!-- Enrollment Date -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Enrollment Date</label>
                <input type="date" x-model="form.enrollment_date"
                       :class="errors.enrollment_date ? 'border-red-500' : 'border-gray-300'"
                       class="block w-full rounded-md shadow-md" />
                <template x-if="errors.enrollment_date">
                    <p class="text-sm text-red-600 mt-1" x-text="errors.enrollment_date[0]"></p>
                </template>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Password (Leave blank to keep current)</label>
                <input type="password" x-model="form.password"
                       class="mt-1 block w-full rounded-md shadow-sm" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" x-model="form.confirm_password"
                       class="mt-1 block w-full rounded-md shadow-sm" />
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-2 mt-6">
                <a href="{{ route('students.index') }}"
                   class="bg-gray-400 hover:bg-gray-500 text-black px-4 py-2 rounded">
                    Cancel
                </a>
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Update
                </button>
            </div>
        </form>
    </div>

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        function updateStudentForm() {
            return {
                successMessage: '',
                errors: {},
                form: {
                    name: '{{ $user->name }}',
                    email: '{{ $user->email }}',
                    address: '{{ $user->student->address ?? "" }}',
                    phone_no: '{{ $user->student->phone_no ?? "" }}',
                    gender: '{{ $user->student->gender ?? "" }}',
                    birthdate: '{{ $user->student->birthdate ?? "" }}',
                    student_id: '{{ $user->student->student_id ?? "" }}',
                    grade: '{{ $user->student->grade ?? "" }}',
                    section: '{{ $user->student->section ?? "" }}',
                    status_id: '{{ $user->student->status_id ?? "" }}',
                    enrollment_date: '{{ $user->student->enrollment_date ?? "" }}',
                    password: '',
                    confirm_password: ''
                },
                async submitForm() {
                    try {
                        const response = await fetch("{{ route('students.update', $user->id) }}", {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(this.form)
                        });

                        if (response.status === 422) {
                            const result = await response.json();
                            this.errors = result.errors;

                            Toast.fire({
                                icon: "error",
                                title: "Please fix the validation errors."
                            });
                            return;
                        }

                        if (!response.ok) throw new Error('Failed to update student');

                        const result = await response.json();
                        this.successMessage = result.message || 'Student updated successfully.';

                        Toast.fire({
                            icon: "success",
                            title: this.successMessage
                        });

                        this.errors = {}; // clear errors

                    } catch (error) {
                        console.error(error);
                        Toast.fire({
                            icon: "error",
                            title: "There was an error updating the student."
                        });
                    }
                }
            }
        }
    </script>
</x-app-layout>
