<!-- Modify Button trigger modal -->
<button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modifyModal">
    Reserve instead of the previous appointment
</button>

<!--Modify Modal -->
<div class="modal fade" id="modifyModal" tabindex="-1" aria-labelledby="modifyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modifyModalLabel">Appointment Modification Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fw-bolder">
                Would you like to reserve [{{$appointment->date.' '.date('h:i A', strtotime($appointment->start_time))}}]
                instead of [{{$old_appointment->date.' '.date('h:i A', strtotime($old_appointment->start_time))}}]
            </div>
            <div class="modal-footer">
                <form action="{{route('patient.modify.appointment.confirm')}}" method="post">
                    @csrf
                    <input type="hidden" name="old_appointment_id" value="{{$old_appointment->id }}">
                    <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">

                    <button type="submit" class="btn btn-outline-danger btn-sm">Yes, reserve this appointment!</button>
                </form>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Dismiss</button>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>



