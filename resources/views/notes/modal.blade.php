<div class="modal fade" id="addnew" tabindex="-1" aria-labelledby="addnewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addnewModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {!!  Form::open(['url' => 'save']) !!}
            <div class='mb-3'>
                {{ Form::label('title', 'Title') }}
                {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) }}
            </div>
            <div class='mb-3'>
                {{ Form::label('content', 'Content') }}
                {{ Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Your note here...']) }}

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