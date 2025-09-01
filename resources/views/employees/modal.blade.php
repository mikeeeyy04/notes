<div class="modal fade" id="addEmployee" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addEmployeeModalLabel">Add Employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {!!  Form::open(['url' => 'employees/save', 'enctype' => 'multipart/form-data']) !!}
            <div class='mb-3'>
                {{ Form::label('firstName', 'First Name') }}
                {{ Form::text('firstName', null, ['class' => 'form-control', 'placeholder' => 'First Name']) }}
            </div>
            <div class='mb-3'>
                {{ Form::label('middleName', 'Middle Name') }}
                {{ Form::text('middleName', null, ['class' => 'form-control', 'placeholder' => 'Middle Name']) }}
            </div>
            <div class='mb-3'>
                {{ Form::label('lastName', 'Last Name') }}
                {{ Form::text('lastName', null, ['class' => 'form-control', 'placeholder' => 'Last Name']) }}
            </div>
      <div class='mb-3'>
        {{ Form::label('birthday', 'Birthday') }}
        {{ Form::date('birthday', null, ['class' => 'form-control', 'placeholder' => 'Birthday', 'id' => 'birthday']) }}
      </div>
      <div class='mb-3'>
        {{ Form::label('age', 'Age') }}
        {{ Form::text('age', null, ['class' => 'form-control', 'placeholder' => 'Age', 'readonly' => true, 'id' => 'age']) }}
      </div>
      <div class='mb-3'>
        {{ Form::label('image', 'Profile Image') }}
        {{ Form::file('image', ['class' => 'form-control']) }}
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>