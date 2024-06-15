@section('title')
    Signin
@endsection

@extends('managers.app.appAuth', ['title' => 'Inscription'])


@section('css')
<style>

</style>
@endsection

@section('content')
<main class="main" id="top">
    <div class="container-fluid bg-body-tertiary dark__bg-gray-1200">
      <div class="bg-holder bg-auth-card-overlay" style="background-image:url(/managers/assets/img/bg/37.png);"></div>
      <div class="row flex-center position-relative min-vh-100 g-0 py-5">
        <div class="col-11 col-sm-10 col-xl-8">
          <div class="card border border-translucent auth-card">
            <div class="card-body pe-md-0">
              <div class="row align-items-center gx-0 gy-7">
                <div class="col-auto bg-body-highlight dark__bg-gray-1100 rounded-3 position-relative overflow-hidden auth-title-box">
                  <div class="bg-holder" style="background-image:url(/managers/assets/img/bg/38.png);"></div>
                  <div class="position-relative px-4 px-lg-7 pt-7 pb-7 pb-sm-5 text-center text-md-start pb-lg-7 pb-md-7">
                    <h3 class="mb-3 text-body-emphasis fs-7">Bienvenue à Mounix School!</h3>
                    {{-- <p class="text-body-tertiary">Give yourself some hassle-free development process with the uniqueness of Phoenix!</p> --}}
                    {{-- <ul class="list-unstyled mb-0 w-max-content w-md-auto">
                      <li class="d-flex align-items-center"><span class="uil uil-check-circle text-success me-2"></span><span class="text-body-tertiary fw-semibold">Fast</span></li>
                      <li class="d-flex align-items-center"><span class="uil uil-check-circle text-success me-2"></span><span class="text-body-tertiary fw-semibold">Simple</span></li>
                      <li class="d-flex align-items-center"><span class="uil uil-check-circle text-success me-2"></span><span class="text-body-tertiary fw-semibold">Responsive</span></li>
                    </ul> --}}
                  </div>
                  <div class="position-relative z-n1 mb-6 d-none d-md-block text-center mt-md-15"><img class="auth-title-box-img d-dark-none" src="{{asset('/managers/assets/img/spot-illustrations/auth.png')}}" alt="" /><img class="auth-title-box-img d-light-none" src="{{asset('/managers/assets/img/spot-illustrations/auth-dark.png')}}" alt="" /></div>
                </div>
                <div class="col mx-auto">
                  <div class="auth-form-box">
                    <div class="text-center mb-7"><a class="d-flex flex-center text-decoration-none mb-4" href="#">
                        <div class="d-flex align-items-center fw-bolder fs-3 d-inline-block"><img src="{{asset('/logo/logo.png')}}" alt="phoenix" width="80" /></div>
                      </a>
                      <h3 class="text-body-highlight">Connexion</h3>
                      <p class="text-body-tertiary">Veillez renseigner vos identificants</p>
                    </div>
                    {{-- <button class="btn btn-phoenix-secondary w-100 mb-3"><span class="fab fa-google text-danger me-2 fs-9"></span>M'inscrire avec mon compte google</button><button class="btn btn-phoenix-secondary w-100"><span class="fab fa-facebook text-primary me-2 fs-9"></span>Utiliser mon compte facebook</button> --}}
                    {{-- <div class="position-relative">
                      <hr class="bg-body-secondary mt-5 mb-4" />
                      <div class="divider-content-center bg-body-emphasis">où utiliser mon email</div>
                    </div> --}}
                    <form action="{{route('manager_signin_success')}}" method="post">
                    @csrf
                      @if(session('success'))
                      <div class="alert alert-success" role="alert">
                          {{ session('success') }}
                      </div>
                      @endif

                      @if(session('error'))
                      <div class="alert alert-danger" role="alert">
                          {{ session('error') }}
                      </div>
                      @endif

                      @if(session('infos'))
                      <div class="alert alert-warning" role="alert">
                          {{ session('info') }}
                      </div>
                      @endif
                    <div class="mb-3 text-start"><label class="form-label" for="email">Email</label>
                      <div class="form-icon-container">
                        <input class="form-control form-icon-input" name="email" type="email" placeholder="ex: ali@gmail.com *" required/>
                        <span class="fas fa-user text-body fs-9 form-icon"></span>
                      </div>
                    </div>
                    <div class="mb-4 text-start">
                        <label class="form-label" for="password">Mot de passe</label>
                        <div class="form-icon-container">
                            <input class="form-control form-icon-input" name="password" type="password" placeholder="Password" minlength="8" required />
                            <span class="fas fa-key text-body fs-9 form-icon"></span>
                        </div>
                    </div>
                    <div class="row flex-between-center mb-4">
                      <div class="col-auto">
                        <div class="form-check mb-0">
                          <input class="form-check-input" name="remember_me" id="basic-checkbox" type="checkbox" checked="checked" />
                          <label class="form-check-label mb-0" for="basic-checkbox">Se souvenir de moi.</label>
                        </div>
                    </div>
                      <div class="col-auto"><a class="fs-9 fw-semibold" href="#">Mot de passe oublié?</a></div>
                    </div><button type="submit" class="btn btn-primary w-100 mb-3">Se connecter</button>
                    {{-- <div class="text-center"><a class="fs-9 fw-bold" href="sign-up.html">Create an account</a></div> --}}
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection


@section('js')


@endsection

