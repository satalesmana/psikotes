<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama</th>
      <th scope="col">Pekerjaan</th>
      <th scope="col">Usia</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($data as $dt)
    <tr>      
        <th scope="row">1</th>
        <td >{{$dt->nama}}</td>
        <td >{{$dt->pekerjaan}}</td>
        <td >{{$dt->usia}}</td>
        </tr>
@endforeach

    
  </tbody>
</table>