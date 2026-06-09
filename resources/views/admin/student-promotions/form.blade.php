@extends('components.dashmaster')

@section('body')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Promote Selected Students</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="mb-3">
                <p class="text-muted">Academic Year: {{ $currentYear }} → {{ $currentYear + 1 }}</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Validation Errors:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Select Students for Promotion</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.promotions.promote') }}" method="POST" id="promotionForm">
                                @csrf

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="filterClass" class="form-label">Filter by Class:</label>
                                            <select class="form-control" id="filterClass">
                                                <option value="">-- All Classes --</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <button type="button" class="btn btn-secondary w-100" id="selectAllBtn">
                                                <i class="fas fa-check-square"></i> Select All Visible
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover" id="studentsTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="50">
                                                    <input type="checkbox" id="selectAllCheckbox" class="form-check-input" title="Select all visible students">
                                                </th>
                                                <th>#</th>
                                                <th>Student Name</th>
                                                <th>Email</th>
                                                <th>Current Class</th>
                                                <th>Promote To Class *</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $index = 0; @endphp
                                            @forelse ($classes as $class)
                                                @forelse ($class->students as $student)
                                                    <tr class="student-row" data-class-id="{{ $class->id }}" data-student-id="{{ $student->id }}" data-row-index="{{ $index }}">
                                                        <td>
                                                            <input type="checkbox" class="form-check-input student-checkbox"
                                                                   data-row-index="{{ $index }}">
                                                        </td>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $student->name }}</td>
                                                        <td>{{ $student->email }}</td>
                                                        <td>
                                                            <span class="badge bg-secondary">{{ $class->name }}</span>
                                                        </td>
                                                        <td>
                                                            <select class="form-control form-control-sm to-class-select"
                                                                    data-row-index="{{ $index }}">
                                                                <option value="">-- Select Class --</option>
                                                                @foreach ($classes as $targetClass)
                                                                    @if ($targetClass->id !== $class->id)
                                                                        <option value="{{ $targetClass->id }}">
                                                                            {{ $targetClass->name }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                            <input type="hidden" class="student-id-input" value="{{ $student->id }}">
                                                        </td>
                                                    </tr>
                                                    @php $index++; @endphp
                                                @empty
                                                @endforelse
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted">
                                                        No students found in any class.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success btn-lg" id="promoteBtn">
                                            <i class="fas fa-graduation-cap"></i> Promote Selected Students
                                        </button>
                                        <a href="{{ route('admin.promotions.index') }}" class="btn btn-secondary btn-lg">
                                            <i class="fas fa-arrow-left"></i> Back
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz">Visit Our Website</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      {{-- <b>Version</b> 3.2.0 --}}
    </div>
</footer>

<script>
    document.getElementById("currentYear").textContent = new Date().getFullYear();

    document.addEventListener('DOMContentLoaded', function() {
        const promotionForm = document.getElementById('promotionForm');
        const selectAllCheckbox = document.getElementById('selectAllCheckbox');
        const studentCheckboxes = document.querySelectorAll('.student-checkbox');
        const filterClass = document.getElementById('filterClass');
        const selectAllBtn = document.getElementById('selectAllBtn');
        const studentRows = document.querySelectorAll('.student-row');

        // Filter by class functionality
        filterClass.addEventListener('change', function() {
            const selectedClassId = this.value;

            studentRows.forEach(row => {
                if (!selectedClassId || row.dataset.classId === selectedClassId) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            selectAllCheckbox.checked = false;
        });

        // Select all visible students button
        selectAllBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const visibleCheckboxes = Array.from(studentCheckboxes).filter(cb => {
                return cb.closest('tr').style.display !== 'none';
            });

            const allChecked = visibleCheckboxes.every(cb => cb.checked);
            visibleCheckboxes.forEach(cb => {
                cb.checked = !allChecked;
            });
        });

        // Select all checkbox in header
        selectAllCheckbox.addEventListener('change', function() {
            const visibleCheckboxes = Array.from(studentCheckboxes).filter(cb => {
                return cb.closest('tr').style.display !== 'none';
            });

            visibleCheckboxes.forEach(cb => {
                cb.checked = this.checked;
            });
        });

        // Update header checkbox when individual checkboxes change
        studentCheckboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                const visibleCheckboxes = Array.from(studentCheckboxes).filter(chk => {
                    return chk.closest('tr').style.display !== 'none';
                });

                selectAllCheckbox.checked = visibleCheckboxes.length > 0 &&
                                           visibleCheckboxes.every(chk => chk.checked);
            });
        });

        // Form submission
        promotionForm.addEventListener('submit', function(e) {
            e.preventDefault();

            let promotions = [];
            let checkedCount = 0;
            let hasError = false;

            studentCheckboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    const row = checkbox.closest('tr');
                    const toClassSelect = row.querySelector('.to-class-select');
                    const studentIdInput = row.querySelector('.student-id-input');
                    const toClassId = toClassSelect.value;
                    const studentId = studentIdInput.value;

                    if (!toClassId) {
                        hasError = true;
                        return;
                    }

                    promotions.push({
                        student_id: studentId,
                        to_class_id: toClassId
                    });
                    checkedCount++;
                }
            });

            if (hasError) {
                alert('Please select a target class for all checked students.');
                return;
            }

            if (checkedCount === 0) {
                alert('Please select at least one student to promote.');
                return;
            }

            // Remove any existing promotion inputs
            document.querySelectorAll('input[name^="promotions"]').forEach(input => input.remove());

            // Add new promotion inputs
            let index = 0;
            promotions.forEach((promo) => {
                const input1 = document.createElement('input');
                input1.type = 'hidden';
                input1.name = 'promotions[' + index + '][student_id]';
                input1.value = promo.student_id;
                promotionForm.appendChild(input1);

                const input2 = document.createElement('input');
                input2.type = 'hidden';
                input2.name = 'promotions[' + index + '][to_class_id]';
                input2.value = promo.to_class_id;
                promotionForm.appendChild(input2);

                index++;
            });

            // Submit the form
            promotionForm.submit();
        });
    });
</script>

<style>
    .form-control {
        border: 1px solid #ced4da;
    }

    .form-control.is-invalid {
        border-color: #dc3545;
        background-color: #fff5f5;
    }
</style>
@endsection
