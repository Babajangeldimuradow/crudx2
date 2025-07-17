<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Car Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <h2>Edit Car</h2>
<form action="{{ route('cars.update', ['id' => $car->id]) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="mb-3">
                        <label for="make" class="form-label">Make</label>
                        <input type="text" name="make" id="make" class="form-control" value="{{$car->make}}" />
                    </div>
                    <div class="mb-3">
                        <label for="model" class="form-label">Model</label>
                        <input type="text" name="model" id="model" class="form-control" value="{{$car->model}}" />
                    </div>
                    <div class="mb-3">
                        <label for="produced_on" class="form-label">Produced On</label>
                        <input type="date" name="produced_on" id="produced_on" class="form-control" value="{{$car->produced_on}}" />
                    </div>
                    <div class="mb-3">
    <label for="image">Update Car Image</label>
    <input type="file" name="image" class="form-control" accept="image/*">
</div>

@if ($car->image)
    <div class="mb-3">
        <label>Current Image:</label><br>
        <img src="{{ asset('storage/' . $car->image) }}" width="150">
    </div>
@endif

                    <button type="submit" class="btn btn-block btn-success  ">Update</button>
                </form>
            </div>
    </div>
     
</body>
</hmtl>