<!-- resources/views/your/absent/partial.blade.php -->

<!-- Your Absent Table -->
<div class="table-responsive">
    <table class="table table-hover table-center mb-0">
        <thead>
            <tr>
                <th class="text-center">序號</th>
                <th>MENTEE LISTS</th>
                <th>SCHEDULED DATE</th>
                <th class="text-center">SCHEDULED TIMINGS</th>
                <th class="text-center">STATUS</th>
                <th class="text-center">ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absentData as $index => $data)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $data->mentee_name }}</td>
                <td>{{ $data->scheduled_date }}</td>
                <td class="text-center">{{ $data->scheduled_time }}</td>
                <td class="text-center">{{ $data->status }}</td>
                <td class="text-center">
                    <button class="btn btn-sm bg-info-light">Action</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
