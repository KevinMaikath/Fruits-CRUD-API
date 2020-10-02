<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruits-CRUD-API</title>
</head>
<body>

<h1 class="display-3">Add a fruit</h1>
<div>
    <form method="post" action="{{ route('fruits.store') }}">
        @csrf
        <div>
            <label for="first_name">Name:</label>
            <input type="text" name="name"/>
        </div>
        <div class="form-group">
            <label for="last_name">Size:</label>
            <input type="text" name="size"/>
        </div>
        <div class="form-group">
            <label for="email">Colour:</label>
            <input type="text" name="colour"/>
        </div>
        <button type="submit">Add fruit</button>
    </form>
</div>

</body>
</html>
