<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>FAS</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/main.css">
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="/"><img src="/images/logo.png" alt="FootBall" width="70" height="70"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link" href="/">Main</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/teams">Teams</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/leagues">Leagues</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/players">Players</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="/fixtures">Fixtures</a>
                </li>
                  </ul>
                </div>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                  <ul class="navbar-nav">
                      <li class="nav-item">
                          <a class="nav-link" href="/login">Sign in</a>
                      </li>
                  </ul>
                </div>
              </div>
          </nav>

        <div class="container">
            <div class="col-md-6">
                <form action="/teamPlayer/@php echo $name @endphp">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <select name="filter" class="form-control">
                                    <option value="">Default</option>
                                    <optgroup label="Position">
                                        <option value="Goalkeeper">Goalkeeper</option>
                                        <option value="Defender">Defender</option>
                                        <option value="Midfielder">Midfielder</option>
                                        <option value="Attacker">Attacker</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-outline-light">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <h2>@php echo $name @endphp players</h2>
                <table class="table" id="playerTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Number</th>
                            <th>Position</th>
                            <th>Team</th>
                            <th>More</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $players)
                            <tr>
                                <td>{{ $players->name }}</td>
                                <td>{{ $players->age }}</td>
                                <td>{{ $players->number }}</td>
                                <td>{{ $players->position }}</td>
                                <td>{{ $players->team }}</td>
                                <td><a class="btn btn-outline-light" href="/playerStats/{{ $players->name }}">Stats</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="overlay"></div>
    </body>
</html>
<script src="//code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>$(document).ready(function () {
    $('#playerTable').DataTable({
        lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, 'All'],
        ],
    });
});
</script>
