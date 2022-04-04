<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/b-2.2.2/b-html5-2.2.2/datatables.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    {{-- Custom Css --}}
    <link rel="stylesheet" href="{{ asset('css/sidenav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>{{ $title }}</title>
</head>
<body>
    <div class="sidebar">
        <div class="logo-details">
            <div class="logo_name">Hotel.LuuL</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list"> 
            <li>
                <a href="/contact" class="a {{ ($title === "Contact") ? 'open1' : '' }}">
                    <i class='bx bxs-contact {{ ($title === "Contact") ? 'open1' : '' }}'></i>
                    <span class="links_name {{ ($title === "Contact") ? 'open1' : '' }}">Contact</span>
                </a>
                <span class="tooltip {{ ($title === "Contact") ? 'open1' : '' }}">Contact</span>
            </li>
            {{-- <li class="profile">
                <form action="/logout" method="POST">
                    @csrf
                    <button class="btn" type="submit">
                        <div class="profile-details">
                            <div class="name_job">
                                <div class="name"></div>
                            </div>
                        </div>
                        <div class="name"><p class="text-end me-3 mt-1">Logout<p></div>
                            <i class='bx bx-log-out' id="log_out" href="/logout"></i>
                    </button>
                </form>
            </li> --}}
        </ul>
    </div>
    <section class="home-section">
        <div class="container-fluid" style="min-height: calc(100vh - 60px);">
              <div class="content-header">
                <div class="container-fluid">
                  <div class="row pb-1 mb-1">
                    <div class="col-sm-6">
                      <h2 class="title-mobile mt-4"><b>Contact</b></h2>
                    </div>
                    <hr class="mt-3 ms-2 mb-1">
                  </div>
                </div>
              </div>
              <div class="container-fluid">
                <div class="row py-2">
                    <div class="col">
                        <div class="card-body p-0 ms-1 mb-5" style="overflow-x: auto;">
                            <table class="table table-bordered yajra-datatable">
                                <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>Nama</th>
                                      <th>Email</th>
                                      <th>Pesan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contact as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->pesan }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show ms-2 position-absolute top-0 start-50 translate-middle-x" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show ms-2 position-absolute top-0 start-50 translate-middle-x" role="alert">
                {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <footer class="main-footer text-light py-3 px-2" style="min-height: 60px">
            <strong>Copyright &copy; {{ date('Y') }} <a href="/">Contact.LuuL</a>.</strong>
            All rights reserved.
        </footer>
    </section>
    {{-- modal tambah --}}
    <div class="modal fade" id="tambah" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true" >
        <form class="mt-1" action="/contact" method="post">
            <div class="modal-dialog">
            <div class="modal-content" style="background-color: #f5f5f5;border-radius:10px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahLabel">Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" style="background-color: #e4e9f7">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama :</label>
                        <input required type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email :</label>
                        <input required type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pesan :</label>
                        <input required type="text" class="form-control" id="pesan" name="pesan">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">{{ $satu }} + {{ $dua }}</span>
                        <input type="hidden" class="form-control" name="satu" id="satu" value="{{ $satu }}">
                        <input type="hidden" class="form-control" name="dua" id="dua" value="{{ $dua }}">
                        <input required type="text" class="form-control" name="captcha" id="captcha">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/b-2.2.2/b-html5-2.2.2/datatables.min.js"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  	});
    $(function () {
        var table = $('.yajra-datatable').DataTable({
          dom: 'l<"toolbar">frtip',
            initComplete: function(){
            $("div.toolbar")
                .html('<a type="button" class="create p-2 px-3 mb-2 btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#tambah"><i class="bi bi-plus-lg text-light"></i><span class="text-light">Tambah</span></a>');           
            },  
      });
      
    });
    </script>
</body>
</html>