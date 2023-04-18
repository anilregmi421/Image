<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Image</title>
  </head>
  <body>
      <div class="container">

      
    <form action="{{route('store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">name</label>
          <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">address</label>
          <input type="text" class="form-control" id="address" name="address">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">image</label>
            <input type="file" class="form-control" id="image" name="image">
          </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">SN</th>
            <th scope="col">name</th>
            <th scope="col">address</th>
            <th scope="col">image</th>
          </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            @foreach($images as $image)
            <tr>
              <th scope="row">{{$i}}</th>
              <td>{{$image->name}}</td>
              <td>{{$image->address}}</td>
              <td>
                  <img src="/images/{{$image->image}}" height="50" width="50">
              </td>
              <td>
                <a href="{{route('edit',$image->id)}}"><button class="btn btn-outline-primary">Edit</button></a>
                <a href="{{route('delete',$image->id)}}"><button class="btn btn-outline-danger">Delete</button></a>
              </td>
            </tr>
            <?php $i++ ?>
            @endforeach
        </tbody>
      </table>

    <!-- Optional JavaScript; choose one of the two! -->
</div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>
