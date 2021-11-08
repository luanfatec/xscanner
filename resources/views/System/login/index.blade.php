<html>

<head>
    <title>{{ $title }}</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
  <style>
    body {
      display: flex;
      min-height: 100vh;
      flex-direction: column;
      background-image: url("{{ url('/assets/images/login/padlock-ge41d0e31b_1920.jpg') }}");
      background-attachment: fixed;
      background-position: center;
      background-size: cover;
      background-repeat: no-repeat;
    }

    main {
      flex: 1 0 auto;
    }

    .input-field input[type=date]:focus + label,
    .input-field input[type=text]:focus + label,
    .input-field input[type=email]:focus + label,
    .input-field input[type=password]:focus + label {
      color: #e91e63;
    }

    .input-field input[type=date]:focus,
    .input-field input[type=text]:focus,
    .input-field input[type=email]:focus,
    .input-field input[type=password]:focus {
      border-bottom: 2px solid #e91e63;
      box-shadow: none;
    }
  </style>
</head>

<body>
  <div class="section"></div>
  <main>
    <center>
      {{-- <img class="responsive-img" style="width: 250px;" src="" /> --}}
      <div class="section"></div>

      {{-- <h5 class="indigo-text">Please, login into your account</h5> --}}
      <div class="section">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      </div>

      <div class="container">
        <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

          <form class="col s12" method="post" action="{{ route('system.login.auth') }}">
              @csrf
            <div class='row'>
              <div class='col s12'>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='email' name='email' id='email' value="luan@teste.com" />
                <label for='email'>Entre com seu e-mail</label>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='password' name='password' id='password' />
                <label for='password'>Entre com a sua senha</label>
              </div>
              <label style='float: right;'>
                <a class='pink-text' href='#'><b></b></a>
              </label>
            </div>

            <br />
            <center>
              <div class='row'>
                <button type='submit' class='col s12 btn btn-large waves-effect indigo'>Entrar</button>
              </div>
            </center>
          </form>
        </div>
      </div>
    </center>

    {{-- <div class="section"></div> --}}
    {{-- <div class="section"></div> --}}
  </main>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
</body>

</html>
