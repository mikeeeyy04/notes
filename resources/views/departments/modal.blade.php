<div class="modal fade" id="addEmployee" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmployeeModalLabel">Add Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => 'save', 'enctype' => 'multipart/form-data']) !!}
                @csrf
                <div class='mb-3'>
                    {{ Form::label('name', 'Department Name') }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-dark">
                    <i class="bi bi-save me-2"></i>Save Department
                </button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
