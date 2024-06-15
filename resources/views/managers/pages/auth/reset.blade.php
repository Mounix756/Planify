@extends('collaborators.app.appAuth')

@section('title')
Signup
@endsection

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
                  <div class="position-relative px-4 px-lg-7 pt-7 pb-7 pb-sm-5 text-center text-md-start pb-lg-7 card-sign-up">
                    <h3 class="mb-3 text-body-emphasis fs-7">Planify</h3>
                    <p class="text-body-tertiary">Votre application de suivi et de planification de projet !</p>
                    {{-- <ul class="list-unstyled mb-0 w-max-content w-md-auto">
                      <li class="d-flex align-items-center"><span class="uil uil-check-circle text-success me-2"></span><span class="text-body-tertiary fw-semibold">Fast</span></li>
                      <li class="d-flex align-items-center"><span class="uil uil-check-circle text-success me-2"></span><span class="text-body-tertiary fw-semibold">Simple</span></li>
                      <li class="d-flex align-items-center"><span class="uil uil-check-circle text-success me-2"></span><span class="text-body-tertiary fw-semibold">Responsive</span></li>
                    </ul> --}}
                  </div>
                  <div class="position-relative z-n1 mb-6 d-none d-md-block text-center mt-md-15">
                    <img class="auth-title-box-img d-dark-none" src="{{asset('/managers/assets/img/spot-illustrations/auth.png')}}" alt="" /><img class="auth-title-box-img d-light-none" src="{{asset('/managers/assets/img/spot-illustrations/auth-dark.png')}}" alt="" /></div>
                </div>
                <div class="col mx-auto">
                  <div class="auth-form-box">
                    <div class="text-center mb-7"><a class="d-flex flex-center text-decoration-none mb-4" href="#">
                        <div class="d-flex align-items-center fw-bolder fs-3 d-inline-block"><img src="{{asset('/logo/logo.jpeg')}}" alt="phoenix" width="58" /></div>
                      </a>
                      <h3 class="text-body-highlight">Inscription</h3>
                      <p class="text-body-tertiary">Veillez remplir tous ces champs !</p>
                    </div>
                    {{-- <button class="btn btn-phoenix-secondary w-100 mb-3"><span class="fab fa-google text-danger me-2 fs-9"></span>M'inscrire avec mon compte google</button><button class="btn btn-phoenix-secondary w-100"><span class="fab fa-facebook text-primary me-2 fs-9"></span>Utiliser mon compte facebook</button>
                    <div class="position-relative mt-4">
                      <hr class="bg-body-secondary" />
                      <div class="divider-content-center bg-body-emphasis">où utiliser mon email</div>
                    </div> --}}
                    <form action="{{route('collaborator_signup_success')}}" method="post">
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

                      @if(session('info'))
                      <div class="alert alert-warning" role="alert">
                          {{ session('info') }}
                      </div>
                      @endif

                      @if(session('message'))
                      <div class="alert alert-warning" role="alert">
                          {{ session('message') }}
                      </div>
                      @endif
                      {{-- <div class="mb-3 text-start">
                        <label class="form-label" for="name">Pays</label>
                        <input class="form-control" name="name" type="text" placeholder="Nom et prenom *" required />
                      </div> --}}

                      <div class="mb-3 text-start">
                        {{-- <label class="form-label" for="email">Nom</label> --}}
                        <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputName">
                            Nom
                        </label>
                        <input class="form-control" name="name" type="text" placeholder="Nom et prenom *" required/>
                      </div>

                      <div class="mb-3 text-start">
                        {{-- <label class="form-label" for="email">Nom</label> --}}
                        <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputName">
                            Email
                        </label>
                        <input class="form-control" name="email" type="text" placeholder="Nom et prenom *" required/>
                      </div>

                      <div class="mb-3 text-start">
                        {{-- <label class="form-label" for="email">Nom</label> --}}
                        <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputName">
                            Mot de passe
                        </label>
                        <input class="form-control" name="password" type="password" placeholder="Mot de passe *" required/>
                      </div>

                      <div class="mb-3 text-start">
                        {{-- <label class="form-label" for="email">Nom</label> --}}
                        <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputName">
                            Confirmation
                        </label>
                        <input class="form-control" name="confirm" type="password" placeholder="Retapez *" required/>
                      </div>


                      {{-- <div class="row g-3 mb-3">
                        <div class="col-xl-6"><label class="form-label" for="password">Mot de passe</label><input class="form-control form-icon-input" name="password" id="password" type="password" placeholder="Mot de passe *" required /></div>
                        <div class="col-xl-6"><label class="form-label" for="confirmPassword">Confirmation</label><input class="form-control form-icon-input" name="confirm" id="confirmPassword" type="password" placeholder="Retapez *" required /></div>
                      </div> --}}
                      <div class="form-check mb-3"><input class="form-check-input" id="termsService" type="checkbox" required /><label class="form-label fs-9 text-transform-none" for="termsService">J'accepte les <a href="#!">termes </a>et <a href="#!">conditions</a></label></div><button class="btn btn-primary w-100 mb-3">S'inscrire</button>
                      <div class="text-center"><a class="fs-9 fw-bold" href="#">J'ai déjà un compte, se connecter</a></div>
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

