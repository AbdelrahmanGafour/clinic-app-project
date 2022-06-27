<!-- Modal -->
<div class="modal fade w-100" id="previousVisitsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="previousVisitsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previousVisitsModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Symptoms</th>
                        <th scope="col">Diagnosis</th>
                        <th scope="col">Treatment</th>
                        <th scope="col">Note</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($patientPreviousVisits as $visit)
                        <tr>
                            <td>{{$visit->doctor->first_name}}</td>
                            <td>{{$visit->doctor->specialty->specialty_name}}</td>
                            <td>{{$visit->doctor->first_name}}</td>
                            <td>{{$visit->doctor->first_name}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
