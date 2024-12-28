<div class="container mt-5">
    <div class="d-flex flex-wrap">
        @foreach($members as $member)
            <!-- Modal -->
            <div class="modal fade" id="editMemberModal-{{ $member->id }}" tabindex="-1" aria-labelledby="editMemberModalLabel-{{ $member->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editMemberModalLabel-{{ $member->id }}">Edit Member</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('members.update', $member->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="modal-body">
                                <!-- Role -->
                                <div class="form-group mb-3">
                                    <label for="role">Role</label>
                                    <select name="role" class="form-control" required>
                                        <option value="Coach" {{ $member->role == 'Coach' ? 'selected' : '' }}>Coach</option>
                                        <option value="Athlete" {{ $member->role == 'Athlete' ? 'selected' : '' }}>Athlete</option>
                                    </select>
                                </div>

                                <!-- Name -->
                                <div class="form-group mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $member->name }}" required>
                                </div>

                                <!-- Member Profile Photo -->
                                <div class="form-group mb-3">
                                    <label for="member_photo">Member Profile</label>
                                    <input type="file" name="member_photo" class="form-control">
                                    @if ($member->photo)
                                        <img src="{{ asset('storage/' . $member->photo) }}" alt="Member Profile" class="img-fluid mt-2" style="max-height: 200px;">
                                    @endif
                                </div>

                                <!-- School -->
                                <div class="form-group mb-3">
                                    <label for="school">School</label>
                                    <input type="text" name="school" class="form-control" value="{{ $member->school }}" required>
                                </div>

                                <!-- Gender -->
                                <div class="form-group mb-3">
                                    <label for="gender">Gender</label>
                                    <select name="gender" class="form-control" required>
                                        <option value="Male" {{ $member->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ $member->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>

                                <!-- Belt -->
                                <div class="form-group mb-3">
                                    <label for="belt">Belt</label>
                                    <input type="text" name="belt" class="form-control" value="{{ $member->belt }}" required>
                                </div>

                                <!-- Medal -->
                                <div class="form-group mb-3">
                                    <label for="medal">Medal</label>
                                    <select name="medal" class="form-control">
                                        <option value="" {{ !$member->medal ? 'selected' : '' }}>No Medal</option>
                                        <option value="gold" {{ $member->medal == 'gold' ? 'selected' : '' }}>Gold</option>
                                        <option value="silver" {{ $member->medal == 'silver' ? 'selected' : '' }}>Silver</option>
                                        <option value="bronze" {{ $member->medal == 'bronze' ? 'selected' : '' }}>Bronze</option>
                                    </select>
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
    </div>
</div>
