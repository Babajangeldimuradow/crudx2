<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Car Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <div class="jumbotron jumbotron-fluid bg-danger">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="display-4">Cars</h1>
                        <p class="Lead">A web Application that creates cars..</p>
                    </div>
                    <div class="col-md-6">
                        <img src="" alt="" >
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h2>Create Car</h2>
               <form action="{{ route('cars.create') }}" method="POST" enctype="multipart/form-data">
          

                    @csrf
                    <div class="mb-3">
                        <label for="make" class="form-label">Make</label>
                        <input type="text" name="make" id="make" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="model" class="form-label">Model</label>
                        <input type="text" name="model" id="model" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="produced_on" class="form-label">Produced On</label>
                        <input type="date" name="produced_on" id="produced_on" class="form-control" required />
                    </div>
                    <div class="mb-3">
                             <label for="image" class="form-label">Car Image</label>
                          <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        </div>

                    <button type="submit" class="btn btn-success w-100">Create</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2>Cars List</h2>
                  <form action="{{ route('cars.show') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Gözleg üçin..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Gözle</button>
        </div>
        <div class="input-group">
        <label class="input-group-text" for="sort">Tertiple</label>
        <select name="sort" id="sort" class="form-select" onchange="this.form.submit()">
            <option value="make_asc" {{ request('sort') == 'make_asc' ? 'selected' : '' }}>Make (A-Z)</option>
            <option value="make_desc" {{ request('sort') == 'make_desc' ? 'selected' : '' }}>Make (Z-A)</option>
            <option value="model_asc" {{ request('sort') == 'model_asc' ? 'selected' : '' }}>Model (A-Z)</option>
            <option value="model_desc" {{ request('sort') == 'model_desc' ? 'selected' : '' }}>Model (Z-A)</option>
            <option value="produced_on_asc" {{ request('sort') == 'produced_on_asc' ? 'selected' : '' }}>Produced (Oldest)</option>
            <option value="produced_on_desc" {{ request('sort') == 'produced_on_desc' ? 'selected' : '' }}>Produced (Newest)</option>
        </select>
    </div>
    </form>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Make</th>
                            <th>Model</th>
                            <th>Produced On</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cars as $car)
                            <tr>
                                <td>{{ $car->make }}</td>
                                <td>{{ $car->model }}</td>
                                <td>{{ $car->produced_on }}</td>
                        <td>
    <a href="{{ route('cars.edit', ['id' => $car->id]) }}" class="btn btn-sm btn-primary">Edit</a>

    <form action="{{ route('cars.destroy', ['id' => $car->id]) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Pozmak isleýäňizmi?')">
            Delete
        </button>
    </form>
</td>
<td>
    @if($car->image)
        <img src="{{ asset('storage/' . $car->image) }}" width="100">
    @else
        <span>No Image</span>
    @endif
</td>


                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Ulag goşulmadyk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Pagination düwmeleri -->
<div class="d-flex justify-content-center my-4">
    {{ $cars->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>


</div>

            </div>
        </div>
    </div>
</body>
</html>
