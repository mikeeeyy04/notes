<div class="modal fade" id="addEmployee" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmployeeModalLabel">Add Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'employees/save', 'enctype' => 'multipart/form-data']) !!}
                <div class='mb-3'>
                    {{ Form::label('firstName', 'First Name') }}
                    {{ Form::text('firstName', '', ['class' => 'form-control', 'placeholder' => 'First Name']) }}
                </div>
                <div class='mb-3'>
                    {{ Form::label('middleName', 'Middle Name') }}
                    {{ Form::text('middleName', '', ['class' => 'form-control', 'placeholder' => 'Middle Name']) }}
                </div>
                <div class='mb-3'>
                    {{ Form::label('lastName', 'Last Name') }}
                    {{ Form::text('lastName', '', ['class' => 'form-control', 'placeholder' => 'Last Name']) }}
                </div>
                <div class='mb-3'>
                    {{ Form::label('department_id', 'Department') }}
                    {{ Form::select('department_id', $departments->pluck('name', 'id'), '', ['class' => 'form-control', 'placeholder' => 'Select Department']) }}
                </div>
                <div class='input-group mb-3'>
                    <span class="input-group-text">₱</span>
                    {{ Form::number('salary', '', ['class' => 'form-control', 'placeholder' => 'Salary per hour']) }}
                    <span class="input-group-text">.00</span>
                </div>
                @php
                    $today = date('Y-m-d');
                @endphp
                <div class='mb-3'>
                    {{ Form::label('birthday', 'Birthday') }}
                    {{ Form::date('birthday', '', ['class' => 'form-control birthday', 'placeholder' => 'Birthday', 'id' => 'birthday', 'max' => $today]) }}
                </div>
                <div class='mb-3'>
                    {{ Form::label('age', 'Age') }}
                    {{ Form::text('age', '', ['class' => 'form-control age', 'placeholder' => 'Age', 'readonly' => true, 'id' => 'age']) }}
                </div>
                <div class='mb-3'>
                    {{ Form::label('image', 'Profile Image') }}
                    {{ Form::file('image', ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-dark">
                    <i class="bi bi-save me-2"></i>Save Employee
                </button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
