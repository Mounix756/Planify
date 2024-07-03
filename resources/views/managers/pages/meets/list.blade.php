@extends('managers.app.app', ['title' => 'Projets'])

@section('title')
    Réunions
@endsection

@section('css')

@endsection


@section('content')
<div class="content">
    <nav class="mb-2" aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{route('manager_home')}}">Accueil</a></li>
        <li class="breadcrumb-item"><a href="#!">Gestion de réunions</a></li>
        <li class="breadcrumb-item active">Réunions</li>
      </ol>
    </nav>
    <div class="row gx-6 gy-3 mb-4 align-items-center">
      <div class="col-auto">
        <h2 class="mb-0">Réunions prévues<span class="fw-normal text-body-tertiary ms-3">({{$meets_count}})</span></h2>
      </div>
      <div class="col-auto"><a class="btn btn-primary px-5" href="#addMeetBtn" data-bs-toggle="modal"><span class="fa-solid fa-plus me-2"></span>Créer une réunion</a></div>
    </div>
    <div class="row justify-content-between align-items-end mb-4 g-3">
      <div class="col-12 col-sm-auto">
        <ul class="nav nav-links mb-3 mb-lg-2 mx-n3">
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="#"><span>Tous </span><span class="text-body-tertiary fw-semibold">(2)</span></a></li>
            <li class="nav-item"><a class="nav-link" href="#"><span>Prochaines</span><span class="text-body-tertiary fw-semibold">({{$ongoing_count}})</span></a></li>
            <li class="nav-item"><a class="nav-link" href="#"><span>Terminé</span><span class="text-body-tertiary fw-semibold">({{$finish_count}})</span></a></li>
        </ul>
      </div>
      <div class="col-12 col-sm-auto">
        <div class="d-flex align-items-center">
          <div class="search-box me-3">
            <form class="position-relative" data-bs-toggle="search" data-bs-display="static"><input class="form-control search-input search" type="search" placeholder="Search projects" aria-label="Search" />
              <span class="fas fa-search search-box-icon"></span>
            </form>
          </div><a class="btn btn-phoenix-primary px-3 me-1" href="project-list-view.html" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="List view"><span class="fa-solid fa-list fs-10"></span></a><a class="btn btn-phoenix-primary px-3 me-1 border-0 text-body" href="project-board-view.html" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Board view"><svg width="9" height="9" viewbox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M0 0.5C0 0.223857 0.223858 0 0.5 0H1.83333C2.10948 0 2.33333 0.223858 2.33333 0.5V1.83333C2.33333 2.10948 2.10948 2.33333 1.83333 2.33333H0.5C0.223857 2.33333 0 2.10948 0 1.83333V0.5Z" fill="currentColor"></path>
              <path d="M3.33333 0.5C3.33333 0.223857 3.55719 0 3.83333 0H5.16667C5.44281 0 5.66667 0.223858 5.66667 0.5V1.83333C5.66667 2.10948 5.44281 2.33333 5.16667 2.33333H3.83333C3.55719 2.33333 3.33333 2.10948 3.33333 1.83333V0.5Z" fill="currentColor"></path>
              <path d="M6.66667 0.5C6.66667 0.223857 6.89052 0 7.16667 0H8.5C8.77614 0 9 0.223858 9 0.5V1.83333C9 2.10948 8.77614 2.33333 8.5 2.33333H7.16667C6.89052 2.33333 6.66667 2.10948 6.66667 1.83333V0.5Z" fill="currentColor"></path>
              <path d="M0 3.83333C0 3.55719 0.223858 3.33333 0.5 3.33333H1.83333C2.10948 3.33333 2.33333 3.55719 2.33333 3.83333V5.16667C2.33333 5.44281 2.10948 5.66667 1.83333 5.66667H0.5C0.223857 5.66667 0 5.44281 0 5.16667V3.83333Z" fill="currentColor"></path>
              <path d="M3.33333 3.83333C3.33333 3.55719 3.55719 3.33333 3.83333 3.33333H5.16667C5.44281 3.33333 5.66667 3.55719 5.66667 3.83333V5.16667C5.66667 5.44281 5.44281 5.66667 5.16667 5.66667H3.83333C3.55719 5.66667 3.33333 5.44281 3.33333 5.16667V3.83333Z" fill="currentColor"></path>
              <path d="M6.66667 3.83333C6.66667 3.55719 6.89052 3.33333 7.16667 3.33333H8.5C8.77614 3.33333 9 3.55719 9 3.83333V5.16667C9 5.44281 8.77614 5.66667 8.5 5.66667H7.16667C6.89052 5.66667 6.66667 5.44281 6.66667 5.16667V3.83333Z" fill="currentColor"></path>
              <path d="M0 7.16667C0 6.89052 0.223858 6.66667 0.5 6.66667H1.83333C2.10948 6.66667 2.33333 6.89052 2.33333 7.16667V8.5C2.33333 8.77614 2.10948 9 1.83333 9H0.5C0.223857 9 0 8.77614 0 8.5V7.16667Z" fill="currentColor"></path>
              <path d="M3.33333 7.16667C3.33333 6.89052 3.55719 6.66667 3.83333 6.66667H5.16667C5.44281 6.66667 5.66667 6.89052 5.66667 7.16667V8.5C5.66667 8.77614 5.44281 9 5.16667 9H3.83333C3.55719 9 3.33333 8.77614 3.33333 8.5V7.16667Z" fill="currentColor"></path>
              <path d="M6.66667 7.16667C6.66667 6.89052 6.89052 6.66667 7.16667 6.66667H8.5C8.77614 6.66667 9 6.89052 9 7.16667V8.5C9 8.77614 8.77614 9 8.5 9H7.16667C6.89052 9 6.66667 8.77614 6.66667 8.5V7.16667Z" fill="currentColor"></path>
            </svg></a><a class="btn btn-phoenix-primary px-3" href="project-card-view.html" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Card view"><svg width="9" height="9" viewBox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M0 0.5C0 0.223858 0.223858 0 0.5 0H3.5C3.77614 0 4 0.223858 4 0.5V3.5C4 3.77614 3.77614 4 3.5 4H0.5C0.223858 4 0 3.77614 0 3.5V0.5Z" fill="currentColor"></path>
              <path d="M0 5.5C0 5.22386 0.223858 5 0.5 5H3.5C3.77614 5 4 5.22386 4 5.5V8.5C4 8.77614 3.77614 9 3.5 9H0.5C0.223858 9 0 8.77614 0 8.5V5.5Z" fill="currentColor"></path>
              <path d="M5 0.5C5 0.223858 5.22386 0 5.5 0H8.5C8.77614 0 9 0.223858 9 0.5V3.5C9 3.77614 8.77614 4 8.5 4H5.5C5.22386 4 5 3.77614 5 3.5V0.5Z" fill="currentColor"></path>
              <path d="M5 5.5C5 5.22386 5.22386 5 5.5 5H8.5C8.77614 5 9 5.22386 9 5.5V8.5C9 8.77614 8.77614 9 8.5 9H5.5C5.22386 9 5 8.77614 5 8.5V5.5Z" fill="currentColor"></path>
            </svg></a>
        </div>
      </div>
    </div>
    <div class="row g-3 mb-9">

      @foreach ($meets as $meet)
      <div class="col-12 col-sm-6 col-md-4 col-xxl-3">
        <div class="btn-reveal-trigger position-relative rounded-2 overflow-hidden p-4" style="height: 236px;">
          <div class="bg-holder" style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0) 39.41%, rgba(0, 0, 0, 0.4) 100%), url(/logo/meet.jpg)"></div>
          <div class="position-relative h-100 d-flex flex-column justify-content-between">
            <div class="d-flex justify-content-between align-items-center"><span class="badge badge-phoenix fs-10 badge-phoenix-primary" data-bs-theme="light">Bientôt</span>
              <div class="z-2"><button class="btn btn-icon btn-reveal dropdown-toggle dropdown-caret-none transition-none" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-v"></span></button>
                <div class="dropdown-menu dropdown-menu-end py-2">
                    <a class="dropdown-item" href="{{route('manager_show_meet', ['token' => $meet->token])}}">Voir plus</a>
                    <a class="dropdown-item" href="{{route('manager_show_meet', ['token' => $meet->token])}}">Inviter</a>
                    <a class="dropdown-item" href="#!">Exporter</a>
                <div class="dropdown-divider">
              </div>
              <a class="dropdown-item text-danger" href="#!" onclick="confirmDelete('{{ route('manager_meet_delete', ['token' => $meet->token])}}')">Supprimer</a>
                </div>
              </div>
            </div>
            <h3 class="text-white fw-bold line-clamp-2">{{$meet->subject}}</h3>
          </div><a class="stretched-link" href="#projectsBoardViewModal" data-bs-toggle="modal"></a>
        </div>
      </div>
      @endforeach

      {{--<div class="col-12 col-sm-6 col-md-4 col-xxl-3">
        <div class="btn-reveal-trigger position-relative rounded-2 overflow-hidden p-4" style="height: 236px;">
          <div class="bg-holder" style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0) 39.41%, rgba(0, 0, 0, 0.4) 100%), url(/managers/assets/img/generic/52.png)"></div>
          <div class="position-relative h-100 d-flex flex-column justify-content-between">
            <div class="d-flex justify-content-between align-items-center"><span class="badge badge-phoenix fs-10 badge-phoenix-warning" data-bs-theme="light">Completed</span>
              <div class="z-2"><button class="btn btn-icon btn-reveal dropdown-toggle dropdown-caret-none transition-none" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-v"></span></button>
                <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                  <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                </div>
              </div>
            </div>
            <h3 class="text-white fw-bold line-clamp-2">Project Doughnut Dungeon</h3>
          </div><a class="stretched-link" href="#projectsBoardViewModal" data-bs-toggle="modal"></a>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4 col-xxl-3">
        <div class="btn-reveal-trigger position-relative rounded-2 overflow-hidden p-4" style="height: 236px;">
          <div class="bg-holder" style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0) 39.41%, rgba(0, 0, 0, 0.4) 100%), url(/managers/assets/img/generic/53.png)"></div>
          <div class="position-relative h-100 d-flex flex-column justify-content-between">
            <div class="d-flex justify-content-between align-items-center"><span class="badge badge-phoenix fs-10 badge-phoenix-warning" data-bs-theme="light">Completed</span>
              <div class="z-2"><button class="btn btn-icon btn-reveal dropdown-toggle dropdown-caret-none transition-none" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-v"></span></button>
                <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                  <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                </div>
              </div>
            </div>
            <h3 class="text-white fw-bold line-clamp-2">Harnessing stupidity from Jerry the Mortypop</h3>
          </div><a class="stretched-link" href="#projectsBoardViewModal" data-bs-toggle="modal"></a>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4 col-xxl-3">
        <div class="btn-reveal-trigger position-relative rounded-2 overflow-hidden p-4" style="height: 236px;">
          <div class="bg-holder" style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0) 39.41%, rgba(0, 0, 0, 0.4) 100%), url(/managers/assets/img/generic/54.png)"></div>
          <div class="position-relative h-100 d-flex flex-column justify-content-between">
            <div class="d-flex justify-content-between align-items-center"><span class="badge badge-phoenix fs-10 badge-phoenix-info" data-bs-theme="light">Inactive</span>
              <div class="z-2"><button class="btn btn-icon btn-reveal dropdown-toggle dropdown-caret-none transition-none" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-v"></span></button>
                <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                  <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                </div>
              </div>
            </div>
            <h3 class="text-white fw-bold line-clamp-2">Making the Butterflies shoot each other dead</h3>
          </div><a class="stretched-link" href="#projectsBoardViewModal" data-bs-toggle="modal"></a>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4 col-xxl-3">
        <div class="btn-reveal-trigger position-relative rounded-2 overflow-hidden p-4" style="height: 236px;">
          <div class="bg-holder" style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0) 39.41%, rgba(0, 0, 0, 0.4) 100%), url(/managers/assets/img/generic/55.png)"></div>
          <div class="position-relative h-100 d-flex flex-column justify-content-between">
            <div class="d-flex justify-content-between align-items-center"><span class="badge badge-phoenix fs-10 badge-phoenix-warning" data-bs-theme="light">Completed</span>
              <div class="z-2"><button class="btn btn-icon btn-reveal dropdown-toggle dropdown-caret-none transition-none" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-v"></span></button>
                <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                  <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                </div>
              </div>
            </div>
            <h3 class="text-white fw-bold line-clamp-2">The chewing gum attack</h3>
          </div><a class="stretched-link" href="#projectsBoardViewModal" data-bs-toggle="modal"></a>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4 col-xxl-3">
        <div class="btn-reveal-trigger position-relative rounded-2 overflow-hidden p-4" style="height: 236px;">
          <div class="bg-holder" style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0) 39.41%, rgba(0, 0, 0, 0.4) 100%), url(/managers/assets/img/generic/56.png)"></div>
          <div class="position-relative h-100 d-flex flex-column justify-content-between">
            <div class="d-flex justify-content-between align-items-center"><span class="badge badge-phoenix fs-10 badge-phoenix-primary" data-bs-theme="light">Ongoing</span>
              <div class="z-2"><button class="btn btn-icon btn-reveal dropdown-toggle dropdown-caret-none transition-none" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-v"></span></button>
                <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                  <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                </div>
              </div>
            </div>
            <h3 class="text-white fw-bold line-clamp-2">Water resistant mosquito killer gun, version 2.1.0</h3>
          </div><a class="stretched-link" href="#projectsBoardViewModal" data-bs-toggle="modal"></a>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4 col-xxl-3">
        <div class="btn-reveal-trigger position-relative rounded-2 overflow-hidden p-4" style="height: 236px;">
          <div class="bg-holder" style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0) 39.41%, rgba(0, 0, 0, 0.4) 100%), url(/managers/assets/img/generic/57.png)"></div>
          <div class="position-relative h-100 d-flex flex-column justify-content-between">
            <div class="d-flex justify-content-between align-items-center"><span class="badge badge-phoenix fs-10 badge-phoenix-warning" data-bs-theme="light">Completed</span>
              <div class="z-2"><button class="btn btn-icon btn-reveal dropdown-toggle dropdown-caret-none transition-none" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-v"></span></button>
                <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                  <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                </div>
              </div>
            </div>
            <h3 class="text-white fw-bold line-clamp-2">Water resistant mosquito killer gun, version 2.1.0</h3>
          </div><a class="stretched-link" href="#projectsBoardViewModal" data-bs-toggle="modal"></a>
        </div>
      </div>--}}
    </div>

    @include('managers.pages.meets.add')
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
