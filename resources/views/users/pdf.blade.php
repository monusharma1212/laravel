<h2>Users List</h2>

<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Department</th>
            <th>Experience</th>
            <th>Role</th>
            <th>Images</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ is_array($user->department) ? implode(', ', $user->department) : $user->department }}</td>
                <td>{{ $user->experience }}</td>
                <td>{{ $user->role }}</td>
                <td >
                    @if (is_array($user->images))
                        @foreach ($user->images as $img)
                            <img src="{{ public_path('storage/' . $img) }}" width="50" height="50" style="margin:2px;">
                        @endforeach
                    @else
                        <img src="{{ public_path('storage/' . $user->images) }}" width="50">
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
