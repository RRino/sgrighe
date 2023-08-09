<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Summernote Text Editor CRUD and Image Upload in Laravel</title>
  <!-- bootstrap -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>



  <div class="container p-4 ">
    <div class="text-center">
      <h1 class="">Index</h1>
    </div>
    <a href="/create" class="btn btn-md btn-primary">Nuovo Articolo</a>
    <a href="/" class="btn btn-md btn-success">Home</a>
    <hr>

      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Titolo</th>
            <th scope="col">Azione</th>
          </tr>
        </thead>
        <tbody>


            @foreach ($posts as $post)
             <tr>
                <th scope="row">{{ $post->id }}</th>
                <td>{{ $post->title }}</td>
                <td>
                    <a href="show/{{ $post->id }}" class="btn btn-success">Mostra</a>
                    <a href="edit/{{ $post->id }}" class="btn btn-info">Modifica</a>
                    <a href="delete/{{ $post->id }}" class="btn btn-danger">Cancella</a>              
                </td>
            </tr>
            @endforeach
      
        </tbody>
      </table>

    </div>
  
</body>
</html>