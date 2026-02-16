<h2 style="text-align:center; margin-bottom:15px;">USER LIST</h2>

<style>
table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
}

th, td {
    border: 1px solid #000;
    padding: 6px;
    text-align: center;
    vertical-align: middle;
    font-size: 12px;
    word-wrap: break-word;
}

th {
    background: #f2f2f2;
}
.sr-no{
    width: 40px;
}

.images-cell {
    width: 250px;
}

.image-wrapper {
    display: inline-block;
    margin: 3px;
}

.image-wrapper img {
    width: 45px;
    height: 45px;
    object-fit: cover;
    border: 1px solid #ccc;
}
</style>

<table>
    <thead>
        <tr>
            <th class="sr-no">Sr No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Department</th>
            <th>Experience</th>
            <th>Role</th>
            <th>Date of Birth</th>
            <th class="images-cell">Images</th>
        </tr>   
    </thead>

    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>

            <td>
                @php
                $departments = is_array($user->department)
                    ? $user->department
                    : json_decode($user->department, true);
                @endphp
                
                {{ implode(', ', $departments ?? []) }}
            </td>

            <td>{{ $user->experience }}</td>
            <td>{{ $user->role }}</td>
            <td>{{ $user->dob }}</td>

            <td class="images-cell">
                <div style="margin-top:10px;">
            
                    @php
                        $images = is_array($user->images)
                            ? $user->images
                            : json_decode($user->images, true);
                    @endphp
            
                    @foreach ($images ?? [] as $img)
                        <span class="image-wrapper">
                            <img src="{{ public_path('storage/' . $img) }}" width="60">
                        </span>
                    @endforeach
            
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
