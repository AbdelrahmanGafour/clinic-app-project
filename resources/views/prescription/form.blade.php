    <!-- Modal -->
    <div class="modal fade" id="presciptionModal" tabindex="-1" aria-labelledby="presciptionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{route('doctor.prescribe')}}" method="post">@csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Prescription</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="app">

                        <input type="hidden" name="patient_id" value="{{ $patientAppointmentDetails->patient_id }}">
                        <input type="hidden" name="doctor_id" value="{{ $patientAppointmentDetails->doctor_id }}">
                        <input type="hidden" name="appointment_id" value="{{ $patientAppointmentDetails->id }}">
                        <div class="form-row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Symptoms</label>

                                    <textarea name="symptoms" class="form-control" placeholder="" required></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Diagnosis</label>
                                    <textarea name="diagnosis" class="form-control" placeholder="" required></textarea>

                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Treatment</label>
                                    <textarea name="treatment" class="form-control" placeholder="" required></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Note</label>
                                    <textarea name="note" class="form-control" placeholder="" required></textarea>
                                </div>
                            </div>
                        </div>





                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
