<div class="d-flex content-wrap">
    @foreach($classes as $class)
    <div class="modal" id="editScheduleModal-{{ $class->id }}" tabindex="-1" aria-labelledby="editScheduleModalLabel-{{ $class->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="editScheduleModalLabel-{{ $class->id }}">Edit Schedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('schedule.update', $class->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="name">Schedule Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $class->name }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="location">Location</label>
                            <input type="text" name="location" class="form-control" value="{{ $class->location }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="level">Level</label>
                            <select name="level" class="form-control" required>
                                <option value="Beginner" {{ $class->level == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                <option value="Intermediate" {{ $class->level == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="Advanced" {{ $class->level == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="date">Day</label>
                            <select name="date" class="form-control" required>
                                <option value="Monday" {{ $class->date == 'Monday' ? 'selected' : '' }}>Monday</option>
                                <option value="Tuesday" {{ $class->date == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                                <option value="Wednesday" {{ $class->date == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                                <option value="Thursday" {{ $class->date == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                                <option value="Friday" {{ $class->date == 'Friday' ? 'selected' : '' }}>Friday</option>
                                <option value="Saturday" {{ $class->date == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                                <option value="Sunday" {{ $class->date == 'Sunday' ? 'selected' : '' }}>Sunday</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="start_time">Start Time</label>
                            <input type="time" name="start_time" class="form-control" value="{{ $class->start_time }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="end_time">End Time</label>
                            <input type="time" name="end_time" class="form-control" value="{{ $class->end_time }}" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" value="Save Changes" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
