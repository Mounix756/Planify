@extends('managers.app.app', ['title' => 'Création des taches'])

@section('title')
    Taches
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
    <h2 class="mb-4">Créer une tache</h2>
    <div class="row">
      <div class="col-xl-9">
        <form class="row g-3 mb-6" method="POST" action="{{route('task_add')}}" enctype="multipart/form-data">
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
          <div class=" col-md-10 ">
            <div class="form-floating" style="display: none">
              <input class="form-control" name="name" id="floatingInputGrid" type="text" value="{{Auth::guard('manager')->user()->id}}" />
              <label for="floatingInputGrid">Nom de la tache</label>
            </div>
          </div>
          <div class=" col-md-10 ">
            <div class="form-floating">
              <input class="form-control" name="name" id="floatingInputGrid" type="text" placeholder="Nom de la tache" />
              <label for="floatingInputGrid">Nom de la tache</label>
            </div>
          </div>
         <div class="row mt-4">
          <div class=" col-md-5">
            <div class="flatpickr-input-container">
              <div class="form-floating">
                <input class="form-control datetimepicker" name="start_time" id="floatingInputStartDate" type="text" placeholder="date debut" data-options='{"disableMobile":true}' />
                <label class="ps-6" for="floatingInputStartDate">Date debut</label>
                <span class="uil uil-calendar-alt flatpickr-icon text-body-tertiary"></span
                  ></div>
            </div>
          </div>
          <div class=" col-md-5">
            <div class="flatpickr-input-container">
              <div class="form-floating">
                <input class="form-control datetimepicker" name="end_time" id="floatingInputDeadline" type="text" placeholder="date fin" data-options='{"disableMobile":true}' />
                <label class="ps-6" for="floatingInputDeadline">Date fin</label><span class="uil uil-calendar-alt flatpickr-icon text-body-tertiary"></span>
              </div>
            </div>
          </div>
         </div>
          
          <div class="col-12 gy-6">
            <div class="row g-3 justify-content-center">
              <div class="col-auto"><button class="btn btn-phoenix-primary px-5">Supprimer</button></div>
              <div class="col-auto"><button type="submit" class="btn btn-primary px-5 px-sm-15">Créer la tache</button></div>
            </div>
          </div>
        </form>
      </div>
    </div>
   
  </div>
  @endsection


@section('js')

<script>
  document.addEventListener('DOMContentLoaded', function () {
      var element = document.getElementById('organizerMultiple');
      var choices = new Choices(element, {
          removeItemButton: true,
          placeholder: true
      });
  });
</script>

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


{{-- Script d'affichage de popup de confirmation lorsque l'utilisateur souhaite publier un produit --}}
<script>
    function confirmPublish(deleteUrl) {
        Swal.fire({
            title: 'Le produit sera visible sur la plateforme lavendeuse.africa.',
            // text: "Cette action est irréversible !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, publier',
            cancelButtonText: 'Annuler',
        }).then((result) => {
            // Si l'utilisateur clique sur "Oui, publier" dans la popup, effectuer la publication
            if (result.isConfirmed) {
                // Rediriger vers l'URL de publication passée en paramètre
                window.location.href = deleteUrl;
            }
            // Sinon, ne rien faire
        });
    }
</script>

{{-- Script d'affichage de popup de confirmation lorsque l'utilisateur souhaite annuler la publication du produit --}}
<script>
    function confirmNotPublish(deleteUrl) {
        Swal.fire({
            title: 'Le produit ne sera plus visible sur la plateforme lavendeuse.africa.',
            // text: "Cette action est irréversible !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, depublier',
            cancelButtonText: 'Annuler',
        }).then((result) => {
            // Si l'utilisateur clique sur "Oui, annuler" dans la popup, effectuer l'annulation
            if (result.isConfirmed) {
                // Rediriger vers l'URL d'annulation passée en paramètre
                window.location.href = deleteUrl;
            }
            // Sinon, ne rien faire
        });
    }
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

        // setTimeout(function() {
        //     window.location.href = '{{ route('admin_students_list') }}';
        // }, 1000);
    });
</script>
@endif
@endsection
