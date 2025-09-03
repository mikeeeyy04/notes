@foreach ($employees as $employees)
    <div>
        <div class="modal fade" id="viewEmployee{{ $employees->id }}" tabindex="-1"
            aria-labelledby="viewEmployeeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewEmployeeModalLabel">View Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {!! Form::model($employees, [
                            'method' => 'patch',
                            'route' => ['employees.update', $employees->id],
                            'files' => true,
                        ]) !!}

                        <div class='mb-3'>
                            {{ Form::label('firstName', 'First Name') }}
                            {{ Form::text('firstName', $employees->firstName, ['class' => 'form-control']) }}
                        </div>
                        <div class='mb-3'>
                            {{ Form::label('middleName', 'Middle Name') }}
                            {{ Form::text('middleName', $employees->middleName, ['class' => 'form-control']) }}
                        </div>
                        <div class='mb-3'>
                            {{ Form::label('lastName', 'Last Name') }}
                            {{ Form::text('lastName', $employees->lastName, ['class' => 'form-control']) }}
                        </div>
                        <div class='mb-3'>
                            {{ Form::label('department_id', 'Department') }}
                            {{ Form::select('department_id', $departments->pluck('name', 'id'), $employees->department_id, ['class' => 'form-control', 'placeholder' => 'Select Department']) }}
                        </div>
                        <div class='input-group mb-3'>
                            <span class="input-group-text">₱</span>
                            {{ Form::number('salary', $employees->salary, ['class' => 'form-control', 'placeholder' => 'Salary per hour']) }}
                            <span class="input-group-text">.00</span>
                        </div>
                        @php
                            $today = date('Y-m-d');
                        @endphp
                        <div class='mb-3'>
                            {{ Form::label('birthday', 'Birthday') }}
                            {{ Form::date(
                                'birthday',
                                $employees->birthday ? \Carbon\Carbon::parse($employees->birthday)->format('Y-m-d') : '',
                                [
                                    'class' => 'form-control birthday',
                                    'placeholder' => 'Birthday',
                                    'max' => $today,
                                ],
                            ) }}
                        </div>
                        <div class='mb-3'>
                            {{ Form::label('age', 'Age') }}
                            {{ Form::text('age', $employees->age, [
                                'class' => 'form-control age',
                                'readonly' => true,
                            ]) }}
                        </div>
                        <div class='mb-3'>
                            {{ Form::label('image', 'Profile Image') }}
                            {{ Form::file('image', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" data-bs-toggle="modal"
                            data-bs-target="#deleteemployee{{ $employees->id }}">Delete</button>
                        {{ Form::button('<i class="bi bi-save me-2"></i> Save', ['class' => 'btn btn-dark', 'type' => 'submit']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- @include('employees.script') --}}

    <div>
        <div class="modal fade" id="deleteemployee{{ $employees->id }}" tabindex="-1"
            aria-labelledby="deleteemployeeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteemployeeModalLabel">Delete Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span
                            class="bold">"<strong>{{ ($employee->firstName ?? '') . ' ' . ($employee->middleName ?? '') . ' ' . ($employee->lastName ?? '') }}</strong>"</span>
                        employee will be deleted
                        permanently. Are you sure?
                        {!! Form::model($employees, ['method' => 'delete', 'route' => ['employees.destroy', $employees->id]]) !!}
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
