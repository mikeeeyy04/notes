@extends('notes.app')

@section('content')
    <main>
        <div class="container py-4">
            <header class="pb-3 mb-4 border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" fill="currentColor"
                            class="bi bi-file-earmark-fill" viewBox="0 0 16 16">
                            <path
                                d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m5.5 1.5v2a1 1 0 0 0 1 1h2z" />
                        </svg>
                        <h2>Notes</h2>
                    </a>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#addnew" class="btn btn-dark"><i
                            class='bi bi-plus-lg me-2'></i>Add Note</button>
                </div>
            </header>

            @php
                $sortedNotes = $notes->sortByDesc('created_at')->values();
            @endphp
            @if ($sortedNotes->count())
                <div class="p-5 mb-4 bg-dark rounded-3 text-ligth latest-note">
                    <div class="container-fluid text-light py-2">
                        <h1 class="display-5 text-light fw-bold">{{ $sortedNotes[0]->title ?? 'Untitled' }}</h1>
                        <p class="col-md-8 fs-4">{!! $sortedNotes[0]->content ?? '' !!}</p>
                        <button class="btn text-dark btn-lg bg-light" type="button" data-bs-toggle="modal" data-bs-target="#viewNote{{ $sortedNotes[0]->id }}"><i class="bi bi-eye me-2"></i>View Note</button>
                        @include('notes.view')
                    </div>
                </div>

                @if ($sortedNotes->count() > 1)
                    <div class="row align-items-md-stretch">
                        @foreach ($sortedNotes->slice(1) as $note)
                            <div class="col-md-6 mb-3">
                                <div
                                    class="h-100 p-5 {{ $loop->index % 6 == 0 ? 'bg-light border' : ($loop->index % 6 == 1 ? 'text-white bg-dark' : ($loop->index % 6 == 2 ? 'text-white bg-dark' : ($loop->index % 6 == 3 ? 'bg-light border' : ($loop->index % 6 == 4 ? 'bg-light border' : 'text-white bg-dark')))) }} rounded-3">
                                    <h2>{{ $note->title ?? 'Untitled' }}</h2>
                                    <p>{!! $note->content ?? '' !!}</p>
                                    <button class="btn {{ $loop->index % 6 == 0 ? 'btn-outline-secondary' : ($loop->index % 6 == 1 ? 'btn-outline-light' : ($loop->index % 6 == 2 ? 'btn-outline-light' : ($loop->index % 6 == 3 ? 'btn-outline-secondary' : ($loop->index % 6 == 4 ? 'btn-outline-secondary' : 'btn-outline-light')))) }}"
                                        type="button" data-bs-toggle="modal" data-bs-target="#viewNote{{ $note->id }}"><i class="bi bi-eye me-2"></i>View Note</button>
                                    @include('notes.view', ['note' => $note])
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @else
                <li class="list-group-item">No notes found.</li>
            @endif

            


            <footer class="pt-3 mt-4 text-muted border-top">
                &copy; 2025
            </footer>
        </div>
    </main>
@endsection
