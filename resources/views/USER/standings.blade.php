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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
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
                        <a class="nav-link active" aria-current="page" href="/leagues">Leagues</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/players">Players</a>
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
        <div class="container" style="margin-bottom: 35px">
            <div class="row">
                <div class="row" style="margin-bottom: 25px">
                    <div class="col">
                        <h2>@php echo $name @endphp standings</h2>
                    </div>
                    <div class="col">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Compare teams
                            </button>
                        </div>
                    </div>
                </div>
                <table class="table" id="standingsTable">
                    <thead>
                        <tr>
                            <th>Team</th>
                            <th>Form</th>
                            <th>Wins</th>
                            <th>Ties</th>
                            <th>Loses</th>
                            <th>Points</th>
                            <th>Function</th>
                            {{-- <th>Players</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $team)
                            <tr>
                                <td>{{ $team->team }}</td>
                                <td>{{ $team->form }}</td>
                                <td>{{ $team->wins }}</td>
                                <td>{{ $team->ties }}</td>
                                <td>{{ $team->loses }}</td>
                                @foreach ($results as $r)
                                    @if ($team->team == $r['team'])
                                        <th>@php echo $r['points'] @endphp</th>
                                    @endif
                                @endforeach
                                <td><a class="btn btn-outline-light" href="/teamStats/{{ $team->team }}" style="height: 30px; width: 65px; padding: 0; text-align: center;">Stats</a> |
                                    <a class="btn btn-outline-light" href="/teamPlayer/{{ $team->team }}" style="height: 30px; width: 65px; padding: 0; text-align: center;">Players</a></td>
                                {{-- <td><a class="btn btn-outline-light" href="" style="height: 30px; width: 65px; padding: 0; text-align: center;">Players</a></td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <form action="/compareTeams" method="get" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Select teams to compare</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="f_team">Select first team</label><br>
                            <select name="f_team" id="f_team">
                                @foreach ($data as $team)
                                    <option value="{{ $team->team }}">{{ $team->team }}</option>
                                @endforeach
                            </select><br>

                            <label for="s_team">Select second team</label><br>
                            <select name="s_team" id="s_team">
                                @foreach ($data as $team)
                                    <option value="{{ $team->team }}">{{ $team->team }}</option>
                                @endforeach
                            </select><br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Compare!</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="overlay"></div>
    </body>
</html>
<script src="//code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>$(document).ready(function () {
    $('#standingsTable').DataTable({
        order: [[5, 'desc']],
        paging: false,
    });
});
</script>
