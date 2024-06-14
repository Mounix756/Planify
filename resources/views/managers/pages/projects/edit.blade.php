@extends('managers.app.app', ['title' => 'Nos projets'])

@section('title')
    projets
@endsection

@section('css')

@endsection


@section('content')
<div class="modal fade" id="EditProjet" tabindex="-1" aria-labelledby="projectsBoardViewModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content overflow-hidden">
        <div class="modal-header position-relative p-0">
            <button class="btn btn-circle project-modal-btn position-absolute end-0 top-0 mt-3 me-3 bg-body-emphasis" data-bs-dismiss="modal">
                <span class="fa-solid fa-xmark text-body dark__text-white"></span>
            </button>
        </div>
          <div class="row mt-8" style="margin: 20px">
            <form method="post" action="{{route('update_project')}}" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-12 mb-4 mb-lg-0">
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
                        <h3 class="mb-5">Projets</h3>
                        <div class="row g-4">
                            
                            <div class="col-12">
                                <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputAddress1">Nom du projet</label>
                                <input class="form-control" id="inputAddress1" name="name" type="text" placeholder="Nom du projet *" value="{{ isset($project) ? $project->name : '' }}"/>
                            </div>

                            <div class="col-12" style="display: none">
                                <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputAddress1">Prenom de l'élève</label>
                                <input class="form-control" name="sender_id" type="text" value="{{ isset($project) ? $project->id : '' }}"/>
                            </div>


                            <div class="col-12">
                                <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputAddress1">Description du projet</label>
                                <textarea id="content" class="form-control" name="content" type="text" placeholder="Description du projet *">{{ isset($project) ? $project->content : '' }}</textarea>
                            </div>

                            <div class="col-12">
                                <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="startDate">Date de début</label>
                                <input class="form-control" id="startDate" name="start_time" type="date" placeholder="Date de début *" value="{{ isset($project) ? $project->start_time : '' }}" />
                            </div>
                            <div class="col-12">
                                <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="endDate">Date de fin</label>
                                <input class="form-control" id="endDate" name="end_time" type="date" placeholder="Date de fin *" value="{{ isset($project) ? $project->end_time : '' }}"/>
                            </div>

                            <div class="col-lg-12">
                                <button class="btn btn-primary mb-2 px-8 px-sm-11 me-2" onclick="confirmUpdate()" type="submit" >Enregistrer</button>
                                <a href="#"><button class="btn btn-phoenix-secondary text-nowrap" type="button">Effacer</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
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

<script>
    $(document).ready(function() {
        $('#contenu').summernote({
            height: "200px",
            placeholder: "Entrez le contenu de l'actualité*"
        })
    })
</script>

{{-- Script pour demander la confirmation avant d'effectuer la mise à jour de l'actualité --}}

<script>
    function confirmUpdate() {
        // Afficher la boîte de dialogue de confirmation
        Swal.fire({
            title: 'Confirmation',
            text: 'Êtes-vous sûr de vouloir enregistrer ces modifications ?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, enregistrer',
            cancelButtonText: 'Annuler',
        }).then((result) => {
            if (result.isConfirmed) {
                // Si l'utilisateur clique sur "Oui, enregistrer", soumettre le formulaire
                document.querySelector("#confirmationForm").submit();
            }
            // Sinon, rien ne se produit
        });
    }
</script>

{{-- Afficher un messages d'erreur survenu lors de l'enregistrement de l'actualité. --}}
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
{{-- Message en cas d'enregistrement réussie. --}}
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

        setTimeout(function() {
            window.location.href = '{{ route('liste_des_actualites') }}';
        }, 4000);
    });
</script>
@endif







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
