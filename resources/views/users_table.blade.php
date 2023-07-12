<table class="table table-striped table-sm text-center align-middle">
    <thead>
      <tr>
        <th>ID</th>
        <th>Avatar</th>
        <th>Name</th>
        <th>E-mail</th>
        <th>Country</th>
        <th>State</th>
        <th>City</th>
        <th>Phone</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    @forelse($datalist as $emp)
        <tr>
        <td>{{ $loop->iteration }}</td>
        <td><img src="{{ asset('public/storage/images/' . $emp->photo) }}" width="50" class="img-thumbnail rounded-circle"></td>
        <td>{{ $emp->name }}</td>
        <td>{{ $emp->email }}</td>
        <td>{{ $emp->country->country_name }}</td>
        <td>{{ $emp->state->state_name }}</td>
        <td>{{ $emp->city->city_name }}</td>
        <td>{{ $emp->mobile }}</td>
        <td>
          <a href="#" id="{{ $emp->id }}" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i class="bi-pencil-square h4"></i></a>
          <a href="#" id="{{ $emp->id }}" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
        </td>
      </tr>
      @empty
      <tr><td colspan="7"><h5 class="text-center">No Records Found</h5></td></tr>
      @endforelse
    </tbody>
</table>