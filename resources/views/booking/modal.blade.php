<!-- Cancel Button trigger modal -->
<button type="button" class="btn btn-outline-danger btn-sm w-100 m-1" data-bs-toggle="modal" data-bs-target="#cancelModal">
    Cancel Appointment
</button>

<!--Cancel Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel">Appointment Cancellation Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fw-bolder">
                Would you like to cancel you reserved appointment?
            </div>
            <div class="modal-footer">
                <form action="{{route('patient.cancel.appointment')}}" method="post">
                    @csrf
                    <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                    <button type="submit" class="btn btn-outline-danger btn-sm">Yes, Cancel this appointment!</button>
                </form>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Dismiss</button>
            </div>
        </div>
    </div>
</div>


<!-- Cancel Button trigger modal -->
<button type="button" class="btn btn-outline-dark btn-sm w-100 m-1" data-bs-toggle="modal" data-bs-target="#modifyModal">
    Change Appointment
</button>

<!--Cancel Modal -->
<div class="modal fade" id="modifyModal" tabindex="-1" aria-labelledby="modifyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modifyModalLabel">Appointment Changing Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fw-bolder">
                Would you like to change you reserved appointment?
            </div>
            <div class="modal-footer">
                <form action="{{route('patient.modify.appointment')}}" method="post">
                    @csrf
                    <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                    <button type="submit" class="btn btn-outline-dark btn-sm">Yes, Change this appointment!</button>
                </form>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Dismiss</button>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>



