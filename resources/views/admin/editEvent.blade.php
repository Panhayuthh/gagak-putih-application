{{-- <div class="container mt-5"> --}}
    @foreach($events as $event)
        <div class="modal" id="editEventModal-{{ $event->id }}" tabindex="-1" aria-labelledby="editEventModalLabel-{{ $event->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h5 class="modal-title text-white" id="editEventModalLabel-{{ $event->id }}">Edit Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="name">Event Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $event->name }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="place">Place</label>
                                <input type="text" name="location" class="form-control" value="{{ $event->location }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                <input type="text" name="description" class="form-control" value="{{ $event->description }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="event_photo">Event Photo</label>
                                <input type="file" name="event_photo" class="form-control">
                                @if ($event->photo)
                                    <img src="{{ asset('storage/' . $event->photo) }}" alt="Event Photo" class="img-fluid mt-2" style="max-height: 200px;">
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="date">Date</label>
                                <input type="date" name="date" class="form-control" value="{{ $event->date }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
{{-- </div> --}}
