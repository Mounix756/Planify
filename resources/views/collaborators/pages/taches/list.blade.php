@extends('managers.app.app', ['title' => 'Mes taches'])

@section('title')
    Mes taches
@endsection

@section('css')

@endsection


@section('content')
<div class="content">
    <nav class="mb-2" aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="#!">Page 1</a></li>
        <li class="breadcrumb-item"><a href="#!">Page 2</a></li>
        <li class="breadcrumb-item active">Default</li>
      </ol>
    </nav>
    <div class="mb-9">
      <div id="projectSummary" data-list='{"valueNames":["projectName","assigness","start","deadline","task","projectprogress","status","action"],"page":6,"pagination":true}'>
        <div class="row mb-4 gx-6 gy-3 align-items-center">
          <div class="col-auto">
            <h2 class="mb-0">Projects<span class="fw-normal text-body-tertiary ms-3">(32)</span></h2>
          </div>
          <a href="#addAssignBtn" data-bs-toggle="modal">
            <button class="btn btn-primary" id="addProject">
                <span class="fas fa-plus me-2"></span>
                Ajouter une assignation
            </button>
        </a>        </div>
        <div class="row g-3 justify-content-between align-items-end mb-4">
          <div class="col-12 col-sm-auto">
            <ul class="nav nav-links mx-n2">
              <li class="nav-item"><a class="nav-link px-2 py-1 active" aria-current="page" href="#"><span>All</span><span class="text-body-tertiary fw-semibold">(32)</span></a></li>
              <li class="nav-item"><a class="nav-link px-2 py-1" href="#"><span>Ongoing</span><span class="text-body-tertiary fw-semibold">(14)</span></a></li>
              <li class="nav-item"><a class="nav-link px-2 py-1" href="#"><span>Cancelled</span><span class="text-body-tertiary fw-semibold">(2)</span></a></li>
              <li class="nav-item"><a class="nav-link px-2 py-1" href="#"><span>Finished</span><span class="text-body-tertiary fw-semibold">(14)</span></a></li>
              <li class="nav-item"><a class="nav-link px-2 py-1" href="#"><span>Postponed</span><span class="text-body-tertiary fw-semibold">(2)</span></a></li>
            </ul>
          </div>
          <div class="col-12 col-sm-auto">
            <div class="d-flex align-items-center">
              <div class="search-box me-3">
                <form class="position-relative" data-bs-toggle="search" data-bs-display="static"><input class="form-control search-input search" type="search" placeholder="Search projects" aria-label="Search" />
                  <span class="fas fa-search search-box-icon"></span>
                </form>
              </div><a class="btn btn-phoenix-primary px-3 me-1 border-0 text-body" href="project-list-view.html" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="List view"><span class="fa-solid fa-list fs-10"></span></a><a class="btn btn-phoenix-primary px-3 me-1" href="project-board-view.html" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Board view"><svg width="9" height="9" viewbox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg">
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
        <div class="table-responsive scrollbar">
          <table class="table fs-9 mb-0 border-top border-translucent">
            <thead>
              <tr>
                <th class="sort white-space-nowrap align-middle ps-0" scope="col" data-sort="projectName" style="width:30%;">##</th>
                <th class="sort white-space-nowrap align-middle ps-0" scope="col" data-sort="projectName" style="width:30%;">NOM PROJETS</th>
                <th class="sort white-space-nowrap align-middle ps-0" scope="col" data-sort="projectName" style="width:30%;">NOM TACHES</th>
                <th class="sort white-space-nowrap align-middle ps-0" scope="col" data-sort="projectName" style="width:30%;">STATUS</th>
                <th class="sort align-middle ps-3" scope="col" data-sort="start" style="width:10%;">DATE DEBUT</th>
                <th class="sort align-middle ps-3" scope="col" data-sort="deadline" style="width:15%;">DATE FIN</th>
                <th class="sort align-middle text-end" scope="col" data-sort="statuses" style="width:10%;">ACTIONS</th>
                <th class="sort align-middle text-end" scope="col" style="width:10%;"></th>
              </tr>
            </thead>
            <tbody class="list" id="project-list-table-body">
              @php
              $numero = 0;
              @endphp
              @foreach ($assignments as $assignment)
              @php
              $numero +=1
             
              @endphp
              <tr class="position-static">
                <td class="product align-middle ps-4">{{$numero}}</td>
                <td class="align-middle time white-space-nowrap ps-0 projectName py-4" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">{{ $assignment->projet }}</td>
                <td class="align-middle time white-space-nowrap ps-0 projectName py-4" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">{{ $assignment->name }}</td>
                <td class="align-middle time white-space-nowrap ps-0 projectName py-4" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">
                  @if ($assignment->status == -1)
                  <span class="badge badge-tag me-2 mb-2 bg-danger">Pas commencé</span>
              @elseif ($assignment->status == 0)
                  <span class="badge badge-tag me-2 mb-2 bg-warning">Encours</span>
              @else
                  <span class="badge badge-tag me-2 mb-2 bg-success">Terminé</span>
              @endif
              </td>
                <td class="align-middle white-space-nowrap start ps-3 py-4" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">{{ \Carbon\Carbon::parse($assignment->start_time)->format('M j, Y') }}</td>
                <td class="align-middle white-space-nowrap deadline ps-3 py-4" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">{{ \Carbon\Carbon::parse($assignment->end_time)->format('M j, Y') }}</td>
                <td class="align-middle white-space-nowrap text-start pe-0 ps-4 btn-reveal-trigger">
                    <div class="btn-reveal-trigger position-static">
                      <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                      <div class="dropdown-menu dropdown-menu-end py-2">
                        <a class="dropdown-item" href="#editAssignBtn" data-bs-toggle="modal" data-product-id="">Marquer comme terminer</a>
                        </div>
                    </div>
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="d-flex flex-wrap align-items-center justify-content-between py-3 pe-0 fs-9 border-bottom border-translucent">
          <div class="d-flex">
            <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p><a class="fw-semibold" href="#!" data-list-view="*">View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a><a class="fw-semibold d-none" href="#!" data-list-view="less">View Less<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
          </div>
          <div class="d-flex"><button class="page-link" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
            <ul class="mb-0 pagination"></ul><button class="page-link pe-0" data-list-pagination="next"><span class="fas fa-chevron-right"></span></button>
          </div>
        </div>
      </div>
    </div>
   
    {{-- @include('managers.pages.assignations.edit') --}}

    {{-- @include('managers.pages.assignations.add') --}}
   

  </div>

  @endsection


