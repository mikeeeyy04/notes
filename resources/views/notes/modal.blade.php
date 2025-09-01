<div class="modal fade" id="addnew" tabindex="-1" aria-labelledby="addnewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addnewModalLabel">Add Note</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'notes.save']) !!}
                @csrf
                <div class='mb-3'>
                    {{ Form::label('title', 'Title') }}
                    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) }}
                </div>
                <div class='mb-3'>
                    {{ Form::label('content', 'Content') }}
                    {{ Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Your note here...', 'id' => 'ckeditor1']) }}

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-dark">Save</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<script>
    ClassicEditor
        .create(document.querySelector('textarea[name="content"]'))
        .catch(error => {
            console.error(error);
        });
</script>
