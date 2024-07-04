
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
              <h2 class="mb-0">{{$project->name}}</h2>
            </div>

            <div class="row mt-8" style="margin: 20px">
                <form method="post" action="{{ route('update_project', ['id' => $project->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <div class="row g-4 pt-50">
                                <img src="{{asset('logo/logo.png')}}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4 mb-lg-0">
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
                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputAddress1">Nom</label>
                                    <input class="form-control" id="inputAddress1" name="name" type="text" placeholder="Nom du projet *" value="{{$project->name}}" required/>
                                </div>

                                <div class="col-12" style="display: none">
                                    <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputAddress1">ID</label>
                                    <input class="form-control" id="inputAddress1" name="user_id" type="text" value="{{Auth::guard('manager')->user()->id}}" placeholder="Oject *" />
                                </div>

                                <div class="col-12">
                                    <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputAddress1">Date de debut</label>
                                    <input type="datetime-local" class="form-control" name="start_time" value="{{$project->start_time}}" required>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputAddress1">Date de debut</label>
                                    <input type="datetime-local" class="form-control" name="end_time" value="{{$project->end_time}}" required>
                                </div>


                                <div class="col-12">
                                    <label class="form-label fs-8 text-body-highlight ps-0 text-transform-none" for="inputAddress1">Description</label>
                                    <textarea id="content" class="form-control" name="content" type="text" placeholder="Description *" required>{{$project->content}}</textarea>
                                </div>

                                <div class="col-lg-12">
                                    <button class="btn btn-primary mb-2 px-8 px-sm-11 me-2" type="submit" >Enregistrer</button>
                                    <a href="#"><button class="btn btn-phoenix-secondary text-nowrap" type="button">Effacer</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
              </div>
          </div>
        </div>
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


<script>
  document.addEventListener('DOMContentLoaded', function() {
      const editModal = document.getElementById('editProjectBtn');
      const productIdInput = editModal.querySelector('input[name="user_id"]');
      const productNameInput = editModal.querySelector('input[name="name"]');
      const productStartTimeInput = editModal.querySelector('input[name="start_time"]');
      const productEndTimeInput = editModal.querySelector('input[name="end_time"]');
      const productContentTextarea = editModal.querySelector('textarea[name="content"]');

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