@section('js')

<script>
    document.addEventListener('DOMContentLoaded', function() {
      // Récupérer le modal et le champ eleve_id
      const modal = document.getElementById('AjoutProjet');
      const productIdInput = modal.querySelector('input[name="id"]');

      // Écouter le clic sur les boutons "Faire une promotion"
      const promotionButtons = document.querySelectorAll('[data-bs-toggle="modal"]');
      promotionButtons.forEach(button => {
        button.addEventListener('click', function() {
          const productId = this.getAttribute('data-product-id');
          // Affecter l'ID du produit au champ product_id dans le formulaire
          productIdInput.value = id;
        });
      });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editModal = document.getElementById('editAssignBtn');
        const productIdInput = editModal.querySelector('input[name="user_id"]');
        const productNameInput = editModal.querySelector('input[name="name"]');
        const productContentTextarea = editModal.querySelector('input[name="user_name"]');
    
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const productId = button.getAttribute('data-product-id');
            const productName = button.getAttribute('data-product-name');
            const productStartTime = button.getAttribute('data-product-start-time');
            const productEndTime = button.getAttribute('data-product-end-time');
            const productContent = button.getAttribute('data-product-content');
    
            productIdInput.value = productId;
            productNameInput.value = productName;
            productStartTimeInput.value = productStartTime;
            productEndTimeInput.value = productEndTime;
            productContentTextarea.value = productContent;
        });
    });
    </script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Récupérer le modal et le champ eleve_id
    const modal = document.getElementById('EditProjet');
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
            title: 'Êtes-vous sûr de vouloir supprimer cet élève ?',
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
            height: "220px",
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