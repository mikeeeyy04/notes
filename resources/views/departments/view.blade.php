@foreach ($departments as $department)
    <div>
        <div class="modal fade" id="viewDepartment{{ $department->id }}" tabindex="-1"
            aria-labelledby="viewDepartmentModalLabel{{ $department->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewDepartmentModalLabel{{ $department->id }}">
                            View Department Details
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        {!! Form::model($department, [
                            'method' => 'PATCH',
                            'route' => ['departments.update', $department->id],
                            'files' => true,
                        ]) !!}

                        <div class="mb-3">
                            {{ Form::label('name', 'Department Name') }}
                            {{ Form::text('name', $department->name, ['class' => 'form-control']) }}
                        </div>

                        <h6 class="mt-4">Employees in this Department:</h6>

                        @if ($department->employees->count())
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Employee Name</th>
                                            <th>Age</th>
                                            <th>Birthday</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($department->employees as $index => $employee)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ ($employee->firstName ?? '') . ' ' . ($employee->middleName ?? '') . ' ' . ($employee->lastName ?? '') }}
                                                </td>
                                                <td>{{ $employee->age ?? '-' }}</td>
                                                <td>{{ $employee->birthday ? \Carbon\Carbon::parse($employee->birthday)->format('F d, Y') : '' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted">No employees found in this department.</p>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        {{-- Optional: Delete button with confirmation modal --}}
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" data-bs-toggle="modal"
                            data-bs-target="#deleteDepartment{{ $department->id }}">
                            Delete
                        </button>

                        {{ Form::button('<i class="bi bi-save me-2"></i> Save', ['class' => 'btn btn-dark', 'type' => 'submit']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div>
        <div class="modal fade" id="deleteDepartment{{ $department->id }}" tabindex="-1"
            aria-labelledby="deleteDepartmentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteDepartmentModalLabel">Delete Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="bold">"<strong>{{ $department->name }}</strong>"</span> department will be
                        deleted permanently. Are you sure?
                        {!! Form::model($department, ['method' => 'delete', 'route' => ['departments.destroy', $department->id]]) !!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        {{ Form::button('<i class="bi bi-trash me-2"></i> Delete', ['class' => 'btn btn-danger', 'type' => 'submit']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
