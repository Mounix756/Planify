@extends('managers.app.app', ['title' => 'Réunions'])

@section('title')
    Réunions
@endsection

@section('css')

@endsection


@section('content')
<div class="content">
    <nav class="mb-2" aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{route('collaborator_home')}}">Accueil</a></li>
        <li class="breadcrumb-item"><a href="#!">Réunions</a></li>
        <li class="breadcrumb-item active">Liste</li>
      </ol>
    </nav>
    <div class="pb-9">
      <h2 class="mb-4 mb-lg-6">Mes réunions</h2><img class="rounded w-100 fit-cover mb-5 mb-md-6 mb-xl-8" src="{{asset('/logo/meet.jpg')}}" alt="" style="max-height: 300px;" />
      <div class="row gx-lg-9">
        <div class="col-xl-8 border-end-xl">
          <div class="card mb-9">
            <div class="card-body">
              <h1 class="lh-sm fs-6 fs-xxl-4 mb-2">{{$meet->subject}}</h1>
              <div class="card mb-5 mb-xxl-7">
                <div class="card-body">
                  <div class="row gy-5">
                    <div class="col-md-6 d-flex justify-content-between">
                      <div>
                        <div class="mb-3">
                          <div class="d-flex align-items-center">
                            <div class="px-2 py-1 bg-info-subtle rounded"><span class="text-info" data-feather="map-pin"></span></div>
                            <h5 class="ms-2 text-body-emphasis mb-0">Location</h5>
                          </div>
                        </div>
                        <p class="lh-sm mb-0 text-body-tertiary">ESGIS Avedji.<br /></p>
                      </div>
                      <div class="my-4 mx-3 border-start border-translucent d-none d-md-block"></div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <div class="d-flex align-items-center">
                          <div class="px-2 py-1 bg-primary-subtle rounded"><span class="text-primary" data-feather="clock"></span></div>
                          <h5 class="ms-2 mb-0">Date</h5>
                        </div>
                      </div>
                      <p class="lh-sm mb-0 text-body-tertiary">{{ \Carbon\Carbon::parse($meet->start_time)->format('M j, Y') }} - {{ \Carbon\Carbon::parse($meet->start_time)->format('H:i') }}<br/>
                        {{ \Carbon\Carbon::parse($meet->start_time)->format('M j, Y') }} - {{ \Carbon\Carbon::parse($meet->end_time)->format('H:i') }}
                    </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row g-2">
                <form action="{{route('manager_invite_collaborator')}}" method="post">
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
                                {{ session('infos') }}
                            </div>
                        @endif

                    <div class="col-12 mb-6" style="display: none">
                        <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputAddress1">Meet</label>
                        <input type="text" class="form-control" name="meet_id" value="{{$meet->id}}">
                    </div>

                    <div class="col-12">
                        {{-- <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="user_id">Début</label> --}}
                        <div class="d-flex align-items-center">
                            <select class="form-select mr-2" name="user_id">
                                @foreach ($collaborators_list as $my_collaborator)
                                    <option value="{{ $my_collaborator->id }}">{{ $my_collaborator->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 mt-3 mb-9">
                            <button class="btn btn-primary w-100" type="submit">Inviter</button>
                        </div>
                        <div class="col-6 mt-3 mb-9">
                            <a href="{{route('manager_send_meet_notification', ['token' => $meet->token])}}"><button class="btn btn-primary w-100" type="button">Notifier par mail</button></a>
                        </div>
                    </div>
                </form>


                <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1">
                    <div class="table-responsive scrollbar-overlay mx-n1 px-1">
                      <table class="table table-sm fs-9 mb-0">
                        <thead>
                          <tr>
                            <th class="sort align-middle pe-5" scope="col" data-sort="customer" style="width:10%;">NOM</th>
                            <th class="sort align-middle pe-5" scope="col" data-sort="email" style="width:20%;">EMAIL</th>
                            <th class="sort align-middle text-start" scope="col" data-sort="total-orders" style="width:10%">FONCTION</th>
                            <th class="sort align-middle text-start" scope="col" data-sort="total-orders" style="width:10%">STATUS</th>
                          </tr>
                        </thead>
                        <tbody class="list" id="customers-table-body">
                          @foreach ($collaborators as $collaborator)
                          <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                              <td class="customer align-middle white-space-nowrap pe-5"><a class="d-flex align-items-center text-body-emphasis" href="customer-details.html">
                                  <div class="avatar avatar-m"><img class="rounded-circle avatar-placeholder" src="/managers/assets/img/team/avatar.webp" alt="" /></div>
                                  <p class="mb-0 ms-3 text-body-emphasis fw-bold">{{$collaborator->name}}</p>
                                </a>
                              </td>
                              <td class="email align-middle white-space-nowrap pe-5"><a class="fw-semibold" href="mailto:{{$collaborator->email}}">{{$collaborator->email}}</a></td>
                              <td class="total-orders align-middle white-space-nowrap fw-semibold text-end text-body-highlight">
                                @if ($collaborator->fonction == NULL)
                                <em>Non renseigné</em>
                                @else
                                <span class="badge badge-info badge-pill">{{$collaborator->fonction}}</span>
                                @endif
                              </td>

                              <td class="total-orders align-middle white-space-nowrap fw-semibold text-end text-body-highlight">
                                @if ($collaborator->statut == 0)
                                    <strong style="color: red">Non confirmé</strong>
                                @else
                                    <strong style="color: blue">Confirmé</strong>
                                @endif
                              </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
                      <div class="col-auto d-flex">
                        <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p><a class="fw-semibold" href="#!" data-list-view="*">View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a><a class="fw-semibold d-none" href="#!" data-list-view="less">View Less<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                      </div>
                      <div class="col-auto d-flex">
                        <button class="page-link" data-list-pagination="prev">
                            <span class="fas fa-chevron-left"></span>
                        </button>
                        <ul class="mb-0 pagination"></ul>
                        <button class="page-link pe-0" data-list-pagination="next">
                            <span class="fas fa-chevron-right"></span>
                        </button>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <h3 class="mb-5 mb-xl-4">Créer par :</h3>
          <div class="row g-2 mb-6 align-items-center">
            <div class="col-auto">
                <img class="rounded img-fluid" src="/managers/assets/img/team/avatar.webp" alt="..." width="40" height="40" />
            </div>
            <div class="col-sm-auto flex-1"><a class="mb-0 text-primary fw-semibold lh-sm" href="#!">{{$meet->name}}</a></div>
            <div class="col-sm-auto col-xl-12 col-xxl-auto"><button class="btn btn-link text-body p-0 me-1" type="button">10k Followers </button><button class="btn btn-phoenix-primary px-3" type="button"><span class="fa-solid fa-user-plus me-2"></span>Follow</button></div>
            <h2>Description</h2>
            <p class="text-justify">{!!$meet->content!!}</p>

          </div>
        </div>
      </div>
    </div>
    @include('collaborators.partial.footer')
</div>
@endsection


@section('js')

{{-- Script pour afficher un popup de confirmation lorsque l'utilisateur souhaite supprimer un produit. --}}
<script>
    function confirmDelete(deleteUrl) {
        // Afficher la popup de confirmation
        Swal.fire({
            title: 'Êtes-vous sûr de vouloir supprimer cette réunion?',
            text: "Cette action est irréversible !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler',
        }).then((result) => {
            // Si l'utilisateur clique sur "Oui, supprimer" dans la popup, effectuer la suppression
            if (result.isConfirmed) {
                // Rediriger vers l'URL de suppression passée en paramètre
                window.location.href = deleteUrl;
            }
            // Sinon, ne rien faire
        });
    }
</script>


<script>
    $(document).ready(function() {
        $('#content').summernote({
            height: "120px",
            placeholder: "Votre message * *"
        })
    })
</script>



{{-- Popup d'affichage d'eventuel erreurs survenues lors d'une opération. --}}
<script>
    @if(session('error'))
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Erreur',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    });
    @endif
</script>

{{-- Popup affichant une opération réussie --}}

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Succès',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK',
            showConfirmButton: false,
        });
    });
</script>
@endif
@endsection
