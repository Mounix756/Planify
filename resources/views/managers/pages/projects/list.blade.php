@extends('managers.app.app', ['title' => 'Projets'])

@section('title')
    Projets
@endsection

@section('css')

@endsection


@section('content')
<div class="content">
        <nav class="mb-2" aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#!">Gestion de projets</a></li>
            <li class="breadcrumb-item active">Mes projets</li>
          </ol>
        </nav>
        <div class="mb-9">
          <div class="row g-3 mb-4">
            <div class="col-auto">
              <h2 class="mb-0">Liste des projets</h2>
            </div>
          </div>
          <ul class="nav nav-links mb-3 mb-lg-2 mx-n3">
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="#"><span>Tous </span><span class="text-body-tertiary fw-semibold">(2)</span></a></li>
            <li class="nav-item"><a class="nav-link" href="#"><span>En cours </span><span class="text-body-tertiary fw-semibold">(5)</span></a></li>
            <li class="nav-item"><a class="nav-link" href="#"><span>En retard</span><span class="text-body-tertiary fw-semibold">(2)</span></a></li>
            <li class="nav-item"><a class="nav-link" href="#"><span>Terminé</span><span class="text-body-tertiary fw-semibold">(4)</span></a></li>
          </ul>
          <div id="products" data-list='{"valueNames":["product","price","category","tags","vendor","time"],"page":10,"pagination":true}'>
            <div class="mb-4">
              <div class="d-flex flex-wrap gap-3">
                <div class="search-box">
                  <form class="position-relative" data-bs-toggle="search" data-bs-display="static"><input class="form-control search-input search" type="search" placeholder="Rechercher un projet" aria-label="Rechercher" />
                    <span class="fas fa-search search-box-icon"></span>
                  </form>
                </div>
                <div class="scrollbar overflow-hidden-y">
                  <div class="btn-group position-static" role="group">
                    <div class="btn-group position-static text-nowrap">
                        <button class="btn btn-phoenix-secondary px-7 flex-shrink-0" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                            Filtre
                            <span class="fas fa-angle-down ms-2"></span>
                        </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Non commencés</a></li>
                        <li><a class="dropdown-item" href="#">Encours</a></li>
                        <li><a class="dropdown-item" href="#">Terminés</a></li>
                        <li><a class="dropdown-item" href="#">En retard</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="ms-xxl-auto">
                    <button class="btn btn-link text-body me-4 px-0">
                        <span class="fa-solid fa-file-export fs-9 me-2"></span>
                        Exporter
                    </button>
                    <a href="#addProjectBtn" data-bs-toggle="modal">
                        <button class="btn btn-primary" id="addProject">
                            <span class="fas fa-plus me-2"></span>
                            Ajouter un projet
                        </button>
                    </a>
                </div>
              </div>
            </div>
            <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1">
              <div class="table-responsive scrollbar mx-n1 px-1">
                <table class="table fs-9 mb-0">
                  <thead>
                    <tr>
                      <th class="sort white-space-nowrap align-middle fs-10" scope="col">##</th>
                      <th class="sort white-space-nowrap align-middle ps-4" scope="col" data-sort="product">TITRE</th>
                      <th class="sort align-middle text-start ps-4" scope="col" data-sort="price">DESCRIPTION</th>
                      <th class="sort align-middle text-start ps-4" scope="col" data-sort="price">DEBUT</th>
                      <th class="sort align-middle text-start ps-4" scope="col" data-sort="price">FIN</th>
                      <th class="sort align-middle ps-4" scope="col" data-sort="category">STATUS</th>
                      <th class="sort text-start align-middle pe-0 ps-4" scope="col"></th>
                    </tr>
                  </thead>
                  <tbody class="list" id="products-table-body">
                    @foreach ($projects as $project)
                    <tr class="position-static">
                        <td class="product align-middle ps-4"><a class="fw-semibold line-clamp-3 mb-0" href="#"></a></td>
                        <td class="product align-middle ps-4"><a class="fw-semibold line-clamp-3 mb-0" href="#">{{$project->name}}</a></td>
                        <td class="price align-middle white-space-nowrap text-start fw-bold text-body-tertiary ps-4">{!!substr($project ->content, 0, 30)!!}...</td>
                        <td class="category align-middle white-space-nowrap text-body-quaternary fs-9 ps-4 fw-semibold">{{ \Carbon\Carbon::parse($project->start_time)->format('M j, Y') }}</td>
                        <td class="category align-middle white-space-nowrap text-body-quaternary fs-9 ps-4 fw-semibold">{{ \Carbon\Carbon::parse($project->end_time)->format('M j, Y') }}</td>
                        <td class="tags align-middle review pb-2 ps-3">
                            @if ($project->status == -1)
                                <span class="badge badge-tag me-2 mb-2 bg-danger">Pas commencé</span>
                            @elseif ($project->status == 0)
                                <span class="badge badge-tag me-2 mb-2 bg-warning">Encours</span>
                            @else
                                <span class="badge badge-tag me-2 mb-2 bg-success">Terminé</span>
                            @endif
                        </td>
                        <td class="align-middle white-space-nowrap text-start pe-0 ps-4 btn-reveal-trigger">
                          <div class="btn-reveal-trigger position-static">
                            <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                            <div class="dropdown-menu dropdown-menu-end py-2">
                              <a class="dropdown-item" href="#">Editer le projet</a>
                              <a class="dropdown-item" href="#addTaskBtn" data-bs-toggle="modal" data-product-id="{{$project->id}}">Ajouter des taches</a>
                              <a class="dropdown-item" href="#">Voir les taches</a>
                              <a class="dropdown-item text-danger" href="#!" onclick="confirmDelete('{{ route('manager_project_delete', ['token' => $project->token])}}')">Supprimer</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
                <div class="col-auto d-flex">
                  <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p>
                  <a class="fw-semibold" href="#!" data-list-view="*">Voir plus
                    <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span>
                  </a>
                  <a class="fw-semibold d-none" href="#!" data-list-view="less">Voir moins
                    <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span>
                  </a>
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

        @if ($page == 0)
            @include('managers.pages.projects.add')
        @else
            @include('managers.pages.tasks.add')
        @endif

    </div>
@endsection


@section('js')

<script>
    document.addEventListener('DOMContentLoaded', function() {
      // Récupérer le modal et le champ eleve_id
      const modal = document.getElementById('addTaskBtn');
      const productIdInput = modal.querySelector('input[name="project_id"]');

      // Écouter le clic sur les boutons "Faire une promotion"
      const promotionButtons = document.querySelectorAll('[data-bs-toggle="modal"]');
      promotionButtons.forEach(button => {
        button.addEventListener('click', function() {
          const productId = this.getAttribute('data-product-id');
          // Affecter l'ID du produit au champ product_id dans le formulaire
          productIdInput.value = productId;
        });
      });
    });
</script>




{{-- Script pour afficher un popup de confirmation lorsque l'utilisateur souhaite supprimer un produit. --}}
<script>
    function confirmDelete(deleteUrl) {
        // Afficher la popup de confirmation
        Swal.fire({
            title: 'Êtes-vous sûr de vouloir supprimer cet projet?',
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
