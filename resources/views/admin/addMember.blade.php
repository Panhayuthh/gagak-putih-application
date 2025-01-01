{{-- <div class="container mt-5"> --}}
    <!-- Add Member Modal -->
    <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMemberModalLabel">Add Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label d-block">Role</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="roleCoach" name="role" value="coach" required>
                                <label class="form-check-label" for="roleCoach">Coach</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="roleAthlete" name="role" value="athlete" required checked>
                                <label class="form-check-label" for="roleAthlete">Athlete</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="school" class="form-label">School</label>
                            <input type="text" class="form-control" id="school" name="school" required>
                        </div>
                        <div class="mb-3">
                            <label for="belt" class="form-label">Belt</label>
                            <select class="form-select" id="belt" name="belt" required>
                                <option value="white">White</option>
                                <option value="yellow">Yellow</option>
                                <option value="yellow">Orange</option>
                                <option value="yellow">Green</option>
                                <option value="yellow">Blue</option>
                                <option value="yellow">Brown</option>
                                <option value="yellow">Black</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="medal" class="form-label">Medal</label>
                            <select class="form-select" id="medal" name="medal">
                                <option value="">No Medal</option>
                                <option value="gold">Gold</option>
                                <option value="silver">Silver</option>
                                <option value="bronze">Bronze</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block">Gender</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="genderMale" name="gender" value="Male" required>
                                <label class="form-check-label" for="genderMale">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="genderFemale" name="gender" value="Female" required>
                                <label class="form-check-label" for="genderFemale">Female</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Profile Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{-- </div> --}}
