<div class="container mt-3">
    <div class="d-flex content-wrap">
        <div class="modal" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h5 class="modal-title text-white" id="addEventModalLabel">Add Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="form-group mb-3">
                                <label for="name">Event Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="location">Location</label>
                                <input type="text" name="location" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                <input type="text" name="description" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="event_photo">Event Photo</label>
                                <input type="file" name="event_photo" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="date">Date</label>
                                <input type="date" name="date" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" value="Add Event" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
