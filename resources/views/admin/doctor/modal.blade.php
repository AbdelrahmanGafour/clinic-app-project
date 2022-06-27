<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="{{'#doctorModal'.$doctor->id}}">
    Doctor Details
</button>

<div class="modal fade" id="{{'doctorModal'.$doctor->id}}" tabindex="-1" role="dialog" aria-labelledby="{{'doctorModal'.$doctor->id.'Label'}}"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Doctor information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><img src="{{--asset('images') }}/{{ $user->image--}}" class="table-user-thumb" alt="" width="200"></p>
{{--
                <p class="badge badge-pill badge-dark">Role: {{ $user->role->name }}</p>
--}}
                <p><strong>Name:</strong>  {{'Dr. '.$doctor->first_name.' '.$doctor->middle_name.' '.$doctor->last_name }}</p>
                <p><strong>Title:</strong> {{ $doctor->title_name }}</p>
                <p><strong>Specialty:</strong> {{ $doctor->specialty_name }}</p>
                <p><strong>Email:</strong> {{ $doctor->email }}</p>
                <p><strong>City:</strong> {{ $doctor->city }}</p>
                <p><strong>Phone number:</strong> {{ $doctor->phone_number }}</p>
                <p><strong>Gender:</strong> {{ $doctor->gender }}</p>
                <p><strong>About:</strong> {{ $doctor->bio }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Dismiss</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
