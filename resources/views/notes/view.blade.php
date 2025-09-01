@foreach($notes as $notes)
<div>
    <div class="modal fade" id="viewNote{{ $notes->id }}" tabindex="-1" aria-labelledby="viewNoteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewNoteModalLabel">View Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! Form::model($notes, ['method' => 'patch', 'route' => ['notes.update', $notes->id]]) !!}
                    <div class='mb-3'>
                        {{ Form::label('title', 'Title') }}
                        {{ Form::text('title', $notes->title, ['class' => 'form-control']) }}
                    </div>
                    <div class='mb-3'>
                        {{ Form::label('content', 'Content') }}
                        {{ Form::textarea('content', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="card bg-light border-0">
                                <div class="card-body p-2">
                                    <small class="text-muted">Date Created:</small>
                                    <div class="fw-semibold">{{ $notes->datecreated ? date('M d, Y h:i A', strtotime($notes->datecreated)) : 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-light border-0">
                                <div class="card-body p-2">
                                    <small class="text-muted">Date Updated:</small>
                                    <div class="fw-semibold">{{ $notes->dateupdated ? date('M d, Y h:i A', strtotime($notes->dateupdated)) : 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#deleteNote{{ $notes->id }}">Delete</button>
                    {{ Form::button('<i class="bi bi-save me-2"></i> Save', ['class' => 'btn btn-dark', 'type' => 'submit']) }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <div class="modal fade" id="deleteNote{{ $notes->id }}" tabindex="-1" aria-labelledby="deleteNoteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteNoteModalLabel">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="bold">"<strong>{{ $notes->title }}</strong>"</span> note will be deleted permanently. Are you sure?
                    {!! Form::model($notes, ['method' => 'delete', 'route' => ['notes.destroy', $notes->id]]) !!}
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